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
</style>
<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">Edit User</h5>
          <!-- Account -->
          <form action="{{ENV('APP_URL')}}/updateuser" method="post" enctype="multipart/form-data"  onsubmit="return handleSubmit()">
            @csrf
          <div class="card-body">
          <input type="hidden" name="userid" id="userid" value="{{$user->id}}" />
              <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">First Name</label>
                    <input class="form-control" type="text" id="firstName" name="firstName"  value="{{$user->first_name}}" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Last Name</label>
                    <input class="form-control" type="text" id="lastName" name="lastName"  value="{{$user->last_name}}" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Email</label>
                    <input class="form-control" type="email" id="email" name="email"  value="{{$user->email}}" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Department</label>
                    <input class="form-control" type="text" id="department" name="department"  value="{{$user->department}}" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Phone</label>
                    <input class="form-control" type="text"  id="phone" name="phone" value="{{$user->phone}}" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Location of Specialty</label>
                    <input class="form-control" type="text" id="specialty" name="specialty"  value="{{$user->specialty}}" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Designation</label>
                    <input class="form-control" type="text" id="designation" name="designation"  value="{{$user->designation}}" />
                  </div>
                 
                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Role</label>
                    <select id="role" name="role" class="form-select"  aria-label="Default select example">
                      <option value="0">Select Role</option>
                      @foreach($role as $row)
                      <option value="{{$row->id}}" <?php echo $row->id == $rolename->id ? 'selected' : '' ?>>{{$row->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="mb-3 col-md-12">
                    <label for="address" class="form-label">Agent Location</label>
                    <input type="text" class="form-control" id="address" name="location" value="{{$user->location}}" placeholder="Enter Agent Location" />
                    </div>
                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select"  aria-label="Default select example">
                      <option value="1" <?php echo $row->status=='1' ? 'selected' : '' ?>>Active</option>
                      <option value="0" <?php echo $row->status=='0' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="formFile" class="form-label">Profile Photo</label>
                    <input class="form-control" type="file" name="formFile" id="formFile">
                    <!-- <img width="100px" height="50px" src="{{ENV('APP_URL')}}/users/images/{{$user->photo}}"> -->
                    <input type="hidden" name="oldimage" id="oldimage" value="{{$user->photo}}">
                  </div>
                  
              </div>
          </div>
          <hr class="my-0">
          <div class="card-body">
              
            <div class="row">
                <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                <button type="reset" class="btn btn-outline-secondary">Discard</button>
                </div>
            </div>
        </div>
        <!-- /Notifications -->
      </div>
  </div>
</form> 
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
        let phone = document.getElementById('phone').value;
        let department = document.getElementById('department').value;
        let specialty = document.getElementById('specialty').value;
        let designation = document.getElementById('designation').value;
        let role = document.getElementById('role').value;
        let photo = document.getElementById('oldimage').value; 
        let address = document.getElementById("address").value;

        $(".error").remove();
    
     if (firstName.length < 1) {
    $('#firstName').after('<span class="error">This field is required*</span>');
    return false;
    }
    if (lastName.length < 1) {
      $('#lastName').after('<span class="error">This field is required*</span>');
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
    if (department.length < 1) {
      $('#department').after('<span class="error">Department is required*</span>');
    spinner.hide();
 return false;
    }

    if (phone.length < 8 || phone.length > 13 ) {
      $('#phone').after('<span class="error">Phone Length Should be in Between 8 To 13 Digit*</span>');
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
    var selrole=$('#role');
    if(selrole.val() == 0)
    {
      $('#role').after('<span class="error"> Select a Valid Role</span>');
      return false;
    }

    if (address.length < 1) {
    $('#address').after('<span class="error">Address is required*</span>');
    spinner.hide();
    return false;
    }

    if(photo.length < 1)
    {
      $('#formFile').after('<span class="error">Upload an Image</span>');
      return false;
    }
   
     else{
     return true;
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

