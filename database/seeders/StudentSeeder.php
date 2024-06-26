<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Student\RoomStudent;
use App\Models\Student\StudentEducationalBackground;
use App\Models\StudentFamily;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sf =
            StudentFamily::create([
                'father_name' => 'John Doe',
                'father_nik' => '1234567890',
                'father_phone' => '123456789',
                'father_education' => 'Bachelor Degree',
                'father_job' => 'Engineer',
                'father_income' => '10000000',
                'mother_name' => 'Jane Doe',
                'mother_nik' => '0987654321',
                'mother_phone' => '987654321',
                'mother_education' => 'Master Degree',
                'mother_job' => 'Teacher',
                'mother_income' => '8000000',
                'guard_name' => 'Guardian Doe',
                'guard_nik' => '5678901234',
                'guard_phone' => '567890123',
                'guard_education' => 'High School',
                'guard_job' => 'Driver',
                'guard_income' => '5000000',
            ]);



        for ($i = 0; $i < 20; $i++) {
            $faker = Faker::create();
            $student = [
                'student_family_id' => $sf->id,
                'name' => $faker->name,
                'nickname' => 'angga',
                'user_id' => 3,
                'nik' => '1234567890',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '1990-01-01',
                'gender' => ['male', 'female'][array_rand(['male', 'female'], 1)],
                'address' => '123 Example Street',
                'rt_rw' => '01/01',
                'village' => 'Example Village',
                'district' => 'Example District',
                'city' => 'Example City',
                'province' => 'Example Province',
                'postal_code' => '12345',
                'religion' => 'Islam',
                'nationality' => 'Indonesian',
                'phone' => '123456789',
                'student_image' => 'example.jpg',
                // 'parent_image' => 'example.jpg',
                'nis' => generateNIS(),
                'hobby' => 'Melukis',
                'ambition' => 'Example Ambition',
                'housing_status' => 'Example Housing Status',
                'recidency_status' => 'Example Residency Status',
                'nism' => '123456',
                'kis' => '1234567890',
                'kip' => '1234567890',
                'kks' => '1234567890',
                'pkh' => '1234567890',

                'child_number' => 1,
                'siblings' => 4
            ];
            $sc = Student::create($student);
            StudentEducationalBackground::create([
                'student_id' => $sc->id,
                'school_name' => 'SMP Darul ulum',
                'level' => 'primary',
                'school_address' => 'Jalan KH. Abdullah Kamil',
                'school_phone_number' => '324234234',
                'npsn' => '34234234',
                'no_ijazah' => '4324234234'
            ]);

            RoomStudent::create(
                [
                    'room_id' => rand(1, 5),
                    'student_id' => $sc->id,
                    'dormitory_id' => rand(1, 5),
                ]
            );
        }
    }
}
