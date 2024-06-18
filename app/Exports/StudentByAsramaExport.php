<?php

namespace App\Exports;

use App\Models\Student;
use App\Models\Bakid\Dormitory;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Exports\Sheets\StudentPerAsramaSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class StudentByAsramaExport implements WithMultipleSheets, FromQuery, ShouldQueue
{
    use Exportable;

    public $year;
    public $category;

    public function __construct(string $category, $year=null)
    {
        $this->year = $year;
        $this->category = $category;
    }

    public function query()
    {
        // $q = Student::query()
        //     ->withoutGlobalScopes()
        //     ->with('dormitory', 'room');

        // if($this->year != null){
        //     $q->whereYear('verified_at', $this->year);
        // }else{
        //     $q->whereNotNull('verified_at');
        // }

        // return $q;
    }
    public function sheets(): array
    {
        $sheets = [];
        
        $dormitories = Dormitory::get();
        
        foreach ($dormitories as $key => $dormitory) {
            $sheets[] = new StudentPerAsramaSheet($this->year, $dormitory);
        }

        // Log::info($sheets);

        return $sheets;
    }
}