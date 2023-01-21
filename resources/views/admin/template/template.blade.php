@extends('layouts.admin.admin_layout')
@section('content')
@section('title','Catalogues')
@section('breadcrumb-active','Templates')
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
                        <h3 class="card-title">Templates</h3>
                        <a href="{{ url('admin/add-edit-template') }}" class="btn btn-success float-right">add
                            template</a>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" style="overflow-x: auto;">
                        <table id="templates" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>template</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($templates as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a href="{{ url('admin/add-images/'.$item->id) }}">
                                            @if (!empty($item->image) &&
                                            file_exists("storage/".$item->image))

                                            <img src="{{ asset('storage/'. $item->image ) }}"
                                                alt="{{ $item->template_name }} image" style="width: 100px">
                                            @else
                                            <img src="{{ asset('storage/products/No_Image.png')}}" alt="no_image"
                                                style="width: 100px">
                                            @endif
                                        </a>
                                    </td>


                                    <td>
                                        <a href="javascript:void(0)" class="updateTemplateStatus"
                                            id="template-{{ $item->id }}" template_id="{{ $item->id }}">
                                            <span
                                                class="{{ $item->status == 1 ? 'badge badge-sm bg-gradient-success' : 'badge badge-sm bg-gradient-secondary'}} ">{{
                                                $item->status == 1 ? 'active' : 'inactive' }}</span>
                                        </a>
                                    </td>
                                    <td>

                                        <a href="{{ url('admin/add-edit-template/'.$item->id) }}">
                                            <i class="fas fa-edit text-sm " data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="edit template"></i>
                                        </a>
                                        &nbsp;&nbsp;&nbsp;
                                        <a href="javascript:void(0);" record="template" recordId="{{ $item->id }}"
                                            class="confirm_delete">
                                            <i class="fas fa-trash text-primary text-sm" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="delete template"></i>
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