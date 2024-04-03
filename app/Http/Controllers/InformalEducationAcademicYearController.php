<?php

namespace App\Http\Controllers;

use App\Tables\Bakid\Education\Informal\AcademicYear;
use App\Models\Informal\InformalEducationAcademicYear;
use App\Http\Requests\StoreInformalEducationAcademicYearRequest;
use App\Http\Requests\UpdateInformalEducationAcademicYearRequest;

class InformalEducationAcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('bakid.education.informal.academic_year.index', 
        ['data' => AcademicYear::class, 
                'title' => 'Tahun Akademik'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bakid.education.informal.academic_year.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInformalEducationAcademicYearRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(InformalEducationAcademicYear $informalEducationAcademicYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InformalEducationAcademicYear $informalEducationAcademicYear)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInformalEducationAcademicYearRequest $request, InformalEducationAcademicYear $informalEducationAcademicYear)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InformalEducationAcademicYear $informalEducationAcademicYear)
    {
        //
    }
}