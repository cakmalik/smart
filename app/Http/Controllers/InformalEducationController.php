<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInformalEducationRequest;
use App\Http\Requests\UpdateInformalEducationRequest;
use App\Models\Informal\InformalEducation;
use ProtoneMedia\Splade\Facades\Toast;

class InformalEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = InformalEducation::all();
        // dd($data);
        return view('bakid.education.informal.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInformalEducationRequest $request)
    {
        InformalEducation::create($request->all());
        Toast::success('Berhasil menambah data')->autoDismiss(3);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(InformalEducation $informal)
    {
        return view('bakid.education.informal.show', compact('informal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InformalEducation $informalEducation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInformalEducationRequest $request, InformalEducation $informalEducation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InformalEducation $informalEducation)
    {
        //
    }
}
