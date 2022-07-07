<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Booking;
use App\Models\Classroom;
use App\Models\Event;
use App\Models\Logbook;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\Assign;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        if (auth()->user()->hasAnyRole('admin', 'bedel')) {
            $classrooms = Classroom::where('building', 'Informática')->get(['id']);
            $bookings = Booking::whereIn('classroom_id', $classrooms)->get(['id']);
            $today_logbook = Logbook::where('date', Carbon::now()->setTimezone('America/Argentina/Buenos_Aires')->format('Y-m-d'))->whereIn('booking_id', $bookings)->get();

            return view('logbook.index', compact('today_logbook'));
        } else {
            return abort(403);
        }
    }

    /**
     * Función que se encarga de generar el logbook del dia solo si este no se ha creado con anterioridad.
     * Busca dentro de logbook
     * Unused
     **
     */
    public function generarLogbook()
    {

        try {
            //$today_bookings = Booking::where('booking_date', Carbon::today()->format('Y-m-d'))->get();
            $today_bookings = DB::table('bookings')
                ->join('classrooms', 'bookings.classroom_id', '=', 'classrooms.id')
                ->where('booking_date', '=', Carbon::today()->format('Y-m-d'))
                ->where('status', '=', 'pending')
                ->where('classrooms.building', '=', 'Informática')->get(['bookings.id', 'bookings.booking_date']);

            foreach ($today_bookings as $booking) {

                Logbook::create([
                    'booking_id' => $booking->id,
                    'date' => Carbon::today()->format('Y-m-d')]);
            }
            $today_logbook = Logbook::where('date', Carbon::today()->format('Y-m-d'))->get();
            Log::info($today_logbook);
            return $today_logbook;
        } catch (\Exception $e) {
            return $today_logbook = [];
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public
    function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Logbook $logbook
     */
    public function show(Logbook $logbook, Request $request)
    {
        $user = User::where('user_uuid', $request->uuid)->first();

        return view('logbook.show', compact('logbook', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Logbook $logbook
     */
    public function edit(Logbook $logbook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Logbook $logbook
     */
    public function update(Request $request, Logbook $logbook)
    {
        try {
            $logbook->commentary = $request->commentary;
            $logbook->save();
            return redirect(route('logbooks.index'))->with('success', 'Se ha cargado el comentario exitosamente');
        } catch (\Exception $e) {
            return back()->with('error', 'Ha ocurrido un error al cargar el comentario');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Logbook $logbook
     */
    public function destroy(Logbook $logbook)
    {
        //
    }

    /**
     * Función utilizada para corroborar firma y retornar información para confirmar la llegada a una reserva
     */
    public function checkSign(Request $request)
    {
        if ($request->decodedData) {
            $response = json_decode($request->decodedData, true);
            $checkBooking = Booking::where('booking_uuid', $response['b-uuid'])->first();
            //Chequeamos que exista una reserva para ese identificador
            if ($checkBooking) {
                //Chequeamos que esa reserva corresponda a una entrada del libro de entrada válida para esa fecha (doble chequeo)
                $logbookCheck = Logbook::where('booking_id', $checkBooking->id)->where('date', Carbon::today()->format('Y-m-d'))->first();
                if ($logbookCheck) {
                    //Verificamos que el usuario dentro de la búsqueda pertenezca al conjunto de usuarios de la materia o evento
                    $checkUser = User::where('user_uuid', $response['u-uuid'])->first();
                    if (isset($checkBooking->assignment_id)) {
                        $assignment = Assignment::where('id', $checkBooking->assignment_id)->first();
                        $inAssignment = $assignment->users->where('id', $checkUser->id)->first();
                        if ($inAssignment) {
                            //El chequeo es exitoso, se retorna el logbook_id.
                            return ['status' => 'success', 'url' => url('logbooks') . '/' . $logbookCheck->id . '?uuid=' . $checkUser->user_uuid];
                        }
                    } else if (isset($checkBooking->event_id)) {
                        $event = Event::where('id', $checkBooking->event_id)->first();
                        //Regla conflictiva ¯\_(ツ)_/¯
                        $inEvent = $event->user->id === $checkUser->id;
                        if ($inEvent) {
                            return ['status' => 'success', 'url' => url('logbooks') . '/' . $logbookCheck->id . '?uuid=' . $checkUser->user_uuid];
                        }
                    }
                }
            }
        } else if ($request->token) {
            $logbook = Logbook::findOrFail($request->logbook_id);
            $checkUser = User::where('personal_token', $request->token)->first();
            $booking = $logbook->booking;

            //El codigo no corresponde a ningun usuario
            if ($checkUser) {
                //Se verifica que sea un profesor de la materia
                if ($booking->assignment) {
                    $assignment = $booking->assignment;
                    if ($assignment->users->where('id', $checkUser->id)->first()) {
                        return redirect(url('logbooks') . '/' . $request->logbook_id . '?uuid=' . $checkUser->user_uuid);
                    }
                } else if ($booking->event) {
                    $inEvent = $booking->event->users->id === $checkUser->id;
                    if ($inEvent) {
                        return redirect(url('logbooks') . '/' . $request->logbook_id . '?uuid=' . $checkUser->user_uuid);
                    }
                }
            }
            return back()->with('error', 'No se ha podido verificar la validez de uno o más datos');
        }
        return ['status' => 'error', 'message' => 'No se ha podido verificar la validez de uno o más datos'];
    }

    /**
     * Función utilizada para firmar la llegada a una reserva
     */
    public function signCheckIn(Request $request)
    {
        $user = User::where('user_uuid', $request->uuid)->first();
        try {
            if ($user) {
                $logbookEntry = Logbook::where('id', $request->logbook_id)->first();
                $bookingEntry = Booking::where('id', $logbookEntry->booking_id)->first();

                $bookingEntry->status = 'in_progress';

                $logbookEntry->user_id = $user->id;
                $logbookEntry->check_in = Carbon::now()->setTimezone('America/Argentina/Buenos_Aires')->format('H:i:s');

                $bookingEntry->save();
                $logbookEntry->save();

                return redirect(route('logbooks.index'))->with('success', 'Entrada correctamente firmada');
            } else {
                return redirect(route('logbooks.index'))->with('error', 'Ha ocurrido un error al firmar la entrada');
            }
        } catch (\Exception $e) {
            return redirect(route('logbooks.index'))->with('error', 'Ha ocurrido un error al firmar la entrada');
        }
    }

    /**
     * Función utilizada para firmar una salida de una reserva previamente firmada
     */
    public function signCheckOut(Request $request)
    {
        try {
            $logbook = Logbook::findOrFail($request->logbook_id);
            $logbook->check_out = Carbon::now()->setTimezone('America/Argentina/Buenos_Aires')->format('H:i:s');
            $booking = $logbook->booking;
            $booking->status = 'finished';

            $logbook->save();
            $booking->save();
            flash('Se ha registrado la salida exitosamente')->success();
            return redirect(route('logbooks.index'))->with('success', 'Se ha registrado la salida exitosamente');
        } catch (\Exception $e) {
            flash('Ha ocurrido un error al registrar la salida')->error();
            return back()->with('error', 'Ha ocurrido un error al registrar la salida');
        }
    }

    /**
     * Función que se encarga de retornar los registros del libro de llegada que corresponden a una fecha previamente seleccionada.
     * Se espera su manejo mediante AJAX
     *
     * @param Request $request con la key date con la fecha correspondiente a la seleccionada
     * @return array $logbook con los datos correspondientes a la fecha seleccionada
     */
    public function getHistoryLogbook(Request $request)
    {
        $classrooms = Classroom::where('building', 'Informática')->get(['id']);
        $bookings = Booking::whereIn('classroom_id', $classrooms)->get(['id']);
        $logbook = Logbook::where('date', Carbon::parse($request->date)->format('Y-m-d'))->whereIn('booking_id', $bookings)->get();

        $response = collect();
        foreach ($logbook as $entry) {
            $data = [
                'name' => $entry->booking->assignment ? $entry->booking->assignment->assignment_name : $entry->booking->event->event_name,
                'classroom_name' => $entry->booking->classroom->classroom_name,
                'user_name' => $entry->user ? $entry->user->name . ' ' . $entry->user->surname : 'No disp',
                'date' => $entry->date,
                'check_in' => $entry->check_in,
                'check_out' => $entry->check_out,
                'commentary' => $entry->commentary];
            $response[] = $data;
        }
        return $response;
    }
}
