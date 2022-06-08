<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomStoreRequest;
use App\Http\Requests\ClassroomUpdateRequest;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $classrooms = Classroom::all();
        $buildings = ['Informática', 'Economía', 'Humanidades', 'Aulas comunes', 'Biblioteca'];

        return view('classroom.index', compact('classrooms', 'buildings'));
    }

    /**
     * Show the form for creating a new resource
     *
     */
    public function create()
    {
        return view('classroom.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(ClassroomStoreRequest $request)
    {
        try {
            $classroom = Classroom::create([
                'classroom_name' => $request->classroom_name,
                'location' => $request->location,
                'capacity' => $request->capacity,
                'type' => $request->type,
                'building' => $request->building,
                'available_start' => $request->available_start,
                'available_finish' => $request->available_finish,
            ]);
            $classroom->save();
            flash('Se ha añadido un nuevo aula con éxito')->success();
            return redirect(route('classrooms.index'));
        } catch (\Exception $e) {
            flash('Ha ocurrido un error al crear un nuevo aula')->error();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show(Classroom $classroom)
    {
        return view('classroom.show', compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit(Classroom $classroom)
    {
        return view('classroom.edit', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function update(ClassroomUpdateRequest $request, $id)
    {
        try {
            $classroom = Classroom::findOrFail($id)->fill($request->all());

            $classroom->save();

            flash('Se ha actualizado el aula con éxito')->success();
            return redirect(route('classrooms.index'));
        } catch (\Exception $e) {
            flash('Ha ocurrido un error al actualizar el aula')->error();
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy(Classroom $classroom)
    {
        $classroom->delete();
        return redirect(route('classrooms.index'));
    }
}
