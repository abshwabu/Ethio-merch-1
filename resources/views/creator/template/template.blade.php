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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($template as $item)

                            @if (!empty($item->image) &&
                            file_exists("storage/".$item->image))


                            <div class="col-md-4 col-sm-6" id="wrap">


                                <img src="{{ asset('storage/'. $item->image ) }}" alt="{{ $item->name }} image"
                                    style="height: 200px; ">
                                <p>{{ $item->name }}</p>


                                <a href="{{ asset('storage/'. $item->image ) }}" download="{{$item->name}}"
                                    class="btn-slide2">
                                    <span class="circle2"><i class="fa fa-download"></i></span>
                                    <span class="title2">Download</span>
                                    <span class="title-hover2">Click here</span>
                                </a>


                            </div>
                            @else
                            <img src="{{ asset('storage/products/No_Image.png')}}" alt="no_image" style="width: 100px">
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection