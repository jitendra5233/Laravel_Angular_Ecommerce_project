

@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - View Open Class')

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
          <h5 class="card-header">View Open Class</h5>
          <div class="card-body">
              <div class="row">
              <input type="hidden" name="proid" id="proid" value="{{$openClass->id}}" />
              <div class="mb-3 col-md-6">
                    <label for="classname" class="form-label">Class Name *</label>
                    <input class="form-control" type="text" id="classname" name="classname" value="{{$openClass->classname}}" disabled/>
                  </div>
                   <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Page Title *</label>
                    <input class="form-control" type="text" id="page_title" name="page_title"  value="{{$openClass->page_title}}" disabled/>
                  </div>
                     <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Description *</label>
                    <textarea id="page_description" name="page_description" class="form-control" disabled>{{$openClass->page_description}}</textarea>
                  </div>     
                  
                   <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Schema Json *</label>
                    <textarea id="page_schema" name="page_schema" class="form-control" disabled>{{$openClass->page_schema}}</textarea>
                  </div> 
                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Branch Name *</label>
                    <select id="branchname" name="branchname" class="form-select"  aria-label="Default select example" disabled>
                      <option value="0" selected="">Select Branch</option>
                      @foreach($branch as $r)
                      <option value="{{$r->id}}" <?php echo $openClass->branchname == $r->id ? 'selected' : null ?>>{{$r->name}}</option>
                      @endforeach
                    </select>
                  </div> 

                  <div class="mb-3 col-md-6">
                    <label for="status" class="form-label">Status *</label>
                    <input class="form-control" type="text" id="status" name="status"  value="<?php echo ($openClass->status == 1) ? "Active" :  "Inactive"; ?>" disabled/>
                  </div>


                  <div class="mb-3 col-md-6">
                    <label for="scheduledate" class="form-label">Schedule Date *</label>
                    <input class="form-control" type="Date" id="scheduledate" name="scheduledate" value="{{$openClass->scheduledate}}" disabled/>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="scheduletime" class="form-label">Schedule Time *</label>
                    <input class="form-control" type="time" id="scheduletime" name="scheduletime" value="{{$openClass->scheduletime}}" disabled/>
                  </div>


                  <div class="mb-3 col-md-6">
                    <div class="custom-control custom-switch mb-3">
                    <input type="checkbox" class="custom-control-input" id="f2f_switch" <?php echo $openClass->facetofaceslot !='' ? 'Checked' :'' ?> onchange="togglefacetofaceslot(this)" disabled>
                    <label class="custom-control-label" for="f2f_switch">Face to Face</label>
                    </div>
                    <div class="form-group mb-4" id="slots" name="slots">
                        <label class="mr-sm-2" for="facetofaceslot">Face to Face Slots #</label>
                        <input type="number" class="form-control" id="facetofaceslot" name="facetofaceslot" min="1" value="{{$openClass->facetofaceslot}}" disabled>

                        </div>
                  </div>
                  

                  <div class="mb-3 col-md-6">
                    <div class="custom-control custom-switch mb-3">
                    <input type="checkbox" class="custom-control-input" id="f2f_switch"  <?php echo $openClass->zoomlink !='' ? 'Checked' :'' ?> onchange="togglezoomlink(this)" disabled>
                    <label class="custom-control-label" for="f2f_switch">Zoom</label>
                    </div>
                    <div class="form-group mb-4" id="slots" name="slots">
                        <label class="mr-sm-2" for="zoomlink"> Zoom Link #</label>
                        <input type="number" class="form-control" id="zoomlink" name="zoomlink" value="{{$openClass->zoomlink}}" disabled>

                        </div>
                  </div>


                  <div class="mb-3 col-md-6">
                    <label for="regularrate" class="form-label">Regular Rate *</label>
                    <input class="form-control" type="text" id="regularrate" name="regularrate" value="{{$openClass->regularrate}}" disabled/>
                  </div>

                  
                  <div class="mb-3 col-md-6">
                    <label for="advancepayment" class="form-label">Advance Payment *</label>
                    <input class="form-control" type="text" id="advancepayment" name="advancepayment" value="{{$openClass->advancepayment}}" disabled/>
                  </div>
                    <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Package Thumbnail *</label>
                    <img  id="myImg" class="" src="{{ENV('APP_URL')}}/OpneClassImages/{{$openClass->packagethumbmail}}" data-bigger-src="{{ENV('APP_URL')}}/OpneClassImages/{{$openClass->packagethumbmail}}" disabled />
                    </div>

                    <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Checkout Thumbnail *</label>
                    <img  id="myImg" class="" src="{{ENV('APP_URL')}}/OpneClassImages/{{$openClass->checkoutthumbmail}}" data-bigger-src="{{ENV('APP_URL')}}/OpneClassImages/{{$openClass->checkoutthumbmail}}" disabled />
                    </div>

                    <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Trainer  Name *</label>
                    <select id="branchname" name="branchname" class="form-select"  aria-label="Default select example" disabled>
                      <option value="0" selected="">Select Trainer</option>
                      @foreach($trainer as $trainer)
                      <option value="{{$trainer->id}}" <?php echo $openClass->trainer_id == $trainer->id ? 'selected' : null ?>>{{$trainer->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="mb-3 col-md-12">
                    <label for="description" class="form-label">Description *</label>
                    <textarea id="description" name="description" class="form-control" disabled></textarea>
                    <input name="description" id="inp_htmlcode" type="hidden" value="{{$openClass->description}}"/>
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

