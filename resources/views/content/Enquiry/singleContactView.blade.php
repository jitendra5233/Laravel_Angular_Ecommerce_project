@extends('layouts/contentNavbarLayout')

@section('title', 'Contact  - Signle Contact  Details ')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

<link rel="stylesheet" href="{{asset('assets/richtexteditor/rte_theme_default.css')}}" />
<script type="text/javascript" src="{{asset('assets/richtexteditor/rte.js')}}"></script>
<script type="text/javascript" src='{{asset('assets/richtexteditor/plugins/all_plugins.js')}}'></script>
<script type="text/javascript" src='{{asset('assets/richtexteditor/rte-upload.js')}}'></script>
<style>
  .error{
    color:red;
  }
  #mydata
  {
    text-align:justify;
  }
  #myImg{
    height:100px;
    width:100px;
    margin-bottom:10px;
    float:right;
    margin-right:20px;
    margin-top:10px;

  }
</style>
@section('content')
<div class="row" style="align-items: center;">
  <div class="col-6">

    <h4 class="fw-bold py-3" style="margin:0">
      <span class="text-muted fw-light"> Contact-us </span> 
    </h4>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
    <div class="row">
    <div class="mb-3 col-md-6">
      <h5 class="card-header">Contact-us  Details</h5>
     </div>
      <hr class="my-0">
      <div class="card-body">
        
          <div class="row">
         
          <div class="mb-3 col-md-6">
              <label for="name" class="form-label">Name</label>
              <input class="form-control" type="text" id="name" name="name" value="{{$contact[0]->name}}"  readonly/>
            </div>

            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">email</label>
              <input class="form-control" type="text" name="email" id="email" value="{{$contact[0]->email}}" readonly/>
            </div>

            <div class="mb-3 col-md-6">
              <label for="phone" class="form-label">Phone</label>
              <input class="form-control" type="text" name="phone" id="phone" value="{{$contact[0]->phone}}" readonly/>
            </div>
            
            <div class="mb-3 col-md-6">
              <label for="created_at" class="form-label">contact Date/Time</label>
              <input class="form-control" type="text" name="created_at" id="created_at" value="{{$contact[0]->created_at}}" readonly/>
            </div>
            
            <div class="mb-3 col-md-12">
                    <label for="message" class="form-label">Message</label>
                    <textarea id="message" name="message" class="form-control" disabled>{{$contact[0]->message}}</textarea>
                  </div> 

         
        <!-- </form> -->

      </div>
      <!-- /Account -->
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

@endsection
