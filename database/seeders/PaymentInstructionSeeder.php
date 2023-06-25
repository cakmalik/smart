<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentInstruction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaymentInstructionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentInstructions = [
            [
                'title' => 'Aplikasi BRImo',
                'payment_method_id' => 1,
                'steps' => '[
                    "Login ke aplikasi BRImo Anda",
                    "Pilih menu <b>BRIVA</b>",
                    "Pilih sumber dana dan masukkan Nomor Pembayaran (<b>{{pay_code}}</b>) lalu klik <b>Lanjut</b>",
                    "Klik <b>Lanjut</b>",
                    "Detail transaksi akan ditampilkan, pastikan data sudah sesuai",
                    "Klik <b>Konfirmasi</b>",
                    "Klik <b>Lanjut</b>",
                    "Masukkan kata sandi ibanking Anda",
                    "Klik <b>Lanjut</b>",
                    "Transaksi sukses, simpan bukti transaksi Anda"
                ]'
            ],
            // Tambahkan data dummy lainnya sesuai dengan format JSON
        ];

        foreach ($paymentInstructions as $instruction) {
            PaymentInstruction::create($instruction);
        }
    }
}
