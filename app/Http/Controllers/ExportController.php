<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportController extends Controller
{

    public function index(){
        $title = 'Export data';
        return view('exports.index', compact('title'));
    }
}