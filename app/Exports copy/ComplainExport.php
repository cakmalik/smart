<?php

namespace App\Exports;

use App\Exports\Sheets\ComplainPerMonthSheet;
use App\Models\Teman\Invoice;
use App\Models\Complain\Complain;
use App\Exports\Sheets\InvoicesPerMonthSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class ComplainExport implements WithMultipleSheets
{

    private $year;

    public function __construct($year)
    {
        $this->year  = (int)$year;
    }

    public function collection()
    {

        return Complain::all();
    }

    public function sheets(): array
    {
        $sheets = [];

        for ($month = 1; $month <= 12; $month++) {
            $sheets[] = new ComplainPerMonthSheet($this->year, $month);
        }

        return $sheets;
    }
}
