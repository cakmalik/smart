<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentInOutPermissionRequest;
use App\Http\Requests\UpdateStudentInOutPermissionRequest;
use App\Models\Student\StudentInOutPermission;

class StudentInOutPermissionController extends Controller
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
    public function store(StoreStudentInOutPermissionRequest $request)
    {
        //
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
