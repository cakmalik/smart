<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Informal\InformalEducation;

class InformalEducationController extends Controller
{
    public function getInformalClassesFromInFormalEducation($id)
    {
        $informalEducation = InformalEducation::find((int)$id);
        return response()->json($informalEducation->informalEducationClasses);
    }
    
}
