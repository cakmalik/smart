<?php

namespace App\Exports\Sheets;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use App\Models\Informal\InformalEducation;
use App\Models\Informal\InformalEducationClass;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StudentPerMadinSheet implements FromQuery, WithTitle, WithMapping, WithHeadings, ShouldAutoSize
{
    private $year;
    private $informal;

    public function __construct(int $year, InformalEducationClass $informal)
    {
        $this->year = $year;
        $this->informal = $informal;
    }

    public function query()
    {
        $query = Student
            ::query()
            ->with('informal.kelas','parent','dormitory','room')
            ->whereNotNull('verified_at');

            if($this->informal->name != 'Lainnya'){
                $query->whereHas('informal.kelas', function ($q) {
                    $q->where('informal_education_class_id', $this->informal->id);
                });    
            }else{
                $query->whereDoesntHave('informal.kelas');
            }

            return $query;

    }

    public function map($student): array
    {
        return [
            $student->getAsramaName(),
            $student->name,
            $student->nickname,
           '`'. $student->nik,
            $student->place_of_birth,
            $student->date_of_birth,
            $student->gender,
            $student->address ?? '',
            $student->rt_rw,
            $student->village,
            $student->district,
            $student->city,
            $student->province,
            $student->postal_code,
            $student->verified_at,
            $student->parent->father_phone .'/'. $student->parent->mother_phone,
            $student->getFormalName(),
            $student->getInformalName(),
        ];
    }

    public function headings(): array
    {
        return [
            'ASRAMA',
          'NAMA',
          'PANGGILAN',
          'NIK',
          'TEMPAT LAHIR',
          'TANGGAL LAHIR',
          'JENIS KELAMIN',
          'ALAMAT',
          'RT/RW',
          'DESA',
          'KECAMATAN',
          'KOTA/KAB',
          'PROVINSI',
          'KODE POS',
          'TANGGAL MASUK',
          'NO HP WALI',
          'FORMAL',
          'NON-FORMAL'
        ];
    }

    // public function columnFormats(): array
    // {
    //     return [
    //         'D' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
    //     ];
    // }

    public function startCell(): string
    {
        return 'A2';
    }

    public function title(): string
    {
        return $this->informal->class_name ;
    }
}