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

    public function activate(InformalEducationClass $class)
    {
        // off all academic year
        InformalEducationClass::where('is_active', true)->update(['is_active' => false]);
        $class->is_active = true;
        $class->save();
        Toast::success('Kelas ' . $class->code . ' aktif')->autoDismiss(5);
        return back();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bakid.education.informal.class.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInformalEducationClassRequest $request)
    {
        $education_id = auth()->user()->InformalEducations?->first()->id;
        if(InformalEducationClass::where('class_name', $request->class_name)
        ->where('informal_education_id', $education_id)
        ->exists()) {
            Toast::danger('Kelas ' . $request->class_name . ' sudah ada');
            return back();
        }
        
        try {
            $this->model->create([
                'informal_education_id' => $education_id,
                'class_name' => $request->class_name,
                'qty' => $request->qty??0,
                'current_qty' => $request->current_qty??0,
                'class_name_full' => $request->class_name_full ?? null,
                'teacher_id' => $request->teacher_id ?? null,
            ]);

            Toast::success('Kelas berhasil ditambahkan');
            return back();
        } catch (\Exception $e) {
            Toast::danger($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(InformalEducationClass $class)
    {
        return view('bakid.education.informal.class.show', ['data' => $class]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreInformalEducationClassRequest $request, InformalEducationClass $class)
    {
     
        $education_id = auth()->user()->InformalEducations?->first()->id;

        if(InformalEducationClass::where('class_name', $request->class_name)
        ->where('informal_education_id', $education_id)
        ->where('id', '!=', $class->id)
        ->exists()) {
            Toast::danger('Kelas ' . $request->class_name . ' sudah ada');
            return back();
        }
        
        try {
            $class->update([
                'class_name' => $request->class_name,
                'qty' => $request->qty??0,
                'current_qty' => $request->current_qty??0,
                'class_name_full' => $request->class_name_full ?? null,
                'teacher_id' => $request->teacher_id ?? null,
            ]);
            Toast::success('Kelas berhasil di ubah')->autoDismiss(3);
        } catch (\Exception $e) {
            Toast::danger($e->getMessage())->autoDismiss(3);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InformalEducationClass $class)
    {
        $class->delete();
        Toast::success('Kelas ' . $class->code . ' berhasil di hapus');
        return redirect()->back();
    }
}