<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class StudentByAsramaExport implements FromQuery
{
    
    use Exportable;

    public $year;
    
    public function __construct(int $year)
    {
        $this->year = $year;        
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
}