<?php

namespace App\Http\Controllers;

use App\Jobs\JobSendWhatsappReminder;
use Illuminate\Http\Request;

class TryController extends Controller
{
    function trySendMessage(): void
    {
        JobSendWhatsappReminder::dispatch();
    }
}
