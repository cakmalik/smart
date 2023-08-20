<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class DocumentController extends Controller
{
    public function generateKts()
    {
        // Buat kanvas gambar dengan lebar dan tinggi tertentu
        // $width = 85.60 * 300 / 25.4; // sekitar 1011 piksel
        // $height = 53.98 * 300 / 25.4; // sekitar 638 piksel
        $width = 5037;
        $height = 3081;
        $fontSemiboldPath = public_path('fonts/PlusJakartaSans-SemiBold.ttf');
        $fontRegularPath = public_path('fonts/PlusJakartaSans-Regular.ttf');


        $image = Image::canvas($width, $height, '#ffffff');

        // Buat gambar latar belakang dengan ukuran yang sama seperti kanvas
        $background = Image::canvas($width, $height);
        $backgroundImage = Image::make(public_path('bakid/kartu/kts.jpg'));
        $background->insert($backgroundImage, 'center');
        $image->insert($background);

        // Tambahkan foto profil
        // $profileImage = Image::make(public_path('bakid/bg-bakid.png'));
        // $profileImage->resize(150, 150);
        // $image->insert($profileImage, 'top-left', 30, 30);

        // Tanggal terdaftar
        $fontPath = public_path('fonts/PlusJakartaSans-SemiBold.ttf');
        $image->text(Carbon::now()->translatedFormat('d F Y'), 3300, 2100, function ($font) use ($fontPath) {
            $font->file($fontPath);
            $font->size(110);
            $font->color('#ffffff');
            $font->align('left');
            $font->valign('top');
        });

        // // paragraf
        // $paragraphText = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut varius malesuada urna a facilisis.";
        // $paragraphLines = explode("\n", wordwrap($paragraphText, 40)); // Pisahkan teks ke dalam baris
        // $y = 300; // Koordinat vertikal awal
        // $lineHeight = 120; // Tinggi baris
        // foreach ($paragraphLines as $line) {
        //     $image->text($line, 50, $y, function ($font) {
        //         $font->file(public_path('fonts/PlusJakartaSans-Regular.ttf'));
        //         $font->size(120);
        //         $font->color('#ffffff');
        //         $font->align('left');
        //         $font->valign('top');
        //     });
        //     $y += $lineHeight;
        // }

        // Tambahkan label (gunakan metode yang sesuai dengan kebutuhan Anda)
        $tableText = "NO INDUK \nNama \nAsrama \nTempat, Tgl Lahir \nAlamat \nDesa \nKecamatan \nKota/Kab \nAyah \nNo HP";
        $tableLines = explode("\n", $tableText);
        $tableX = 200; // Koordinat horizontal awal
        $tableY = 1050; // Koordinat vertikal awal
        $tableLineHeight = 200; // Tinggi baris tabel

        foreach ($tableLines as $tableLine) {
            // Jika baris berisi "Desa", tambahkan spasi di sebelah kiri
            if (strpos($tableLine, 'Desa') !== false || strpos($tableLine, 'Kecamatan') !== false || strpos($tableLine, 'Kota/Kab') !== false) {
                $image->text('       ' . $tableLine, $tableX, $tableY, function ($font) use ($fontRegularPath) {
                    $font->file($fontRegularPath);
                    $font->size(120);
                    $font->color('#ffffff');
                    $font->align('left');
                    $font->valign('top');
                });
            } else {
                $image->text($tableLine, $tableX, $tableY, function ($font) use ($fontRegularPath) {
                    $font->file($fontRegularPath);
                    $font->size(120);
                    $font->color('#ffffff');
                    $font->align('left');
                    $font->valign('top');
                });
            }
            $tableY += $tableLineHeight;
        }


        // Tambahkan value
        $tableText = ": NO INDUK \n: Nama \n: Asrama \n: Tempat, Tgl Lahir \n: Alamat \n: Desa \n: Kecamatan \n: Kota/Kab \n: Ayah \n: No HP";
        $tableLines = explode("\n", $tableText);
        $tableX = 1250; // Koordinat horizontal awal
        $tableY = 1050; // Koordinat vertikal awal
        $tableLineHeight = 200; // Tinggi baris tabel

        foreach ($tableLines as $tableLine) {
            // Jika baris berisi "Desa", tambahkan spasi di sebelah kiri

            $image->text($tableLine, $tableX, $tableY, function ($font) use ($fontSemiboldPath) {
                $font->file($fontSemiboldPath);
                $font->size(120);
                $font->color('#ffffff');
                $font->align('left');
                $font->valign('top');
            });

            $tableY += $tableLineHeight;
        }


        // Simpan gambar sebagai file
        // $outputPath = public_path('generated_id_card.jpg');
        // $image->save($outputPath);

        // return response()->download($outputPath)->deleteFileAfterSend();
        // return $image->response('jpg');
        $temporaryImagePath = 'temp_images/generated_id_card.jpg';
        $image->save(public_path($temporaryImagePath));

        // Mengembalikan URL gambar sementara
        return asset($temporaryImagePath);
    }
}
