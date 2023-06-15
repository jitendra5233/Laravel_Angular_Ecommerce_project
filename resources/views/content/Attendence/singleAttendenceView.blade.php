

@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - View Attendance')

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
<script type="text/javascript" src="{{asset(' assets/richtexteditor/plugins/all_plugins.js')}}"></script>
<script type="text/javascript" src="{{asset(' assets/richtexteditor/rte-upload.js')}}"></script>
@section('content')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoyZ_yVsI5N8KhjbWRyQeme1Pfz2DRYYc&libraries=places&callback=initAutocomplete"></script>
<style>
    .form-check-input[type=checkbox] {
        border: 1px solid #00000061;
    }
    .error{
      color:red;
    }
    .AceSelected{
    border: 4px solid #04917a
  }
  #myImg{
    height:100px;
  }
   
</style>
<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">View Attendance Details</h5>
          <div class="card-body">
              <div class="row">
              @foreach($tableData as $row)
              <div class="mb-3 col-md-6">
                    <label for="studentName" class="form-label">Student Name *</label>
                    <input class="form-control" type="text" id="studentName" name="studentName" value="{{$row->studentName}}" disabled/>
                  </div>
                  <?php if($row->workshopName !=''){ ?>
                   <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">WorkShop Title *</label>
                    <input class="form-control" type="text" id="page_title" name="page_title"  value="{{$row->workshopName}}" disabled/>
                  </div>
                  <?php } ?>

                  <?php if($row->pclassName !=''){ ?>

                  <div class="mb-3 col-md-6">
                    <label for="pclassName" class="form-label">Project Class Name *</label>
                    <input class="form-control" type="text" id="pclassName" name="pclassName"  value="{{$row->pclassName}}" disabled/>
                  </div>
                  <?php }  ?>
               
                  <?php if($row->openclassName !=''){ ?>
                  <div class="mb-3 col-md-6">
                    <label for="openclassName" class="form-label">Open Class Name *</label>
                    <input class="form-control" type="text" id="openclassName" name="openclassName"  value="{{$row->openclassName}}" disabled/>
                  </div>
                  <?php } ?>


                  <div class="mb-3 col-md-6">
                    <label for="date" class="form-label">Class Type / Page Type *</label>
                    <input class="form-control" type="text" id="date" name="date"  value="<?php if($row->type == 'workshop'){echo"workshop";}if($row->type == 'p_class'){echo"Project Class";}
                      if($row->type == 'open_class') {echo"Open Class";}if($row->type == 'package'){echo"Package";}
                      ?>
                    " disabled/>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="date" class="form-label">Date *</label>
                    <input class="form-control" type="text" id="date" name="date"  value="{{$row->date}}" disabled/>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="time" class="form-label">Time *</label>
                    <input class="form-control" type="text" id="time" name="time"  value="{{$row->time}}" disabled/>
                  </div>
                </div>
            </div>
            @endforeach
              </div>
          </div>

        <!-- /Notifications -->
      </div>
  </div>
<!--</form>-->



  <!-- /Account -->
        </div>
      </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>


$(document).ready(function() {
    let oldhtml = document.getElementById('inp_htmlcode').value; 
    var text = $(oldhtml).text();
    document.getElementById('description').innerHTML=text; 
   
});
  
   

</script>
<script>
  function init() {
    var input = document.getElementById("location");
    var autocomplete = new google.maps.places.Autocomplete(input);
  }

  google.maps.event.addDomListener(window, "load", init);
</script>


@endsection

