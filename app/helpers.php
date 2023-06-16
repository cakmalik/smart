<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

if (!function_exists('getRandomAyat')) {
    function getRandomAyat()
    {
        try {
            $response = Http::get('https://quran-api-id.vercel.app/random');

            if ($response->successful()) {
                $data = $response->json();
                $fix['ayat'] = $data['arab'];
                $fix['arti'] = $data['translation'];

                $secondaryUrl  = $data['image']['secondary'];

                $pattern_surat_ke = "/\/(\d+)\//";
                preg_match($pattern_surat_ke, $secondaryUrl, $matches);
                $surat_ke = $matches[1];

                $pattern_ayat_ke = "/\/\d+\/(\d+)/";
                preg_match($pattern_ayat_ke, $secondaryUrl, $matches);
                $ayat_ke = $matches[1];


                $surah = Http::get('https://quran-api-id.vercel.app/surahs/' . $surat_ke);
                if ($surah->successful()) {
                    $surah = $surah->json();
                    $fix['surat'] = $surah['name'];
                    $fix['surat_ke'] = $surat_ke;
                    $fix['ayat_ke'] = $ayat_ke;
                }

                return $fix;
            }

            return null;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }
}

function formatPhoneNumber($phoneNumber)
{
    // Menghapus karakter selain angka
    $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

    // Jika nomor dimulai dengan 0, gantikan dengan 62
    if (substr($phoneNumber, 0, 1) === '0') {
        $phoneNumber = '62' . substr($phoneNumber, 1);
    }

    // Jika nomor dimulai dengan +62, hapus tanda +
    if (substr($phoneNumber, 0, 3) === '+62') {
        $phoneNumber = '62' . substr($phoneNumber, 3);
    }

    return $phoneNumber;
}
