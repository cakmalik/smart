<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Exports\Sheets\StudentPerAsramaSheet;
use App\Models\Bakid\Dormitory;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class StudentByAsramaExport implements WithMultipleSheets, FromQuery, ShouldQueue
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
            ->with('dormitory', 'room')
            ->whereYear('verified_at', $this->year);

        return $q;
    }
    public function sheets(): array
    {
        $sheets = [];
        
        $dormitories = Dormitory::get();
        
        // $newDorm = new Dormitory();
        // $newDorm->name = 'Lainnya';
        // $newDorm->gender = auth()->user()->gender == 'male' ? 'L' : 'P';
        // $dormitories->push($newDorm);
        
        foreach ($dormitories as $key => $dormitoy) {
            $sheets[] = new StudentPerAsramaSheet($this->year, $dormitoy);
        }

        return $sheets;
    }
}