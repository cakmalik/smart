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
        $d = Dormitory::where('gender', $jk)->get(['id', 'name']);
        $newD = new Dormitory();
        $newD->id = 0;
        $newD->name = 'Lainnya';
        $d->push($newD);

        return response()->json($d);
    }
}
