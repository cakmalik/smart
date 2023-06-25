<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePaymentInstructionRequest;
use App\Http\Requests\UpdatePaymentInstructionRequest;
use App\Models\PaymentInstruction;

class PaymentInstructionController extends Controller
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
    public function store(StorePaymentInstructionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentInstruction $paymentInstruction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentInstruction $paymentInstruction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentInstructionRequest $request, PaymentInstruction $paymentInstruction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentInstruction $paymentInstruction)
    {
        //
    }
}
