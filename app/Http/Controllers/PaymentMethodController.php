<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Requests\StorePaymentMethodRequest;
use App\Http\Requests\UpdatePaymentMethodRequest;

class PaymentMethodController extends Controller
{
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

            return redirect()->route('invoice.show', $invoice->invoice_number);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan, silahkan coba lagi');
        }
        // return redirect()->route('pay.invoice', $invoice->invoice_number);
    }
}
