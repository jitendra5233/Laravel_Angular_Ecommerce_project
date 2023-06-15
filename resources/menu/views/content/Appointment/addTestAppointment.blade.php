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
<script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoyZ_yVsI5N8KhjbWRyQeme1Pfz2DRYYc&libraries=places&callback=initAutocomplete"></script>
@section('content')
<style>
  .form-check-input[type=checkbox] {
    border: 1px solid #00000061;
  }

  .error {
    color: red;
  }

  .loader {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    background: rgba(0, 0, 0, 0.75) url(images/loading2.gif) no-repeat center center;
    z-index: 10000;
  }
</style>
<!-- <script>
  $(document).ready(function () {

    var getemail = $('#email');
    if (getemail.val() == 0) {
      $('#remarkrow').hide();
    }
  });
</script> -->
<div class="loader"></div>
<div class="row">
  <div class="col-md-12">

    <div class="card mb-4">
      <h5 class="card-header">New Appointment</h5>
      <!-- Account -->
      <div class="card-body">
        <div class="row">
        <div class="mb-3 col-md-6">
        <label for="exampleFormControlSelect1" class="form-label">Call Back Status</label>
          <select name="callbackstatus" class="form-select btn-sm" id="callbackstatus" aria-label="Default select example">
            <option value="0" <?php echo $client[0]->status == 0 ? 'selected': '' ?>>Pending</option>
            <option value="1" <?php echo $client[0]->status == 1 ? 'selected': '' ?>>On Hold</option>
            <option value="2" <?php echo $client[0]->status == 2 ? 'selected': '' ?>>Cancled</option>
            <option value="3" <?php echo $client[0]->status == 3 ? 'selected': '' ?>>Completed</option>
            </select>
        </div>
        </div>
        <div class="row" id="remarkrow">
          <div class="mb-3 col-md-12">
            <label for="exampleFormControlSelect1" class="form-label">Enter Your Remark</label>
            <textarea class="form-control" type="text" id="addremark" name="remark">{{(!empty($client[0]->remark)) ? $client[0]->remark :''}}</textarea>
          </div>
          <div class="mb-3 col-md-4">
            <input type='checkbox' id="check" onchange='handleChange(this);'>
            <label for="check">Click here and add Your Appointment</label>
          </div>
        <div id="mydata" style="display:none;">
          <div class="row" id="myheader">
            <div class="mb-3 col-md-6">
              <input type="hidden" name="clientid" id="clientid" value="{{(!empty($client[0]->id)) ? $client[0]->id :''}}">
              <label for="exampleFormControlSelect1" class="form-label">First Name</label>
              <input class="form-control" type="text" id="firstName" name="firstName"
                value="{{(!empty($client[0]->name)) ? $client[0]->name :''}}">
            </div>
            <div class="mb-3 col-md-6">
              <label for="exampleFormControlSelect1" class="form-label">last Name</label>
              <input class="form-control" type="text" id="lastName" name="lastName"
                value="{{(!empty($client[0]->last_name)) ? $client[0]->last_name :''}}">
            </div>
            <div class="mb-3 col-md-6">
              <label for="exampleFormControlSelect1" class="form-label"> Email
              </label>
              <input class="form-control" type="text" id="email" name="email"
                value="{{(!empty($client[0]->email)) ? $client[0]->email :''}}">
            </div>
            <div class="mb-3 col-md-6">
              <label for="exampleFormControlSelect1" class="form-label">Phone</label>
              <input class="form-control" type="text" id="phone" name="phone"
                value="{{(!empty($client[0]->phone)) ? $client[0]->phone :''}}">
            </div>
            <div class="mb-3 col-md-12">
              <label for="address" class="form-label">Agent Location</label>
              <input type="text" class="form-control" id="address" name="location" placeholder="Enter Agent Location" />
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
              <select name="role" class="form-select" id="property" aria-label="Default select example">
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
        <div class="card-body" id="myfooter">
          <div class="row">
            <div class="mt-4" id="firstbtn" style="display:none">
              <button type="submit" class="btn btn-primary me-2" id="postme" onclick="handleSubmit()">Save
                changes</button>
                <button type="reset" class="btn btn-outline-secondary">Discard</button>
            </div>
            <div class="mt-4" id="secondbtn">
            <button type="submit" class="btn btn-primary me-2" id="postme1" onclick="handleSubmit1()">Save
                Remark</button>
                <button type="reset" class="btn btn-outline-secondary">Discard</button>
              </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script>
  $(document).ready(function () {
    $('#mydata').hide();
    $('secondbtn').show(); 
  });
  function handleChange(checkbox) {
    if (checkbox.checked == true) {
      $('#mydata').show();
      $('#firstbtn').show();
      $('#secondbtn').hide();
      // handleSubmit();
    }
     else {

      $('#mydata').hide();
      $('#firstbtn').hide();
      $('#secondbtn').show();
    }
  }

  function handleSubmit() {
        let firstName = document.getElementById('firstName').value;
        let lastName = document.getElementById('lastName').value;
        let email = document.getElementById('email').value;
        let phone = document.getElementById('phone').value;
        let property = document.getElementById('property').value;
        let user = document.getElementById('user').value;
        let date = document.getElementById('date').value;
        let time = document.getElementById('time').value;
        let addremark = document.getElementById('addremark').value;
        let clientid = document.getElementById('clientid').value;
        var e = document.getElementById("callbackstatus");
        var status=e.value;
        $(".error").remove();
        var spinner = $('.loader');
        spinner.show();
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

        if (phone.length < 8 || phone.length > 13) {
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
        var getuser = $('#user');
        if (getuser.val() == 0) {
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
        else {
          let data = new FormData;
          data.append('firstName', firstName);
          data.append('lastName', lastName);
          data.append('email', email);
          data.append('phone', phone);
          data.append('property', property);
          data.append('user', user);
          data.append('date', date);
          data.append('time', time);
          data.append('remark', addremark);
          data.append('id', clientid);
          data.append('status',status);
          axios.post('{{ENV("APP_URL")}}/submit-appointment', data).then((result) => {
            if(result.data ==1)
            {
              spinner.hide();
             window.location.href = '{{ENV("APP_URL")}}/appointment-view';
            }
          }).catch((err) => {
            spinner.hide();
            console.log(err)
          });
        }

      }

  function handleSubmit1() {
        let addremark = document.getElementById('addremark').value;
        let clientid = document.getElementById('clientid').value;
        var e = document.getElementById("callbackstatus");
        var status=e.value;
        $(".error").remove();
        var spinner = $('.loader');
        spinner.show();
        if (addremark.length < 10) {
          $('#addremark').after('<span class="error">Fill Remark  More than 10  Charecters*</span>');
          spinner.hide();
          return false;
        }
        else {
          let data = new FormData;
          data.append('firstName', '0');
          data.append('lastName', '0');
          data.append('email', '0');
          data.append('phone', '0');
          data.append('property', '0');
          data.append('user', '0');
          data.append('date', '0');
          data.append('time', '0');
          data.append('remark',addremark);
          data.append('id',clientid);
          data.append('status',status);
          axios.post('{{ENV("APP_URL")}}/submit-appointment', data).then((result) => {
            if (result.data == 1) {
              spinner.hide();
              window.location.href = '{{ENV("APP_URL")}}/callback';
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
    function fillInAddress() {
      var place = autocomplete.getPlace();
      var address = place.formatted_address;
      let userElement = document.getElementById('user')
      let data = new FormData;
      data.append('location', address)
      axios.post('{{ENV("APP_URL")}}/getuserbyaddress', data).then((result) => {
        var i, L = userElement.options.length - 1;
        for (i = L; i >= 0; i--) {
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