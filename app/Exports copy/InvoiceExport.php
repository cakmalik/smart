<?php

namespace App\Exports;

use App\Models\Teman\Invoice;
use App\Exports\Sheets\InvoicesPerMonthSheet;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;


class InvoiceExport implements WithMultipleSheets
{

    private $year;

    public function __construct($year)
    {
        $this->year  = (int)$year;
    }

    public function collection()
    {

        return Invoice::all();
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
