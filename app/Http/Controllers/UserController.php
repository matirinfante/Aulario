<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Assignment;
use App\Models\User;
use Carbon\Carbon;
use Hashids\Hashids;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Ramsey\Uuid\Uuid;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        if (auth()->user()->hasAnyRole('admin')) {
            $users = User::withTrashed()->get();
            return view('user.index', compact('users'));
        } else {
            return abort(403);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(UserStoreRequest $request)
    {
        try {
            $newHashid = new Hashids('aulario', 6, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
            $key = $request->dni + Carbon::now()->milliseconds + env('RND_KEY');
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'dni' => $request->dni,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user_uuid' => Uuid::uuid4(),
                'personal_token' => Hash::make($newHashid->encode($key))
            ]);
            if ($request->role == 'teacher') {
                $user->assignRole('teacher');
            } else if ($request->role == 'bedel') {
                $user->assignRole('bedel');
            } else {
                $user->assignRole('user');
            }
            //dd(QrCode::generate($user->dni, url('/qrstorage/qr' . $user->surname . '.svg')));
            flash('Se ha registrado correctamente el nuevo usuario')->success();
            return redirect(route('users.index'));
        } catch (\Exception $e) {
            flash('Ha ocurrido un error al registrar al usuario')->error();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function update(UserUpdateRequest $request, $id)
    {
        //no se modifica la contraseña del usuario
        //TODO: validar request con UserRequest

        try {
            $user = User::withTrashed()->findOrFail($id);
            $lastRole = $user->roles()->first()->name;
            $user->update($request->input());
            $user->removeRole($lastRole);
            switch ($request->role) {
                case 'admin':
                    $user->assignRole('admin');
                    break;
                case 'user':
                    $user->assignRole('user');
                    break;
                case 'teacher':
                    $user->assignRole('teacher');
                    break;
                case 'bedel':
                    $user->assignRole('bedel');
                    break;
            }
            flash('Se actualizó correctamente al usuario')->success();
            return redirect(route('users.index'));

        } catch (\Exception $e) {
            flash('Ha ocurrido un error al actualizar al usuario')->error();
            return back();
        }
    }

    /**
     * Eliminar un usuario según un determinado id. Si lo encuentra, se "reemplazan" sus
     * referencias en materias y se cancelan reservas de eventos. Si no lo encuentra,
     * retorna error.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            flash('Se eliminó correctamente al usuario')->success();
            return redirect(route('users.index'));

        } catch (\Exception $e) {
            flash('Ha ocurrido un error al eliminar el usuario')->error();
            return back();
        }
    }


    /**
     * Reactiva al usuario
     * @return https://music.youtube.com/watch?v=-eGM0IJc70Y&feature=share
     * TODO:borrar esta referencia en prod
     */
    public function activateUser($id)
    {
        $user = User::withTrashed()->where('id', $id)->restore();
        flash('Usuario habilitado correctamente')->success();
        return back();
    }
}
