<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class TemplateController extends Controller
{
    public function template()
    {
        $templates = Template::where('status', 0)->get();
        return view('admin.template.template', compact('templates'));
    }
    public function addEditTemplate(Request $request, $id = null)
    {

        if ($id == "") {
            $title = 'Add Template';
            $template = new Template;
            $templateData = array();
            $message = 'template added successfully';
        } else {
            $title = 'Edit Template';
            $template = Template::find($id);
            $templateData = Template::find($id);
            $message = 'template updated successfully';
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>" ; print_r($data) ; die;
            if ($id == null) {
                $rules = [
                    'name' => ['required', 'unique:templates'],
                    'image' => ['image'],
                ];
            } else {
                $rules = [
                    'image' => ['image'],
                ];
            }
            $customMessages = [
                'image.image' => 'valid image required',
            ];
            $this->validate($request, $rules, $customMessages);

            if ($request->hasFile('image')) {

                $dir = public_path('storage/' . $template->image);

                if (File::exists($dir)) {
                    File::delete($dir);
                }
                //Get file
                $file = $request->file('image');
                $path = $request['image']->store('templates', 'public');
                $template->image = $path;
            }

            $template->name = $request['name'];
            $template->save();
            Session::flash('success', $message);
            return redirect()->route('template');
        }


        return view('admin.template.add_edit_template', compact('title', 'templateData'));
    }
    public function update_status(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();


            if ($data['status'] == 'active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Template::where('id', $data['template_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'template_id' => $data['template_id']]);
        }
    }
}
