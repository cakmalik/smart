<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use App\Models\Bakid\Room;
use Illuminate\Http\Request;
use App\Models\Formal\FormalEducation;
use App\Models\Informal\InformalEducation;
use App\Models\Informal\InformalEducationClass;

class DashboardController extends Controller
{
    public function index()
    {
        $x['formal'] = FormalEducation::all();
        $x['informal'] = InformalEducation::all();
        $user = auth()->user();
        if ($user->students->count() > 0) {
            $x['students'] = Student::where('user_id', auth()->user()->id)->whereNull('education_updated')->orderByDesc('id')->get();
        } else {
            $x['students'] = [];
        }

        $studentsWithoutRoom = User::where('id', auth()->user()->id)
            ->with(['students' => function ($query) {
                $query->whereDoesntHave('rooms');
            }])
            ->first()
            ->students;
        dd($studentsWithoutRoom);

        return view('dashboard', compact('x'));
    }
}
