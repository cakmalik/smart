<?php

namespace App\Models\Formal;

use Illuminate\Database\Eloquent\Model;
use App\Models\Formal\FormalEducationClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormalEducation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function formalEducationClasses()
    {
        return $this->hasMany(FormalEducationClass::class);
    }
}
