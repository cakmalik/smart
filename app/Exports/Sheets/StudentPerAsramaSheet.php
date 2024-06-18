<?php

namespace App\Exports\Sheets;

use App\Models\Bakid\Dormitory;
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

class StudentPerAsramaSheet implements FromQuery, WithTitle, WithMapping, WithHeadings, ShouldAutoSize
{
    private $year;
    private $dormitory;

    public function __construct($year=null, Dormitory $dormitory)
    {
        $this->year = $year;
        $this->dormitory = $dormitory;
    }

    public function query()
    {
        $gender = $this->dormitory->gender == 'L' ? 'male' : 'female';
        $query =  Student
            ::query()
            ->withoutGlobalScopes()
            ->whereNull('deleted_at')
            ->where('gender', $gender);

            $query->whereHas('dormitory', function ($q) {
                $q->where('dormitory_id', $this->dormitory->id);
            });

            if($this->year != null){
                $query->whereYear('verified_at', $this->year);
            }else{
                $query->whereNotNull('verified_at');
            }

        return $query;
    }

    public function map($student): array
    {
        $angkatan = Carbon::parse($student->verified_at)->year;
        return [
            $student->room->count() >0 ? $student->room[0]->name: '-',
            $angkatan??'-',
            $student->name,
            $student->nickname,
           '`'. $student->nik,
            $student->place_of_birth,
            $student->date_of_birth,
            $student->gender??'-',
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
        'ANGKATAN',
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
        return $this->dormitory->name . ' (' . $this->dormitory->gender . ')';
    }
}