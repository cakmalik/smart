<?php

namespace App\Jobs;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use App\Exports\StudentByAsramaExport;
use App\Models\Utils\StudentExportHistory;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
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
    try {
        $exe = new StudentByAsramaExport($this->year);
    
        $filename = 'by-' . $this->category . '-' . $this->year . '(' . date('ymdHis') . ')';
        $filePath = 'exports/' . $filename . '.xlsx'; // Path untuk menyimpan file di dalam direktori 'storage/app/exports'
    
        // Ekspor data siswa ke file Excel
        $exe->download($filePath);
    
        // Pindahkan file Excel ke direktori 'storage/app/exports'
        Storage::move($filePath, 'exports/' . $this->category . '.xlsx');
    
        // Simpan ke database
        StudentExportHistory::create([
            'file_name' => $filename,
            'year' => $this->year,
            'type' => $this->category,
            'status' => 'success',
        ]);
    } catch (\Exception $e) {
        // Tangani exception yang terjadi
        // Contoh: Log pesan kesalahan atau tindakan pemulihan lainnya
        Log::error('Error exporting and storing data: ' . $e->getMessage());
    
        // Ubah status ke 'failed' jika terjadi kesalahan
        StudentExportHistory::create([
            'file_name' => $filename ?? 'unknown',
            'year' => $this->year ?? 'unknown',
            'type' => $this->category ?? 'unknown',
            'status' => 'failed',
        ]);
    
        // Throw exception kembali untuk penanganan lebih lanjut jika perlu
        throw $e;
    }
    
}