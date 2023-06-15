@extends('layouts/blankLayout')

@section('title', 'Forgot Password Basic - Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<style>
    .success{
        color:#04917a;
        padding:10px;
    }
</style>
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">

      <!-- Forgot Password -->
      <div class="card">
        <div class="card-body">
          <!-- /Logo -->
          <h4 class="mb-2">Update Password? 🔒</h4>
          <p class="mb-4">Enter your Email on which you have received the unique code</p>
          <form id="formAuthentication" class="mb-3" action="javascript:void(0)" method="GET">
            <div class="mb-3">
            <!-- <label for="email" class="form-label">Email</label> -->
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email">
            </div>
            <div class="mb-3" id="uniqcodediv">
            <!-- <label for="uniqcode" class="form-label">Unique Code</label> -->
            <input type="text" class="form-control" id="uniqcode" name="uniqcode" placeholder="Enter your Unique Code">
              </div>
              <div class="mb-3" id="Passdiv" style="display:none;">
            <!-- <label for="Newpass" class="form-label">New Password</label> -->
              <input type="text" class="form-control" id="Newpass" name="Newpass" placeholder="Enter your New Password">
              </div>
              <div class="mb-3" id="firstbtn">
            <button class="btn btn-primary d-grid w-100" onclick="handelcheckpassword()">Save changes </button>
            </div>
            <div class="mb-3" id="secondbtn" style="display:none;">
            <button class="btn btn-primary d-grid w-100" onclick="handelupdatepassword()" id="secondbtn">Update Password </button>
              </div>
          </form>
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

    handelcheckpassword = () =>{
      let email = document.getElementById('email').value;
      let uniqcode = document.getElementById('uniqcode').value;
      let data = new FormData;
        data.append('email',email);
        data.append('uniqcode',uniqcode);
        axios.post('{{ENV("APP_URL")}}/UpdatePassword',data).then((result) => {
            if(result.data == 1){
             $('#email').attr('disabled', true);
             $('#uniqcode').attr('disabled', true);
             $('#email').after('<span class="success">Email Varification Done*</span>');
             $('#uniqcode').after('<span class="success">Unique Code Varification Done*</span>');
             $('#Passdiv').show();
             $('#firstbtn').hide();
             $('#secondbtn').show();
              }
              if(result.data == 0)
              {
                $('#email').after('<span class="error">Invalid Email Or Unique Code*</span>');
              }
        }).catch((err) => {
            console.log(err)
        });
     

    }

    handelupdatepassword =() =>{
      let email = document.getElementById('email').value;
      let Newpass = document.getElementById('Newpass').value;
      $(".error").remove();
      if (Newpass.length < 6) {
      $('#Newpass').after('<span class="error">Password must be at least 6 characters long*</span>');
      return false;
    }
    else{
        let data = new FormData;
        data.append('email',email);
        data.append('Newpass',Newpass);
        axios.post('{{ENV("APP_URL")}}/ChnageupdatePassword',data).then((result) => {
            if(result.data == 1){
                Swal.fire(
                    'Thankyou!',
                    'Password Update Successfully !',
                    'success',
                ).then((result) => {
                  window.location.href = '{{ENV("APP_URL")}}/auth/login';
                })
              }
              if(result.data == 0)
              {
                $('#Newpass').after('<span class="error">Invalid Email*</span>');
              }
        }).catch((err) => {
            console.log(err)
        });
    }
     
    }
</script>
@endsection
