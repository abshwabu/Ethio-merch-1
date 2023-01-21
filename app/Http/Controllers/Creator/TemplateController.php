<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {
        $template = Template::where('status', 1)->get();
        $title = 'Templates';
        return view('creator.template.template', compact('template', 'title'));
    }
}
