<?php

namespace App\Models\Formal;

use App\Models\Formal\FormalEducation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormalEducationClass extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function formalEducation()
    {
        return $this->belongsTo(FormalEducation::class);
    }
}
