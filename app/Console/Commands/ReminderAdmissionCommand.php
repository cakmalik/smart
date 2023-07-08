<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Admission;
use Illuminate\Console\Command;
use App\Jobs\JobReminderAdmission;

class ReminderAdmissionCommand extends Command
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
            JobReminderAdmission::dispatch();
        }
    }
}
