<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class PresentationController extends Controller
{
    // index
    public function index()
    {
        $presentations = Employee::where('is_leader', 1)->firstOrFail();
        $i = 0;
        return view('presentations.index', compact('presentations', 'i'));
    }
}
