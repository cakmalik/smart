<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormalEducationRequest;
use App\Http\Requests\UpdateFormalEducationRequest;
use App\Models\Formal\FormalEducation;
use ProtoneMedia\Splade\Facades\Toast;

class FormalEducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = FormalEducation::all();
        // dd($data);
        return view('bakid.education.formal.index', compact('data'));
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
    public function store(StoreFormalEducationRequest $request)
    {
        FormalEducation::create($request->all());
        Toast::success('Berhasil menambah data')->autoDismiss(3);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(FormalEducation $formal)
    {
        return view('bakid.education.formal.show', compact('formal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FormalEducation $formalEducation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormalEducationRequest $request, FormalEducation $formalEducation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FormalEducation $formalEducation)
    {
        //
    }
}
