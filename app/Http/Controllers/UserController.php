<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
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
        //
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'dni' => 'required | unique',
            'email' => 'required | unique',
            'password' => 'required | max:10'
        ]);

        $user = new User([
            'name' => $request->name,
            'surname' => $request->surname,
            'dni' => $request->dni,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $user->save();
        return redirect()->route('user.index')->with('success', 'Usuario guardado con exito');
    }

    /**
     * Display the specified resource.
     *
     */
    public function show($id)
    {
        //
        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
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
        //(requerir a la vista que lo oculte)
        $user = User::find($id);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->dni = $request->dni;

        $user->save();
        return redirect()->route('user.index')->with('success', 'Usuario modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Usuario borrado con exito');
    }
}
