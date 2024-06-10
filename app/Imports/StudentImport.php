<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Student;
use App\Models\StudentFamily;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class StudentImport implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue, SkipsEmptyRows, WithValidation
{
    use Importable;

    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $count = 1;

        foreach ($rows as $row) {
            // log all row key only
            // Log::info($row->toArray());

            $f_id = $this->_storeFamily($row, $count);
            $u_id = $this->_storeUser($row);
            $s_id = $this->_storeStudent($row, $f_id, $u_id);
            // $this->_storeRoom($row);

            $count++;
        }
    }

    private function _storeFamily($row, $count)
    {
        try {
            $sf = new StudentFamily();

            $sf->father_name = $row['nama_a'] ?? '-';
            $sf->father_nik = $row['nik_a'] ?? '-';
            $sf->father_phone = null;
            $sf->father_education = $row['pend_a'] ?? '-';
            $sf->father_job = $row['pek_a'] ?? '-';
            $sf->father_income = $row['peng_a'] ?? '-';
            $sf->father_status = null;
            $sf->father_place_of_birth = null;
            // $sf->father_place_of_birth = $row['tempat_lahir_a']??'-';
            if ($row['tgl_lahir_a']) {
                // str replace '
                $row['tgl_lahir_a'] = str_replace("'", '', $row['tgl_lahir_a']);
                $tgl_lhr_a = Carbon::createFromFormat('d/m/Y', $row['tgl_lahir_a']);
                $sf->father_date_of_birth = $tgl_lhr_a->format('Y-m-d');
            }

            $sf->mother_name = $row['nama_i'] ?? '-';
            $sf->mother_nik = $row['nik_i'] ?? '-';
            $sf->mother_phone = null;
            $sf->mother_education = $row['pend_i'] ?? '-';
            $sf->mother_job = $row['pek_i'] ?? '-';
            $sf->mother_income = $row['peng_i'] ?? '-';
            $sf->mother_status = null;
            $sf->mother_place_of_birth = null;

            if ($row['tgl_lahir_i']) {
                $row['tgl_lahir_i'] = str_replace("'", '', $row['tgl_lahir_i']);
                $tgl_lhr_i = Carbon::createFromFormat('d/m/Y', $row['tgl_lahir_i']);
                $sf->mother_date_of_birth = $tgl_lhr_i->format('Y-m-d');
            }

            $sf->guard_name = null;
            $sf->guard_nik = null;
            $sf->guard_phone = null;
            $sf->guard_education = null;
            $sf->guard_job = null;
            $sf->guard_income = null;
            $sf->parent_image = null;

            $sf->save();

            return $sf->id;
        } catch (\Exception $e) {
            // Log::error($e->getMessage(). ' at line ' . $e->getLine());
            Log::error('terjadi_kesalahan_baris_' . $count . 'a/n' . $row['name'] . ' ==' . $e->getMessage());
            return false;
        }
    }

    private function _storeUser($row)
    {
        $uniqUsername = generateUniqueUsername($row['name']);
        $user = new User();
        $user->name = $row['name'] ?? null;
        $user->username = $uniqUsername ?? uniqid();
        $user->email = $uniqUsername . '@gmail.com';
        $user->password = Hash::make('password');
        $user->phone = $this->__no_hp($row['no_hp']);
        $user->kk = $this->__no_kependudukan($row['no_kk']);
        $user->profile_photo_path = null;
        $user->gender = $row['gender'] == 'L' ? 'male' : 'female' ?? null;
        $user->doc_kk = null;

        $user->save();

        try {
        } catch (\Exception $e) {
            Log::error($e->getMessage() . ' at line ' . $e->getLine());
            return false;
        }
    }

    private function _storeStudent($row, $f_id, $u_id)
    {
        try {
            if ($row['nik']) {
                $row['nik'] = str_replace('`', '', $row['nik']);
            } else {
                $row['nik'] = uniqid();
            }

            $student = new Student();
            $student->user_id = $u_id;
            $student->student_family_id = $f_id;
            $student->name = $row['name'];
            $student->nickname = $this->__generate_nickname($row);
            $student->nik = $row['nik'];
            $student->place_of_birth = $row['place_of_birth'];
            $student->date_of_birth = $row['date_of_birth'];
            $student->gender = $row['gender'];
            $student->address = $row['address'];
            $student->rt_rw = $row['rt_rw'];
            $student->village = $row['village'];
            $student->district = $row['district'];
            $student->city = $row['city'];
            $student->province = $row['province'];
            $student->postal_code = $row['postal_code'];
            $student->religion = $row['religion'];
            $student->nationality = $row['nationality'];
            $student->phone = $row['phone'];
            $student->student_image = $row['student_image'];
            $student->child_number = $row['child_number'];
            $student->siblings = $row['siblings'];
            $student->nis = $row['nis'];
            $student->hobby = $row['hobby'];
            $student->ambition = $row['ambition'];
            $student->housing_status = $row['housing_status'];
            $student->recidency_status = $row['recidency_status'];
            $student->nism = $row['nism'];
            $student->kis = $row['kis'];
            $student->kip = $row['kip'];
            $student->kks = $row['kks'];
            $student->pkh = $row['pkh'];
            $student->status = $row['status'];
            $student->verified_at = $row['verified_at'];
            $student->drop_out_at = $row['drop_out_at'];
            $student->education_updated = $row['education_updated'];

            $student->save();
        } catch (\Exception $e) {
            Log::error($e->getMessage() . ' at line ' . $e->getLine());
            return false;
        }
    }

    private function _storeRoom($row)
    {
        try {
        } catch (\Exception $e) {
            Log::error($e->getMessage() . ' at line ' . $e->getLine());
            return false;
        }
    }

    public function __generate_nickname(string $row): string
    {
        // Create nickname from the first word of the name
        if (isset($row['name']) && !empty($row['name'])) {
            // Pisahkan nama menjadi array kata-kata
            $nameParts = explode(' ', $row['name']);

            // Ambil kata pertama
            $firstName = $nameParts[0];

            // Ambil dua huruf pertama dari kata pertama
            $nickname = substr($firstName, 0, 2);
        } else {
            // Jika nama tidak tersedia, atur nickname menjadi string kosong atau nilai default
            $nickname = '';
        }

        return $nickname;
    }

    public function __no_kependudukan(string $original_number): string
    {
        if ($original_number) {
            // Replace all non-numeric characters
            $no_replaced = preg_replace('/\D/', '', $original_number);
        
            $user = User::where('kk', $no_replaced)->first();
            if ($user) {
                do {
                    $result = uniqid();
                    $user = User::where('kk', $result)->first();
                } while ($user);
            }
        } else {
            do {
                $result = uniqid();
                $user = User::where('kk', $result)->first();
            } while ($user);
        }

        return $result;
    }

    public function __no_hp(string $original_number): int
    {
         // cek phone  number first, if exist then skip
         $phone = formatPhoneNumber($original_number);
         if ($phone == null) {
             $phone = rand(1000000000000, 9999999999999);
         } else {
             do {
                 $phone = rand(1000000000000, 9999999999999);
                 $user = User::where('phone', $phone)->first();
             } while ($user);
         }

         return $phone;

    }

    public function chunkSize(): int
    {
        return 500;
    }

    public function rules(): array
    {
        return [
            '*.name' => 'required',
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }
}