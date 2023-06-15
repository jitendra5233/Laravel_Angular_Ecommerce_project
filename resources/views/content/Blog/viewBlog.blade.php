@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

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
#myImg{
    height:100px;
    width: 100px;
  }
    
</style>
<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">Update Blog</h5>
          <!-- Account -->
          <form action="{{ENV('APP_URL')}}/updateblog" method="post" enctype="multipart/form-data"  onsubmit="return handleSubmit()">
            @csrf
          <div class="card-body">
              <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Blog Title/(Name)</label>
                    <input class="form-control" type="text" id="title" name="title"  value="{{$blog->title}}" disabled/>
                  </div>
                   <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Page Title</label>
                    <input class="form-control" type="text" id="page_title" name="page_title"  value="{{$blog->page_title}}" disabled/>
                  </div>
                     <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Description</label>
                    <textarea id="page_description" name="page_description" class="form-control" disabled>{{$blog->page_description}}</textarea>
                  </div>     
                  
                   <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Schema Json</label>
                    <textarea id="page_schema" name="page_schema" class="form-control" disabled>{{$blog->page_schema}}</textarea>
                  </div>  
                  
                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Blog Category</label>
                    <select id="category" name="category" class="select2 form-select"  aria-label="Default select example" disabled>
                      <option value="0">Select Blog  Category</option>
                      @foreach($blogcat as $row)
                      <option value="{{$row->id}}" <?php echo $blog->categoryId == $row->id ? 'selected' : '' ?>>{{$row->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Post Date/Time</label>
                    <input class="form-control" type="text" id="title" name="title"  value="{{$blog->created_at}}" disabled/>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select"  aria-label="Default select example" disabled>
                      <option value="1" <?php echo $blog->status=='1' ? 'selected' : '' ?>>Active</option>
                      <option value="0" <?php echo $blog->status=='0' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                  </div>
                  
                    <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Blog Image *</label>
                    <img  id="myImg" class="" src="{{ENV('APP_URL')}}/BlogImg/{{$blog->image}}" data-bigger-src="{{ENV('APP_URL')}}/BlogImg/{{$blog->image}}" disabled />
                    </div>

                    

                  <div class="mb-3 col-md-12">
                    <label for="description" class="form-label"> Blog Description *</label>
                    <textarea id="description" name="description" class="form-control" disabled></textarea>
                    <input name="description" id="inp_htmlcode" type="hidden" value="{{$blog->postContent}}"/>
                    </div>

           
                  
              </div>
          </div>
         
        
        <!-- /Notifications -->
      </div>
  </div>
 </form> 
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
