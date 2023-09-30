<?php

namespace App\Models\Student;

use App\Models\Bakid\InOutPermissionType;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInOutPermission extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(InOutPermissionType::class, 'in_out_permission_type_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
