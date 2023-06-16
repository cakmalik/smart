<?php

namespace App\Console\Commands;

use App\Jobs\ReminderAdmission as JobsReminderAdmission;
use App\Models\Admission;
use Carbon\Carbon;
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
        date_default_timezone_set('Asia/Jakarta');
        $reminder = !!Admission::whereDate('start_date', Carbon::today())->where('is_active', true)->first();
        if ($reminder) {
            JobsReminderAdmission::dispatch();
        }
    }
}
