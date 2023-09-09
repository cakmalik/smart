<?php

namespace App\Models\Bakid;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MutationHistory extends Model
{
    use HasFactory;
    protected $guarded = [];

    function student()
    {
        return $this->belongsTo(Student::class);
    }

    function before()
    {
        return $this->belongsTo($this->model, 'before_id');
    }

    function after()
    {
        return $this->belongsTo($this->model, 'after_id');
    }
}
