<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index($title)
    {
        if ($title=='all_orders') {
            
            $orders = Order::all();
        }
        elseif ($title == 'ordered') {
            $orders = Order::where('status','ordered')->get();
        }
        elseif ($title == 'canceled') {
            $orders = Order::where('status','canceled')->get();
        }
        elseif ($title == 'delivered') {
            $orders = Order::where('status','delivered')->get();
        }
        else {
            $orders = Order::all();
        }
        
        return view('admin.order.all-orders',compact('orders'));
    }

    public function detail($id)
    {   

        $orderDetail = Order::find($id);
        $shipping = Shipping::find($id);
        return view('admin.order.detail' , compact('orderDetail','shipping'));
    }
}
