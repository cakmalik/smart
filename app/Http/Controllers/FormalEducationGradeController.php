<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormalEducationGradeRequest;
use App\Http\Requests\UpdateFormalEducationGradeRequest;
use App\Models\Formal\FormalEducationGrade;

class FormalEducationGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreFormalEducationGradeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FormalEducationGrade $formalEducationGrade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FormalEducationGrade $formalEducationGrade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormalEducationGradeRequest $request, FormalEducationGrade $formalEducationGrade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FormalEducationGrade $formalEducationGrade)
    {
        //
    }
}
