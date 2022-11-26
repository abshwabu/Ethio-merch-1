@extends('layouts.creator.creator_layout')
@section('content')
@section('title',$title)
@section('breadcrumb-item')
<li class="breadcrumb-item"><a href="{{ url('creator/profile/'.Auth::user()->id) }}">Profile</a></li>
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
            <form method="POST" role="form" class="text-start" @if (!empty($creator->id))action="{{ url('creator/personal-information/'.$creator->id) }}" @else action = "{{url ('creator/personal-information')}}" @endif
              enctype="multipart/form-data">

              @csrf
              <div class="col-sm-4 my-2">
                <div class="form-group">
                  <label>Media URL</label>
                  <input type="text"  class="form-control @error('media_url') is-invalid @enderror" name="media_url" @if (!empty($creator['media_url'])) value="{{ $creator['media_url'] }}" @else value="{{ old('media_url') }}" @endif>
                  @error('media_url')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-sm-4 my-2">
                <div class="form-group">
                  <label>First name</label>
                  <input type="text " class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                    @if (!empty($creator['first_name'])) value="{{ $creator['first_name'] }}"

                  @else value="{{ old('first_name') }}" @endif>
                  @error('first_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-sm-4 my-2">
                <div class="form-group">
                  <label>Last name</label>
                  <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                   @if(!empty($creator['last_name'])) value="{{ $creator['last_name'] }}"

                  @else value="{{ old('last_name') }}" @endif>
                  @error('last_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-sm-4 my-2">
                <div class="form-group">
                  <label>Phone Number</label>
                  <input type="tel" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number"
                    @if (!empty($creator['phone_number'])) value="{{ $creator['phone_number'] }}"

                  @else value="{{ old('phone_number') }}" @endif>
                  @error('phone_number')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
             
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-success">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
  @endsection