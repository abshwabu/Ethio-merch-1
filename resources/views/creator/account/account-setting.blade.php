@extends('layouts.creator.creator_layout')
@section('title',$title)
@section('breadcrumb-active',$title)
@section('content')
@if (Session::has('error'))
<script>
$(function() {
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });


    Toast.fire({
      icon: 'error',
      title: "{{ Session::get('error') }}"
    });
  
});
</script>
@endif

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="card">
      
          <!-- /.card-header -->
          <div class="card-body">
            <form method="POST" role="form" class="text-start"
              action="{{ url('creator/account-setting/'.Auth::user()->id) }}" enctype="multipart/form-data">

              @csrf
              <div class="input-group input-group-outline my-3">
                <input type="password" class="form-control" name="current_password"
                  placeholder="current password">
               
              </div>
              <div class="input-group input-group-outline my-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                  placeholder="password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="input-group input-group-outline my-3">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                  placeholder="confirm password">
              </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-success">update</button>
          </div>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <form method="POST" role="form" class="text-start"
              action="{{ url('creator/update-avatar/'.Auth::user()->id) }}" enctype="multipart/form-data">
              @csrf
              @if (Auth::user()->profile_picture)
                  
              <img id="blah" alt="your image" width="100" height="100"
              src="{{ asset('storage/'.Auth::user()->profile_picture) }}" alt="">
              @else
              <img id="blah" alt="your image" width="100" height="100"
              src="{{ asset('assets/images/admin_imgs/dummy-avatar.jpg') }}" />
                  
              @endif

              <div class="form-group">
                <label>change avatar</label>
                <div class="custom-file">
                  <input type="file" name="profile_picture"
                    onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])"
                    class="custom-file-input form-control @error('profile_picture') is-invalid @enderror"
                    data-bs-toggle="tooltip" data-bs-placement="right" title="please use images with white bg">
                  <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  @error('profile_picture')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>


              </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-success">save</button>

          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection