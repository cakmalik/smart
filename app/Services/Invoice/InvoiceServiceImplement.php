<?php

namespace App\Services\Invoice;

use LaravelEasyRepository\Service;
use App\Repositories\Invoice\InvoiceRepository;
use Illuminate\Support\Collection;

class InvoiceServiceImplement extends Service implements InvoiceService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(InvoiceRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function createInvoiceAdmission($student_id): array
    {
        $invoice = $this->mainRepository->createInvoiceAdmission($student_id);
        return $invoice;
    }

    public function getInvoicesByUserAndCode($user_id, $code): Collection
    {
        $invoices = $this->mainRepository->getInvoicesByUserAndCode($user_id, $code);
        return $invoices;
    }
}