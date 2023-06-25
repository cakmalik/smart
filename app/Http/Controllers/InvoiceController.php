<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function show($invoice_number)
    {
        $invoice = Invoice::where('invoice_number', $invoice_number)->first();
        return view('invoice.show', compact('invoice'));
    }
}
