<?php

namespace App\Jobs;

use App\Services\WhatsappService;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Bus\Dispatchable;

class JobSendWhatsappMessage
{
    use Dispatchable;

    /**
     * Create a new job instance.
     */

    public $phone;
    public $message;

    public function __construct(
        string $phone,
        string $message
    ) {
        $this->phone = $phone;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('run: JobSendWhatsapp');
        try {
            $whatsapp = new WhatsappService();
            $whatsapp->sendMessage($this->phone, $this->message);
        } catch (\Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
        Log::info('run: End JobSendWhatsapp');
    }
}