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
                'steps' => json_encode([
                    "Mendatangi kantor kami di Pondok pesantren PP Miftahul Ulum Banyuputih Kidul Lumajang",
                    "Berikan Kode beserta uang tunai kepada Petugas",
                    "Petugas memberikan bukti pembayaran berupa Nota/struk atau",
                    "Petugas mengirimkan bukti pembayaran ke email/wa anda",
                    "Transaksi sukses, simpan bukti transaksi Anda"
                ])
            ],
            // Tambahkan data dummy lainnya sesuai dengan format JSON
        ];

        foreach ($paymentInstructions as $instruction) {
            PaymentInstruction::create($instruction);
        }
    }
}
