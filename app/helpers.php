<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('getRandomAyat')) {
    function getRandomAyat()
    {
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
    }
}
