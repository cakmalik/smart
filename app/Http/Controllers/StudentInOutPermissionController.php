<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentInOutPermissionRequest;
use App\Http\Requests\UpdateStudentInOutPermissionRequest;
use App\Models\Student\StudentInOutPermission;
use App\Repositories\InOutPermission\InOutPermissionRepository;
use App\Repositories\Student\StudentRepository;
use ProtoneMedia\Splade\Facades\Toast;

class StudentInOutPermissionController extends Controller
{

    private $studentRepo;
    private $model;
    public function __construct(StudentRepository $srepo, InOutPermissionRepository $inOut)
    {
        $this->middleware('role:hankamtib');
        $this->studentRepo = $srepo;
        $this->model = $inOut;
    }

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
    public function store(StoreStudentInOutPermissionRequest $request)
    {
        $student = $this->studentRepo->findNis($request->nis);
        if ($this->model->isLoggedOut($student->id)) {
            $store = $this->model->storeOut($student->id);
        } else {
            $store = $this->model->storeIn($student->id, $request);
        }

        if ($store['success']) {
            Toast::success($store['message'])->centerBottom()->autoDismiss(3);
        } else {
            Toast::danger($store['message'])->centerBottom()->autoDismiss(3);
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentInOutPermission $studentInOutPermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentInOutPermission $studentInOutPermission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentInOutPermissionRequest $request, StudentInOutPermission $studentInOutPermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentInOutPermission $studentInOutPermission)
    {
        //
    }
}
