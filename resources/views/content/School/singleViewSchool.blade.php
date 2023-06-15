@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Edit School Video')

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
  #myImg{
    height:100px;
    width: 100px;
  }

    
</style>
<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">School Video Details</h5>
          <!-- Account -->
          <!-- <form action="{{ENV('APP_URL')}}/updateblog" method="post" enctype="multipart/form-data"  onsubmit="return handleSubmit()"> -->
            @csrf
          <div class="card-body">
              <div class="row">
              <input value="{{ENV('APP_URL')}}/media/images/" id="imgurl" type="hidden"/>
              <input type="hidden" name="Schoolid" id="Schoolid" value="{{$School->id}}" />
                  <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Video Title/(Name)</label>
                    <input class="form-control" type="text" id="title" name="title"  value="{{$School->title}}" disabled/>
                  </div>
                   <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Page Title</label>
                    <input class="form-control" type="text" id="page_title" name="page_title"  value="{{$School->page_title}}" disabled/>
                  </div>
                     <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Description</label>
                    <textarea id="page_description" name="page_description" class="form-control" disabled>{{$School->page_description}}</textarea>
                  </div>     
                  
                   <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Schema Json</label>
                    <textarea id="page_schema" name="page_schema" class="form-control" disabled>{{$School->page_schema}}</textarea>
                  </div>  
                  
                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Category</label>
                    <select id="category" name="category" class="select2 form-select"  aria-label="Default select example" disabled>
                      <option value="0">Select Category</option>
                      @foreach($schoolcat as $row)
                      <option value="{{$row->id}}" <?php echo $School->school_category == $row->id ? 'selected' : '' ?>>{{$row->name}}</option>
                      @endforeach
                    </select>
                  </div>

                    <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select"  aria-label="Default select example" disabled>
                      <option value="1" <?php echo $School->status=='1' ? 'selected' : '' ?>>Active</option>
                      <option value="0" <?php echo $School->status=='0' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="price" class="form-label">Price</label>
                    <input class="form-control" type="text" id="price" name="price"  value="{{$School->price}}" disabled/>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="trailer_video" class="form-label">Trailer Video</label>
                    <input class="form-control" type="text" id="trailer_video" name="trailer_video"  value="{{$School->trailer_video}}" disabled/>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="myImg" class="form-label">Thumbnail*</label>
                    <img  id="myImg" class="" src="{{ENV('APP_URL')}}/VideoImage/{{$School->image}}" data-bigger-src="{{ENV('APP_URL')}}/VideoImage/{{$School->image}}" disabled />
                    </div>


                  <div class="mb-3 col-md-12">
                    <label for="description" class="form-label">Description *</label>
                    <textarea id="description" name="description" class="form-control" disabled></textarea>
                    <input name="description" id="inp_htmlcode" type="hidden" value="{{$School->description}}"/>
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
$(document).ready(function() {
    let oldhtml = document.getElementById('inp_htmlcode').value
     var text=$(oldhtml).text();
     document.getElementById('description').innerHTML=text;
});

</script>

@endsection
