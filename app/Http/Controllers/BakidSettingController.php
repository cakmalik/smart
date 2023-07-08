<?php

namespace App\Http\Controllers;

use App\Models\BakidSetting;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreBakidSettingRequest;
use App\Http\Requests\UpdateBakidSettingRequest;
use Psy\Formatter\Formatter;

class BakidSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['api_key_whatsapp'] = BakidSetting::where('name', 'api_key_whatsapp')->first()->value ?? [];
        return view('bakid.setting.index', compact('data'));
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

    public function checkConnection()
    {
        $whatsappService = new \App\Services\WhatsappService();
        $response = $whatsappService->checkConnection('085333920007', 'Test koneksi');
        if ($response['success']) {
            Toast::title('Sukses!')
                ->message($response['message'])
                ->success()
                ->rightTop()
                ->backdrop()
                ->autoDismiss(5);
        } else {
            Toast::title('Gagal!')
                ->message($response['message'])
                ->danger()
                ->rightTop()
                ->backdrop()
                ->autoDismiss(5);
        }
        return back();
    }
}
