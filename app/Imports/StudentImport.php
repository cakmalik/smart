<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Student;
use App\Models\Bakid\Room;
use App\Models\StudentFamily;
use App\Models\Bakid\Dormitory;
use Illuminate\Support\Collection;
use App\Models\Student\RoomStudent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Haruncpi\LaravelIdGenerator\IdGenerator;
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

            $f_id = $this->_storeFamily($row);
            $u_id = $this->_storeUser($row);
            $s_id = $this->_storeStudent($row, $f_id, $u_id);
            $this->_storeRoom($row, $s_id);

            $count++;
        }
    }

    private function _storeFamily($row)
    {
        try {
            $sf = new StudentFamily();

            $sf->father_name = $row['nama_a'] ?? '-';
            $sf->father_nik = $this->__no_kependudukan($row['nik_a']);
            $sf->father_phone = null;
            $sf->father_education = $row['pend_a'] ?? '-';
            $sf->father_job = $row['pek_a'] ?? '-';
            $sf->father_income = $row['peng_a'] ?? '-';
            $sf->father_status = null;
            $sf->father_place_of_birth = $row['tempat_lahir_a'] ?? '-';
            $sf->father_date_of_birth = $row['tgl_lahir_a'] ? $this->__formattedBirthDate($row['tgl_lahir_a'], $row) : null;
            // if ($row['tgl_lahir_a']) {
            //     // str replace '
            //     $row['tgl_lahir_a'] = str_replace("'", '', $row['tgl_lahir_a']);
            //     $tgl_lhr_a = Carbon::createFromFormat('d/m/Y', $row['tgl_lahir_a']);
            //     $sf->father_date_of_birth = $tgl_lhr_a->format('Y-m-d');
            // }

            $sf->mother_name = $row['nama_i'] ?? '-';
            $sf->mother_nik = $this->__no_kependudukan($row['nik_i']);
            $sf->mother_phone = null;
            $sf->mother_education = $row['pend_i'] ?? '-';
            $sf->mother_job = $row['pek_i'] ?? '-';
            $sf->mother_income = $row['peng_i'] ?? '-';
            $sf->mother_status = null;
            $sf->mother_place_of_birth = $row['tempat_lahir_i'] ?? '-';

            // if ($row['tgl_lahir_i']) {
            //     $row['tgl_lahir_i'] = str_replace("'", '', $row['tgl_lahir_i']);
            //     $tgl_lhr_i = Carbon::createFromFormat('d/m/Y', $row['tgl_lahir_i']);
            //     $sf->mother_date_of_birth = $tgl_lhr_i->format('Y-m-d');
            // }

            $sf->mother_date_of_birth = $row['tgl_lahir_a'] ? $this->__formattedBirthDate($row['tgl_lahir_i'], $row) : null;
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
            Log::error('terjadi_kesalahan_baris_' . $row['no'] . 'a/n' . $row['name'] . ' ==' . $e->getMessage());
            return false;
        }
    }

    private function _storeUser($row)
    {
        $no_hp = formatPhoneNumber($row['phone']);

        if ($no_hp == null) {
            do {
                $no_hp = rand(1000000000000, 9999999999999);
                $isExist = User::where('phone', $no_hp)->first();
            } while ($isExist);
        }

        $isExist = User::where('phone', $no_hp)->first();
        if ($isExist) {
            do {
                $no_hp = rand(1000000000000, 9999999999999);
                $isExist = User::where('phone', $no_hp)->first();
            } while ($isExist);
        }

        try {
            $uniqUsername = generateUniqueUsername($row['name']);
            $user = new User();
            $user->name = $row['nama_a'] ?? '-';
            $user->username = $uniqUsername ?? uniqid();
            $user->email = $uniqUsername . '@bakid.id';
            $user->password = Hash::make('password');
            $user->phone = $no_hp;
            $user->kk = $this->__no_kependudukan($row['no_kk']);
            $user->profile_photo_path = null;
            $user->gender = $row['gender'] == 'L' ? 'male' : 'female' ?? null;
            $user->doc_kk = null;
            $user->current_team_id = 2;

            $user->save();
            return $user->id;
        } catch (\Exception $e) {
            Log::error('error store user ' . 'terjadi_kesalahan_baris_' . $row['no'] . 'a/n' . $row['name'] . ' ==' . $e->getMessage() . ' at line ' . $e->getLine());
            return false;
        }
    }

    private function _storeStudent($row, $f_id, $u_id)
    {
        $result_birth_date = $this->__formattedBirthDate($row['tgl_lahir_santri'], $row);
        $result_birth_a = $this->__formattedBirthDate($row['tgl_lahir_a'], $row);
        $result_birth_i = $this->__formattedBirthDate($row['tgl_lahir_i'], $row);

        Log::info('res student::' . $result_birth_date);
        Log::info('res a::' . $result_birth_a);
        Log::info('res i::' . $result_birth_i);

        // if (!$result_birth_date || !$result_birth_a || !$result_birth_i) {
        //     Log::error('Date format error in student data: ' . json_encode($row));
        //     return Carbon::now()->format('Y-m-d');
        // }

        $nickname = '-';
        Log::info('res nickname::' . $nickname);
        $nik = $row['nik'] ? $this->__no_kependudukan($row['nik']) : '-';
        Log::info('res nik::' . $nik);
        $child_number = $this->__translateToNumber($row['anak_ke']) ?? 1;
        Log::info('res child_number::' . $child_number);
        $siblings = $this->__translateToNumber($row['jml_saudara']) ?? 1;
        Log::info('res siblings::' . $siblings);
        $nis = $row['angkatan'] ? $this->__generateNisFromAngkatan($row['angkatan']) : $this->__generateNisFromAngkatan(20);
        Log::info('res nis::' . $nis);

        if(isset($row['join_date']) && $row['join_date'] != null) {
            $verfied_at = $this->__createVerifiedFromJoinDate($row['join_date']);
        }else{
            $verfied_at = $this->__createVerifiedFromAngkatan($row['angkatan']);
        }
        Log::info('res verfied_at::' . $verfied_at);

        $no_hp = formatPhoneNumber($row['phone']);

        if ($no_hp == null) {
            do {
                $no_hp = rand(1000000000000, 9999999999999);
                $isExist = Student::where('phone', $no_hp)->first();
            } while ($isExist);
        }

        $isExist = Student::where('phone', $no_hp)->first();
        if ($isExist) {
            do {
                $no_hp = rand(1000000000000, 9999999999999);
                $isExist = Student::where('phone', $no_hp)->first();
            } while ($isExist);
        }
        
        try {
            $student = new Student();
            $student->user_id = $u_id;
            $student->student_family_id = $f_id;
            $student->name = $row['name'];
            $student->nickname = $nickname;
            $student->nik = $nik;
            $student->place_of_birth = $row['tempat_lahir'] ?? '';
            $student->date_of_birth = $result_birth_date;
            $student->gender = $row['gender'] == 'L' ? 'male' : 'female';
            $student->address = $row['alamat'] ?? '';
            $student->rt_rw = '00/00';
            $student->village = $row['desa'] ?? '';
            $student->district = $row['kecamatan'] ?? '';
            $student->city = $row['kabupaten'] ?? '';
            $student->province = $row['provinsi'] ?? '';
            $student->postal_code = $row['pos'] ?? '';
            $student->religion = 'Islam';
            $student->nationality = 'WNI';
            $student->phone = $no_hp;
            $student->student_image = null;
            $student->child_number = $child_number;
            $student->siblings = $siblings;
            $student->nis = $nis;
            $student->hobby = $row['hobi'] ?? '';
            $student->ambition = $row['cita_cita'] ?? '';
            $student->housing_status = $row['status_mukim']??'Mukim';
            $student->recidency_status = null;
            $student->nism = null;
            $student->kis = null;
            $student->kip = null;
            $student->kks = null;
            $student->pkh = null;
            $student->status = 'accepted';
            $student->verified_at = $verfied_at;
            $student->drop_out_at = null;
            $student->education_updated = Carbon::now();

            // Log object before save
            Log::info('object::::' . $student);
            $student->save();
            return $student->id;
        } catch (\Exception $e) {
            Log::error('err create student ' . 'terjadi_kesalahan_baris_' . $row['no'] . 'a/n: ' . ': ' . $row['name'] . '::' . $e->getMessage() . ' at line ' . $e->getLine());
            return false;
        }
    }

    private function _storeRoom($row, $s_id)
    {
        if($s_id == null){
            return false;
        }

        $asrama = str_replace(' ', '', $row['asr']);
        $asrama = strtoupper($asrama);
        Log::info('asrama::' . $asrama);


         // Menambahkan pengecekan hasil preg_match
        // if (preg_match('/([a-zA-Z]+)\.(\d+)/', $row['asr'], $matches)) {
        if (preg_match('/([a-zA-Z]+)(\d+)/', $row['asr'], $matches)) {
            $huruf = $matches[1];
            $angka = $matches[2];

            Log::info('asrama::' . $huruf . 'angka::' . $angka);

            // cari dormitory
            $dormitory = Dormitory::where('name', $huruf)->first();
            
            if($dormitory){
                $room = Room::where('name', (int)$angka)
                ->where('dormitory_id', $dormitory->id)
                ->first();
            }

            if (!$dormitory || !$room) {
                return false;
            }
            
        } else {
            // Log atau tindakan lain jika pola tidak cocok
            Log::error('Format ASR tidak valid: ' . $row['asr']);
            return false;
        }
        
        try {
            $student_room = new RoomStudent();
            $student_room->room_id = $room->id; 
            $student_room->dormitory_id = $dormitory->id;
            $student_room->student_id = $s_id;
            $student_room->status = 'approved';

            $student_room->save();

        } catch (\Exception $e) {
            Log::error('error asrama' . 'terjadi_kesalahan_baris_' . $row['no'] . 'a/n: ' . ': ' . $row['name'] . '::' . $e->getMessage() . ' at line ' . $e->getLine());
            return false;
        }
    }

    public function __generate_nickname(string $name = null): string
    {
        if (!isset($name) || empty($name)) {
            return '-';
        }
        // Pisahkan nama menjadi array kata-kata
        $nameParts = explode(' ', $name);

        // Ambil kata pertama
        $firstName = $nameParts[0];

        // Ambil dua huruf pertama dari kata pertama
        $nickname = substr($firstName, 0, 2);

        return $nickname;
    }

    public function __no_kependudukan(string $original_number = null): string
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
            } else {
                $result = $no_replaced;
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
        if ($phone) {
            $user = User::where('phone', $phone)->first();

            if ($user) {
                do {
                    $phone = rand(1000000000000, 9999999999999);
                    $user = User::where('phone', $phone)->first();
                } while ($user);
            }
        }

        do {
            $phone = rand(1000000000000, 9999999999999);
            $user = User::where('phone', $phone)->first();
        } while ($user);

        return $phone;
    }

    public function __formattedBirthDate($date, $row)
    {
        if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date)) {
            return Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        }
        
        $formatted = preg_replace('/\D/', '', $date);

        if ($formatted == '' || $formatted == null) {
            return Carbon::now()->format('Y-m-d');
        }

        try {
            $tgl_lhr_i = Carbon::createFromFormat('dmY', $formatted);
            // Log::info('end:birth_date: ' . $tgl_lhr_i->format('Y-m-d') . ' row: ' . $row['name']);
            return $tgl_lhr_i->format('Y-m-d');
        } catch (\Exception $e) {
            Log::error('Error create birth_date: ' . $formatted . '-=' . $e->getMessage() . ' at line ' . $e->getLine());
            return Carbon::now()->format('Y-m-d');
        }
    }

    public function __translateToNumber(string $string = null): int
    {
        if (!$string) {
            return 1;
        }
        // Pastikan input diubah menjadi lowercase
        $string = strtolower($string);

        // Tangani input berupa string angka
        if (is_numeric($string)) {
            return (int) $string;
        }

        // Konversi kata menjadi angka
        switch ($string) {
            case 'satu':
                return 1;
            case 'dua':
                return 2;
            case 'tiga':
                return 3;
            case 'empat':
                return 4;
            case 'lima':
                return 5;
            case 'enam':
                return 6;
            case 'tujuh':
                return 7;
            case 'delapan':
                return 8;
            case 'sembilan':
                return 9;
            case 'sepuluh':
                return 10;
            case 'sebelas':
                return 11;
            default:
                return 1;
        }
    }

    public function __generateNisFromAngkatan(string $angkatan): int
    {
        $config = [
            'table' => 'students',
            'field' => 'nis',
            'length' => 6,
            'prefix' => $angkatan,
            'reset_on_prefix_change' => true,
        ];
        return IdGenerator::generate($config);
    }

    public function __createVerifiedFromJoinDate(string $join_date = null)
    {
        try {
            if (!$join_date) {
                $join_date = Carbon::now()->format('Y-m-d H:i:s');
            }
            return Carbon::createFromFormat('d/m/Y', $join_date)->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            // Tangani kesalahan format di sini
            // Misalnya, kembalikan tanggal saat ini
            return Carbon::now()->format('Y-m-d H:i:s');
        }
    }
    
    public function __createVerifiedFromAngkatan(string $angkatan = null)
    {
        try {
            if (!$angkatan) {
                $angkatan = 20;
            }
            $new = $angkatan . '/01/01';
            return Carbon::createFromFormat('y/m/d', $new)->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            // Tangani kesalahan format di sini
            // Misalnya, kembalikan tanggal default atau null
            return Carbon::now()->format('Y-m-d H:i:s');
        }
    }
    
    public function chunkSize(): int
    {
        return 10;
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