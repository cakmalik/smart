<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::create(
            ['name' => 'Cash', 'description' => 'Pembayaran langsung pada Petugas Administrasi atau Bendahara', 'is_active' => true]
        );

        PaymentMethod::create(
            ['name' => 'Transfer', 'description' => 'Transfer langsung via Rekening Pondok Pesantren', 'is_active' => true]
        );

        PaymentMethod::create(
            ['name' => 'E-Mall', 'description' => 'Pembayaran elalui outlet Basmalah terdekat', 'is_active' => true]
        );
    }
}
