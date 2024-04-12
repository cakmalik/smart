<?php

namespace Database\Seeders;

use App\Models\Admission;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admission::create([
          'period'=>'2024/2025',
          'batch'=>'1',
          'amount'=>250000,
          'start_date'=>Carbon::now(),
          'end_date'=>Carbon::today()->addDay(),
          'is_active'=>true
        ]);
    }
}