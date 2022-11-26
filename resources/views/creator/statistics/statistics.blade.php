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

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-6">
                <!-- small box -->
                <div class="small-box ">
                    <div class="inner">
                        <h3>150$</h3>

                        <p>Credit</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag text-dark"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-md-6">
                <!-- small box -->
                <div class="small-box">
                    <div class="inner">
                        <h3>53</h3>
                        {{-- <sup style="font-size: 20px">%</sup> --}}
                        <p>Uploaded items</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars text-dark"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-md-6">
                <!-- small box -->
                <div class="small-box ">
                    <div class="inner">
                        <h3>44</h3>

                        <p>Sales</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add text-dark"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-md-6">
                <!-- small box -->
                <div class="small-box ">
                    <div class="inner">
                        <h3>65</h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph text-dark"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection