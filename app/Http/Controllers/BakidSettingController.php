<?php

namespace App\Http\Controllers;

use App\Models\BakidSetting;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreBakidSettingRequest;
use App\Http\Requests\UpdateBakidSettingRequest;

class BakidSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('bakid.setting.index');
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
    public function store(StoreBakidSettingRequest $request)
    {
        if ($request->api_key_whatsapp) {
            // dd($request->all());
            $bakidSetting = BakidSetting::firstOrCreate(['name' => 'api_key_whatsapp']);
            $bakidSetting->value = $request->api_key_whatsapp;
            $bakidSetting->save();
        }

        Toast::title('Sukses!')
            ->message('Pengaturan berhasil diperbarui.')
            ->success()
            ->rightTop()
            ->backdrop()
            ->autoDismiss(5);
    }

    /**
     * Display the specified resource.
     */
    public function show(BakidSetting $bakidSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BakidSetting $bakidSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBakidSettingRequest $request, BakidSetting $bakidSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BakidSetting $bakidSetting)
    {
        //
    }
}
