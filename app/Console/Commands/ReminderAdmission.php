<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ReminderAdmission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reminder-admission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // // aku ingin mengingatkan ini di 2 jam yaitu jam 10 pagi dan jam 2 siang

        // date_default_timezone_set('Asia/Jakarta');
        // $current_date = date('Y-m-d');
        // $invoices = Invoice::where('invoice_status', 'draft')
        //     ->whereDate('remember_delivery', $current_date)
        //     ->count();

        // if ($invoices > 0) {
        //     Log::info('Ada ' . $invoices . ' invoice yang harus diingatkan untuk dikirimkan ke tenant');
        //     Broadcast(new RememberAdmin('Ada ' . $invoices . ' yang harus dikirim pagi ini, abaikan pesan ini jika sudah dikirimkan'));
        // } else {
        //     Log::info("harusnya tidak ada invoice yang harus diingatkan");
        // }
    }
}
