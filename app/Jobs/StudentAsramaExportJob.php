<?php

namespace App\Jobs;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class StudentAsramaExportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public string $category;
    public int $year;
    public int $dormitory_id;
    public int $room_id;
     
    public function __construct(string $category, int $year, int $dormitory_id, int $room_id)
    {
        $this->category = $category;
        $this->year = $year;
        $this->dormitory_id = $dormitory_id;
        $this->room_id = $room_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('run: JobStudentAsramaExport');
    }
}