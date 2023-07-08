<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFormatMessageRequest;
use App\Http\Requests\UpdateFormatMessageRequest;
use App\Models\FormatMessage;
use App\Tables\FormatMessages;
use ProtoneMedia\Splade\Facades\Toast;

class FormatMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('bakid.setting.format_message.index', [
            'format_message' => FormatMessages::class,
        ]);
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
    public function store(StoreFormatMessageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FormatMessage $formatMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FormatMessage $formatMessage)
    {
        return view('bakid.setting.format_message.edit', compact('formatMessage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormatMessageRequest $request, FormatMessage $formatMessage)
    {
        $formatMessage->update($request->validated());
        Toast::success('Pesan berhasil diubah');
        return redirect()->route('format-message.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FormatMessage $formatMessage)
    {
        //
    }
}
