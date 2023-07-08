<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReminderNotification;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreReminderNotificationRequest;
use App\Http\Requests\UpdateReminderNotificationRequest;

class ReminderNotificationController extends Controller
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
    public function store(Request $request)
    {
        try {
            $reminderNotification = ReminderNotification::create([
                'user_id' => $request->user_id,
            ]);
            Toast::success('Pengingat berhasil ditambahkan');
            return back();
        } catch (\Exception $e) {
            Toast::error('Something went wrong');
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ReminderNotification $reminderNotification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReminderNotification $reminderNotification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReminderNotificationRequest $request, ReminderNotification $reminderNotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReminderNotification $reminderNotification)
    {
        //
    }
}
