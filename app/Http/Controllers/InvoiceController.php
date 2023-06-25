<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }

    public function chooseMethod($invoice_number)
    {
        $invoice = Invoice::where('invoice_number', $invoice_number)->first();
        if ($invoice->payment_method_id != null) {
            return redirect()->route('invoice.show', $invoice->invoice_number);
        }
        $payment_methods = PaymentMethod::all();
        // dd($payment_methods);
        return view('invoice.choose_method', compact('invoice', 'payment_methods'));
    }

    public function changeMethod(Request $request)
    {
        try {
            if ($request->payment_method_id == null) {
                // TODO:ini nanti diganti code
                $payment_method = PaymentMethod::where('name', '==', 'Cash')->first()->id;
            } else {
                $payment_method = $request->payment_method_id;
            }

            $invoice = Invoice::where('invoice_number', $request->invoice_number)->first();
            $invoice->payment_method_id = $payment_method;
            $invoice->save();

            return redirect()->route('pay.invoice', $invoice->invoice_number);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan, silahkan coba lagi');
        }
        // return redirect()->route('pay.invoice', $invoice->invoice_number);
    }

    public function show($invoice_number)
    {
        $invoice = Invoice::where('invoice_number', $invoice_number)->first();
        return view('invoice.show', compact('invoice'));
    }
}
