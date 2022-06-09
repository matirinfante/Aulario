<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleStoreRequest;
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
        $schedule = Schedule::all();
        $classrooms = Classroom::all();
        return view('schedule.index', compact('schedule', 'classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('schedule.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleStoreRequest $request)
    {
        try {

        } catch (\Exception $e) {

        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\schedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
