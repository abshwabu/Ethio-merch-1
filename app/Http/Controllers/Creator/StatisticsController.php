<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        $title = 'User Statistics';
        return view('creator.statistics.statistics',compact('title'));
    }
}
