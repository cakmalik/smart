<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\FormatMessage;
use Illuminate\Database\Seeder;
use Database\Seeders\AdmissionSeeder;
use Database\Seeders\DormitorySeeder;
use Database\Seeders\PaymentMethodSeeder;
use Database\Seeders\BakidEducationSeeder;
use Database\Seeders\InvoiceUtilitySeeder;
use Database\Seeders\InvoiceCategorySeeder;
use Database\Seeders\PaymentInstructionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AdmissionSeeder::class,
            InvoiceCategorySeeder::class,
            PaymentMethodSeeder::class,
            DormitorySeeder::class,
            BakidEducationSeeder::class,
            PaymentInstructionSeeder::class,
            InvoiceUtilitySeeder::class,
            FormatMessage::class
        ]);
    }
}
