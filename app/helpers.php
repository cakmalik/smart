<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

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

if (!function_exists('formatPhoneNumber')) {
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
}

if (!function_exists('invoiceNumber')) {
    function invoiceNumber($student_id)
    {
        return 'INV-' . $student_id . '-' . date('YmdHis');
    }
}

if (!function_exists('formatMessage')) {
    function formatMessage($pesan, $placeholders, $values)
    {
        $pesanFormatted = str_replace($placeholders, $values, $pesan);
        return $pesanFormatted;
    }
}

if (!function_exists('roleName')) {
    function roleName(): string
    {
        return auth()->user()->roles[0]->name;
    }
}
if (!function_exists('generateUniqueUsername')) {
    function generateUniqueUsername($name)
    {
        // Ubah name menjadi lowercase dan hapus whitespace
        $username = Str::slug(strtolower($name), '');

        // Cek apakah username sudah ada dalam database
        $isUnique = false;
        $counter = 1;

        while (!$isUnique) {
            $tempUsername = $username;
            if ($counter > 1) {
                $tempUsername .= $counter;
            }

            // Lakukan pengecekan ke database untuk memastikan username unik
            $existingUser = User::where('username', $tempUsername)->first();

            if (!$existingUser) {
                $isUnique = true;
                $username = $tempUsername;
            }

            $counter++;
        }

        return $username;
    }
}
