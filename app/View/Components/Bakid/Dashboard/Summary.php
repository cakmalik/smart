<?php

namespace App\View\Components\Bakid\Dashboard;

use Closure;
use App\Models\Invoice;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Formal\FormalEducation;
use App\Services\Invoice\InvoiceService;
use App\Models\Informal\InformalEducation;

class Summary extends Component
{
    /**
     * Create a new component instance.
     */


    public $invoiceService;

     public function __construct(InvoiceService $invoiceService)
     {
         $this->invoiceService = $invoiceService;
     }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
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
            $x['students'] = DB::table('students')->whereNull('deleted_at')->where('user_id', auth()->user()->id)->whereNull('education_updated')->orderByDesc('id')->get();
            $x['studentsWithoutRooms'] = $this->getStudentsWithoutRooms($user);
            $x['invoices_psb'] = $invoices_psb;
        } else {
            $x['students'] = [];
        }

        $pendaftar = DB::table('students')->whereNull('deleted_at')->where('status', 'waiting')->count();
        $count_students_l = DB::table('students')->whereNull('deleted_at')->where('status', 'accepted')->where('gender', 'male')->count();
        $count_students_p = DB::table('students')->whereNull('deleted_at')->where('status', 'accepted')->where('gender', 'female')->count();

        $invoice_psb = Invoice::whereHas('Category', function ($query) {
            $query->where('code', 'psb');
        })->whereYear('created_at', date('Y'));
        // dd($count_new_students, $count_students,);

        $psb_paid_count = $invoice_psb->where('status', 'paid')->count();
        $psb_paid_amount = $invoice_psb->where('status', 'paid')->sum('final_amount');
        $psb_unpaid_count = $invoice_psb->where('status', 'unpaid')->count();
        $psb_unpaid_amount = $invoice_psb->where('status', 'unpaid')->sum('final_amount');
        $psb_student_count = DB::table('students')->whereNull('deleted_at')->whereyear('verified_at', date('Y'))->count();
        $psb_student_l_count = DB::table('students')->whereNull('deleted_at')->whereyear('verified_at', date('Y'))->where('gender', 'male')->count();
        $psb_student_p_count = DB::table('students')->whereNull('deleted_at')->whereyear('verified_at', date('Y'))->where('gender', 'female')->count();

        
        $summary = [
            'pendaftar' => $pendaftar,
            'student_l_count' => $count_students_l,
            'student_p_count' => $count_students_p,
            'approval' => 0,
            'mutation' => 0,
            'psb_paid_count' => $psb_paid_count,
            'psb_paid_amount' => $psb_paid_amount,
            'psb_unpaid_count' => $psb_unpaid_count,
            'psb_unpaid_amount' => $psb_unpaid_amount,
            'psb_student_count' => $psb_student_count,
            'psb_student_l_count' => $psb_student_l_count,
            'psb_student_p_count' => $psb_student_p_count
        ];
        
        return view('components.bakid.dashboard.summary', compact('summary'));
    }
}