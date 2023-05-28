<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole(['SuperAdmin', 'Operator']))
        {
            return view('admin.dashboard.index');
        }

        if (Auth::user()->hasRole('Manager'))
        {
            return view('manager.dashboard.index');
        }

        if (Auth::user()->hasRole('Teknisi'))
        {
            return view('technician.dashboard.index');
        }

    }
}
