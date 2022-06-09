<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AssignmentRequest;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = Assignment::withTrashed()->get();
        $users = User::all();

        return view('assignment.index', compact('assignments', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('assignment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssignmentRequest $request)
    {
        try {
            $assignment = Assignment::create([
                'assignment_name' => $request->assignment_name,
                'active' => 0,
                'start_date' => $request->start_date,
                'finish_date' => $request->finish_date
            ]);
            $assignment->users()->sync((array)$request->input('user_id'));
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
    public function update(AssignmentRequest $request, Assignment $assignment)
    {
        try {
            $assignment->update($request->all());
            $assignment->users()->sync((array)$request->input('user_id'));
            flash('Materia modificada con éxito')->success();
            return redirect(route('assignments.index'));
        } catch (\Exception $e) {
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

// Reactiva la materia
    public function activateAssignment($id)
    {
        $assignment = Assignment::withTrashed()->where('id', $id)->restore();
        flash('Materia habilitada correctamente')->success();
        return back();
    }

    /**
     * Alterna el estado activo que representa el cuatrimestre de actividad.
     *
     * ¿Mejorable? 5000 rows = 5.47676s
     */
    public function toggleSemester()
    {
        $actives = Assignment::withTrashed()->get();

        foreach ($actives as $active) {
            $active->update(['active' => ($active->active == 1 ? 0 : 1)]);
        }
        dd($actives);
    }
}

