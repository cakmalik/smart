<?php

namespace App\Models;

use App\Models\Informal\InformalEducation;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserHasInformalEducationPermission extends Model
{
    use HasFactory;
    
    protected $table= 'user_has_informal_education_permission';

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function InformalEducation(){
        return $this->belongsTo(InformalEducation::class, 'education_id', 'id');
    }
}