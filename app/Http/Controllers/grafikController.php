<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class grafikController extends Controller
{
    public function index()
    {
        return view('chart');
    }
}
