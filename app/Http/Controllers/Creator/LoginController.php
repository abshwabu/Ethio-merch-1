<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    public function create(){
        return view('creator.auth.login');
    }

    public function store(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (User::where('role','creator')->where('email',$request->email)->exists()) {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect()->intended('creator/dashboard');
            }
           
            session()->flash('error','wrong credentials');
            return redirect('creator/login');
        }
   else {
    session()->flash('error','wrong credentials');
    return redirect('creator/login');
}
    }
    
}
