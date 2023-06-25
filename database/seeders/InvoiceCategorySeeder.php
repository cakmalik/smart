<?php

namespace Database\Seeders;

use App\Models\InvoiceCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Intervention\Image\Gd\Commands\InvertCommand;

class InvoiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InvoiceCategory::create(
            [
                'name' => 'Tagihan Penerimaan Santri Baru',
                'amount' => 250000,
                'code' => 'psb'
            ]
        );
    }
}
