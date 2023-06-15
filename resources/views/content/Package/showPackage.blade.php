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
          <h5 class="card-header">Edit Package</h5>
          <div class="card-body">
              @foreach($package as $row)
              <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="packageName" class="form-label">Package Name</label>
                    <input class="form-control" type="text" id="packageName" name="packageName" value="{{$row->name}}" disabled autofocus />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="price" class="form-label">Price</label>
                    <input class="form-control" type="text" id="price" name="price" value="{{$row->price}}" disabled />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="credit" class="form-label">Credit</label>
                    <input class="form-control" type="text" id="credit" name="credit" value="{{$row->credit}}" disabled autofocus />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="expire" class="form-label">Expire</label>
                    <input class="form-control" type="text" id="expire" name="expire" value="{{$row->expire}}" disabled />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="expire" class="form-label">Class Name</label>
                    <input class="form-control" type="text" id="expire" name="expire" value="{{$row->className}}" disabled />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="expire" class="form-label">Branch</label>
                    <input class="form-control" type="text" id="expire" name="expire" value="{{$row->branchName}}" disabled />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="limit" class="form-label">Package Limit</label>
                    <input class="form-control" type="text" id="limit" name="limit" value="{{$row->package_limit}}" disabled />
                  </div>
                  
                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Package Image *</label>
                    <img  id="myImg" class="" src="{{ENV('APP_URL')}}/PackageImg/{{$row->image}}" data-bigger-src="{{ENV('APP_URL')}}/PackageImg/{{$row->image}}" disabled />
                    </div>
                    
                 
                  <div class="mb-3 col-md-12">
                    <label for="description" class="form-label">Description</label>
                   <textarea class="form-control" id="description" name="description" disabled>{{$row->description}}</textarea>
                  </div>


                  <div class="my-3 col-md-12" style="text-align: center">
                    {!! QrCode::size(150)->generate('https://gforce.techiespreview.website/attendance') !!}
                  </div>
              </div>
              @endforeach
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

