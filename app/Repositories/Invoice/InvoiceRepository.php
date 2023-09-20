<?php

namespace App\Repositories\Invoice;

use Illuminate\Support\Collection;
use LaravelEasyRepository\Repository;

interface InvoiceRepository extends Repository
{

    public function createInvoiceAdmission($student_id): bool;

    public function getInvoicesByUserAndCode($user_id, $code): Collection;

    public function getCategories(): Collection;
}
