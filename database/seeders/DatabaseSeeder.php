<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\FormatMessage;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\StudentSeeder;
use Illuminate\Support\Facades\App;
use Database\Seeders\AdmissionSeeder;
use Database\Seeders\DormitorySeeder;
use Database\Seeders\ViolationSeeder;
use Database\Seeders\PaymentMethodSeeder;
use Database\Seeders\BakidEducationSeeder;
use Database\Seeders\InvoiceUtilitySeeder;
use Database\Seeders\InvoiceCategorySeeder;
use Database\Seeders\PaymentInstructionSeeder;
use Database\Seeders\InOutPermissionTypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $seeders = [
            AdmissionSeeder::class,
            InvoiceCategorySeeder::class,
            PaymentMethodSeeder::class,
            DormitorySeeder::class,
            BakidEducationSeeder::class,
            BakidEducationClassSeeder::class,
            BakidEducationGradeSeeder::class,
            BakidEducationSubjectSeeder::class,
            PaymentInstructionSeeder::class,
            InvoiceUtilitySeeder::class,
            FormatMessageSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
            MadinPermissionSeeder::class,
            ViolationSeeder::class,
            InOutPermissionTypeSeeder::class,
            StudentSeeder::class
        ];

        if (App::environment('production')) {
            $key = array_search(StudentSeeder::class, $seeders);
            if ($key !== false) {
                unset($seeders[$key]);
            }
        }

        $this->call($seeders);
    }
}