<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $file;
    /**
     * Create a new job instance.
     */
    public function __construct($file)
    {
        $this->file = $file; //MENERIMA PARAMETER YANG DIKIRIM 
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        
        Excel::import(new StudentImport, 'public/' . $this->file);
        unlink(storage_path('app/public/' . $this->file));
    }
}