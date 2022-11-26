@extends('layouts.admin.admin_layout')
@section('content')
@section('title','All orders')
@section('breadcrumb-active','Orders')
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
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">all</h3>
            

          </div>
          <!-- /.card-header -->
          <div class="card-body" style="overflow-x: auto">
            <table id="orders"  class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>Id</th>
                <th>Full name</th>
                <th>City</th>
                <th>Address</th>
                <th>Phone number</th>
                <th>Email</th>
                <th>Total pyament</th>
                <th>status</th>
                <th>action</th>
               
              </tr>
              </thead>
              <tbody>
                @foreach ($orders as $order)
              <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->firstname }}{{ $order->lastname }}</td>
                <td>{{ $order->city }}</td>
                <td>{{ $order->streetaddress }}</td>
                <td>{{ $order->mobile }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->total }}</td>
               
                <td>
                  <a href="javascript:void(0)" class="updateOrderStatus" id="cate-{{ $order->id }}" cate_id="{{ $order->id }}">
                    <span class="{{ $order->status == 'ordered' ? 'badge badge-sm bg-gradient-warning' : (($order->status == 'canceled') ? 'badge badge-sm bg-gradient-secondary' : 'badge badge-sm bg-gradient-success')}} ">{{ $order->status == 'ordered' ? 'ordered' : (($order->status == 'canceled') ? 'cancelled' : 'delivered') }}</span>
                    </a>
                </td>
                <td>
                 <a href="{{url('admin/orders/detail/'.$order->id) }}"><i class="fa fa-eye"></i></a>
                </td>
                
              </tr>
              @endforeach
            </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
