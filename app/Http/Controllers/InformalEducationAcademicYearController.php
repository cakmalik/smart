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
        return view('bakid.education.informal.academic_year.index', ['data' => AcademicYear::class, 'title' => 'Academic Year']);
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
    public function show(InformalEducationAcademicYear $academic_year)
    {
        return view('bakid.education.informal.academic_year.show', ['data' => $academic_year]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreInformalEducationAcademicYearRequest $request, InformalEducationAcademicYear $academic_year)
    {

        $code = $request->year . $request->semester;
        if (InformalEducationAcademicYear::where('code', $code)
        ->where('id', '!=', $academic_year->id)->exists()) {
            Toast::danger('Tahun Akademik sudah ada')->autoDismiss(3);
            return back();
        }
        
        try{
            $academic_year->update([
                'code' => $code,
                'year' => $request->year,
                'semester' => $request->semester,
                'start_date' =>inputDateFormat($request->start_date),
                'end_date' => inputDateFormat($request->end_date), 
            ]);
            Toast::success('Tahun Akademik berhasil di ubah')->autoDismiss(3);
        }
        catch(\Exception $e){
            Toast::danger($e->getMessage())->autoDismiss(3);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InformalEducationAcademicYear $academic_year)
    {
        $academic_year->delete();
        Toast::success('Tahun Akademik ' . $academic_year->code . ' berhasil di hapus');
        return back();
    }
}