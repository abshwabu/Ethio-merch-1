<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Catagory;
use App\Models\Section;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class CategoryController extends Controller
{
    public function category()
    {
        // $category=Catagory::get();
        $category = Catagory::with('section')->get();
        // $category=json_decode(json_encode($category));
        // echo "<pre>";print_r($category); die;
        return view('creator.category.category', compact('category'));
    }
    public function addEditCategory(Request $request, $id = null)
    {
        if ($id == null) {
            $title = "Add category";
            $category = new Catagory;
            $categoryData = array();
            $message = "category added successfuly";
            $getCategories = null;
        } else {
            $title = "Edit category";
            $category = Catagory::find($id);
            $categoryData = Catagory::find($id);
            $message = "category updated successfuly";
            // $getCategories = Catagory::with('subcategories')->where('parent_id','0')->where('status','1')->where('section_id',$category['section_id'])->get();

        }
        if ($request->isMethod('post')) {
            if ($id == null) {
                $rules = [
                    'section_id' => ['required'],
                    // 'parent_id' => ['required'],
                    'cate_name' => ['required'],
                    'cate_discount' => ['between:0,99.99', 'nullable'],
                    'cate_image' => ['image'],
                    'slug' => ['required', 'unique:catagories'],

                ];
            } else {
                $rules = [


                    'cate_discount' => ['between:0,99.99'],
                    'cate_image' => ['image'],

                ];
            }


            $customMessages = [
                'section_id.required' => 'section is required',
                // 'parent_id.required' => 'Catagory level is required',
                'cate_image.image' => 'valid image required',
                'cate_discount.discount' => 'valid discount% required',

            ];
            $this->validate($request, $rules, $customMessages);

            if ($request->hasFile('cate_image')) {
                $dir = public_path('storage/' . $category->cate_image);
                if (File::exists($dir)) {
                    File::delete($dir);
                }
                $path = $request['cate_image']->store('categories', 'public');
                $category->cate_image = $path;
            }

            $category->section_id = $request['section_id'];
            // $category->parent_id = $request['parent_id'];
            $category->added_by = Auth::user()->id;
            $category->cate_name = $request['cate_name'];
            $category->description = $request['description'];
            $category->cate_discount = $request['cate_discount'];
            $category->slug = $request['slug'];
            $category->meta_title = $request['meta_title'];
            $category->meta_keyword = $request['meta_keyword'];
            $category->meta_desc = $request['meta_desc'];
            $category->save();
            Session::flash('success', $message);
            return redirect('creator/categories');
        }

        $categories = Catagory::where('id', $id)->first();
        $getSection = Section::all();
        return view('creator.category.add_edit_category', compact('title', 'getSection', 'categoryData', 'categories'));
    }
    public function new_category(Request $request)
    {

        $request->validate([
            'cate_name' => ['required'],
            'cate_discount' => ['numeric', 'nullable'],
            'cate_img' => ['image'],
            'slug' => ['required', 'unique:catagories']

        ]);

        if ($request->hasFile('cate_img')) {
            $path = $request['cate_img']->store('categories', 'public');


            $category = new Catagory([
                'section_id' => $request->section_id,
                // 'parent_id'=>$request->parent_id,
                'cate_name' => $request->cate_name,
                'description' => $request->description,
                'cate_discount' => $request->cate_discount,
                'slug' => $request->slug,
                'meta_title' => $request->meta_title,
                'meta_keyword' => $request->meta_keyword,
                'meta_desc' => $request->meta_desc,
                'cate_image' => $path
            ]);
            $category->save();
        } else {
            $category = new Catagory([
                'section_id' => $request->section_id,
                // 'parent_id'=>$request->parent_id,
                'cate_name' => $request->cate_name,
                'description' => $request->description,
                'cate_discount' => $request->cate_discount,
                'slug' => $request->slug,
                'meta_title' => $request->meta_title,
                'meta_keyword' => $request->meta_keyword,
                'meta_desc' => $request->meta_desc
            ]);
            $category->save();
        }
        return redirect('creator/categories');
    }
    public function update_category(Request $request, $id)
    {

        $request->validate([
            'cate_discount' => ['numeric'],
            'cate_img' => ['image'],

        ]);

        if ($request->hasFile('cate_img')) {
            $category = Catagory::find($id);
            $dir = public_path('storage/' . $category->cate_img);
            if (File::exists($dir)) {
                File::delete($dir);
            }
            $path = $request['cate_img']->store('categories', 'public');



            $category->section_id = $request->section_id;
            // $category->parent_id=$request->parent_id;
            $category->cate_name = $request->cate_name;
            $category->description = $request->description;
            $category->cate_discount = $request->cate_discount;
            $category->slug = $request->slug;
            $category->meta_title = $request->meta_title;
            $category->meta_keyword = $request->meta_keyword;
            $category->meta_desc = $request->meta_desc;
            $category->cate_image = $path;
            $category->update();
        } else {
            $category = Catagory::find($id);
            $category->section_id = $request->section_id;
            // $category->parent_id=$request->parent_id;
            $category->cate_name = $request->cate_name;
            $category->description = $request->input('description');
            $category->cate_discount = $request->cate_discount;
            $category->slug = $request->slug;
            $category->meta_title = $request->meta_title;
            $category->meta_keyword = $request->meta_keyword;
            $category->meta_desc = $request->meta_desc;
            $category->update();
        }
        return redirect('creator/categories');
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
            Catagory::where('id', $data['cate_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'cate_id' => $data['cate_id']]);
        }
    }
    public function delete_category($id)
    {
        $category = Catagory::where('id', $id)->first();
        if (file_exists('storage/' . $category->cate_image)) {
            File::delete('storage/' . $category->cate_image);
        }

        $category->delete();
        Session::flash('success', 'category deleted');
        return redirect()->back();
    }
    //  public function append_categories_level(Request $request){
    //   if($request->ajax()){
    //     $data=$request->all();

    //     $getCategories = Catagory::with('subcategories')->where('parent_id','0')->where('status','1')->where('section_id',$data['section_id'])->get();
    //     $getCategories=json_decode(json_encode($getCategories),true);
    //     // echo "<pre>" ;print_r($getCategories);die;
    //    return view('creator.category.append_categories_level',compact('getCategories'));
    //   }
    //  }
}
