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
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
                   <div class="card-title">Bank account</div>
                     
          </div>
          <!-- /.card-header -->
          <form method="POST" role="form" class="text-start" action="{{ url('creator/add-edit-payment-data/'.$creator->id) }}"
            enctype="multipart/form-data">
            <div class="card-body bank">

              @csrf
              <div class="container-fluid">
                <div class="row">

                  <input type="hidden" name="method" value="bank">

                  <div class="col-md-6 my-2">
                    <label class="form-group has-float-label">
                      <input type="text" class="form-control @error('account_holder_bank') is-invalid @enderror"
                        name="account_holder_bank" @if (!empty( $bank->payment->first()->account_holder))
                        value="{{ $bank->payment->first()->account_holder }}" @else value="{{ old('account_holder_bank') }}" @endif
                        
                        placeholder=" " />
                      <span>Account Holder</span>
                      @error('account_holder_bank')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </label>

                    <label class="form-group has-float-label">
                      <input type="text" class="form-control @error('account_number') is-invalid @enderror"
                        name="account_number" @if (!empty( $bank->payment->first()->account_number))
                        value="{{ $bank->payment->first()->account_number }}" @else value="{{ old('account_number') }}" @endif
                        placeholder=" " />
                      <span>Account number</span>
                      @error('account_number')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </label>
                  </div>
                  <div class="col-md-6 my-2">

                    <label class="form-group has-float-label">
                      <input type="text" class="form-control @error('bank_name') is-invalid @enderror" name="bank_name"
                      @if (!empty( $bank->payment->first()->bank_name))
                      value="{{ $bank->payment->first()->bank_name }}" @else value="{{ old('bank_name') }}" @endif placeholder=" " />
                      <span>Bank name</span>
                      @error('bank_name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer bank">
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>
        </div>
      </div>
   
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <div class="card-title">
                    Telebirr
                  </div>
                </div>
                <form method="POST" role="form" action="{{ url('creator/add-edit-payment-data/'.$creator->id) }}"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="card-body ">
                    <div class="container-fluid">
                      <div class="row">
                        
                        <input type="hidden" name="method" value="telebirr">
                        <div class="col-md-6 my-2 ">
                         
                          <label class="form-group has-float-label">
                            <input type="tel" class="form-control @error('phone_number') is-invalid @enderror"
                            name="phone_number" @if (!empty( $telebirr->payment->first()->phone_number))
                            value="{{ $telebirr->payment->first()->phone_number }}" @else value="{{ old('phone_number') }}" @endif
                            placeholder=" " />
                            <span>Phone number</span>
                            @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            
                          </label>
                          
                          <label class="form-group has-float-label">
                            <input type="text" class="form-control @error('account_holder_telebirr') is-invalid @enderror"
                              name="account_holder_telebirr" @if (!empty( $telebirr->payment->first()->account_holder))
                              value="{{ $telebirr->payment->first()->account_holder }}" @else value="{{ old('account_holder_telebirr') }}" @endif
                              placeholder=" " />
                              <span>Account Holder</span>
                              @error('account_holder_telebirr')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                              @enderror
                            </label>
      
      
                        </div>
      
                      </div>
                    </div>
                  </div>
      
      
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</section>
@endsection