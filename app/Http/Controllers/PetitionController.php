<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        $assignments = Assignment::where('user_id', $user->id)->get();

        return view('petition.create', compact($assignments));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Petition $petition
     * @return \Illuminate\Http\Response
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
    public function update(Request $request, Petition $petition)
    {
        //no
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Petition $petition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Petition $petition)
    {
        //
    }

    public function changeStatus(Petition $petition){

    }


}
