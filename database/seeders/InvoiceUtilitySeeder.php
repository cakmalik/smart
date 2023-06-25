<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceUtilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $utilities = [
            [
                'invoice_category_id' => 1,
                'name' => 'sdfsdf',
                'type' => 'once',
                'description' => 'sdfsdf',
                'amount' => 200000,
            ],
        ];
    }
}
