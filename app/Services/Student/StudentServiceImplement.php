<?php

namespace App\Services\Student;

use Image;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Student\StudentRepository;
use Illuminate\Support\Facades\Log;

class StudentServiceImplement extends Service implements StudentService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(StudentRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }
    public function storeNewStudent($request)
    {
        $parent_data = [
            'father_name',
            'father_nik',
            'father_phone',
            'father_education',
            'father_job',
            'father_income',
            'mother_name',
            'mother_nik',
            'mother_phone',
            'mother_education',
            'mother_job',
            'mother_income',
            'parent_image',
        ];
        $student_data = $request->except($parent_data);
        $student_data['user_id'] = auth()->user()->id;

        if ($file = $request->file('student_image')) {
            $filename =  compressAndStoreImage($file);
            $student_data['student_image'] = $filename;
        }
        if ($file = $request->file('parent_image')) {
            $filename =  compressAndStoreImage($file, 'parent-photos');
            $parent_data['parent_image'] = $filename;
        }

        try {
            DB::beginTransaction();
            $parent = $this->mainRepository->createParent($request->only($parent_data));
            $student_data['student_family_id'] = $parent->id;
            $this->mainRepository->create($student_data);
            $status = true;
            $message = 'Data berhasil disimpan';
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $status = false;
            $message = 'Data gagal disimpan';
            $err = $e->getMessage();
            Log::error($err . ':' . $e->getLine());
        }
        return [
            'status' => $status,
            'message' => $message,
            'err' => $err ?? null
        ];
    }
}
