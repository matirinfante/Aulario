<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = Assignment::withTrashed()->get();
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
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'assignment_name' => 'required',
            ]);

            $assignment = Assignment::create([
                'assignment_name' => $request->assignment_name,
            ]);
            $assignment->users()->sync((array)$request->input('users'));
            $assignment->save();
            flash('La materia se ha cargado exitosamente')->success();
            return redirect(route('assignments.index'));
        } catch (\Exception $e) {
            flash('Ha ocurrido un error al añadir la materia')->error();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show(Assignment $assignment)
    {
        $teachers = $assignment->users()->get();
        return view('assignment.show', compact('assignment', 'teachers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit(Assignment $assignment)
    {
        $teachers = $assignment->users()->get();
        return view('assignment.edit', compact('assignment', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     *TODO:sincronizar profes con materia sync()
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'assignment_name' => 'required',
            ]);

            $assignment = Assignment::findOrFail($id)->fill($request->all());

            $assignment->save();

            flash('Materia modificada con éxito')->success();
            return redirect(route('assignments.index'));
        } catch (\Exception $e) {
            dd('llegue');
            flash('Ha ocurrido un error al actualizar la materia')->error();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        try {
            $assignment = Assignment::findOrFail($id);
            $assignment->delete();
            flash('Materia eliminada con éxito')->success();
            return redirect(route('assignments.index'));

        } catch (\Exception $e) {
            flash('Ha ocurrido un error al eliminar la materia')->error();
            return back();
        }
    }
}
