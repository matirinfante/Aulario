<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $assignments = Assignment::all();
        return view('assignment.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $users = User::all();
        return view('assignment.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'assignment_name' => 'required',
            'user_id' => 'required'
        ]);

        $assignment = Assignment::create([
            'assignment_name' => $request->assignment_name,
            'user_id' => $request->user_id
        ]);
        $assignment->save();
        return redirect()->route('assignment.index')->with('success', 'Asignatura guardada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $assignment = Assignment::find($id);
        return view('assignment.show', compact('assignment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit($id)
    {
        $assignment = Assignment::find($id);
        $users = User::all();
        return view('assignment.edit', compact('assignment', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Request $request, $id)
    {
        //
        $assignment = Assignment::find($id);
        $assignment->assignment_name = $request->assignment_name;
        $assignment->user_id = $request->user_id;

        $assignment->save();
        return redirect()->route('assignment.index')->with('success', 'Asignatura modificada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $assignment = Assignment::find($id);
        $assignment->delete();
        return redirect()->route('assignment.index')->with('success', 'Asignatura borrada con exito');
    }
}
