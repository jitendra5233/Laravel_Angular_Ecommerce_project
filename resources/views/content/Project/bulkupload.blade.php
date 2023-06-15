@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Add Project')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

<link rel="stylesheet" href="{{asset('assets/richtexteditor/rte_theme_default.css')}}" />
<script type="text/javascript" src="{{asset('assets/richtexteditor/rte.js')}}"></script>
<script type="text/javascript" src='{{asset('assets/richtexteditor/plugins/all_plugins.js')}}'></script>
<script type="text/javascript" src='{{asset('assets/richtexteditor/rte-upload.js')}}'></script>
@section('content')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoyZ_yVsI5N8KhjbWRyQeme1Pfz2DRYYc&libraries=places&callback=initAutocomplete"></script>
<style>
    .form-check-input[type=checkbox] {
        border: 1px solid #00000061;
    }
    .AceSelected{
    border: 4px solid #04917a
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
<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">Bulk Upload</h5>
          <!-- Account -->
          <form action="{{ENV('APP_URL')}}/bulkuploadproperty" method="post" enctype="multipart/form-data" onsubmit="return checkvalidate()">
            @csrf
          <div class="card-body">
              <div class="row">
                  <div class="mb-3 col-md-12">
                    <input class="form-control" type="file" id="formFile" name="filecsv"  onchange="return fileValidation()" >
                  </div>
              </div>
          </div>
          <hr class="my-0">
          <div class="card-body">
              
            <div class="row">
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary me-2">Upload</button>
                </div>
            </div>
        </div>
        <!-- /Notifications -->
      </div>
  </div>
</form>
    </div>
  </div>
</div>
        </div>
      </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

@endsection

    <script>
        function fileValidation() {
              $(".error").remove();
            var fileInput =
                document.getElementById('formFile');
             
            var filePath = fileInput.value;
         
            // Allowing file type
            var allowedExtensions =
                    /(\.csv)$/i;
             
            if (!allowedExtensions.exec(filePath)) {
                  $('#formFile').after('<span class="error"> Please upload file having extensions .csv only</span>');
                fileInput.value = '';
                return false;
            }
            else
            {
             
                // Image preview
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                    };
                     
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }
   
</script>
<script>


 checkvalidate = () =>{
     $(".error").remove();
    var fileInput = document.getElementById('formFile').value;
    var files = $('#formFile')[0].files;
    if( fileInput == '' || fileInput == null){
      $('#formFile').after('<span class="error"> Please upload file having extensions .csv and make sure your csv file is correct</span>');
      return false;
      
    }else{
     
    //   Swal.fire({
    //         title: "Thankyou!",   
    //         text: "Bulk Upload Successfully  !",   
    //         type: "success", 
    //         showConfirmButton: false, 
    //         allowOutsideClick: false, 
    //         timer: 4000,
    //         });
            return true;
     
    }
}

</script>
