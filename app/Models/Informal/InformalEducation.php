<?php

namespace App\Models\Informal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformalEducation extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'value'];
    public function informalEducationClasses()
    {
        return $this->hasMany(InformalEducationClass::class);
    }
}