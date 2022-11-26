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
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Shop name </label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label >Shop logo </label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection