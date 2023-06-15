@extends('layouts/contentNavbarLayout')

@section('title', 'Account settings - Account')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection
<style>
  .error{
    color:red;
  }
</style>
@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Profile Settings /</span> Profile
</h4>
<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Profile Details</h5>
      <!-- Account -->
      <form id="formAccountSettings" action="{{ENV('APP_URL')}}/updateprofile" method="post"   onsubmit="return checkvalidate()" enctype="multipart/form-data">
      @foreach($tableData as $row)
        @csrf
      <div class="card-body">
        <div class="d-flex align-items-start align-items-sm-center gap-4">
          <img src="{{ENV('APP_URL')}}/users/images/{{$row->photo}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
          <div class="button-wrapper">
            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
              <span class="d-none d-sm-block">Upload new photo</span>
              <i class="bx bx-upload d-block d-sm-none"></i>
              <input type="file" id="upload" name="photo" class="account-file-input" hidden accept="image/png, image/jpeg" />
            </label>
            <p class="text-muted mb-0">Allowed JPG, JPEG or PNG. Max size of 800K</p>
          </div>
        </div>
      </div>
      <hr class="my-0">
      <div class="card-body">
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="first_name" class="form-label">First Name</label>
              <input class="form-control" type="text" id="first_name" name="first_name" value="{{$row->first_name}}" autofocus />
            </div>
            <div class="mb-3 col-md-6">
              <label for="last_name" class="form-label">Last Name</label>
              <input class="form-control" type="text" name="last_name" id="last_name" value="{{$row->last_name}}" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">E-mail</label>
              <input class="form-control" type="text" id="email" name="email" value="{{$row->email}}" placeholder="john.doe@example.com" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="phoneNumber">Phone Number</label>
              <div class="input-group input-group-merge">
                <span class="input-group-text"></span>
                <input type="text" id="phone" name="phone" value="{{$row->phone}}" class="form-control" placeholder="Phone Number" />
              </div>
            </div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save changes</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
        </form>
        @endforeach
      </div>
      <!-- /Account -->
    </div>
    <div class="card">
      <h5 class="card-header">Update Password</h5>
      <div class="card-body">
        <div class="mb-3 col-12 mb-0">
          <div class="alert alert-warning">
            <h6 class="alert-heading fw-bold mb-1">Are you sure you want to Update  your Password?</h6>
          </div>
        </div>
        <form id="formAccountDeactivation">
          <button type="button" class="btn btn-primary deactivate-account" data-bs-toggle="modal" data-bs-target="#updatepass">Update Password</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="updatepass" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Update Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <!-- <form  method="post" action="{{ENV('APP_URL')}}/updatepassword" onsubmit="return validate()"> -->
        @csrf
        <div class="row">
            <div class="col-md-12">
            <label for="oldpass" class="form-label">Old Password</label>
            <input type="text" id="oldpass" name="oldpass"  class="form-control" placeholder="Old Password">
            </div>
            <div class="col-md-12 mt-3">
            <label for="newpass" class="form-label">New Password</label>
            <input type="text" id="newpass" name="newpass" class="form-control" placeholder="New Password">
            </div>
            <div class="col-md-12 mt-3">
            <label for="confpass" class="form-label">Confirm Password</label>
            <input type="text" id="confpass" name="confpass" class="form-control" placeholder="Confirm Password">
            </div>
        </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onclick="UpdatePass()">Update</button>
        </div>
    </div>
    <!-- </form> -->
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script>

UpdatePass = () =>{
      let oldpass = document.getElementById('oldpass').value;
      let newpass = document.getElementById('newpass').value;
      let confpass = document.getElementById('confpass').value;
      $(".error").remove();
      if (oldpass.length < 1) {
      $('#oldpass').after('<span class="error">Old Password is Required*</span>');
      return false;
      }

      if (newpass.length < 6) {
      $('#newpass').after('<span class="error">Password must be at least 6 characters long*</span>');
      return false;
      }
      if (newpass != confpass) {
      $('#confpass').after('<span class="error"> Confirm Password must be Same as Password*</span>');
      return false;
      }
      else{
      let data = new FormData;
      data.append('oldpass',oldpass);
      data.append('newpass',newpass);

      axios.post('{{ENV("APP_URL")}}/updatepassword',data).then((result) => {
      console.log(result.data)
      if(result.data == 1){
      Swal.fire(
      'Thankyou!',
      'Password Update Successfully !',
      'success',
      )
      }
      else{
      Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Invalid Old password!',
      })
      } 
      }).catch((err) => {
      console.log(err)
      });
      $('#updatepass').modal('hide');
      }
}

function checkvalidate()
{
  let first_name = document.getElementById('first_name').value;
  let last_name = document.getElementById('last_name').value;
  let email = document.getElementById('email').value;
  let phone = document.getElementById('phone').value;

  $(".error").remove();
    
  if (first_name.length < 1) {
  $('#first_name').after('<span class="error">This field is required*</span>');
  return false;
  }
  if (last_name.length < 1) {
  $('#last_name').after('<span class="error">This field is required*</span>');
  return false;

  }

  if (email.length < 1) {
  $('#email').after('<span class="error">This field is required*</span>');
  return false;
  } else {
  var regEx = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
  var validEmail = regEx.test(email);
  if (!validEmail) {
  $('#email').after('<span class="error">Enter a valid email*</span>');
  return false;
  }
  }
  if (phone.length < 8 || phone.length > 13 ) {
  $('#phone').after('<span class="error">Phone Length Should be in Between 8 To 13 Digit*</span>');
  return false;
  }
  
  else{
  return true;
  }
}
</script>

@endsection
