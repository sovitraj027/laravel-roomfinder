<?php

namespace App\Http\Controllers;

use Closure;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        if (auth()->user()->role == 4 || auth()->user()->role == 3) {
            return view('banned');
        }
        return view('home');
    }
}
