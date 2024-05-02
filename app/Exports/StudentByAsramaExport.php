<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class StudentByAsramaExport implements WithMultipleSheets, FromQuery, ShouldQueue
{
    
    use Exportable;

    public $year;
    public $category;

    public function __construct(string $category,int $year)
    {
        $this->year = $year;        
        $this->category = $category;
    }

    public function query()
    {
        $q = Student::query();
    //     ->with('dormitory', 'room')
    //     ->whereYear('verified_at', $this->year)
    //     ->whereHas('dormitory', function($q) {
    //         $q->where('id', $this->dormitory_id);
    //     })
    //     ->whereHas('room', function($q) {
    //         $q->where('id', $this->room_id);
    //     });

        return $q; 

    }
    public function sheets(): array
    {
        $sheets = [];

        for ($month = 1; $month <= 12; $month++) {
            $sheets[] = new InvoicesPerMonthSheet($this->year, $month);
        }

        return $sheets;
    }
}