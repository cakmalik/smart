<?php

namespace App\Models\Informal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformalEducationClass extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function informalEducation()
    {
        return $this->belongsTo(InformalEducation::class);
    }
}
