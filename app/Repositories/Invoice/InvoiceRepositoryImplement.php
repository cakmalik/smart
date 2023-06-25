<?php

namespace App\Repositories\Invoice;

use App\Models\Invoice;
use App\Models\Admission;
use App\Models\InvoiceDetail;
use App\Models\InvoiceCategory;
use App\Models\InvoiceUtility;
use App\Models\Student;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use LaravelEasyRepository\Implementations\Eloquent;

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
            $findUtilities = InvoiceUtility::where('invoice_category_id', $findCategory->id)->get();
            if (!$findCategory) {
                return false;
            }
            $admission = Admission::where('is_active', true)->first();

            DB::beginTransaction();
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

            // // get student count
            // $student = Student::find($student_id);
            // $studentCount = Student::whereHas('user', function ($query) use ($student) {
            //     $query->where('user_id', $student->user_id);
            // })->count();

            $grandTotal = 0;
            foreach ($findUtilities as $utility) {

                $det = InvoiceDetail::create([
                    'invoice_id' => $invoice->id,
                    'name' => $utility->name,
                    'period' => $utility->period,
                    'description' => $utility->description,
                    'sub_total' => $utility->sub_total,
                ]);
                $grandTotal += $utility->sub_total;
            }

            $invoice->amount = $grandTotal;
            $invoice->save();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();

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
