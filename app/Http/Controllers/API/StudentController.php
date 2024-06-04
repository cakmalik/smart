<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    
    public function importStudent(Request $request)
    {
        $validate  = Validator::make($request->all(), [
            'file' => 'required|mimes:xls,xlsx',
        ], [
            'file.required' => 'File harus diisi.',
            'file.mimes' => 'File harus berupa file excel.',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validate->errors()->first(),
            ]);
        }
        
        $file = $request->file('file');
        
        Excel::import(new StudentImport, $file);
        
    }
}