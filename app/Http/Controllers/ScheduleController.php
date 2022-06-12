<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleStoreRequest;
use App\Http\Requests\ScheduleUpdateRequest;
use App\Models\Classroom;
use App\Models\Schedule;
use Carbon\Carbon;
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
        
        $verificationSchedule = $this->scheduleVerification($request);
        if ($verificationSchedule) {
            try {
                $schedule= Schedule::create([
                    'classroom_id' =>$request->classroom_id ,
                    'day'=> $request->day,
                    'start_time'=>$request->start_time,
                    'finish_time'=>$request->finish_time
                ]);
                $schedule->save();
                flash('Se ha registrado el horario correctamente')->success();
                return redirect(route('schedules.index'));

            } catch (\Exception $e) {
                flash('Ha ocurrido un error al crear el horario')->error();
                return back();
            }
        } else {
            flash('Ya existe un horario')->error();
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

    //funcion para validar si se puede agregar un horario de disponibilidad para un aula
    public function scheduleVerification($request)
    {
        //traemos en la condicion una coleccion de horarios que se correspondan con el dia que tiene el request
        $schedule = Schedule::where('classroom_id', $request->classroom_id)->where('day', $request->day)->get();
        $start_time_request = Carbon::parse($request->start_time)->format('H:i:s');;
        $finish_time_request = Carbon::parse($request->finish_time)->format('H:i:s');;
        $flag = true;
        $i = 0;
        if (count($schedule) > 0) {
            //recorremos la coleccion, trayendo el horario de inicio y fin existente por posicion del arreglo
            while ($i < count($schedule) && $flag = true) {
                $start_time = $schedule[$i]->start_time;
                $finish_time = $schedule[$i]->finish_time;
                //mejor no preguntar que hace la condicion(si el horario de inicio del aula pisa un  rango de horario
                //ya existente O la hora de fin pisa un rango de horario existente no puede cargar la disponibilidad )
                if (($start_time_request >= $start_time && $start_time_request <= $finish_time) ||
                    ($finish_time_request >= $start_time && $finish_time_request <= $finish_time)) {
                    $flag = false;
                }
                $i++;
            }
        }
        return $flag;
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
