<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('getRandomAyat')) {
    function getRandomAyat()
    {
        $response = Http::get('https://quran-api-id.vercel.app/random');

        if ($response->successful()) {
            $data = $response->json();
            // $text = $data['text'];
            // return $text;
            return $data;
        }

        return null;
    }
}
