<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleStoreRequest;
use App\Http\Requests\ScheduleUpdateRequest;
use App\Models\Classroom;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $schedules = Schedule::all();
        $classrooms = Classroom::all();
        return view('schedule.index', compact('schedules', 'classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('schedule.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(ScheduleStoreRequest $request)
    {
        try {
            Schedule::create([$request->all()])->save();

            flash('Se ha registrado el horario correctamente')->success();
            return redirect(route('schedules.index'));
        } catch (\Exception $e) {
            flash('Ha ocurrido un error al crear el horario')->error();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\schedule $schedule
     */
    public function show(Schedule $schedule)
    {
        return view('schedule.show', compact('schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\schedule $schedule
     */
    public function edit(Schedule $schedule)
    {
        return view('schedule.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\schedule $schedule
     */
    public function update(ScheduleUpdateRequest $request, Schedule $schedule)
    {
        try {
            $schedule->update($request->all());
            flash('Se ha actualizado el horario correctamente')->success();

            return redirect(route('schedules.index'));
        } catch (\Exception $e) {
            flash('Ha ocurrido un error al actualizar el horario')->error();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\schedule $schedule
     */
    public function destroy(Schedule $schedule)
    {
        try {
            $schedule->delete();
            flash('Se ha eliminado el horario correctamente')->success();
            return redirect(route('schedules.index'));
        } catch (\Exception $e) {
            flash('Ha ocurrido un error al borrar el horario')->error();
            return back();
        }
    }
}
