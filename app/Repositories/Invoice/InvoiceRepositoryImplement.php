<?php

namespace App\Repositories\Invoice;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Invoice;

class InvoiceRepositoryImplement extends Eloquent implements InvoiceRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(Invoice $model)
    {
        $this->model = $model;
    }

    public function createInvoiceAdmission($student_id): bool
    {
        $invoice = $this->model->create([
            'student_id' => $student_id,
            'invoice_number' => 'INV-' . $student_id . '-' . date('YmdHis'),
            'invoice_date' => date('Y-m-d'),
            'due_date' => date('Y-m-d', strtotime('+7 days')),
            'total' => 0,
            'status' => 'unpaid',
        ]);
        return $invoice;
    }
}
