<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInOutPermissionRequest;
use App\Http\Requests\UpdateInOutPermissionRequest;
use App\Models\Bakid\InOutPermission;

class InOutPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('bakid.permittion.index');
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
    public function store(StoreInOutPermissionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(InOutPermission $inOutPermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InOutPermission $inOutPermission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInOutPermissionRequest $request, InOutPermission $inOutPermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InOutPermission $inOutPermission)
    {
        //
    }
}
