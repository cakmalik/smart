<?php

namespace Database\Seeders;

use App\Models\FormatMessage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormatMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FormatMessage::create(
            [
                'name' => 'reminder_registration',
                'label' => 'Pengingat Pendaftaran',
                'message' => 'Assalamualaikum #nama_ortu, #enter #enter Terima kasih telah berkenan untuk mendaftar di PP Miftahul Ulum Bakid. #enter Kami mengingatkan bahwa hari ini Pendaftaran Santri Baru telah dibuka. #enter #enter Jangan lupa melanjutkan pengisian data santri di website bakid.id #enter #enter Terima kasih, #enter #panitia_psb_2023',
            ]
        );
    }
}
