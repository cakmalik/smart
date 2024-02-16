<?php

namespace App\Models\Formal;

use App\Models\Formal\FormalEducation;
use Illuminate\Database\Eloquent\Model;
use App\Models\Formal\FormalEducationGrade;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormalEducationClass extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function formalEducation()
    {
        return $this->belongsTo(FormalEducation::class);
    }

    public function rombel(){
        return $this->hasMany(FormalEducationGrade::class);
    }
}
