<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;

class InvoiceController extends Controller
{
    public function show($invoice_number)
    {
        $invoice = Invoice::where('invoice_number', $invoice_number)->first();
        // dd($invoice);
        $pi = DB::table('payment_methods')
            ->join('payment_instructions as pi', 'pi.payment_method_id', '=', 'payment_methods.id')
            ->where('payment_methods.id', $invoice->payment_method_id)
            ->first();

        return view('invoice.show', compact('invoice', 'pi'));
    }
}
