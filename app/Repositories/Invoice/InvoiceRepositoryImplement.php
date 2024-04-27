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

    public function __construct()
    {
        $this->model = new Invoice();
    }

    public function createInvoiceAdmission($student_id): array
    {
        try {
            $findCategory = InvoiceCategory::where('code', 'psb')->first();
            $findUtilities = InvoiceUtility::where('invoice_category_id', $findCategory->id)->get();
            if (!$findCategory) {
                return [
                    'status' => false,
                    'message' => 'Kategori Pendaftaran Santri Baru Tidak Ditemukan',
                ];
            }
            $admission = Admission::where('is_active', true)->first();

            DB::beginTransaction();

            $invoice = new Invoice();
            $invoice->user_id = auth()->user()->id;
            $invoice->student_id = $student_id;
            $invoice->invoice_category_id = $findCategory->id;
            $invoice->period = $admission->period;
            $invoice->description = 'Pendaftaran Santri Baru';
            $invoice->amount = $admission->amount;
            $invoice->title = 'Administrasi';
            $invoice->save();

            $grandTotal = 0;
            foreach ($findUtilities as $utility) {
                $invoiceDetail = new InvoiceDetail();
                $invoiceDetail->invoice_id = $invoice->id;
                $invoiceDetail->name = $utility->name;
                $invoiceDetail->period = $utility->period;
                $invoiceDetail->description = $utility->description;
                $invoiceDetail->sub_total = $utility->sub_total;
                $invoiceDetail->save();

                $grandTotal += $invoiceDetail->sub_total;
            }

            $invoice->amount = $grandTotal;
            $invoice->discount_amount = 0;

            $invoice->final_amount = $grandTotal - $invoice->discount_amount;
            $invoice->save();
            DB::commit();

            // $whatsappService = new \App\Services\WhatsappService();
            // $whatsappService->sendInvoice($invoice->invoice_number);

            return [
                'status' => true,
                'data' => $invoice,
                'message' => 'Invoice created successfully',
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage() . ' ' . $e->getLine());
            return [
                'status' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ];
        }
        // return $invoice;
    }

    public function getInvoicesByUserAndCode($user_id, $code): Collection
    {
        $invoices = $this->model
            ->where('user_id', $user_id)
            ->whereHas('invoiceCategory', function ($query) use ($code) {
                $query->where('code', $code);
            })
            ->whereIn('status', ['unpaid'])
            ->get();
        return $invoices;

        //or join manual like here
        // $invoices = DB::table('invoices')
        // ->join('invoice_categories', 'invoices.invoice_category_id', '=', 'invoice_categories.id')
        // ->where('invoice_categories.code', '=', 'psb')
        // ->where('invoices.user_id', '=', auth()->user()->id)
        // ->get();
    }

    public function getCategories(): Collection
    {
        $categories = InvoiceCategory::all();
        return $categories;
    }
}