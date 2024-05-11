<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Jobs\StudentAsramaExportJob;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentByMadinExport;
use App\Exports\StudentByAsramaExport;
use App\Exports\StudentByFormalExport;
use ProtoneMedia\Splade\Facades\Toast;

class ExportController extends Controller
{
    public function index()
    {
        $title = 'Export data';

        $year_collection = Student::whereNotNull('verified_at')->selectRaw('YEAR(verified_at) as year')->groupBy('year')->orderBy('year', 'desc')->pluck('year');

        return view('exports.index', compact('title', 'year_collection'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'year' => 'required',
        ]);

        if ($request->category == 'asrama') {
            $file_name = 'export_' . $request->category . '_' . $request->year . '-' . date('YmdHis') . '.xlsx';
            Excel::store(new StudentByAsramaExport($request->category, (int) $request->year), $file_name, 'google', null, ['visibility' => 'public']);
        }elseif($request->category == 'formal'){
            $file_name = 'export_' . $request->category . '_' . $request->year . '-' . date('YmdHis') . '.xlsx';
            Excel::store(new StudentByFormalExport($request->category, (int) $request->year), $file_name, 'google', null, ['visibility' => 'public']);
        }else{
            $file_name = 'export_madin_' . $request->year . '-' . date('YmdHis') . '.xlsx';
            Excel::store(new StudentByMadinExport($request->category, (int) $request->year), $file_name, 'google', null, ['visibility' => 'public']);
        }
        
        Toast::title('Berhasil')->message('Hasil export disimpan ke google drive')->success()->center()->autoDismiss(3);
        return back();
    }
}