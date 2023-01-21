@extends('layouts.admin.admin_layout')
@section('title',$title)
@section('breadcrumb-item')
<li class="breadcrumb-item"><a href="{{ route('template') }}">templates</a></li>
@endsection
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
@section('breadcrumb-active',$title)
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="POST" role="form" class="text-start" @if (empty($templateData))
                            action="{{ url('admin/add-edit-template') }}" @else
                            action="{{ url('admin/add-edit-template/'.$templateData->id) }}" @endif
                            enctype="multipart/form-data">
                            @csrf
                            <div class="container-fluid">
                                <div class="row">

                                    <div class="col-md-6 my-2">
                                        <div class="form-group">
                                            <label>name</label>
                                            <input type="text " class="form-control @error('name') is-invalid @enderror"
                                                name="name" @if (!empty($templateData->name)) value="{{
                                            $templateData->name }}"

                                            @else value="{{ old('name') }}" @endif>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                    </div>


                                    <div class="col-md-6 my-2">
                                        <div class="form-group">
                                            <label>template image</label>
                                            <div class="custom-file">
                                                <input type="file" name="image"
                                                    class="custom-file-input form-control @error('image') is-invalid @enderror"
                                                    data-bs-toggle="tooltip" data-bs-placement="right"
                                                    title="please use images with white bg">
                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                    file</label>
                                                @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            @if (!empty($templateData->image))
                                            <img src="/storage/{{ $templateData->image }}" style="width: 80px" alt="">


                                            @endif
                                        </div>
                                    </div>

                                    {{-- //generate a hash value for images --}}
                                    <input type="hidden" name="image_hash_value" value="{{Str::random(60)}}">
                                </div>
                                <div class="card-footer">
                                    <div class="my-2">
                                        <button type="submit" class="btn btn-success float-right">submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
</section>
@endsection