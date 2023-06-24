<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use App\Models\Example; // Ganti "Example" dengan model yang sesuai

class ExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // for ($i = 0; $i < 10; $i++) { // Ubah 10 menjadi jumlah data yang diinginkan
        Invoice::create([
            'user_id' => 1,
            'student_id' => 1,
            'invoice_category_id' => 1,
            'period' => '2020',
            'invoice_number' => null,
        ]);
        // }
    }
}
