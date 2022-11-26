<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Creator;
use App\Models\Customer;
class UserController extends Controller
{
   
    public function creator(){
        $user = Creator::get();
        return view('admin.users.creator',compact('user'));
    }
    public function customer(){
        $user = Customer::get();
        return view('admin.users.customer',compact('user'));
    }
}
