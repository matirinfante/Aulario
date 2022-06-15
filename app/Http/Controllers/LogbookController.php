<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Logbook;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $today_logbook = Logbook::where('date', Carbon::today()->format('d-m-Y'));
        if (empty($today_logbook)) {
            $today_logbook = $this->generarLogbook();
        }
        return view('logbook.index', compact('today_logbook'));
    }

    /**
     * Función que se encarga de generar el logbook del dia solo si este no se ha creado con anterioridad.
     * Busca dentro de lo
     * @return array
     */

    public function generarLogbook()
    {
        try {
            $today_bookings = Booking::where('date', Carbon::today()->format('Y-m-d'));
            $today_bookings->add(Booking::where('week_day', Carbon::today()->dayName));
            foreach ($today_bookings as $booking) {
                Logbook::create([
                    'booking_id' => $booking->booking_id,
                    'date' => Carbon::today()->format('Y-m-d')]);
            }
            $today_logbook = Logbook::where('date', Carbon::today()->format('Y-m-d'));
            return $today_logbook;
        } catch (\Exception $e) {
            return $today_bookings = [];
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
}
