<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Booking;
use App\Models\Classroom;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        //Problema: si evento o assignment es nulo en la BD no retorna nada. Hotfix: solo mostrar horarios fijos
        if (auth()->user()->hasRole('teacher')) {
            $bookings = DB::table('bookings')
                ->join('events', 'bookings.event_id', '=', 'events.id')
                ->join('classrooms', 'bookings.classroom_id', '=', 'classrooms.id')
                ->where('user_id', '=', auth()->user()->id)
                ->get(['bookings.id as booking_id', 'bookings.description as booking_description', 'bookings.booking_date as booking_date', 'bookings.start_time as start_time', 'bookings.finish_time as finish_time', 'bookings.status as status',
                    'events.event_name as event_name', 'classrooms.classroom_name as classroom_name']);

        } else if (auth()->user()->hasRole('admin')) {
            $bookings_event = DB::table('bookings')
                ->join('events', 'bookings.event_id', '=', 'events.id')
                ->join('classrooms', 'bookings.classroom_id', '=', 'classrooms.id')
                ->get(['bookings.id as booking_id', 'bookings.description as booking_description', 'bookings.booking_date as booking_date', 'bookings.start_time as start_time', 'bookings.finish_time as finish_time', 'bookings.status as status',
                    'events.event_name as event_name', 'classrooms.classroom_name as classroom_name']);

            $bookings_assignments = DB::table('bookings')
                ->join('assignments', 'assignments.assignments_id', '=', 'assignments.id')
                ->join('classrooms', 'bookings.classroom_id', '=', 'classrooms.id')
                ->get(['bookings.id as booking_id', 'bookings.description as booking_description', 'bookings.booking_date as booking_date', 'bookings.start_time as start_time', 'bookings.finish_time as finish_time', 'bookings.status as status',
                    'events.event_name as event_name', 'classrooms.classroom_name as classroom_name']);
        }
        return view('booking.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *TODO: enviar solamente eventos creados por el usuario. Si es super usuario, enviar todo.
     */
    public function create()
    {
        $assignments = Assignment::all();
        $events = Event::all();
        $classrooms = Classroom::all();

        return view('booking.create', compact('assignments', 'events', 'classrooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * TODO:implementar store de Booking
     */
    public function store(Request $request)
    {
        try {
            if ($request->assignment) {
                //Se carga la reserva de la materia según el user_id asociado.
                $assignment = Assignment::findOrFail($request->assignment_id);
                //$assignment->user_id;
            } else {
                //Ya ni me acuerdo que estaba pensando pero lo dejo porsiaca
                $event = Event::findOrFail($request->event_id);
                //$event->user_id;
            }

            //Añadir lógica restante

            flash('Se ha agregado una nueva reserva con éxito')->success();
            return redirect(route('bookings.index'));
        } catch (\Exception $e) {
            flash('Ha ocurrido un error al agregar una nueva reserva')->error();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show(Booking $booking)
    {
        return view('booking.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit(Booking $booking)
    {
        $assignments = Assignment::all();
        $events = Event::all();
        $classrooms = Classroom::all();
        return view('booking.edit', compact('booking', 'assignments', 'events', 'classrooms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function update(Request $request, $id)
    {

        try {
            $request->validate([
                'assignment_id' => 'integer',
                'event_id' => 'integer',
                'user_id' => 'required|integer',
                'description' => 'string',
                'start_time' => 'required',
                'finish_time' => 'required'
            ]);

            $booking = Booking::findOrFail($id)->fill($request->all());

            $booking->save();

            flash('Reserva modificada con éxito')->success();
            return redirect(route('bookings.index'));
        } catch (\Exception $e) {
            flash('Ha ocurrido un error al actualizar la reserva')->error();
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
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect(route('bookings.index'));
    }

    /**
     * Se encarga de cambiar el estado de la reserva
     * TODO: implementar estado de la reserva
     */
    public function changeStatus(Booking $booking)
    {

    }

    /**
     * Muestra solo reservas de materias
     * TODO: implementar mostrar solo reservas de materias
     */
    public function showSchedule()
    {

    }
}
