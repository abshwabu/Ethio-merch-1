@extends('layouts.admin.admin_layout')
@section('content')
@section('title',"$orderDetail->firstname $orderDetail->lastname's order")
@section('breadcrumb-item')
<li class="breadcrumb-item">
  <a href="{{url('admin/orders/all')}}">Orders</a>
</li>
@endsection
@section('breadcrumb-active','detail')
@if (Session::has('success'))
<script>
  $(function() {
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });


    Toast.fire({
      icon: 'success',
      title: "{{ Session::get('success') }}"
    });
  
});
</script>
@endif
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Billing Details</h3>
                <h3 class="card-title float-right">Ordered at : &nbsp;&nbsp; {{ date('d M Y - H:i:s',
                  $orderDetail->created_at->timestamp) }}</h3>
              </div>
              <div class="card-body">
                <label style="font-weight:normal">Firstname</label>
                <h6 style="font-weight: bolder" class="border p-2">{{$orderDetail->firstname}}</h6>
                <label style="font-weight:normal">Lastname</label>
                <h6 style="font-weight: bolder" class="border p-2">{{$orderDetail->lastname}}</h6>
                <label style="font-weight:normal">City</label>
                <h6 style="font-weight: bolder" class="border p-2">{{$orderDetail->city}}</h6>
                <label style="font-weight:normal">Street Address</label>
                <h6 style="font-weight: bolder" class="border p-2">{{$orderDetail->streetaddress}}</h6>
                <label style="font-weight:normal">Contact</label>
                <h6 style="font-weight: bolder" class="border p-2">{{$orderDetail->mobile}}</h6>
                <label style="font-weight:normal">Email</label>
                <h6 style="font-weight: bolder" class="border p-2">{{$orderDetail->email}}</h6>
               
    
              </div>
            </div>
          </div>
          
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Shipping Details</h3>
              </div>
              <div class="card-body">
                @if($orderDetail->is_shipping_different == 1 && !empty($shipping))

                <label style="font-weight:normal">Firstname</label>
                <h6 style="font-weight: bolder" class="border p-2">{{$shipping->firstname}}</h6>
                <label style="font-weight:normal">Lastname</label>
                <h6 style="font-weight: bolder" class="border p-2">{{$shipping->lastname}}</h6>
                <label style="font-weight:normal">City</label>
                <h6 style="font-weight: bolder" class="border p-2">{{$shipping->city}}</h6>
                <label style="font-weight:normal">Street Address</label>
                <h6 style="font-weight: bolder" class="border p-2">{{$shipping->streetaddress}}</h6>
                <label style="font-weight:normal">Contact</label>
                <h6 style="font-weight: bolder" class="border p-2">{{$shipping->mobile}}</h6>
                <label style="font-weight:normal">Email</label>
                <h6 style="font-weight: bolder" class="border p-2">{{$shipping->email}}</h6>
                @else
             
                <h6 style="font-weight: bolder" class="border p-2">ship to same address </h6>
                @endif
    
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Product Details</h3>

              </div>
              <div class="card-body" style="overflow-x: auto">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <td>id</td>
                      <td>name</td>
                      <td>price</td>
                      <td>quantity</td>
                      <td>image</td>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($orderDetail->orderItems as $item)
                    <tr>
                      <td>{{ $item->products->id }}</td>
                      <td>{{ $item->products->product_name }}</td>
                      <td>{{ $item->price }}</td>
                      <td>{{ $item->quantity }}</td>
                      <td>
                        <img src="{{ asset('storage/'.$item->products->product_image) ?? '' }}"
                          alt="{{ $item->products->product_name ?? 'deleted'}}" height="70px" width="70px">
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="card-footer h4">
                Total:- {{ $orderDetail->total }}
              </div>
            </div>
          </div>
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Summary</h3>
              </div>
              <div class="card-body" style="overflow-x: auto">
                <table class="table table-bordered table-striped">

                  <tbody>
                    <tr>
                      <td>subtotal</td>
                      <td>{{ $orderDetail->subtotal }}</td>
                    </tr>
                    <tr>
                      <td>tax</td>
                      <td>{{ $orderDetail->tax }}</td>
                    </tr>
                    <tr>
                      <td>discount</td>
                      <td>{{ $orderDetail->discount }}</td>
                    </tr>
                    <tr>
                      <td>total</td>
                      <td>{{ $orderDetail->total }}</td>
                    </tr>
                  </tbody>
                </table>

                <label>Order Status</label>
                <select class="form-control select2" name="status">
                  <option {{ $orderDetail->status=='ordered'? 'selected':'' }} value="0">ordered</option>
                  <option {{ $orderDetail->status=='delivered'? 'selected':'' }} value="1">delivered</option>
                  <option {{ $orderDetail->status=='canceled'? 'selected':'' }} value="1">canceled</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
@endsection