<?php

namespace App\Http\Livewire;
use Cart;

use App\Models\Product;
use App\Models\Catagory;
use App\Models\Section;
use Livewire\Component;
use Livewire\withPagination;

class CatagoryComponent extends Component
{
    public $sorting;
    public $pagesize;
    public $slug;
    public $section;
    
    public function mount($slug)
    {
        $this->sorting = "default";
        $this->pagesize = 12;
        $this->slug = $slug;
    }
    public function store($product_id,$product_name,$product_price)
    {
        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item added in cart');
        return redirect()->route('product.cart');
    }
    public function addToWishlist($product_id,$product_name,$product_price)
    {
        Cart::instance('wishlist')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        $this->emitTo('wishlist-count-component','refreshComponent');
        session()->flash('success_message','Item added in Wishlist');
        // return redirect()->route('product.cart');
    }
    public function removeFromWishlist($product_id)
    {
        foreach(Cart::instance('wishlist')->content() as $witem)
        {
            if ($witem->id == $product_id) {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wishlist-count-component','refreshComponent');
                return;
            }
        }
    }
    use withPagination;
    public function render()
    {
        if ($this->slug == 'all') {
        $section = Section::where('name',$this->section)->first();
        $category = Catagory::where('section_id',$section->id)->first();
        $category_slug= 'all';
        $category_name = 'all';

        if($this->sorting == 'date')
        {
            $products = Product::where(['status' => 1 ,'section_id' => $section->id])->orderBy('created_at','DESC')->paginate($this->pagesize);
        }
        else if($this->sorting == 'price')
        {
            $products = Product::where(['status' => 1 ,'section_id' => $section->id])->orderBy('regular_price','ASC')->paginate($this->pagesize);
        }
        else if($this->sorting == 'price-desc')
        {
            $products = Product::where(['status' => 1 ,'section_id' => $section->id])->orderBy('regular_price','DESC')->paginate($this->pagesize);
        }
        else 
        {
            $products = Product::where(['status' => 1 ,'section_id' => $section->id])->paginate($this->pagesize);
        }

        }
        else {
            
        $section = Section::where('name',$this->section)->first();
        $category = Catagory::where('slug',$this->slug)->first();
        $category_id = $category->id;
        $category_name = $category->cate_name;
        $category_slug = $category->slug;


        if($this->sorting == 'date')
        {
            $products = Product::where(['category_id' => $category_id , 'status' => 1 ,'section_id' => $section->id])->orderBy('created_at','DESC')->paginate($this->pagesize);
        }
        else if($this->sorting == 'price')
        {
            $products = Product::where(['category_id' => $category_id , 'status' => 1 ,'section_id' => $section->id])->orderBy('regular_price','ASC')->paginate($this->pagesize);
        }
        else if($this->sorting == 'price-desc')
        {
            $products = Product::where(['category_id' => $category_id , 'status' => 1 ,'section_id' => $section->id])->orderBy('regular_price','DESC')->paginate($this->pagesize);
        }
        else 
        {
            $products = Product::where(['category_id' => $category_id , 'status' => 1 ,'section_id' => $section->id])->paginate($this->pagesize);
        }
    }
        $categories = Section::with('categories')->get();
        return view('livewire.catagory-component',['section_name'=>$this->section,'products'=>$products, 'categories'=>$categories,'category_name'=>$category_name , 'category_slug' => $category_slug])->layout('layouts.home');
    }
}
