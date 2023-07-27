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
                ->where('for', 'registration')
                ->get();
            Log::info('run: Loop JobReminderAdmission');
            foreach ($reminder as $key => $value) {
                // $message = "Assalamualaikum " . $value->user->name . ",\n\n";
                // $message .= "Terima kasih telah berkenan untuk mendaftar di PP Miftahul Ulum Bakid.\n";
                // $message .= "Kami mengingatkan bahwa hari ini Pendaftaran Santri Baru telah dibuka.\n\n";
                // $message .= "Jangan lupa melanjutkan pengisian data santri di website bakid.id\n\n";
                // $message .= "Terima kasih,\n";
                // $message .= config('app.name');

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
