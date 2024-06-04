<?php

namespace App\Imports;

use App\Models\Student;
use App\Models\StudentFamily;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $this->_storeFamily($row);
            $this->_storeUser($row);
            $this->_storeStudent($row);
            $this->_storeRoom($row);
            
        }
    }

    public function headingRow(): int
    {
        return 1;
    }

    private function _storeFamily($row){
        try {

            $sf = new StudentFamily();

            $sf->father_name = $row['nama_ayah'];
            $sf->father_nik = $row['no_nik'];
            $sf->father_phone = $row['nama_ayah'];
            $sf->father_education = $row['nama_ayah'];
            $sf->father_job = $row['nama_ayah'];
            $sf->father_income = $row['nama_ayah'];
            $sf->father_status = $row['ayah_kandung'];
            $sf->father_place_of_birth = $row['nama_ayah'];
            $sf->father_date_of_birth = $row['nama_ayah'];

            $sf->mother_name = $row['nama_ayah'];
            $sf->mother_nik = $row['nama_ayah'];
            $sf->mother_phone = $row['nama_ayah'];
            $sf->mother_education = $row['nama_ayah'];
            $sf->mother_job = $row['nama_ayah'];
            $sf->mother_income = $row['nama_ayah'];
            $sf->mother_status = $row['nama_ayah'];
            $sf->mother_place_of_birth = $row['nama_ayah'];
            $sf->mother_date_of_birth = $row['nama_ayah'];

            $sf->guard_name = $row['nama_ayah'];
            $sf->guard_nik = $row['nama_ayah'];
            $sf->guard_phone = $row['nama_ayah'];
            $sf->guard_education = $row['nama_ayah'];
            $sf->guard_job = $row['nama_ayah'];
            $sf->guard_income = $row['nama_ayah'];
            $sf->parent_image = $row['nama_ayah'];

            $sf->save();
            
        }catch(\Exception $e){
            Log::error($e->getMessage(). ' at line ' . $e->getLine());
            return false;
        }
    }

    private function _storeUser($row){
        try {
        }catch(\Exception $e){
            Log::error($e->getMessage(). ' at line ' . $e->getLine());
            return false;
        }
    }
    
    private function _storeStudent($row){
        try {
        }catch(\Exception $e){
            Log::error($e->getMessage(). ' at line ' . $e->getLine());
            return false;
        }
    }

    private function _storeRoom($row){
        try {
        }catch(\Exception $e){
            Log::error($e->getMessage(). ' at line ' . $e->getLine());
            return false;
        }
    }

}