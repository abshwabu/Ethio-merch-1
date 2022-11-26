<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use App\Models\Transaction;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CheckoutComponent extends Component
{
    public $ship_to_different;

    public $firstname;
    public $lastname;
    public $mobile;
    public $email;
    public $city;
    public $streetaddress;

    public $s_firstname;
    public $s_lastname;
    public $s_mobile;
    public $s_email;
    public $s_city;
    public $s_streetaddress;

    public $paymentmode;
    public $thankyou;

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'firstname'=>'required',
            'lastname'=>'required',
            'mobile'=>'required|numeric',
            'email'=>'required|email',
            'city'=>'required',
            'streetaddress'=>'required',
            'paymentmode'=>'required'
        ]);
        if ($this->ship_to_different) {
            $this->validateOnly($fields,[
                's_firstname'=>'required',
                's_lastname'=>'required',
                's_mobile'=>'required|numeric',
                's_email'=>'required|email',
                's_city'=>'required',
                's_streetaddress'=>'required',
                'paymentmode'=>'required',
            ]);
        }
    }

    public function placeOrder()
    {
        $this->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'mobile'=>'required|numeric',
            'email'=>'required|email',
            'city'=>'required',
            'streetaddress'=>'required',
            'paymentmode'=>'required',

        ]);
        $order = new Order();
        if (Auth::check()) {
          
            $order->user_id = Auth::user()->id;
        }
        else{
            $session_id= Session::get('session_id');
            if(empty($session_id)){
                $session_id = Session::getId();
                Session::put('session_id',$session_id);
            }
            $order->session_id = $session_id;
        }
        $order->subtotal = session()->get('checkout')['subtotal'];
        $order->tax = session()->get('checkout')['tax'];
        $order->total = session()->get('checkout')['total'];
        $order->firstname = $this->firstname;
        $order->lastname = $this->lastname;
        $order->mobile = $this->mobile;
        $order->email = $this->email;
        $order->city = $this->city;
        $order->streetaddress = $this->streetaddress;
        $order->status = 'ordered';
        $order->is_shipping_different = $this->ship_to_different ? 1:0;
        $order->save();

       foreach(Cart::instance('cart')->content() as $item)
       {
        $orderItem = new OrderItem();
        $orderItem->product_id = $item->id;
        $orderItem->order_id = $order->id;
        $orderItem->price = $item->price;
        $orderItem->quantity = $item->qty;
        $orderItem->save();
        
       }
       if ($this->ship_to_different) {
            $this->validate([
                's_firstname'=>'required',
                's_lastname'=>'required',
                's_mobile'=>'required|numeric',
                's_email'=>'required|email',
                's_city'=>'required',
                's_streetaddress'=>'required',
                'paymentmode'=>'required',
            ]);

            $shipping = new Shipping();
            $shipping->order_id = $order->id;
            $shipping->firstname = $this->s_firstname;
            $shipping->lastname = $this->s_lastname;
            $shipping->email = $this->s_email;
            $shipping->mobile = $this->s_mobile;
            $shipping->city = $this->s_city;
            $shipping->streetaddress = $this->s_streetaddress;
            $shipping->save();


       }

       if($this->paymentmode == 'cod')
       {
         $transaction = new Transaction();
         if (Auth::check()) {
          
            $transaction->user_id = Auth::user()->id;
        }
        else{
            $session_id= Session::get('session_id');
            if(empty($session_id)){
                $session_id = Session::getId();
                Session::put('session_id',$session_id);
            }
            $transaction->session_id = $session_id;
        }
         $transaction->order_id = $order->id;
         $transaction->mode = 'cod';
         $transaction->status = 'pending';
         $transaction->save();
       }
       $this->thankyou = 1;
       Cart::instance('cart')->destroy();
       session()->forget('checkout');

    }
    public function verifyCheckout()
    {
        // if(!Auth::check())
        // {
        //     return redirect('/login');
        // }
        if($this->thankyou)
        {
            return redirect()->route('thankyou');
        }
        else if(!session()->get('checkout'))
        {
            return redirect()->route('product.cart');
        }
    }

    public function render()
    {
        $this->verifyCheckout();
        return view('livewire.checkout-component')->layout('layouts.home');
    }
}
