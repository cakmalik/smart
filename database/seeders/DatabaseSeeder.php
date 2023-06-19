<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AdmissionSeeder;
use Database\Seeders\DormitorySeeder;
use Database\Seeders\PaymentMethodSeeder;
use Database\Seeders\BakidEducationSeeder;
use Database\Seeders\InvoiceCategorySeeder;

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
        ]);
    }
}
