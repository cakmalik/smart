<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Exports\Sheets\StudentPerMadinSheet;
use App\Models\Informal\InformalEducationClass;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class StudentByMadinExport implements WithMultipleSheets, FromQuery, ShouldQueue
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
        
        $informals = InformalEducationClass::whereHas('informalEducation', function ($q) {
            $q->where('name', 'Madin');
        })->get();
        
        foreach ($informals as $key => $informal) {
            $sheets[] = new StudentPerMadinSheet($this->year,$informal);
        }

        return $sheets;
    }
}