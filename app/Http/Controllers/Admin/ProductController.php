<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Models\Section;
use App\Models\Catagory;
use App\Models\Product;
use App\Models\ProductAttributes;
use App\Models\ProductImages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function product()
    {
        $product = Product::with(['catagory' => function ($query) {
            $query->select('id', 'cate_name');
        }, 'section' => function ($query) {
            $query->select('id', 'name');
        }])->get();
        //   $product=json_decode(json_encode([$product ]));
        // echo "<pre>";print_r($product); die;
        return view('admin.product.product', compact('product'));
    }

    public function addEditProduct(Request $request, $id = null)
    {

        if ($id == "") {
            $title = 'Add Product';
            $product = new Product;
            $productData = array();
            $message = 'product added successfully';
        } else {
            $title = 'Edit Product';
            $product= Product::find($id);
            $productData = Product::find($id);
            $message = 'product updated successfully';

        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>" ; print_r($data) ; die;
            if ($id == null) {
                $rules = [
                    'category_id' => ['required'],
                    'product_name' => ['required', 'unique:products'],
                    'product_discount' => ['numeric'],
                    'product_image' => ['image'],
                    'slug' => ['required', 'unique:products'],
                    'product_code' => ['required', 'regex:/^[A-Za-z]{2}\d{4}$/', 'unique:products'],
                    'regular_price' => ['required', 'numeric'],
                    'sale_price' => ['required', 'numeric'],
                    'stock' => ['required', 'numeric'],
                    'product_color' => ['required'],
                ];
            } else {
                $rules = [
                
                
                    'product_discount' => ['numeric'],
                    'product_image' => ['image'],
                    'product_code' => ['regex:/^[A-Za-z]{2}\d{4}$/'],
                    'regular_price' => ['numeric'],
                    'sale_price' => ['numeric'],
                    'stock' => ['numeric']
                    ];
            }
            
            
            $customMessages = [
                'category_id.required' => 'Catagory is required',
                'product_image.image' => 'valid image required',
                'product_code.regex' => 'valid product code required ex.Ab0012',
                'regular_price.numeric' => 'valid product price is required',
                'sale_price.numeric' => 'valid product price is required'
            ];
            $this->validate($request, $rules, $customMessages);

            if ($request->hasFile('product_image')) {
                
                $dir = public_path('storage/' . $product->product_image);
              
                if (File::exists($dir)) {
                    File::delete($dir);
                }
                //Get file
                $file= $request->file('product_image');
                
                $path = $request['product_image']->store('products', 'public');

                $product->product_image = $path;
            }
            $categoryDetails = Catagory::find($data['category_id']);

            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $request->category_id;
            $product->added_by = Auth::user()->id;
            $product->product_name = $request['product_name'];
            $product->description = $request['description'];
            $product->product_code = $request['product_code'];
            $product->product_color = $request['product_color'];
            $product->regular_price = $request['regular_price'];
            $product->sale_price = $request['sale_price']; 
            $product->quantity = $request['stock'];
            // $product->fabric = $request['fabric'];
            // $product->fit = $request['fit'];
            // $product->sleeve = $request['sleeve'];
            // $product->pattern = $request['pattern'];
            // $product->occassion = $request['occassion'];
            // $product->wash_care = $request['wash_care'];
            $product->product_discount = $request['product_discount'];
            $product->slug = $request['slug'];
            $product->meta_title = $request['meta_title'];
            $product->meta_keyword = $request['meta_keyword'];
            $product->meta_description = $request['meta_description'];
            $product->save();
            Session::flash('success', $message);
            return redirect()->route('product');
        }
      
        //Filter array
        // $fabricArray = array('cotton', 'polyester');
        // $fitArray = array('regular', 'slim');
        // $sleeveArray = array('full sleeve', 'half sleeve', 'sleeveless');
        // $patternArray = array('self', 'plain', 'checkered ', 'solid', 'printed');
        // $occassionArray = array('casual', 'formal');,// 'fabricArray', 'fitArray', 'sleeveArray', 'patternArray', 'occassionArray'
        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories), true);
        // echo "<pre>"; print_r($categories); die; 
        return view('admin.product.add_edit_product', compact('title', 'categories','productData'));
    }

    public function update_product(Request $request, $id)
    {

        $request->validate([
            'product_discount' => ['numeric', 'nullable'],
            'product_image' => ['image'],
            'product_code' => ['regex:/^[A-Z]{2}\d{4}$/'],

        ]);

        if ($request->hasFile('product_image')) {
            $product = Product::find($id);
            $dir = public_path('storage/' . $product->product_image);
            if (File::exists($dir)) {
                File::delete($dir);
            }
            $path = $request['product_image']->store('products', 'public');

            $product->section_id = $request->section_id;
            $product->category_id = $request->category_id;
            $product->product_name = $request->product_name;
            $product->description = $request->description;
            $product->product_discount = $request->product_discount;
            $product->slug = $request->slug;
            $product->meta_title = $request->meta_title;
            $product->meta_keyword = $request->meta_keyword;
            $product->meta_description = $request->meta_description;
            $product->product_image = $path;
            $product->update();
        } else {
            $product = product::find($id);
            $product->section_id = $request->section_id;
            $product->category_id = $request->category_id;
            $product->product_name = $request->product_name;
            $product->description = $request->input('description');
            $product->product_discount = $request->product_discount;
            $product->slug = $request->slug;
            $product->meta_title = $request->meta_title;
            $product->meta_keyword = $request->meta_keyword;
            $product->meta_description = $request->meta_description;
            $product->update();
        }
        return redirect()->route('product');
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
            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }
    public function update_is_featured(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();


            if ($data['is_featured'] == 'Yes') {
                $is_featured = 0;
            } else {
                $is_featured = 1;
            }
            Product::where('id', $data['product_id2'])->update(['is_featured' => $is_featured]);
            return response()->json(['is_featured' => $is_featured, 'product_id2' => $data['product_id2']]);
        }
    }
    public function delete_product($id)
    {
        $product = Product::where('id', $id)->first();
        if (file_exists('storage/' . $product->product_image)) {
            File::delete('storage/' . $product->product_image);
        }

        $product->delete();
        Session::flash('success', 'product deleted');
        return redirect()->back();
    }
    // public function append_product_categories(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = $request->all();

    //         $getCategories = Catagory::with('subcategories')->where('parent_id', '0')->where('status', '1')->where('section_id', $data['section_id'])->get();
    //         //   $getCategories=json_decode(json_encode($getCategories),true);
    //         //   echo "<pre>" ;print_r($getCategories);die;
    //         return view('admin.product.append_categories_level', compact('getCategories'));
    //     }
    // }

    
    public function addAttributes(Request $request ,$id = null){
        $product = Product::select('id','product_name','product_code','product_color','product_image')->with('attributes')->find($id);
            $product=json_decode(json_encode($product),true);
            // echo "<pre>";print_r($product); die;
            $title = 'Add product attributes';
        if ($request->isMethod('post')) {
            $data = $request->all();
           foreach ($data['SKU'] as $key => $value) {
           
            if (!empty($value)) {
                if (ProductAttributes::where('SKU',$value)->exists()) {
                    $message = 'SKU already exists choose another';
                    Session::flash('error', $message);
                    return redirect()->back();
                }
                if (ProductAttributes::where(['product_id'=>$id, 'size'=>$data['size'][$key]])->exists()) {
                    $message = 'duplicate size choose another size';
                    Session::flash('error', $message);
                    return redirect()->back();
                }
                $attribute = new ProductAttributes;
                $attribute->product_id = $id;
                $attribute->SKU = $value;
                $attribute->size = $data['size'][$key];
                $attribute->stock = $data['stock'][$key];
                $attribute->price = $data['price'][$key];
                $attribute->save();
              
              

            }
           }
           $message = 'attribute added successfully';
           Session::flash('success', $message);
           return redirect()->back();
        }
        return view('admin.product.add_attributes')->with(compact('product','title'));
    }
    public function editAttributes(Request $request, $id){
        $attributes = Product::select('id')->with('attributes')->find($id);
        if ($request->isMethod('post')) {
            $data = $request->all();
            foreach ($data['atrrId'] as $key => $value) {
                if (!empty($value)) {
                    ProductAttributes::where('id',$data['atrrId'][$key])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
                    
                }
            }
            session()->flash('success','attributes updated');
            return redirect()->back();
            // $data=json_decode(json_encode($data),true);
            // echo "<pre>";print_r($data); die;
        }
    }
     public function update_attribute_status(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $data=json_decode(json_encode($data),true);
            // echo "<pre>";print_r($data); die;
            if ($data['status']=='active') {
                $status = 0;
            }
            else{
                $status = 1;
            }
            ProductAttributes::where(['id'=>$data['attribute_id']])->update(['status'=>$status]);
            return response()->json(['attribute_id' => $data['attribute_id'] , 'status' => $status]);
        }
    }
    public function delete_attribute($id)
    {
        ProductAttributes::find($id)->delete();
        session()->flash('success','attribute deleted successfully');
        return redirect()->back();
    }
    public function addImages(Request $request ,$id = null){
        $product = Product::select('id','product_name','product_code','product_color','product_image')->with('images')->find($id);
            $product=json_decode(json_encode($product),true);
            // echo "<pre>";print_r($product); die;
            $title = 'Add product Image';
        if ($request->isMethod('post')) {
           if($request->hasFile('images')){
            $images = $request->file('images');
            foreach ($images as $key => $image) {
                $productImage = new ProductImages;
                $existing_image = ProductImages::find($id);
                $image_hash = Str::random(60);
                $path = $image->store('products', 'public');
                
                $productImage->product_id= $id;
                $productImage->image = $path;
                $productImage->save();
                    

            }
            session()->flash('success','images added successfully');
            return redirect()->back();
           }
        }
        return view('admin.product.add_images')->with(compact('product','title'));
    }
    public function update_image_status(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $data=json_decode(json_encode($data),true);
            // echo "<pre>";print_r($data); die;
            if ($data['status']=='active') {
                $status = 0;
            }
            else{
                $status = 1;
            }
            ProductImages::where(['id'=>$data['image_id']])->update(['status'=>$status]);
            return response()->json(['image_id' => $data['image_id'] , 'status' => $status]);
            
        }
    }
    public function delete_image($id)
    {
                $productsImage = ProductImages::where('id', $id)->first();
                $dir = public_path('storage/' . $productsImage->image);
               
                if (file_exists($dir)) {
                    File::delete($dir);
                }
                $productsImage->delete();
                
        session()->flash('success','image deleted successfully');
        return redirect()->back();
    }
}
