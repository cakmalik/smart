<?php

namespace App\Services\Invoice;

use LaravelEasyRepository\BaseService;

interface InvoiceService extends BaseService
{

    public function createInvoiceAdmission($student_id): bool;
}
