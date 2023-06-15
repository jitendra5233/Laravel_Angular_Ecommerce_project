

@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - View Trainer')

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
          <h5 class="card-header">Trainer Details </h5>
          <!-- Account -->
          <div class="card-body">
              <div class="row">
              <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Name *</label>
                    <input class="form-control" type="text" id="name" name="name"  value="{{$getTrainer->name}}" disabled/>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Branch Name *</label>
                    <select id="branch_id" name="branch_id" class="form-select"  aria-label="Default select example" disabled>
                      <option value="0" selected="">Select Branch</option>
                      @foreach($branch as $r)
                      <option value="{{$r->id}}" <?php echo $getTrainer->branch_id == $r->id ? 'selected' : null ?>>{{$r->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  
                  <div class="mb-3 col-md-6">
                    <label for="speciality" class="form-label">Speciality*</label>
                    <input class="form-control" type="text" id="speciality" name="speciality"  value="{{$getTrainer->speciality}}" disabled/>
                  </div>

                   <div class="mb-3 col-md-6">
                    <label for="page_title" class="form-label">Page Title *</label>
                    <input class="form-control" type="text" id="page_title" name="page_title"  value="{{$getTrainer->page_title}}" disabled/>
                  </div>
                     <div class="mb-3 col-md-6">
                    <label for="page_description" class="form-label">Page Description *</label>
                    <textarea id="page_description" name="page_description" class="form-control" disabled>{{$getTrainer->page_description}}</textarea>
                  </div>     
                  
                   <div class="mb-3 col-md-6">
                    <label for="page_schema" class="form-label">Page Schema Json *</label>
                    <textarea id="page_schema" name="page_schema" class="form-control" disabled>{{$getTrainer->page_schema}}</textarea>
                  </div>  


                  <div class="mb-3 col-md-6">
                    <label for="status" class="form-label">Status *</label>
                    <select id="status" name="status" class="form-select"  aria-label="Default select example" disabled>
                      <option value="1" <?php echo $getTrainer->status=='1' ? 'selected' : '' ?>>Active</option>
                      <option value="0" <?php echo $getTrainer->status=='0' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                  </div>


                  <div class="mb-3 col-md-6">
                    <label for="myImg" class="form-label">Trainer Image *</label>
                    <img  id="myImg" class="" src="{{ENV('APP_URL')}}/TrainerImg/{{$getTrainer->image}}" data-bigger-src="{{ENV('APP_URL')}}/TrainerImg/{{$getTrainer->image}}" disabled />
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
  //Genrate autocomplete map code Here...
  function init() {
    var input = document.getElementById("location");
    var autocomplete = new google.maps.places.Autocomplete(input);
  }

  google.maps.event.addDomListener(window, "load", init);
</script>


@endsection

