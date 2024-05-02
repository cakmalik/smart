<?php

namespace App\Exports\Sheets;

use Carbon\Carbon;
use App\Models\Complain\Complain;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ComplainPerMonthSheet implements FromQuery, WithTitle, WithMapping, WithHeadings, ShouldAutoSize
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
        return Complain::query()
            ->with('tenant', 'engineer')
            ->whereMonth('complain_date', $this->month)
            ->whereYear('complain_date', $this->year);
    }

    public function map($invoice): array
    {
        return [
            $invoice->number,
            $invoice->tenant->code,
            $invoice->tenant->name,
            $invoice->status,
            $invoice->engineer->name ?? '-',
            $invoice->follow_up_date,
            $invoice->estimation_date,
            $invoice->finish_date,
            $invoice->title,
            $invoice->description
        ];
    }

    public function headings(): array
    {
        return [
            'Number',
            'Tenant Code',
            'Tenant Name',
            'Status',
            'Engineer',
            'Follow Up Date',
            'Estimation Date',
            'Finish Date',
            'Title',
            'Description'
        ];
    }

    public function columnFormats(): array
    {
        return [
            // 'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
    public function title(): string
    {
        return Carbon::createFromFormat('m', $this->month)->format('F');
    }
}
