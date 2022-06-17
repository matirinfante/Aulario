<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetitionStoreRequest;
use App\Jobs\SendPetitionNotificationJob;
use App\Jobs\SendPetitionRejectJob;
use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PetitionUpdateRequest;

class PetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $classroom_type = ['Laboratorio', 'Aula común'];
        $weekdays = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
        if (auth()->user()->hasRole('admin')) {
            $petitions = Petition::orderBy('status')->get();
        } else if (auth()->user()->hasRole('teacher')) {
            $petitions = Petition::orderBy('status')->where('user_id', auth()->user()->id)->get();
        } else {
            return abort(403);
        }
        return view('petition.index', compact('petitions', 'classroom_type', 'weekdays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $user = Auth::user();
        $assignments = $user->assignments()->get();

        //TEST ONLY
        //$petition = Petition::where('status', 'unsolved')->first();
        //Mail::to(env('MAIL_ADMIN'))->send(new petitionsMail($petition));
        return view('petition.create', compact('user', 'assignments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(PetitionStoreRequest $request)
    {

        try {
            $petition = Petition::create([
                'user_id' => $request->user_id,
                'assignment_id' => $request->assignment_id,
                'estimated_people' => $request->estimated_people,
                'classroom_type' => $request->classroom_type,
                'start_time' => $request->start_time,
                'finish_time' => $request->finish_time,
                'start_date' => $request->start_date,
                'finish_date' => $request->finish_date,
                'days' => $request->days,
                'message' => $request->message,
                'status' => 'unsolved'
            ]);
            $this->dispatch(new SendPetitionNotificationJob($petition));
            flash('Se ha cargado una nueva petición con éxito')->success();
            return redirect(route('petitions.index'));
        } catch (\Exception $e) {
            flash('Ha ocurrido un error al crear una nueva petición')->error();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Petition $petition
     */
    public function show(Petition $petition)
    {
        return view('petition.show', compact('petition'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Petition $petition
     * @return \Illuminate\Http\Response
     */
    public function edit(Petition $petition)
    {
        //no
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Petition $petition
     */
    public function update(PetitionUpdateRequest $request, $id)
    {
        try {
            $petition = Petition::findOrFail($id)->fill($request->all());

            $petition->save();

            flash('Estado modificado con éxito')->success();
            return redirect(route('petition.index'));
        } catch (\Exception $e) {
            flash('Ha ocurrido un error al actualizar el estado')->error();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Petition $petition
     */
    public function destroy(Petition $petition)
    {
        //no
    }

    /**
     * Se encarga de cambiar el estado de la petición
     * @param Petition $petition
     */

    public function rejectPetition(Request $request, Petition $petition)
    {
        try {
            $petition->status = 'rejected';
            $petition->save();

            $this->dispatch(new SendPetitionRejectJob($petition, $request->input('reason')));
            return redirect(route('petitions.index'));
        } catch (\Exception $e) {
            return back();
        }
    }


}
