<?php

namespace App\Repositories\Invoice;

use LaravelEasyRepository\Repository;

interface InvoiceRepository extends Repository
{

    public function createInvoiceAdmission($student_id): bool;
}
