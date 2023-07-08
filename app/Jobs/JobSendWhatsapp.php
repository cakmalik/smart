<?php

namespace App\Jobs;

use App\Services\WhatsappService;
use Illuminate\Foundation\Bus\Dispatchable;

class JobSendWhatsapp
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
        // gunakan whatsapp service untuk mengirim pesan
        $whatsapp = new WhatsappService();
        $whatsapp->send($this->phone, $this->message);
    }
}
