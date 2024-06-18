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
    
    private $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function index()
    {
        $invoices_psb = $invoices = $this->invoiceService->getInvoicesByUserAndCode(auth()->user()->id, 'psb');
        $x['formal'] = FormalEducation::get(['name', 'level', 'id']);
        $newFormalEducation = new FormalEducation();
        $newFormalEducation->name = 'Lainnya';
        $newFormalEducation->level = '';
        $newFormalEducation->id = 0;
        $x['formal']->push($newFormalEducation);
        // dd($x['formal']);
        $x['informal'] = InformalEducation::all(['name', 'level', 'id']);
        $newFormalEducation = new InformalEducation();
        $newFormalEducation->name = 'Lainnya';
        $newFormalEducation->level = '';
        $newFormalEducation->id = 0;
        $x['informal']->push($newFormalEducation);

        $user = Auth::user();
        if ($user->students->count() > 0) {
            $x['students'] = Student::where('user_id', auth()->user()->id)->whereNull('education_updated')->orderByDesc('id')->get();
            $x['studentsWithoutRooms'] = $this->getStudentsWithoutRooms($user);
            $x['invoices_psb'] = $invoices_psb;
        } else {
            $x['students'] = [];
        }

        $count_new_students = Student::where('status', 'waiting')->count();
        $count_students = Student::where('status', 'accepted')->count();
        // dd($count_new_students, $count_students,);

        $summary = [
            'new_students' => $count_new_students,
            'students' => $count_students,
            'approval' => 0,
            'mutation' => 0
        ];
        return view('dashboard', compact('x', 'summary'));
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