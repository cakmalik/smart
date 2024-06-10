<?php

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Haruncpi\LaravelIdGenerator\IdGenerator;

if (!function_exists('getRandomAyat')) {
    function getRandomAyat()
    {
        try {
            $response = Http::get('https://quran-api-id.vercel.app/random');

            if ($response->successful()) {
                $data = $response->json();
                $fix['ayat'] = $data['arab'];
                $fix['arti'] = $data['translation'];

                $secondaryUrl = $data['image']['secondary'];

                $pattern_surat_ke = '/\/(\d+)\//';
                preg_match($pattern_surat_ke, $secondaryUrl, $matches);
                $surat_ke = $matches[1];

                $pattern_ayat_ke = '/\/\d+\/(\d+)/';
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
        if($phoneNumber == null){
            return null;
        }
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

if (!function_exists('generateNIS')) {
    function generateNIS()
    {
        $config = [
            'table' => 'students',
            'field' => 'nis',
            'length' => 6,
            'prefix' => date('y'),
            'reset_on_prefix_change' => true
        ];
        return IdGenerator::generate($config);
    }
}

if (!function_exists('countBrothers')) {
    function countBrothers($student_id)
    {
        $s = Student::find($student_id);
        return Student::where('user_id', $s->user_id)->count();
    }
}

if (!function_exists('statusLabel')) {
    function statusLabel($status)
    {
        switch ($status) {
            case 'unpaid':
                return 'Menunggu pembayaran';
                break;
            case 'drat':
                return 'Tersimpan';
                break;
            case 'sent':
                return 'Terkirim';
                break;

            default:
                'Menunggu pembayaran';
                break;
        }
    }
}

if (!function_exists('formatRupiah')) {
    function formatRupiah($angka)
    {
        $hasil_rupiah = 'Rp ' . number_format($angka, 2, ',', '.');
        return $hasil_rupiah;
    }
}

if (!function_exists('statusBgColor')) {
    function statusBgColor($status)
    {
        switch ($status) {
            case 'unpaid':
                return 'bg-yellow-300';
                break;
            case 'drat':
                return 'bg-gray-300';
                break;
            case 'sent':
                return 'bg-blue-300';
                break;
            case 'waiting':
                return 'bg-blue-300';
                break;
            case 'paid':
                return 'bg-green-300';
                break;
            case 'canceled':
                return 'bg-red-300';
                break;
            case 'reject':
                return 'bg-red-300';
                break;
            case 'expired':
                return 'bg-red-300';
                break;

            default:
                'bg-gray-300';
                break;
        }
    }
}

if (!function_exists('statusTextColor')) {
    function statusTextColor($status)
    {
        switch ($status) {
            case 'unpaid':
                return 'text-yellow-800';
                break;
            case 'drat':
                return 'text-gray-800';
                break;
            case 'sent':
                return 'text-blue-800';
                break;
            case 'waiting':
                return 'text-blue-800';
                break;
            case 'paid':
                return 'text-green-800';
                break;
            case 'canceled':
                return 'text-red-800';
                break;
            case 'reject':
                return 'text-red-800';
                break;
            case 'expired':
                return 'text-red-800';
                break;

            default:
                'text-gray-800';
                break;
        }
    }
}

if (!function_exists('isHasStudents')) {
    function isHasStudents()
    {
        $s = Student::where('user_id', auth()->user()->id)->count();
        return $s;
    }
}

if (!function_exists('numberToRoman')) {
    function numberToRoman($number)
    {
        $map = ['M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1];
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
}
if (!function_exists('inputDateFormat')) {
    function inputDateFormat($date)
    {
        return date('Y-m-d', strtotime($date));
    }
}