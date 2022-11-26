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


                    <div class="card-body d-flex">
                        
                     

                        @foreach ($product as $item)
                        
                        <div class="col-md-4">
                            <img src="{{ asset('storage/'. $item->product_image ) }}" alt="" height="300px">
                           <p><a href="{{ asset('storage/'. $item->product_image ) }}" download="{{$item->product_name}}"><i class="fa fa-download"></i></a></p>
                        </div>
                        @endforeach
                       
                    </div>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection