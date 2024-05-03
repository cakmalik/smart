<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\Bakid\Dormitory;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Exports\Sheets\StudentPerAsramaSheet;
use App\Exports\Sheets\StudentPerFormalSheet;
use App\Models\Formal\FormalEducation;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class StudentByFormalExport implements WithMultipleSheets, FromQuery, ShouldQueue
{
    use Exportable;

    public $year;
    public $category;

    public function __construct(string $category, int $year)
    {
        $this->year = $year;
        $this->category = $category;
    }

    public function query()
    {
        $q = Student::query()
            ->with('formal', 'informal')
            ->whereYear('verified_at', $this->year);
        return $q;
    }
    public function sheets(): array
    {
        $sheets = [];
        
        $formals = FormalEducation::get();
        foreach ($formals as $key => $formal) {
            $sheets[] = new StudentPerFormalSheet($this->year,$formal);
        }

        return $sheets;
    }
}