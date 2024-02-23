<?php

namespace App\Models\Informal;

use Illuminate\Database\Eloquent\Model;
use App\Models\Informal\InformalEducationGrade;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InformalEducationClass extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function informalEducation()
    {
        return $this->belongsTo(InformalEducation::class);
    }

    public function rombel()
    {
        return $this->belongsTo(InformalEducationGrade::class);
    }
}
