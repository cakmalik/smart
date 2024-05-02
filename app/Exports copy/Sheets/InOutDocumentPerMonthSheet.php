<?php

namespace App\Exports\Sheets;

use App\Models\InOutDocument\IncomingOutgoingDocument;
use Carbon\Carbon;
use App\Models\Teman\Invoice;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class InOutDocumentPerMonthSheet implements FromQuery, WithTitle, WithMapping, WithHeadings, ShouldAutoSize
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
        return IncomingOutgoingDocument
            ::query()
            ->with('tenant')
            ->whereMonth('document_date', $this->month)
            ->whereYear('document_date', $this->year);
    }

    public function map($row): array
    {
        return [
            $row->document_number,
            $row->tenant->code,
            $row->tenant->name,
            $row->type,
            $row->status,
            $row->responsible_party,
            $row->phone_number,
            $row->document_date,
            $row->realitation_date,
        ];
    }

    public function headings(): array
    {
        return [
            'Document Number',
            'Tenant Code',
            'Tenant Name',
            'Type',
            'Status',
            'Responsible Party',
            'Phone Number',
            'Document Date',
            'Realitation Date',
        ];
    }


    public function title(): string
    {
        return Carbon::createFromFormat('m', $this->month)->format('F');
    }
}