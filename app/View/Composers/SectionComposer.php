<?php

namespace App\View\Composers;


use Illuminate\View\View;
use App\Models\Catagory;
use App\Models\Section;

class SectionComposer
{

    public function compose(View $view)
    {
        $menSection  = Catagory::where('status', '1')->where('section_id', '1')->get();
        $womenSection  = Catagory::where('status', '1')->where('section_id', '2')->get();
        $kidsSection  = Catagory::where('status', '1')->where('section_id', '3')->get();
        // $womenSection = json_decode(json_encode($womenSection),true);
        // echo "<pre>" ; print_r($womenSection) ; die ;
        $sections = Section::where('status',1)->get();
        $view->with(['menSection' => $menSection,'womenSection' => $womenSection,'kidsSection' => $kidsSection,'sections'=>$sections]);
    }
}
