<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolController extends Controller
{

    public function index() {
        return view('tools.index');
    }

    public function create()
    {
        return view('tools.create');
    }

}
