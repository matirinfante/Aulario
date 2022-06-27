<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventStoreRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $events = Event::withTrashed()->get();
        return view('event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(EventStoreRequest $request)
    {
        try {
            $event = Event::create([
                'event_name' => $request->event_name,
                'participants' => $request->participants,
                'user_id' =>$request->user_id
            ]);
            $event->save();
            flash('Se ha creado un nuevo evento con éxito')->success();
            return redirect(route('events.index'));
        } catch (\Exception $e) {
            flash('Ha ocurrido un error al crear un nuevo evento')->error();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show(Event $event)
    {
        return view('event.show', compact('event'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit(Event $event)
    {
        return view('event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function update(EventStoreRequest $request, $id)
    {
        try {
            $event = Event::findOrFail($id)->fill($request->all());

            $event->save();

            flash('Evento modificado con éxito')->success();
            return redirect(route('events.index'));
        } catch (\Exception $e) {
            flash('Ha ocurrido un error al actualizar el evento')->error();
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
        try {
            $event = Event::find($id);
            $event->delete();
            flash('Se ha deshabilitado correctamente el evento');
            return redirect(route('events.index'));
        } catch (\Exception $e) {
            flash('Ha ocurrido un error al deshabilitar el evento');
            return redirect(route('events.index'));
        }

    }

    /**
     * Reactiva el evento
     */
    public function activateEvent($id)
    {
        Event::withTrashed()->where('id', $id)->restore();
        flash('Se ha habilitado correctamente el evento');
        return back();
    }

}
