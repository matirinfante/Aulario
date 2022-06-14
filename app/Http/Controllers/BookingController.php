<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Booking;
use App\Models\Classroom;
use App\Models\Event;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BookingRequest;
use Hamcrest\Arrays\IsArray;
use Spatie\Period\Period;
use Spatie\Period\Precision;

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
        //$booking_type = [];
        $assignments = [];
        $events = [];
        if (auth()->user()->hasRole('admin')) {
            //$booking_type = Assignment::all();
            $assignments = Assignment::all();
            $events = Event::all();
        } else if (auth()->user()->hasAnyRole('teacher', 'user')) {
            //$booking_type = Event::with('user_id', auth()->user()->id); //pero no hay relación xd
            $events = Event::with('user_id', auth()->user()->id);
        }

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
            $reservas = count($request->classroom_id);
            //Dependiendo de la cantidad de aulas seleccionadas es la cantidad de reservas a crear
            for ($i = 0; $i < $reservas; $i++) {
                $booking = Booking::create([
                    'user_id' => $user_id,
                    'classroom_id' => $request->classroom_id[$i],
                    'assignment_id' => $request->assignment_id,
                    'event_id' => $request->event_id,
                    'description' => $request->description,
                    'status' => 'pending',
                    'week_day' => $request->week_day,
                    'booking_date' => $request->booking_date,
                    'start_time' => $request->start_time,
                    'finish_time' => $request->finish_time
                ]);
            }

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
     * TODO: no se edita
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
     *
     *
     */
    public function getGaps()
    {
        $totalTime = Schedule::where('classroom_id', 3)->get(['start_time', 'finish_time']);
        $availability = array();

        foreach ($totalTime as $times) {
            $start_date = Carbon::today()->setTimeFromTimeString($times->start_time . ':00')->format('Y-m-d H:i:s');
            $finish_date = Carbon::today()->setTimeFromTimeString($times->finish_time)->format('Y-m-d H:i:s');

            $availability[] = Period::make($start_date, $finish_date, Precision::MINUTE());
        }
        $date = Carbon::createFromFormat('Y-m-d', '2021-09-24');
        $reservedEvents = Booking::where('classroom_id', 3)->where('booking_date', $date->format('Y-m-d'))->get(['start_time', 'finish_time']);

        $reservedAssignments = Booking::where('classroom_id', 3)->where('week_day', ucfirst($date->dayName))->get();
        dd($reservedEvents);
        return $availability;
    }

}
