<?php

namespace App\Services\Invoice;

use LaravelEasyRepository\Service;
use App\Repositories\Invoice\InvoiceRepository;

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

    public function createInvoiceAdmission($student_id): bool
    {
        $invoice = $this->mainRepository->createInvoiceAdmission($student_id);
        return $invoice;
    }
}
