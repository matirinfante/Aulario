<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Logbook;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $today_logbook = Logbook::where('date', Carbon::today()->format('Y-m-d'))->get();

        if ($today_logbook->isEmpty()) {
            $today_logbook = $this->generarLogbook();
        }
        return view('logbook.index', compact('today_logbook'));
    }

    /**
     * Función que se encarga de generar el logbook del dia solo si este no se ha creado con anterioridad.
     * Busca dentro de lo
     ** @return array
     */
    public function generarLogbook()
    {

        try {
            //$today_bookings = Booking::where('booking_date', Carbon::today()->format('Y-m-d'))->get();
            $today_bookings = DB::table('bookings')
                ->join('classrooms', 'bookings.classroom_id', '=', 'classrooms.id')
                ->where('booking_date', '=', Carbon::today()->format('Y-m-d'))
                ->where('status', '=', 'pending')
                ->where('classrooms.building', '=', 'Informática')->get();
            foreach ($today_bookings as $booking) {
                Logbook::create([
                    'booking_id' => $booking->id,
                    'date' => Carbon::today()->format('Y-m-d')]);
            }
            $today_logbook = Logbook::where('date', Carbon::today()->format('Y-m-d'))->get();
            return $today_logbook;
        } catch (\Exception $e) {
            return $today_logbook = [];
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
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
    public function show(Logbook $logbook)
    {
        //
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
        //TODO:Acá va la lógica de chequeo QR
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
        $check_user = User::where('uuid', $request->data)->first();

        if ($check_user) {
            $response = ['status' => 'success', 'info' => $check_user->name . ' ' . $check_user->surname];
            return $response;
        } else {
            $response = ['status' => 'error', 'info' => 'No se ha encontrado firma vinculada a ningún usuario'];
            return $response;
        }
    }

    /**
     * Función utilizada para firmar la llegada a una reserva
     */
    public function signCheckIn(Request $request)
    {
        $user = User::where('uuid', $request->data)->first();
        try {
            if ($user) {
                $logbookEntry = Logbook::where('id', $request->id)->get();
                $bookingEntry = Booking::where('id', $logbookEntry->booking_id)->get();

                $bookingEntry->status = 'in_progress';

                $logbookEntry->user_id = $user->id;
                $logbookEntry->check_in = Carbon::now()->format('H:i:s');

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

    }
}
