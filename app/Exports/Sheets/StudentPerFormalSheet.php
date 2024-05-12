<?php

namespace App\Exports\Sheets;

use App\Models\Bakid\formal;
use App\Models\Formal\FormalEducation;
use App\Models\Student;
use Carbon\Carbon;
use App\Models\Teman\Invoice;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class StudentPerFormalSheet implements FromQuery, WithTitle, WithMapping, WithHeadings, ShouldAutoSize
{
    private $year;
    private $formal;

    public function __construct(int $year, FormalEducation $formal)
    {
        $this->year = $year;
        $this->formal = $formal;
    }

    public function query()
    {
        $query = Student
            ::query()
            ->with('formal','parent','dormitory','room')
            ->whereNotNull('verified_at');

            if($this->formal->name == 'Lainnya'){
                $query->whereDoesntHave('formal');              
            }else{
                $query->whereHas('formal', function ($q) {
                    $q->where('formal_education_id', $this->formal->id);
                });
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
        return $this->formal->name ;
    }
}