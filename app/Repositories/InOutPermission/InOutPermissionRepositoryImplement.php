<?php

namespace App\Repositories\InOutPermission;

use App\Models\Bakid\InOutPermission;
use App\Models\Student;
use App\Models\Student\StudentInOutPermission;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use LaravelEasyRepository\Implementations\Eloquent;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

class InOutPermissionRepositoryImplement extends Eloquent implements InOutPermissionRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model;

    public function __construct(StudentInOutPermission $model)
    {
        $this->model = $model;
    }

    public function isLoggedOut($student_id): bool
    {

        $find = !!$this->model->where('student_id', $student_id)->whereNotNull('out_time')->whereNull('in_time')->first();
        return $find;
    }

    public function storeIn($student_id, $request)
    {
        try {
            $this->model->create([
                'student_id' => $student_id,
                'in_out_permission_type_id' => $request->type ?? 1,
                'out_time' => now(),
                'reason' => $request->reason ?? '',
                'approved_by' => Auth::user()->id
            ]);
            $data['success'] = true;
            $data['message'] = 'Perizinan Berhasil';
            return $data;
        } catch (\Exception $e) {
            $data['success'] = false;
            $data['message'] = 'Terjadi kesalahan. silahkan periksa kembali' . $e->getMessage();
        }
        return $data;
    }

    public function storeOut($student_id)
    {
        try {
            $find = $this->model->with('type')->where('student_id', $student_id)->orderByDesc('id')->first();
            $is_late = Carbon::parse($find->out_time)->addMinutes($find->type->duration) < Carbon::now();

            $find->in_time = now();
            $find->is_late = $is_late;
            $find->save();

            $data['success'] = true;
            $data['message'] =  $is_late ? 'TERLAMBAT : Berhasil Check In Pesantren' : 'TEPAT WAKTU : Berhasil Check In Pesantren ';
            return $data;
        } catch (\Exception $e) {
            $data['success'] = false;
            $data['message'] = 'Terjadi kesalahan. silahkan periksa kembali' . $e->getMessage();
        }
        return $data;
    }
}
