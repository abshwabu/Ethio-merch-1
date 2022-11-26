<?php

namespace App\Http\Controllers\Creator;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::where(['status'=>1,'stok_status'=>'instock'])->get();
        $title = 'Products';
        return view('creator.product.product',compact('title','product'));
    }
}
