<?php

namespace App\View\Components\Bakid\Dashboard\Chart;

use Closure;
use App\Models\Student;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class SantriAktif extends Component
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
        $baseQuery = DB::table('students')->whereNotNull('verified_at')
                                      ->whereNull('deleted_at')
                                      ->whereNull('drop_out_at');
    
        $jml_santri_putri = (clone $baseQuery)->where('gender', 'female')->count();
        $jml_santri_putra = (clone $baseQuery)->where('gender', 'male')->count();
        
        $series = [$jml_santri_putra,$jml_santri_putri];
        $labels = ['Laki-laki','Perempuan'];
        return view('components.bakid.dashboard.chart.santri-aktif',compact('series','labels'));
    }
}