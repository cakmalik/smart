<?php

namespace Database\Seeders;

use App\Models\InvoiceUtility;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InvoiceUtilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $utilities = [
            // psb
            [
                'invoice_category_id' => 1,
                'name' => 'Infaq Gedung',
                'period' => 'once',
                'description' => '-',
                'amount' => 250000,
                'code' => 'infg'
            ],
            [
                'invoice_category_id' => 1,
                'name' => 'Administrasi Pesantren',
                'period' => 'once',
                'description' => '-',
                'amount' => 150000,
                'code' => 'adm-pes'
            ],
            [
                'invoice_category_id' => 1,
                'name' => 'Administrasi Madin',
                'period' => 'once',
                'description' => '-',
                'amount' => 50000,
                'code' => 'adm-madin'
            ],
            [
                'invoice_category_id' => 1,
                'name' => 'Buku Profil & Miftahus surur',
                'period' => 'once',
                'description' => '-',
                'amount' => 50000,
                'code' => 'buku'
            ],

            // pesantren
            [
                'invoice_category_id' => null,
                'name' => 'Uang syahriah (Bersaudara)',
                'period' => 'biannual',
                'description' => 'setoran pertama harus lunas di kwartal1 dan setoran kedua harus lunas di kwartal2',
                'amount' => 260000,
                'code' => 'adm-syah'
            ],
            [
                'invoice_category_id' => null,
                'name' => 'Uang syahriah (Tidak bersaudara)',
                'period' => 'biannual',
                'description' => 'setoran pertama harus lunas di kwartal1 dan setoran kedua harus lunas di kwartal2',
                'amount' => 300000,
                'code' => 'adm-syah1'
            ],
            [
                'invoice_category_id' => null,
                'name' => 'Jamub & Gamus',
                'period' => 'per-kwartal',
                'description' => '-',
                'amount' => 10000,
                'code' => 'jamgam'
            ],

            // poskestren
            [
                'invoice_category_id' => null,
                'name' => 'Dana sehat',
                'period' => 'biannual',
                'description' => '-',
                'amount' => 30000,
                'code' => 'sehat'
            ],
            [
                'invoice_category_id' => null,
                'name' => 'Kwartal1',
                'period' => 'per-kwartal',
                'description' => 'Harus lunas sebelum pelaksaanaan Kwartal dimulai',
                'amount' => 30000,
                'code' => 'kw1'
            ],
            [
                'invoice_category_id' => null,
                'name' => 'Kwartal2',
                'period' => 'per-kwartal',
                'description' => 'Harus lunas sebelum pelaksaanaan Kwartal dimulai',
                'amount' => 30000,
                'code' => 'kw2'
            ],
            [
                'invoice_category_id' => null,
                'name' => 'Kwartal3',
                'period' => 'per-kwartal',
                'description' => 'Harus lunas sebelum pelaksaanaan Kwartal dimulai',
                'amount' => 30000,
                'code' => 'kw3'
            ],
        ];

        foreach ($utilities as $utility) {
            InvoiceUtility::create($utility);
        }
    }
}
