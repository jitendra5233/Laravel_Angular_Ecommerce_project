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
#myImg{
    height:100px;
    width: 100px;
  }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
          <h5 class="card-header">New Branch</h5>
          <div class="card-body">
              <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="branchName" class="form-label">Name</label>
                    <input class="form-control" type="text" id="branchName" name="branchName" value="{{$branch->name}}" disabled />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="location" class="form-label">Location</label>
                    <input class="form-control" type="text" id="location" name="location" value="{{$branch->fulllocation}}" disabled />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="batch" class="form-label">Phone</label>
                    <input class="form-control" type="text" id="batch" name="batch" value="{{$branch->phone}}" disabled />
                  </div>
                   <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Branch Image *</label>
                    <img  id="myImg" class="" src="{{ENV('APP_URL')}}/uploadImages/branch/{{$branch->img}}" data-bigger-src="{{ENV('APP_URL')}}/uploadImages/branch/{{$branch->img}}" disabled />
                    </div>
                  <div class="mb-3 col-md-12">
                    <label for="des" class="form-label">Description</label>
                    <textarea class="form-control" id="des" name="des" disabled>{{$branch->des}}</textarea>
                  </div>
              </div>
          </div>

        </div>
      </div>
</div>
<div class="loader"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoyZ_yVsI5N8KhjbWRyQeme1Pfz2DRYYc&libraries=places&callback=initAutocomplete"></script>


@endsection

