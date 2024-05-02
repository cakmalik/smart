<?php

namespace App\Exports\Sheets;

use Carbon\Carbon;
use App\Models\Teman\Invoice;
use App\Models\WorkPermit\WorkPermitDocument;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class WorkPermitPerMonthSheet implements FromQuery, WithTitle, WithMapping, WithHeadings, ShouldAutoSize
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
        return WorkPermitDocument
            ::query()
            ->with('tenant')
            ->whereMonth('working_date', $this->month)
            ->whereYear('working_date', $this->year);
    }

    public function map($row): array
    {
        return [
            $row->document_number,
            $row->tenant->code,
            $row->tenant->name,
            $row->status,
            $row->applicant_name,
            $row->vendor_name,
            $row->responsible_party,
            $row->phone_number,
            $row->working_date,
            $row->estimation_date,
            $row->job_details,
            $row->workers_name,
        ];
    }

    public function headings(): array
    {
        return [
            'Document Number',
            'Tenant Code',
            'Tenant Name',
            'Status',
            'Applicant Name',
            'Vendor Name',
            'Responsible Party',
            'Phone Number',
            'Working Date',
            'Estimation Date',
            'Job Details',
            'Workers Name',
        ];
    }

    public function title(): string
    {
        return Carbon::createFromFormat('m', $this->month)->format('F');
    }
}
