<?php

namespace App\Jobs;

use App\Models\FormatMessage;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\Log;
use App\Models\ReminderNotification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class JobReminderAdmission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //fungsi kirim wa untuk mengingatkan semua orang yang terdaftar
        Log::info('run: JobReminderAdmission');
        try {
            $reminder = ReminderNotification::with('user')
                ->where('status', 'pending')
                // ->where('for', 'registration')
                ->get();

            Log::info('run: Loop JobReminderAdmission');
            $message = FormatMessage::where('name', 'reminder_registration')->first()->message;

            foreach ($reminder as $key => $value) {

                // placeholder
                $namaOrtu = $value->user->name;
                $enter = PHP_EOL;
                $placeholders = ['#nama_ortu', '#enter'];
                $values = [$namaOrtu, $enter];

                // formatted + to url
                $pesanFormatted = formatMessage($message, $placeholders, $values);
                $message = urlencode($pesanFormatted);

                $send = new JobSendWhatsappReminder($value->user->phone, $message);
                dispatch($send);

                // $whatsapp = new WhatsappService();
                // $whatsapp->send($value->user->phone, $message);
            }
            Log::info('run: End Loop JobReminderAdmission');
        } catch (\Exception $e) {
            Log::error($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
        }
    }
}
