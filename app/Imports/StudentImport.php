<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Student;
use App\Models\StudentFamily;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class StudentImport implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue, SkipsEmptyRows
{
    use Importable;

    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $count = 1;

        foreach ($rows as $row) {
            // log all row key only
            // Log::info($row->toArray());

            $this->_storeFamily($row, $count);
            // $this->_storeUser($row);
            // $this->_storeStudent($row);
            // $this->_storeRoom($row);

            $count++;
        }
    }

    public function headingRow(): int
    {
        return 1;
    }

    private function _storeFamily($row, $count)
    {
        try {
            $sf = new StudentFamily();

            $sf->father_name = $row['nama_a'] ?? '-';
            $sf->father_nik = $row['nik_a'] ?? '-';
            $sf->father_phone = null;
            $sf->father_education = $row['pend_a'] ?? '-';
            $sf->father_job = $row['pek_a'] ?? '-';
            $sf->father_income = $row['peng_a'] ?? '-';
            $sf->father_status = null;
            $sf->father_place_of_birth = null;
            // $sf->father_place_of_birth = $row['tempat_lahir_a']??'-';
            if ($row['tgl_lahir_a']) {
                // str replace '
                $row['tgl_lahir_a'] = str_replace("'", '', $row['tgl_lahir_a']);
                $tgl_lhr_a = Carbon::createFromFormat('d/m/Y', $row['tgl_lahir_a']);
                $sf->father_date_of_birth = $tgl_lhr_a->format('Y-m-d');
            }

            $sf->mother_name = $row['nama_i'] ?? '-';
            $sf->mother_nik = $row['nik_i'] ?? '-';
            $sf->mother_phone = null;
            $sf->mother_education = $row['pend_i'] ?? '-';
            $sf->mother_job = $row['pek_i'] ?? '-';
            $sf->mother_income = $row['peng_i'] ?? '-';
            $sf->mother_status = null;
            $sf->mother_place_of_birth = null;
            
            if ($row['tgl_lahir_i']) {
                $row['tgl_lahir_i'] = str_replace("'", "", $row['tgl_lahir_i']);
                $tgl_lhr_i = Carbon::createFromFormat('d/m/Y', $row['tgl_lahir_i']);
                $sf->mother_date_of_birth = $tgl_lhr_i->format('Y-m-d');
            }

            $sf->guard_name = null;
            $sf->guard_nik = null;
            $sf->guard_phone = null;
            $sf->guard_education = null;
            $sf->guard_job = null;
            $sf->guard_income = null;
            $sf->parent_image = null;

            $sf->save();
        } catch (\Exception $e) {
            // Log::error($e->getMessage(). ' at line ' . $e->getLine());
            Log::error('terjadi_kesalahan_baris_' . $count . 'a/n' . $row['nama'] . ' ==' . $e->getMessage());
            return false;
        }
    }

    private function _storeUser($row)
    {
        try {
        } catch (\Exception $e) {
            Log::error($e->getMessage() . ' at line ' . $e->getLine());
            return false;
        }
    }

    private function _storeStudent($row)
    {
        try {
        } catch (\Exception $e) {
            Log::error($e->getMessage() . ' at line ' . $e->getLine());
            return false;
        }
    }

    private function _storeRoom($row)
    {
        try {
        } catch (\Exception $e) {
            Log::error($e->getMessage() . ' at line ' . $e->getLine());
            return false;
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}