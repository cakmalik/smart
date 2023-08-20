<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorJPG;
use Picqer\Barcode\BarcodeGeneratorPNG;
use ProtoneMedia\Splade\Facades\Toast;

class DocumentController extends Controller
{
    public function kts(string $nis, $action = 'preview')
    {
        $dataSantri = Student::where('nis', $nis)->first();
        $dataSantri->load('parent');

        if (!$dataSantri) {
            Toast::danger('data tidak ditemukan')->autoDismiss(2);
            return back();
        }

        return $this->generateKts($dataSantri, $action);
    }

    public function generateKts($dataSantri, string $action = 'preview') //preview or download
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

        // Tambahkan barcode ke kanvas gambar
        $barcodeImage = $this->generateBarcode('123456');
        $image->insert($barcodeImage, 'top-left', 3300, 1600);

        // Tanggal terdaftar
        $fontPath = public_path('fonts/PlusJakartaSans-SemiBold.ttf');
        $image->text(Carbon::now()->translatedFormat('d F Y'), 3300, 2100, function ($font) use ($fontPath) {
            $font->file($fontPath);
            $font->size(110);
            $font->color('#ffffff');
            $font->align('left');
            $font->valign('top');
        });

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
        $tgl_lhr = Carbon::parse($dataSantri->date_of_birth)->translatedFormat('d/m/Y');
        $tableText = ": {$dataSantri->nis} \n: {$dataSantri->name} \n: Asrama \n: {$dataSantri->place_of_birth}, {$tgl_lhr} \n \n: {$dataSantri->village} \n: {$dataSantri->district} \n: {$dataSantri->city} \n: {$dataSantri->parent?->father_name} \n: {$dataSantri->phone}";
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


        if ($action == 'download') {
            $file_name = $dataSantri->nis . '.jpg';
            $path = 'storage/kts/' . $file_name;
            $image->save(public_path($path));
            return response()->download(public_path($path));
        } else {
            $image->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $temporaryImagePath = 'storage/temp_images/' . $dataSantri->nis . '.jpg';
            $image->save(public_path($temporaryImagePath));

            // Return URL
            return asset($temporaryImagePath);
        }
    }

    public function generateBarcode(string $kode)
    {
        // Dapatkan kode barcode
        $barcode = $kode ?? '123456';

        // Inisialisasi Barcode Generator untuk JPG
        $barcodeGenerator = new BarcodeGeneratorJPG();

        // Dapatkan binary data barcode sebagai JPG
        $barcodeJPG = $barcodeGenerator->getBarcode($barcode, $barcodeGenerator::TYPE_CODE_128);

        // Simpan binary data JPG barcode ke file sementara
        $barcodeTempPath = tempnam(sys_get_temp_dir(), 'barcode');
        file_put_contents($barcodeTempPath, $barcodeJPG);

        // Buat gambar dari file sementara
        $barcodeImage = Image::make($barcodeTempPath);

        // Tentukan tinggi dan padding untuk barcode
        $barcodeWidth = 1300; // Ganti dengan lebar yang diinginkan
        $paddingTop = 50; // Ganti dengan jumlah padding atas yang diinginkan

        // Resize barcode image to the desired height and add padding
        $barcodeImage->resize($barcodeWidth, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        return $barcodeImage;
    }
}
