@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Add Manual Appointment')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
<script src="{{asset('assets/js/ui-toasts.js')}}"></script>
<script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" charset="utf-8"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css">
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
    .start-50 {
   left : 85%!important;
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
          <h5 class="card-header">New Appointment</h5>
          <!-- Account -->
          <div class="card-body">
              <div class="row">
              <div class="mb-3 col-md-6">
              <label for="exampleFormControlSelect1" class="form-label">Appointment Status</label>
              <select  name="appointmentstatus" class="form-select" id="appointmentstatus" aria-label="Default select example">
                <option value="0" selected="">Select Appointment</option>
                @foreach($appointment as $row)
                <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
              </select>
            </div>
                  <!-- onchange="updateAppointmentStatus(this.value)" -->
             
              <div class="mb-3 col-md-12">
            <label for="exampleFormControlSelect1" class="form-label">Enter Your Remark</label>
            <textarea class="form-control" type="text" id="addremark" name="remark"> </textarea>
          </div>
        
                <div class="mb-3 col-md-6">
                  <label for="exampleFormControlSelect1" class="form-label">First Name</label>
                  <input class="form-control" type="text" id="firstName" name="firstName" value="">
                </div>
                <div class="mb-3 col-md-6">
                  <label for="exampleFormControlSelect1" class="form-label">last Name</label>
                  <input class="form-control" type="text" id="lastName" name="lastName" value="">
                </div>
                <div class="mb-3 col-md-6">
                  <label for="exampleFormControlSelect1" class="form-label"> Email
                  </label>
                  <input class="form-control" type="text" id="email" name="email" value="">
                </div>
                <div class="mb-3 col-md-6">
                  <label for="exampleFormControlSelect1" class="form-label">Phone</label>
                  <input class="form-control" type="text" id="phone" name="phone" value="">
                </div>
                <div class="mb-3 col-md-12">
                    <label for="address" class="form-label">Agent Location</label>
                    <input type="text" class="form-control" id="address" name="location"  placeholder="Enter Agent Location" />
                    </div>
                    <div class="mb-3 col-md-6">
                  <label for="exampleFormControlSelect1" class="form-label">Users</label>
                  <select id="user" name="user" class="select2 form-select">
                  <option value="0">Select User</option>
                  <option value="no_user">No User</option>
                </select>
                </div>
                <div class="mb-3 col-md-6">
                  <label for="exampleFormControlSelect1" class="form-label">Property</label>
                  <select  name="role" class="form-select" id="property" aria-label="Default select example">
                    <option value="0" selected="">Select Property</option>
                    @foreach($property as $row)
                    <option value="{{$row->id}}">{{$row->name}}</option>
                    @endforeach
                  </select>
                </div>
              
                <div class="mb-3 col-md-6">
                  <label for="exampleFormControlSelect1" class="form-label">Date</label>
                  <input class="form-control" type="date" value="" id="date"> 
                </div>
                <div class="mb-3 col-md-6">
                  <label for="exampleFormControlSelect1" class="form-label">Time</label>
                  <input class="form-control" type="time" value="" id="time">
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
  <!-- /Account -->
        </div>
      </div>
</div>

<div class="card mb-4" style="display:none">
  <div class="card-body">
    <div class="row gx-3 gy-2 align-items-center">
      <div class="col-md-3">
        <label class="form-label" for="selectTypeOpt">Type</label>
        <select id="selectTypeOpt" class="form-select color-dropdown">
          <option value="bg-success">Success</option>
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label" for="selectPlacement">Placement</label>
        <select class="form-select placement-dropdown" id="selectPlacement">
          <option value="top-0 start-50 translate-middle-x">Top center</option>
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label" for="showToastPlacement">&nbsp;</label>
        <button id="showToastPlacement" class="btn btn-primary d-block"></button>
      </div>
    </div>
  </div>
</div>
<div class="bs-toast toast toast-placement-ex m-2 fade bg-success top-0 end-0 hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
  <div class="toast-header">
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
   Status Updated Successfully.
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script>
  // updateAppointmentStatus = (id) =>{
  //   let data = new FormData;
  //   data.append('status',id);
  //   axios.post('{{ENV("APP_URL")}}/updateAppointmentStatus',data).then((result) => {
  //     if(result.data == 1){
  //       console.log(result.data);
  //       return false;
  //       // $('#showToastPlacement').trigger('click');
  //     }
  //   }).catch((err) => {
  //     console.log(err)
  //   });
  // }
</script>
<script>
  function  handleSubmit() {
      
      let firstName = document.getElementById('firstName').value;
      let lastName = document.getElementById('lastName').value;
      let email = document.getElementById('email').value;
      let phone = document.getElementById('phone').value;
      let appointmentstatus = document.getElementById('appointmentstatus').value;
      let property = document.getElementById('property').value;
      let user = document.getElementById('user').value;
      let date = document.getElementById('date').value;
      let time = document.getElementById('time').value;
      let addremark = document.getElementById('addremark').value;
      $(".error").remove();
      var spinner = $('.loader');
      spinner.show();
      
      var getproperty=$('#appointmentstatus');
    if(getproperty.val() == 0)
    {
      $('#appointmentstatus').after('<span class="error"> Select a Valid Appointment Status*</span>');
      spinner.hide();
      return false;
    }

    if (addremark.length < 10) {
          $('#addremark').after('<span class="error">Fill Remark  More than 10  Charecters*</span>');
          spinner.hide();
          return false;
        }

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
    
    if (phone.length < 8 || phone.length > 13 ) {
      $('#phone').after('<span class="error">Phone Length Should be in Between 8 To 13 Digit*</span>');
    spinner.hide();

      return false;
    }

    var getaddress=$('#address');
        if (getaddress.val() == 0) {
          $('#address').after('<span class="error">Chose a Valid address for Choose valid user acording to area*</span>');
          spinner.hide();
          return false;
        }

    var getuser=$('#user');
    if(getuser.val() == 0)
    {
      $('#user').after('<span class="error"> Select a Valid User*</span>');
      spinner.hide();
      return false;
    }

    var getproperty = $('#property');
        if (getproperty.val() == 0) {
          $('#property').after('<span class="error"> Select a Valid Property*</span>');
          spinner.hide();
          return false;
        }
    if (date == '') {
    $('#date').after('<span class="error"> Date is Required*</span>');
    spinner.hide();
    return false;
    }

    if (time == '') {
    $('#time').after('<span class="error"> Time is Required*</span>');
    spinner.hide();
    return false;
    }
      else
      {
        let data = new FormData;
        data.append('firstName',firstName);
        data.append('lastName',lastName);
        data.append('email',email);
        data.append('phone',phone);
        data.append('property',property);
        data.append('user',user);
        data.append('date',date);
        data.append('time',time);
        data.append('status',appointmentstatus);
        data.append('remark',addremark);
        axios.post('{{ENV("APP_URL")}}/ManualAppointment',data).then((result) => {
          if(result.data == 1){
          spinner.hide();
          window.location.href = '{{ENV("APP_URL")}}/appointment-view';
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
    autocomplete.addListener('place_changed', fillInAddress)
    function fillInAddress()
  {
    var place = autocomplete.getPlace();
    var address=  place.formatted_address;
    let userElement = document.getElementById('user')
    let data =  new FormData;
    data.append('location',address)
    axios.post('{{ENV("APP_URL")}}/getuserbyaddress',data).then((result) => {
      var i, L = userElement.options.length - 1;
      for(i = L; i >= 0; i--) {
        userElement.remove(i);
      }
      var doption = document.createElement("option");
        doption.text = 'Select';
        doption.value = 0;
        userElement.appendChild(doption);
        var doption2 = document.createElement("option");
        doption2.text = 'No User';
        doption2.value = 'no_user';
        userElement.appendChild(doption2);
        result.data.map(x => {
          var option = document.createElement("option");
          option.text = x.first_name + " " + x.last_name;
          option.value = x.id;
          userElement.appendChild(option);
        })
    }).catch((err) => {
      console.log(err)
    }); 
  }
  }
  google.maps.event.addDomListener(window, "load", init);
</script>


@endsection
