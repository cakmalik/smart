<?php

namespace App\View\Components\Bakid\Dashboard\Chart;

use Closure;
use Carbon\Carbon;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class AnnualStudentCounter extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $currentYear = Carbon::now()->year;

        $jml_data = [];
        $label_data = [];
        for($i=0; $i<=6; $i++){
            $year = $currentYear - $i;
            $count = DB::table('students')
            ->whereYear('verified_at',$year)
            ->whereNull('deleted_at')
            ->count(); 
            
            $jml_data[] = $count;
            $label_data[] = $year;
        }


        return view('components.bakid.dashboard.chart.annual-student-counter',compact('jml_data','label_data')); 
    }
}