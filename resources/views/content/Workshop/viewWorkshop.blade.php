

@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - View Workshop')

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
<script type="text/javascript" src="{{asset('assets/richtexteditor/rte-upload.js')}}"></script>
<script type="text/javascript" src="{{asset('js/mobiscroll.javascript.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/mobiscroll.javascript.min.css')}}" />
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
    width: 100px;
  }
   
</style>
<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">View Workshop</h5>
          <div class="card-body">
              <div class="row">
              <input type="hidden" name="proid" id="proid" value="{{$getWorkshop->id}}" />

              <div class="mb-3 col-md-12">
              <label for="calendar" class="form-label" >Workshop Dates *</label>
              <input  id="calendar" class="form-control" placeholder="Please select..." value="<?php echo $finalworkdate ?>" disabled/> 
              <div id="calendar"></div>

              </div>
              <div class="mb-3 col-md-6">
                    <label for="class_id" class="form-label">Class Name *</label>
                    <select id="class_id" name="class_id" class="form-select"  aria-label="Default select example" disabled>
                      <option value="0" selected="">Select Class</option>
                      @foreach($projectClass as $row2)
                      <option value="{{$row2->id}}" <?php echo $getWorkshop->class_id == $row2->id ? 'selected' : ''?>>{{$row2->name}}</option>
                       @endforeach
                    </select>
                  </div>
                  

                  <div class="mb-3 col-md-6">
                    <label for="branch_id" class="form-label">Branch Name *</label>
                    <select id="branch_id" name="branch_id" class="form-select"  aria-label="Default select example" disabled>
                      <option value="0" selected="">Select Branch</option>
                      @foreach($branch as $r)
                      <option value="{{$r->id}}" <?php echo $getWorkshop->branch_id == $r->id ? 'selected' : null ?>>{{$r->name}}</option>
                      @endforeach
                    </select>
                  </div> 


                  <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Workshop Title *</label>
                    <input class="form-control" type="text" id="title" name="title"  value="{{$getWorkshop->title}}" disabled/>
                  </div>

                  
                  <div class="mb-3 col-md-6">
                    <label for="paymenttitle" class="form-label">Payment Title *</label>
                    <input class="form-control" type="text" id="paymenttitle" name="paymenttitle"  value="{{$getWorkshop->paymenttitle}}" disabled/>
                  </div>

                   <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Page Title *</label>
                    <input class="form-control" type="text" id="page_title" name="page_title"  value="{{$getWorkshop->page_title}}" disabled/>
                  </div>
                     <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Description *</label>
                    <textarea id="page_description" name="page_description" class="form-control" disabled>{{$getWorkshop->page_description}}</textarea>
                  </div>     
                  
                   <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Schema Json *</label>
                    <textarea id="page_schema" name="page_schema" class="form-control" disabled>{{$getWorkshop->page_schema}}</textarea>
                  </div>  

                  <div class="mb-3 col-md-6">
                    <label for="price" class="form-label">Price *</label>
                    <input class="form-control" type="text" id="price" name="price" value="{{$getWorkshop->price}}" disabled/>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Status *</label>
                    <select id="status" name="status" class="form-select"  aria-label="Default select example" disabled>
                      <option value="1" <?php echo $getWorkshop->status=='1' ? 'selected' : '' ?>>Active</option>
                      <option value="0" <?php echo $getWorkshop->status=='0' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="starttime" class="form-label">Start Time *</label>
                    <input class="form-control" type="time" id="starttime" name="starttime" value="{{$getWorkshop->starttime}}" disabled/>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="endtime" class="form-label">End Time *</label>
                    <input class="form-control" type="time" id="endtime" name="endtime" value="{{$getWorkshop->endtime}}" disabled/>
                  </div>

                    <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">WorkShop Image *</label>
                    <img  id="myImg" class="" src="{{ENV('APP_URL')}}/WorkshopImage/{{$getWorkshop->image}}" data-bigger-src="{{ENV('APP_URL')}}/WorkshopImage/{{$getWorkshop->image}}" disabled />
                    </div>

                
                    
                  <div class="mb-3 col-md-12">
                    <label for="short_description" class="form-label">Short Description</label>
                    <textarea id="short_description" name="short_description" class="form-control" disabled>{{$getWorkshop->short_description}}</textarea>
                  </div> 

                  <div class="mb-3 col-md-12">
                    <label for="description" class="form-label">Description *</label>
                    <textarea id="description" name="description" class="form-control" disabled></textarea>
                    <input name="description" id="inp_htmlcode" type="hidden" value="{{$getWorkshop->description}}"/>
                  </div>

                  {!! QrCode::size(150)->generate('https://gforce.techiespreview.website/attendance') !!}
                </div>
            </div>
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

// Get Editor code here  first make simple then send it to Editor Field


$(document).ready(function() {
    let oldhtml = document.getElementById('inp_htmlcode').value
     var text=$(oldhtml).text();
     document.getElementById('description').innerHTML=text;
});

</script>

<script>
  //Genrate autocomplete map code Here...
  function init() {
    var input = document.getElementById("location");
    var autocomplete = new google.maps.places.Autocomplete(input);
  }

  google.maps.event.addDomListener(window, "load", init);
</script>


@endsection

