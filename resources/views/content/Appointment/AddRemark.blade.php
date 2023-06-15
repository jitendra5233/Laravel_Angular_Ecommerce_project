@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Add Remark')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/ui-toasts.js')}}"></script>
<!-- <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script> -->
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
          <h5 class="card-header">Update Remark</h5>
          <!-- Account -->
          <div class="card-body">
              <div class="row">
                <input type="hidden" value="{{$Appidid}}" id="Appidid">
              <div class="mb-3 col-md-6">
              <label for="exampleFormControlSelect1" class="form-label">Appointment Status</label>
              <select  name="appointmentstatus" class="form-select" id="appointmentstatus" aria-label="Default select example" onchange="updateAppointmentStatus(this.value,{{$Appidid}})">
                <option value="0" selected="">Select Appointment</option>
                @foreach($appointmentstatus as $row)
                <option value="{{$row->id}}" <?php echo $row->id == $status ? 'selected' :''?>>{{$row->name}}</option>
                @endforeach
              </select>
            </div> 
              <div class="mb-3 col-md-12">
            <label for="exampleFormControlSelect1" class="form-label">Enter Your Remark</label>
            <textarea class="form-control" type="text" id="addremark" name="remark">{{$remark}} </textarea>
          </div>
          </div>
          <div class="card-body"> 
            <div class="row">
                <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2" onclick="handleSubmit()">Save changes</button>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
  updateAppointmentStatus = (status,Appidid) =>{
    let data = new FormData;

    data.append('status',status);
    data.append('Appidid',Appidid);
    axios.post('{{ENV("APP_URL")}}/updateAppointmentStatus',data).then((result) => {
      if(result.data == 1){
        $('#showToastPlacement').trigger('click');
      }
    }).catch((err) => {
      console.log(err)
    });
  }
</script>
<script>
  function  handleSubmit() {
      

      let appointmentstatus = document.getElementById('appointmentstatus').value;
      let addremark = document.getElementById('addremark').value;
      let Appidid =document.getElementById('Appidid').value;
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
      else
      {
        let data = new FormData;
        data.append('status',appointmentstatus);
        data.append('remark',addremark);
        data.append('Appidid',Appidid);
        axios.post('{{ENV("APP_URL")}}/Save_remark',data).then((result) => {
          if(result.data == 1){
          spinner.hide();
          Swal.fire(
            'Thankyou!',
            'Remark Added Successfully !',
            'success',
            //  confirmButtonColor:true,
            // confirmButtonText: "Ok",
            ).then((result) => {
            //   if (result.isConfirmed) {
              window.location.href = '{{ENV("APP_URL")}}/appointment-view';
            //   }        
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
