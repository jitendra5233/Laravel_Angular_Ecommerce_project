@extends('layouts/blankLayout')

@section('title', 'Forgot Password Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      <!-- Forgot Password -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="{{url('/')}}" class="app-brand-link gap-2" style="justify-content: center">
              {{-- <span class="app-brand-logo demo">@include('_partials.macros',['width'=>25,'withbg' => "#696cff"])</span>
              <span class="app-brand-text demo text-body fw-bolder">{{ config('variables.templateName') }}</span> --}}
              <img src="{{ asset('assets/img/logo/logo.png') }}" alt  width="100%">
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-2">Forgot Password? 🔒</h4>
          <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
          <form id="formAuthentication" class="mb-3" action="javascript:void(0)" method="GET">
            <div class="mb-3">
          
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus>
              <input type="hidden" class="form-control" id="uniqcode" value="<?php echo(rand(10,10000000));?>">
            </div>
            <button class="btn btn-primary d-grid w-100" onclick="ForgetPass()">Send Reset Link</button>
          </form>
          <div class="text-center">
            <a href="{{url('auth/login')}}" class="d-flex align-items-center justify-content-center">
              <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
              Back to login
            </a>
          </div>
        </div>
      </div>
      <!-- /Forgot Password -->
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script>

ForgetPass = () =>{
    let email = document.getElementById('email').value;
    let uniqcode = document.getElementById('uniqcode').value;
    $(".error").remove();
    if (email.length < 1) {
    $('#email').after('<span class="error">Please Fill Valid Email*</span>');
    return false;
    }

    else{
        let data = new FormData;
        data.append('email',email);
        data.append('uniqcode',uniqcode);
        axios.post('{{ENV("APP_URL")}}/Sendmail',data).then((result) => {
            if(result.data == 1){
                Swal.fire(
                    'Thankyou!',
                    'Email has been send !',
                    'success',
                ).then((result) => {
                  window.location.href = '{{ENV("APP_URL")}}/ChnagePassword';
                })
              }
        }).catch((err) => {
            console.log(err)
        });
    }
       
    }
</script>
@endsection
