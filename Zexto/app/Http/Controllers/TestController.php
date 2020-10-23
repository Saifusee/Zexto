<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Exports\TestExport;

class TestController extends Controller
{
    public function index() 
    {
        $export = new TestExport([
            [1, 2, 3],
            [4, 0, 6]
        ]);
 
        return Excel::download($export, 'invoices.xlsx');   
        // return view('welcome')->with('frontend_url', env('FRONTEND_URL')); 
    }
}
