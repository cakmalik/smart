<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use App\Tables\Bakid\Education\Informal\Kelas;
use App\Models\Informal\InformalEducationClass;
use App\Tables\Bakid\Education\Informal\AcademicYear;
use App\Http\Requests\StoreInformalEducationClassRequest;
use App\Http\Requests\UpdateInformalEducationClassRequest;

class InformalEducationClassController extends Controller
{
  
    protected $model;
    public function __construct()
    {
        $this->model = new InformalEducationClass();
    }
    public function index()
    {
        return view('bakid.education.informal.class.index', ['data' => Kelas::class, 'title' => 'Class']);
    }

    public function activate(InformalEducationClass $academic_year){
        // off all academic year
        InformalEducationClass::where('is_active', true)->update(['is_active' => false]);
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
    public function store(StoreInformalEducationClassRequest $request)
    {
        $education_id = auth()->user()->InformalEducations?->first()->id;
        $code = $request->year . $request->semester;
        if (InformalEducationClass::where('code', $code)->exists()) {
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
    public function show(InformalEducationClass $academic_year)
    {
        return view('bakid.education.informal.academic_year.show', ['data' => $academic_year]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreInformalEducationClassRequest $request, InformalEducationClass $academic_year)
    {

        $code = $request->year . $request->semester;
        if (InformalEducationClass::where('code', $code)
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
    public function destroy(InformalEducationClass $academic_year)
    {
        $academic_year->delete();
        Toast::success('Tahun Akademik ' . $academic_year->code . ' berhasil di hapus');
        return back();
    }
}