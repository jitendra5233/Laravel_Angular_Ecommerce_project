@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoyZ_yVsI5N8KhjbWRyQeme1Pfz2DRYYc&libraries=places&callback=initAutocomplete"></script>
@section('content')
<style>
    .form-check-input[type=checkbox] {
        border: 1px solid #00000061;
    }
    .error{
      color:red;
    }
  .loader {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(0,0,0,0.75) url(images/loading2.gif) no-repeat center center;
  z-index: 10000;
}
    
</style>
<div class="loader"></div>
<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">New User</h5>
          <!-- Account -->
          {{-- <form action="/submit-user" method="post"> --}}
            @csrf
          <div class="card-body">
              <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">First Name</label>
                    <input class="form-control" type="text" id="firstName" name="firstName"  value="" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Last Name</label>
                    <input class="form-control" type="text" id="lastName" name="lastName"  value="" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Email</label>
                    <input class="form-control" type="email" id="email" name="email"  value="" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Department</label>
                    <input class="form-control" type="text" id="department" name="department"  value="" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Phone</label>
                    <input class="form-control" type="text"  id="phone" name="phone" value="" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Location of Specialty</label>
                    <input class="form-control" type="text" id="specialty" name="specialty"  value="" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Designation</label>
                    <input class="form-control" type="text" id="designation" name="designation"  value="" />
                  </div>
                   
                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Password</label>
                    <input class="form-control" type="text" id="password" name="password" value="" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Confirm Password</label>
                    <input class="form-control" type="text" id="confirmPassword" name="confirmPassword" value="" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select"  aria-label="Default select example">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                  <div class="mb-3 col-md-12">
                    <label for="address" class="form-label">Agent Location</label>
                    <input type="text" class="form-control" id="address" name="location" placeholder="Enter Agent Location" />
                    </div>
                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Role</label>
                    <select id="role" name="role" class="form-select"  aria-label="Default select example">
                      <option value="0">Select Role</option>
                      @foreach($role as $row)
                      <option value="{{$row->id}}">{{$row->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="formFile" class="form-label">Profile Photo</label>
                    <input class="form-control" type="file" id="formFile">
                  </div>
              </div>
          </div>
          <hr class="my-0">
          <div class="card-body">
              
            <div class="row">
                <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2" onclick="handleSubmit()">Save changes</button>
                <button type="reset" class="btn btn-outline-secondary">Discard</button>
                </div>
            </div>
        </div>
        <!-- /Notifications -->
      </div>
  </div>
{{-- </form> --}}
  <!-- /Account -->
        </div>
      </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script>
    handleSubmit = () =>{

        let firstName = document.getElementById('firstName').value;
        let lastName = document.getElementById('lastName').value;
        let email = document.getElementById('email').value;
        let department = document.getElementById('department').value;
        let phone = document.getElementById('phone').value;
        let specialty = document.getElementById('specialty').value;
        let designation = document.getElementById('designation').value;
        let address = document.getElementById("address").value;
        let password = document.getElementById('password').value;
        let confirmPassword = document.getElementById('confirmPassword').value;
        let role = document.getElementById('role').value;
        let photo = document.getElementById('formFile').files[0]; 
        let status=document.getElementById('status').value;

        $(".error").remove();
    var spinner = $('.loader');
      spinner.show();
     if (firstName.length < 1) {
    $('#firstName').after('<span class="error">This field is required*</span>');
    spinner.hide();
    return false;
    }
    if (lastName.length < 1) {
      $('#lastName').after('<span class="error">This field is required*</span>');
    spinner.hide();

      return false;
    }
    if (email.length < 1) {
      $('#email').after('<span class="error">This field is required*</span>');
    spinner.hide();

      return false;

    } else {
      var regEx = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
      var validEmail = regEx.test(email);
      if (!validEmail) {
        $('#email').after('<span class="error">Enter a valid email*</span>');
    spinner.hide();

        return false;
  
      }
    }

    if (department.length < 1) {
      $('#department').after('<span class="error">Department is required*</span>');
    spinner.hide();
 return false;
    }

    if (phone.length < 8 || phone.length > 13 ) {
      $('#phone').after('<span class="error">Phone Length Should be in Between 8 To 13 Digit*</span>');
    spinner.hide();

      return false;
    }
    if (specialty.length < 1) {
      $('#specialty').after('<span class="error">Specialty is required*</span>');
    spinner.hide();

      return false;
    }
    if (designation.length < 1) {
      $('#designation').after('<span class="error">Designation is required*</span>');
    spinner.hide();

      return false;
    }

    if (password.length < 6) {
      $('#password').after('<span class="error">Password must be at least 6 characters long*</span>');
    spinner.hide();

      return false;
   
    }

    if (password != confirmPassword) {
      $('#confirmPassword').after('<span class="error"> Confirm Password must be Same as Password*</span>');
    spinner.hide();

     return false; 
    }
    
    if (address.length < 1) {
    $('#address').after('<span class="error">Address is required*</span>');
    spinner.hide();
    return false;
    }
    var selrole=$('#role');
    if(selrole.val() == 0)
    {
      $('#role').after('<span class="error"> Select a Valid Role</span>');
    spinner.hide();

      return false;
    }
    if(photo == undefined)
    {
      $('#formFile').after('<span class="error">Upload an Image</span>');
    spinner.hide();

      return false;
    }
   
     else{
        let data = new FormData;
        data.append('firstName',firstName);
        data.append('lastName',lastName);
        data.append('email',email);
        data.append('phone',phone);
        data.append('password',password);
        data.append('role',role);
        data.append('photo',photo);
        data.append('status',status);
        data.append('department',department);
        data.append('location',address);
        data.append('specialty',specialty);
        data.append('designation',designation);
        axios.post('{{ENV("APP_URL")}}/submit-user',data).then((result) => {
          if(result.data == 1){
          spinner.hide();
            Swal.fire(
            'Thankyou!',
            'User Added Successfully !',
            'success',
            ).then((result) => {
             location.reload();
             });
            }
            if(result.data == 0)
            {
              spinner.hide();
              Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'This Email is Already Exist!',
              }).then((result) => {
              location.reload();
              });
            }
        }).catch((err) => {
            spinner.hide();
            console.log(err)
        });
     }
        
    }
</script>
<script>
  function init() {
    var input = document.getElementById("address");
    var autocomplete = new google.maps.places.Autocomplete(input);
  }

  google.maps.event.addDomListener(window, "load", init);
</script>

@endsection
