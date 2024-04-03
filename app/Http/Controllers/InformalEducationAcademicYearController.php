<?php

namespace App\Http\Controllers;

use ProtoneMedia\Splade\Facades\Toast;
use App\Tables\Bakid\Education\Informal\AcademicYear;
use App\Models\Informal\InformalEducationAcademicYear;
use App\Http\Requests\StoreInformalEducationAcademicYearRequest;
use App\Http\Requests\UpdateInformalEducationAcademicYearRequest;

class InformalEducationAcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $model;
    public function __construct()
    {
        $this->model = new InformalEducationAcademicYear();
    }
    public function index()
    {
        return view('bakid.education.informal.academic_year.index', ['data' => AcademicYear::class, 'title' => 'Tahun Akademik']);
    }

    public function activate(InformalEducationAcademicYear $academic_year){
        // off all academic year
        InformalEducationAcademicYear::where('is_active', true)->update(['is_active' => false]);
        $academic_year->is_active = true;
        $academic_year->save();
        Toast::success('Tahun Akademik ' . $academic_year->code . ' aktif')->autoDismiss(5);
        return back();
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
        $education_id = auth()->user()->InformalEducations?->first()->id;
        $code = $request->year . $request->semester;
        if (InformalEducationAcademicYear::where('code', $code)->exists()) {
           Toast::danger('Tahun Akademik sudah ada');
           return back();
        }

        try {
            $this->model->create([
                'code' => $code,
                'year' => $request->year,
                'semester' => $request->semester,
                'start_date' =>inputDateFormat($request->start_date),
                'end_date' => inputDateFormat($request->end_date),
                'is_active' => false,
                'informal_education_id' => $education_id
            ]);

            Toast::success('Tahun Akademik berhasil ditambahkan');
            return back();
        } catch (\Exception $e) {
            Toast::danger($e->getMessage());
        }
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