@extends('layouts/contentNavbarLayout')

@section('title','Dashboard -Achievement Details')

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
          <h5 class="card-header">View Achievement</h5>
          <!-- Account -->
          <!-- <form action="{{ENV('APP_URL')}}/addnewblog" method="post" enctype="multipart/form-data"  onsubmit="return handleSubmit()"> -->
            @csrf
          <div class="card-body">
              <div class="row">
              <!-- <input type="hidden" name="proid" id="proid" value="{{$getAchicvement->id}}" /> -->

                 <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Title</label>
                    <input class="form-control" type="text" id="title" name="title"  value="{{$getAchicvement->title}}" disabled/>
                  </div>         
                  
            

                    <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Achievement Image *</label>
                    <img  id="myImg" class="" src="{{ENV('APP_URL')}}/AchievementImage/{{$getAchicvement->image}}" data-bigger-src="{{ENV('APP_URL')}}/AchievementImage/{{$getAchicvement->image}}" disabled />
                    </div>
            
                    <div class="mb-3 col-md-12">
                    <label for="description" class="form-label">Description *</label>
                    <textarea id="description" name="description" class="form-control" disabled> {{$getAchicvement->description}}</textarea>
                  </div>
                </div>
                  
              </div>
          </div>
          <hr class="my-0">
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

 <!-- </form>  -->

  <!-- /Account -->
        </div>
      </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
    
//     $(document).ready(function() {
//     let oldhtml = document.getElementById('inp_htmlcode').value
//      var text=$(oldhtml).text();
//      document.getElementById('description').innerHTML=text;
// });


   
 
</script>
  
@endsection

