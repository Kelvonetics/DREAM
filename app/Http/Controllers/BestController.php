<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BestController extends Controller
{
    public function index()
    {
    	return view('best.index');
    }
}
