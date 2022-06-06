<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


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
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'surname' => 'required',
                'dni' => 'required | unique:users',
                'email' => 'required | unique:users',
                'password' => 'required'
            ]);
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
    public function update(Request $request, $id)
    {
        //no se modifica la contraseña del usuario
        //TODO: validar request con UserRequest

        try {

            $user = User::findOrFail($id)->fill($request->all());
            $user->save();

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
     * TODO:implementar eliminación/excepción user
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id); //devuelve error si no encuentra
        $assignments = Assignment::where('user_id', $id)->get();
        if (!$assignments->isEmpty()) {

        }
        $user->delete();
        flash('Se eliminó correctamente al usuario')->success();
        return back();
    }
}
