<?php

namespace App\Exports\Sheets;

use Carbon\Carbon;
use App\Models\Teman\Invoice;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class InvoicesPerMonthSheet implements FromQuery, WithTitle, WithMapping, WithHeadings, ShouldAutoSize
{
    private $month;
    private $year;

    public function __construct(int $year, int $month)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function query()
    {
        $period = $this->year . '-' . $this->month;
        return Invoice
            ::query()
            ->with('tenant')
            ->whereNotIn('invoice_status', ['template', 'canceled'])
            ->where('periode', $period);
    }

    public function map($invoice): array
    {
        return [
            $invoice->invoice_number,
            $invoice->tenant->code,
            $invoice->tenant->name,
            // $invoice->invoice_total,
            // $invoice->invoice_total_tax,
            (int)$invoice->grand_total,
            $invoice->invoice_status
        ];
    }

    public function headings(): array
    {
        return [
            'Invoice Number',
            'Tenant Code',
            'Tenant Name',
            // 'Invoice Total',
            // 'Total Tax',
            'Invoice Total',
            'Status'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
        ];
    }

    public function startCell(): string
    {
        return 'A2';
    }

    public function title(): string
    {
        return Carbon::createFromFormat('m', $this->month)->format('F');
    }
}
