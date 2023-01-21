@extends('layouts.creator.creator_layout')
@section('content')
@section('title','Catalogues')
@section('breadcrumb-active','Products')
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
            <h3 class="card-title">Products</h3>
            <a href="{{ url('creator/add-edit-product') }}" class="btn btn-success float-right">add product</a>

          </div>
          <!-- /.card-header -->
          <div class="card-body" style="overflow-x: auto;">
            <table id="products" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Product</th>
                  <th>Code</th>
                  <th>Color</th>
                  <th>Image</th>
                  <th>Category</th>
                  <th>Section</th>
                  <th>Status</th>
                  <th>Actions</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($product as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td>{{ $item->product_name }}</td>
                  <td>{{ $item->product_code }}</td>
                  <td>{{ $item->product_color }}</td>
                  <td>
                    <a href="{{ url('creator/add-images/'.$item->id) }}">
                      @if (!empty($item->product_image) && file_exists("storage/".$item->product_image))

                      <img src="{{ asset('storage/'. $item->product_image ) }}" alt="{{ $item->product_name }} image"
                        style="width: 100px">
                      @else
                      <img src="{{ asset('storage/products/No_Image.png')}}" alt="no_image" style="width: 100px">
                      @endif
                    </a>
                  </td>
                  <td>{{ (is_null($item->catagory)) == true ? 'null': $item->catagory->cate_name }}</td>
                  <td>{{ $item->section->name }}</td>

                  <td>
                    <a href="javascript:void(0)" class="updateProductStatus" id="product-{{ $item->id }}"
                      product_id="{{ $item->id }}" user="creator">
                      <span
                        class="{{ $item->status == 1 ? 'badge badge-sm bg-gradient-success' : 'badge badge-sm bg-gradient-secondary'}} ">{{
                        $item->status == 1 ? 'active' : 'inactive' }}</span>
                    </a>
                  </td>
                  <td>
                    <a href="{{ url('creator/add-attributes/'.$item->id) }}">
                      <i class="fas fa-plus text-sm " data-bs-toggle="tooltip" data-bs-placement="top"
                        title="add product attribute"></i>
                    </a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="{{ url('creator/add-edit-product/'.$item->id) }}">
                      <i class="fas fa-edit text-sm " data-bs-toggle="tooltip" data-bs-placement="top"
                        title="edit product"></i>
                    </a>
                    &nbsp;&nbsp;&nbsp;
                    <a href="javascript:void(0);" record="product" recordId="{{ $item->id }}" class="confirm_delete"
                      user="creator">
                      <i class="fas fa-trash text-primary text-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="delete product"></i>
                    </a>

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