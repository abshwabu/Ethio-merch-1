<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use Illuminate\Support\Facades\Session;

class SectionController extends Controller
{
    public function section(){
        $section=Section::all();
        return view('admin.section.section',compact('section'));
     }
     public function edit_section($id){
        $section = Section::where('id',$id)->first();
        return view('admin.section.edit_section', compact('section'));
     }
     protected function update_section(Request $request , $id){
      $request->validate([
         'name' => ['string', 'min:3']
      ]);
      $section = Section::where('id',$id)->first();
      $section->name=$request->name;
      $section->status=$request->status == true ? '1' : '0';
      $section->save();
      
         Session::flash('success','section updated');
      
     
      return redirect()->route('section');
     }
   
   protected function delete_section($id){
      Section::find($id)->delete();
      return back();
   }
   public function update_status(Request $request){
      if ($request->ajax()) {
         $data= $request->all();
        
      
      if($data['status']== 'active'){
          $status = 0;
      }
      else {
          $status = 1;
      }
      Section::where('id',$data['section_id'])->update(['status'=>$status]);
      return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
  }
   }
 
}
