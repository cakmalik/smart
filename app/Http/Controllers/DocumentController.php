<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorJPG;
use Picqer\Barcode\BarcodeGeneratorPNG;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DocumentController extends Controller
{
    public function kartuMahram(string $nis, $action = 'preview')
    {
        $dataSantri = Student::where('nis', $nis)->first();
        $dataSantri->load('parent', 'room', 'dormitory', 'user');
        return $this->generateKartuMahram($dataSantri, $action);
    }

    public function kts(string $nis, $action = 'preview')
    {
        $dataSantri = Student::where('nis', $nis)->first();
        $dataSantri->load('parent', 'room', 'dormitory', 'user');

        if (!$dataSantri) {
            Toast::danger('data tidak ditemukan')->autoDismiss(2);
            return back();
        }

        return $this->generateKts($dataSantri, $action);
    }

    public function generateKts($dataSantri, string $action = 'preview') //preview or download
    {
        ini_set('memory_limit', '-1');
        try {
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

            QrCode::format('png')->size(900)->generate($dataSantri->user?->kk, public_path('storage/qrcode/' . $dataSantri->nis . '.png'));
            $qrCodeImage = Image::make(imagecreatefrompng(public_path('storage/qrcode/' . $dataSantri->nis . '.png')));
            $image->insert($qrCodeImage, 'top-right', 120, 1000);

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
            if (count($dataSantri->dormitory) == 0) {
                $asrama = '';
            } else {
                $asrama = $dataSantri->dormitory[0]?->name . '' . $dataSantri->room[0]?->name;
            }

            $tableText = ": {$dataSantri->nis} \n: {$dataSantri->name} \n: {$asrama} \n: {$dataSantri->place_of_birth}, {$tgl_lhr} \n \n: {$dataSantri->village} \n: {$dataSantri->district} \n: {$dataSantri->city} \n: {$dataSantri->parent?->father_name} \n: {$dataSantri->phone}";
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
                // return true;
                // Toast::success('kartu tanda santri berhasil dibuat')->autoDismiss(2);
                // return redirect()->back();
                // Return URL
                // return asset($temporaryImagePath);
            }
            // Toast::success('kartu tanda santri berhasil dibuat')->autoDismiss(2);
            // return back();
        } catch (\Exception $e) {

            Log::error('kts gagal dibuat ' . $e->getMessage() . ' - ' . $e->getLine());
            return false;
        }
    }

    public function generateKartuMahram($dataSantri, string $action = 'preview') //preview or download
    {
        try {
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
            $backgroundImage = Image::make(public_path('bakid/kartu/k_mahram.jpg'));
            $background->insert($backgroundImage, 'center');
            $image->insert($background);

            //make qrcode
            $qrCode = QrCode::format('png')->size(550)->generate($dataSantri->user?->kk, public_path('storage/qrcode/kk' . $dataSantri->user?->kk . '.png'));
            $qrCodeImage = Image::make(imagecreatefrompng(public_path('storage/qrcode/kk' . $dataSantri->user?->kk . '.png')));
            $image->insert($qrCodeImage, 'bottom-left', 390, 300);

            // ...
            // Insert the parent photo
            try {
                if ($dataSantri->parent?->parent_image != null) {
                    $fotoOrtu = Image::make(public_path('storage/parent-photos/' . $dataSantri->parent?->parent_image));
                } else {
                    $fotoOrtu = Image::make(public_path('bakid/default-profile.png'));
                }
            } catch (\Exception $e) {
                // Jika terjadi kesalahan saat membuka gambar, tangani di sini
                // Anda dapat memberikan fallback gambar atau melakukan tindakan lain
                $fotoOrtu = Image::make(public_path('bakid/default-profile.png'));
            }

            // Determine the dimensions of the larger canvas
            $canvasWidth = 1200; // Ganti dengan lebar canvas yang Anda inginkan
            $canvasHeight = 1500; // Ganti dengan tinggi canvas yang Anda inginkan

            // Create the canvas
            $canvas = Image::canvas($canvasWidth, $canvasHeight);

            // Fit the parent's photo to the canvas and position it in the center
            $fotoOrtu->fit($canvasWidth, $canvasHeight, null, 'center');

            // Add border radius
            $radius = 50; // Ganti dengan nilai radius yang Anda inginkan
            $fotoOrtu->rectangle(0, 0, $fotoOrtu->width(), $fotoOrtu->height(), function ($draw) use ($radius) {
                $draw->border($radius, '#ffffff'); // Border radius dan warna dapat disesuaikan
            });

            // Insert the resized and bordered parent's photo to the canvas
            $canvas->insert($fotoOrtu);

            // Insert the canvas to the main image
            $image->insert($canvas, 'bottom-right', 210, 400);

            // Set the border radius on the original image
            $radius = 50; // You can adjust this value based on your preference
            $image->circle($radius * 2, $canvas->width() / 2, $canvas->height() / 2, function ($draw) {
                $draw->border(5, '#ffffff'); // You can adjust the border width and color
            });
            // ...

            // Tanggal terdaftar
            $fontPath = public_path('fonts/PlusJakartaSans-SemiBold.ttf');
            $image->text(Carbon::now()->translatedFormat('d F Y'), 2270, 2230, function ($font) use ($fontPath) {
                $font->file($fontPath);
                $font->size(80);
                $font->color('#000000');
                $font->align('left');
                $font->valign('top');
            });

            // Tambahkan label (gunakan metode yang sesuai dengan kebutuhan Anda)
            $tableText = "NO INDUK \nNama \nAsrama \nOrang Tua/Wali \nAlamat";
            $tableLines = explode("\n", $tableText);
            $tableX = 350; // Koordinat horizontal awal
            $tableY = 1090; // Koordinat vertikal awal
            $tableLineHeight = 170; // Tinggi baris tabel

            foreach ($tableLines as $tableLine) {
                // Jika baris berisi "Desa", tambahkan spasi di sebelah kiri
                if (strpos($tableLine, 'Desa') !== false || strpos($tableLine, 'Kecamatan') !== false || strpos($tableLine, 'Kota/Kab') !== false) {
                    $image->text('       ' . $tableLine, $tableX, $tableY, function ($font) use ($fontRegularPath) {
                        $font->file($fontRegularPath);
                        $font->size(120);
                        $font->color('#000000');
                        $font->align('left');
                        $font->valign('top');
                    });
                } else {
                    $image->text($tableLine, $tableX, $tableY, function ($font) use ($fontRegularPath) {
                        $font->file($fontRegularPath);
                        $font->size(120);
                        $font->color('#000000');
                        $font->align('left');
                        $font->valign('top');
                    });
                }
                $tableY += $tableLineHeight;
            }

            // Tambahkan value
            if (count($dataSantri->dormitory) == 0) {
                $asrama = '';
            } else {
                $asrama = $dataSantri->dormitory[0]?->name . '' . $dataSantri->room[0]?->name;
            }
            $addr = $dataSantri->village . ', ' . $dataSantri->district;
            $tableText = ": {$dataSantri->nis} \n: {$dataSantri->name} \n: {$asrama} \n: {$dataSantri->parent?->father_name} \n: {$addr} \n  {$dataSantri->city}";
            $tableLines = explode("\n", $tableText);
            $tableX = 1260; // Koordinat horizontal awal
            $tableY = 1090; // Koordinat vertikal awal
            $tableLineHeight = 170; // Tinggi baris tabel

            foreach ($tableLines as $tableLine) {
                // Jika baris berisi "Desa", tambahkan spasi di sebelah kiri

                $image->text($tableLine, $tableX, $tableY, function ($font) use ($fontSemiboldPath) {
                    $font->file($fontSemiboldPath);
                    $font->size(120);
                    $font->color('#000000');
                    $font->align('left');
                    $font->valign('top');
                });

                $tableY += $tableLineHeight;
            }


            if ($action == 'download') {
                $file_name = $dataSantri->user?->kk . '.jpg';
                $path = 'storage/k_mahram/' . $file_name;
                $image->save(public_path($path));
                return response()->download(public_path($path));
            } else {
                $image->resize(500, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $temporaryImagePath = 'storage/temp_images/kk' . $dataSantri->user?->kk . '.jpg';
                $image->save(public_path($temporaryImagePath));

                // Return URL
                return asset($temporaryImagePath);
            }
            return true;
        } catch (\Exception $e) {
            dd($e->getMessage() . ' - ' . $e->getLine());
            return false;
            Log::error('kartu mahram gagal dibuat ' . $e->getMessage() . ' - ' . $e->getLine());
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