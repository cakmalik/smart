<?php

namespace App\Http\Controllers;

use App\Models\BakidSetting;
use Illuminate\Http\Request;
use Psy\Formatter\Formatter;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreBakidSettingRequest;
use App\Http\Requests\UpdateBakidSettingRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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

    public function changeAccessCode(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:1',
            'new_password' => 'required|min:1',
            'confirm_password' => 'required|min:1|same:new_password'
        ]);

        if ($request->old_password != env('KODE_AKSES')) {
            return back()->with('error', 'Password lama tidak sesuai');
        }

        $password = env('KODE_AKSES');
        $newPassword = $request->new_password;

        $path = base_path('.env');
        $getContent = file_get_contents($path);

        if (file_exists($path)) {
            file_put_contents($path, str_replace('KODE_AKSES=' . $password, 'KODE_AKSES=' . $newPassword, $getContent));
        }
        // return
        return back()->with('success', 'Kode akses diubah');
    }


    function changeBackground()
    {
        $current_bg = env('CURRENT_BACKGROUND');
        $path = base_path('.env');
        $getContent = file_get_contents($path);

        // Mendapatkan daftar nama file dari folder "public/bg"
        $backgroundFiles = $this->getBackgroundFiles();

        // Menghitung indeks berikutnya berdasarkan current_background
        $currentIndex = array_search($current_bg, $backgroundFiles);
        $nextIndex = ($currentIndex === false) ? 0 : ($currentIndex + 1) % count($backgroundFiles);

        // Mendapatkan nama background baru berdasarkan indeks berikutnya
        $newBg = $backgroundFiles[$nextIndex];

        if (file_exists($path)) {
            file_put_contents($path, str_replace('CURRENT_BACKGROUND=' . $current_bg, 'CURRENT_BACKGROUND=' . $newBg, $getContent));
        }

        Toast::message('Background diganti');
        return back();
    }



    function getBackgroundFiles()
    {
        $path = public_path('bg');

        if (File::exists($path)) {
            $files = File::files($path);
            $fileNames = [];

            foreach ($files as $file) {
                $fileNames[] = pathinfo($file, PATHINFO_FILENAME);
            }
            return $fileNames;
        }

        return [];
    }
}
