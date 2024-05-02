<?php

namespace App\Exports;

use App\Exports\Sheets\InOutDocumentPerMonthSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class InOutDocumentExport implements WithMultipleSheets
{
    private $year;

    public function __construct($year)
    {
        $this->year  = (int)$year;
    }

    public function sheets(): array
    {
        $sheets = [];

        for ($month = 1; $month <= 12; $month++) {
            $sheets[] = new  InOutDocumentPerMonthSheet($this->year, $month);
        }

        return $sheets;
    }
}
