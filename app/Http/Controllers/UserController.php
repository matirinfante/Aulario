<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $users = User::withTrashed()->get();
        return view('user.index', compact('users'));
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
    public function store(UserRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'dni' => $request->dni,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            flash('Se ha registrado correctamente el nuevo usuario')->success();
            return redirect(route('users.show', $user->id));
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
    public function update(UserRequest $request, User $user)
    {
        //no se modifica la contraseña del usuario
        //TODO: validar request con UserRequest
        try {
            $user->update($request->input());

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
