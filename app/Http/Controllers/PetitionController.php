<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetitionStoreRequest;
use App\Models\Assignment;
use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\petitionsMail;
use App\Http\Requests\PetitionRequest;
use App\Mail\petitionReject;

class PetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $petitions = Petition::all();
        return view('petition.index', compact('petitions'));
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
        return view('petition.create', compact('user','assignments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *TODO: implementar carga petition
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
            Mail::to(env('MAIL_ADMIN'))->send(new petitionsMail($petition));
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
     * @return \Illuminate\Http\Response
     */
    public function update(PetitionRequest $request, $id)
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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Petition $petition)
    {
        //no
    }

    /**
     * Se encarga de cambiar el estado de la petición
     * @param Petition $petition
     * TODO: implementar cambio de estado de la petición
     */

    public function rejectPetition(Request $request, Petition $petition)
    {
      try {
        $petition->status = 'rejected';
        // $petition->reason = '$request->input('test-input')';
        
        $petition->save();

        // dd($petition->user->email);

        Mail::to($petition->user->email)->send(new petitionReject($request->input('test-reason')));
        
        return back();
        
      } catch (\Exception $e) {
        
      }
    }


}
