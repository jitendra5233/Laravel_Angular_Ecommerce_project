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
          <h5 class="card-header">New Branch</h5>
          <div class="card-body">
              <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="branchName" class="form-label">Name</label>
                    <input class="form-control" type="text" id="branchName" name="branchName" value="" autofocus />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="location" class="form-label">Location</label>
                    <input class="form-control" type="text" id="location" name="location" value="" />
                  </div>
                  <div class="mb-3 col-md-6">
                   <label for="phone" class="form-label">Branch Contact Number</label>
                   <input class="form-control" type="text" id="phone" name="phone" value="" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="image" class="form-label">Image</label>
                    <input class="form-control" type="file" id="image" name="image" value="" />
                  </div>
                  <div class="mb-3 col-md-12">
                    <label for="des" class="form-label">Description</label>
                   <textarea class="form-control" id="des" name="des"></textarea>
                  </div>
                  <div class="mb-3 col-12">
                     <button type="submit" class="btn btn-primary me-2" onclick="handleSubmit()">Add Branch</button>
                  </div>
              </div>
          </div>

        </div>
      </div>..
</div>
<div class="loader"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoyZ_yVsI5N8KhjbWRyQeme1Pfz2DRYYc&libraries=places&callback=initAutocomplete"></script>

<script>
    handleSubmit = () =>{
      let name = document.getElementById('branchName').value;
      let location = document.getElementById('location').value;
      let des = document.getElementById('des').value;
      let phone = document.getElementById('phone').value;
      let img = $('#image')[0].files;

        $(".error").remove();
        var spinner = $('.loader');
        spinner.show();
        if (name.length < 1) {
        $('#branchName').after('<span class="error">Branch Name is required*</span>');
        spinner.hide();
        return false;
        }
        
         if (location.length < 1) {
        $('#location').after('<span class="error">Location is required*</span>');
        spinner.hide();
        return false;
        }

      if (phone.length < 8 || phone.length > 13 ) {
      $('#phone').after('<span class="error">Phone Length Should be in Between 8 To 13 Digit*</span>');
      spinner.hide();
      return false;

       }

         if (img.length == 0) {
            $('#image').after('<span class="error">Image is required*</span>');
            spinner.hide();
            return false;
          }
        
         if (des.length < 1) {
        $('#des').after('<span class="error">Description  is required*</span>');
        spinner.hide();
        return false;
        }
        
         else{
         let data = new FormData()
      data.append('name',name);
      data.append('location',location);
      data.append('phone',phone);
      data.append('des',des);
      data.append('img',img[0]);
      
      axios.post('{{ENV("APP_URL")}}/api/submitBranch',data).then((result) => {
       if(result.data == 1)
        {
        spinner.hide(); 
        Swal.fire(
            '',
            'Branch Added Successfully',
            'success'
        )
        .then((result) => {
          window.location.href = '{{ENV("APP_URL")}}/allBranch';
        });
        }

        
      }).catch((err) => {
        console.log(err)
      });
         }
      
      
    }

    function init() {
      var input = document.getElementById("location");
      var autocomplete = new google.maps.places.Autocomplete(input);
    }

    google.maps.event.addDomListener(window, "load", init);

</script>

@endsection

