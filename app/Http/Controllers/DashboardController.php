<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Student;
use App\Models\Bakid\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Formal\FormalEducation;
use App\Services\Invoice\InvoiceService;
use App\Models\Informal\InformalEducation;
use App\Models\Informal\InformalEducationClass;

class DashboardController extends Controller
{
    

    public function index()
    {
        return view('dashboard');
    }

    public function getStudentsWithoutRooms($user)
    {
        $studentsWithoutRooms = DB::table('students')->whereNull('deleted_at')
            ->leftJoin('room_students', 'students.id', '=', 'room_students.student_id')
            ->whereNull('room_students.student_id')
            ->whereIn('students.id', $user->students->pluck('id'))
            ->select('students.id', 'students.name')
            ->get();
        return $studentsWithoutRooms;
    }
}