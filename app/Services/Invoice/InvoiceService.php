<?php

namespace App\Services\Invoice;

use Illuminate\Support\Collection;
use LaravelEasyRepository\BaseService;

interface InvoiceService extends BaseService
{

    public function createInvoiceAdmission($student_id): array;

    public function getInvoicesByUserAndCode($user_id, $code): Collection;
}