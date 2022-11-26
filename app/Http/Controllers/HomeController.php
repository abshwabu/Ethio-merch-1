<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if (Auth::user()->role== 'admin') {
            return redirect('admin');  
        }
        elseif (Auth::user()->role == 'creator') {
            return redirect('creator');
        }
        elseif (Auth::user()->role == 'user') {
            return redirect('/');
        }
        else {
            return redirect('login');
        }
    }
   
}
