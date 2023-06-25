<?php

namespace App\Repositories\Invoice;

use App\Models\Admission;
use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Invoice;
use App\Models\InvoiceCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

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
        try {

            $findCategory = InvoiceCategory::where('code', 'psb')->first();
            if (!$findCategory) {
                return false;
            }
            $admission = Admission::where('is_active', true)->first();
            $invoice = $this->model->create([
                'user_id' => auth()->user()->id,
                'student_id' => $student_id,
                'invoice_category_id' => $findCategory->id,
                'period' => $admission->period,
                //    'invoice_number'=> $this->generateInvoiceNumber($findCategory->code),
                //    'invoice_date'=>
                //    'due_date'=>
                'description' => 'Pendaftaran Santri Baru',
                'amount' => $admission->amount,
                //    'status'=>
                //    'payment_method_id'=>
                'title' => 'Administrasi'
                //    'reference'=>
                //    'desc'=>
            ]);
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getLine());
            return false;
        }
        // return $invoice;
    }

    public function getInvoicesByUserAndCode($user_id, $code): Collection
    {
        $invoices = $this->model->where('user_id', $user_id)->whereHas('invoiceCategory', function ($query) use ($code) {
            $query->where('code', $code);
        })->get();
        return $invoices;

        //or join manual like here
        // $invoices = DB::table('invoices')
        // ->join('invoice_categories', 'invoices.invoice_category_id', '=', 'invoice_categories.id')
        // ->where('invoice_categories.code', '=', 'psb')
        // ->where('invoices.user_id', '=', auth()->user()->id)
        // ->get();

    }
}
