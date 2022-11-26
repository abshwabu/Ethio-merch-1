<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $title = 'Set up your shop';
       return view('creator.shop.shop',compact('title'));
    }
}
