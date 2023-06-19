<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Formal\FormalEducation;

class FormalEducationController extends Controller
{
    public function getformalClassesFromFormalEducation($id)
    {
        $formalEducation = FormalEducation::find((int)$id);
        return response()->json($formalEducation->formalEducationClasses);
    }
}
