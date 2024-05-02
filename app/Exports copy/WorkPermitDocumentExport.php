<?php

namespace App\Exports;

use App\Exports\Sheets\WorkPermitPerMonthSheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\WorkPermit\WorkPermitDocument as model;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class WorkPermitDocumentExport implements WithMultipleSheets
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
            $sheets[] = new WorkPermitPerMonthSheet($this->year, $month);
        }

        return $sheets;
    }
}
