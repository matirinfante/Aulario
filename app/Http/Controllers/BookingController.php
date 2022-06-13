<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Booking;
use App\Models\Classroom;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BookingRequest;
use Hamcrest\Arrays\IsArray;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *TODO: filtrar por materia activa
     */
    public function index()
    {
        $bookings = [];
        $bookings_assignments = [];

        if (auth()->user()->hasAnyRole('teacher', 'user')) {
            $bookings = DB::table('bookings')
                ->join('events', 'bookings.event_id', '=', 'events.id')
                ->join('classrooms', 'bookings.classroom_id', '=', 'classrooms.id')
                ->where('user_id', '=', auth()->user()->id)
                ->get(['bookings.id as booking_id', 'bookings.description as booking_description', 'bookings.booking_date as booking_date', 'bookings.start_time as start_time', 'bookings.finish_time as finish_time', 'bookings.status as status',
                    'events.event_name as event_name', 'classrooms.classroom_name as classroom_name']);

        } else if (auth()->user()->hasRole('admin')) {
            $bookings = DB::table('bookings')
                ->join('events', 'bookings.event_id', '=', 'events.id')
                ->join('classrooms', 'bookings.classroom_id', '=', 'classrooms.id')
                ->get(['bookings.id as booking_id', 'bookings.description as booking_description', 'bookings.booking_date as booking_date', 'bookings.start_time as start_time', 'bookings.finish_time as finish_time', 'bookings.status as status',
                    'events.event_name as event_name', 'classrooms.classroom_name as classroom_name']);

            $bookings_assignments = DB::table('bookings')
                ->join('assignments', 'bookings.assignment_id', '=', 'assignments.id')
                ->join('classrooms', 'bookings.classroom_id', '=', 'classrooms.id')
                ->get(['bookings.id as booking_id', 'bookings.description as booking_description', 'bookings.booking_date as booking_date', 'bookings.start_time as start_time', 'bookings.finish_time as finish_time', 'bookings.status as status',
                    'assignments.assignment_name as assignment_name', 'classrooms.classroom_name as classroom_name']);
        }
        return view('booking.index', compact('bookings', 'bookings_assignments',));
    }

    /**
     * Show the form for creating a new resource.
     *TODO: enviar solamente eventos creados por el usuario. Si es super usuario, enviar todo.
     */
    public function create()
    {
        $classrooms = Classroom::all();
        //$booking_type = [];
        $assignments=[];
        $events=[];
        if (auth()->user()->hasRole('admin')) {
            //$booking_type = Assignment::all();
            $assignments=Assignment::all();
            $events=Event::all();
        } else if (auth()->user()->hasAnyRole('teacher', 'user')) {
            //$booking_type = Event::with('user_id', auth()->user()->id); //pero no hay relación xd
            $events=Event::with('user_id', auth()->user()->id);
        }

        return view('booking.create', compact('assignments','events', 'classrooms'));
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
            if ($request->assignment_id) {
                //Se carga la reserva de la materia según el user_id asociado.
                $assignment = Assignment::findOrFail($request->assignment_id);
                $user_id = $assignment->users()->first();
            } else {
                //Ya ni me acuerdo que estaba pensando pero lo dejo porsiaca
                //$event = Event::findOrCreate('event_name', $request->event_name);
                $event = Event::findOrFail($request->event_id);
                $user_id = $event->user_id;
                //$event->user_id;
            }
            $reservas=count($request->classroom_id);
            //dd($reservas);
            //Dependiendo de la cantidad de aulas seleccionadas es la cantidad de reservas a crear
            for($i=0;$i<$reservas;$i++){
                //dd($i);
                $booking= Booking::create([
                    'user_id' => $user_id,
                    'classroom_id' => $request->classroom_id[$i],
                    'assignment_id' => $request->assignment_id,
                    'event_id' => $request->event_id,
                    'description' => $request->description,
                    'status' => 'pending',
                    'week_day' => $request->week_day,
                    'booking_date' =>$request->booking_date,
                    'start_time' =>$request->start_time,
                    'finish_time' =>$request->finish_time
                ]);
            }
            //Para testear
            // $booking= Booking::create([
            //     'user_id' => 5,
            //     'classroom_id' => 3,
            //     'assignment_id' => 5,
            //     'event_id' => 3,
            //     'description' => 'basura',
            //     'status' => 'pending',
            //     'week_day' => 'Lunes',
            //     'booking_date' => '1970-12-14',
            //     'start_time' => '10:49:17',
            //     'finish_time' => '03:36:00'
            // ]);

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
    public function update(BookingRequest $request, $id)
    {

        try {
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
