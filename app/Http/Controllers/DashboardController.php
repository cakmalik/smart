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
        $x['formal'] = FormalEducation::all();
        $x['informal'] = InformalEducation::all();
        $user = Auth::user();
        if ($user->students->count() > 0) {
            $x['students'] = Student::where('user_id', auth()->user()->id)->whereNull('education_updated')->orderByDesc('id')->get();
            $x['studentsWithoutRooms'] = $this->getStudentsWithoutRooms($user);
            $x['invoices_psb'] = $invoices_psb;
        } else {
            $x['students'] = [];
        }

        return view('dashboard', compact('x'));
    }

    public function getStudentsWithoutRooms($user)
    {
        $studentsWithoutRooms = DB::table('students')
            ->leftJoin('room_students', 'students.id', '=', 'room_students.student_id')
            ->whereNull('room_students.student_id')
            ->whereIn('students.id', $user->students->pluck('id'))
            ->select('students.id', 'students.name')
            ->get();
        return $studentsWithoutRooms;
    }
}
