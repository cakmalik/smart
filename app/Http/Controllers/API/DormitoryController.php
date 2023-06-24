<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bakid\Dormitory;
use App\Models\Student;

class DormitoryController extends Controller
{
    public function getDormitoriesByStudentGender(Student $student)
    {
        if ($student->gender === 'male') {
            $jk = 'L';
        } else {
            $jk = 'P';
        }
        $d = Dormitory::where('gender', $jk)->get();
        return response()->json($d);
    }
}
