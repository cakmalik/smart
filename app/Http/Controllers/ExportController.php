<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Jobs\StudentAsramaExportJob;

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
        StudentAsramaExportJob::dispatch($request->category, (int) $request->year, (int) $request->dormitory_id, (int) $request->room_id);
    }
}