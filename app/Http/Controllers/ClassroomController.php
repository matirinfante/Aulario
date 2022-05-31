<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classroom = Classroom::all();
        return view('classroom.index', compact('classroom'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classroom.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'classroom_name' => 'required|unique|alpha_num',
            'location' => 'required',
            'capacity' => 'required|integer',
            'type' => 'required|alpha'
        ]);

        $classroom = new Classroom([
            'classroom_name' => $request->classroom_name,
            'location' => $request->location,
            'capacity' => $request->capacity,
            'type' => $request->type,
        ]);
        $classroom->save();
        return redirect()->route('classroom.index')->with('success', 'Aula guardada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classroom = Classroom::find($id);
        return view('classroom.show', compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classroom = Classroom::find($id);
        return view('classroom.edit', compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'classroom_name' => 'required|unique|alpha_num',
            'location' => 'required',
            'capacity' => 'required|integer',
            'type' => 'required|alpha'
        ]);
        
        $classroom = Classroom::find($id);
        $classroom->classroom_name = $request->classroom_name;
        $classroom->location = $request->location;
        $classroom->capacity = $request->capacity;
        $classroom->type = $request->type;

        $classroom->save();
        return redirect()->route('classroom.index')->with('success', 'Aula modificada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classroom = Classroom::find($id);
        $classroom->delete();
        return redirect()->route('classroom.index')->with('success', 'Aula borrada con exito');
    }
}
