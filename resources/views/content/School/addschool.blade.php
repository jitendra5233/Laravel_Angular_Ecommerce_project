@extends('layouts/contentNavbarLayout')

@section('title','Dashboard - Add School Video')

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
          <h5 class="card-header">New School Video</h5>
          <!-- Account -->
          <!-- <form action="{{ENV('APP_URL')}}/addnewblog" method="post" enctype="multipart/form-data"  onsubmit="return handleSubmit()"> -->
            @csrf
          <div class="card-body">
              <div class="row">
                 <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Video Title/(Name)</label>
                    <input class="form-control" type="text" id="title" name="title"  value="" />
                  </div>
                  
                  <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Page Title</label>
                    <input class="form-control" type="text" id="page_title" name="page_title"  value="" />
                  </div>
                     <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Description</label>
                    <textarea id="page_description" name="page_description" class="form-control"></textarea>
                  </div>     
                  
                   <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Schema Json</label>
                    <textarea id="page_schema" name="page_schema" class="form-control"></textarea>
                  </div>  
                  
                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Category</label>
                    <select id="category" name="category" class="form-select"  aria-label="Default select example">
                      <option value="0">Select Category</option>
                      @foreach($schoolcat as $row)
                      <option value="{{$row->id}}">{{$row->name}}</option>
                      @endforeach
                    </select>
                  </div>

                    <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select"  aria-label="Default select example">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="price" class="form-label">Price</label>
                    <input class="form-control" type="text" id="price" name="price"  value="" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Trailer Video Type*</label>
                    <select id="trailer_video" name="trailer_video" class="form-select"  aria-label="Default select example" onchange="VideoType(this.value)">
                      <option value="0">Select Video Type</option>
                      <option value="video_link">Video Link</option>
                      <option value="Upload_video">Video Upload</option>
                    </select>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="image" class="form-label">Thumbnail *</label>
                    <input type="file" class="form-control" name="image" id="image"/>
                    </div>

                    <div class="mb-3 col-md-6" id="video_url" style="display:none;">
                    <label for="video_urls" class="form-label">Trailer Video Url</label>
                    <input class="form-control" type="text" id="video_urls" placeholder="Enter Your Video url here.." name="video_urls"  value="" />
                  </div>
                    
                  <div class="mb-3 col-md-6" id="video_uloadedd" style="display:none;">
                    <label for="video_uloaded" class="form-label">Trailer Video Upload</label>
                    <input type="file" class="form-control" name="video_uloaded" id="video_uloaded"/>
                  </div>

                  <div class="mb-3 col-md-12">
                    <label for="description" class="form-label">Description</label>
                    <input name="htmlcode" id="inp_htmlcode" type="hidden"/>
                    <div id="div_editor1" name='description' class="richtexteditor"></div>
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
    
var editor1 = new RichTextEditor(document.getElementById("div_editor1"));
editor1.attachEvent("change", function () {
  document.getElementById("inp_htmlcode").value = editor1.getHTMLCode();
});

    handleSubmit = () =>{

        let title = document.getElementById('title').value;
        let page_title = document.getElementById('page_title').value;
        let page_description = document.getElementById('page_description').value;
        let page_schema = document.getElementById('page_schema').value;
        let inp_htmlcode = document.getElementById("inp_htmlcode").value;
        let category_id = document.getElementById('category').value;
        let price =document.getElementById('price').value;
        let video_urls =document.getElementById('video_urls').value;
        let status = document.getElementById('status').value;
        var video_uloaded = $('#video_uloaded')[0].files;
        var trailer_video =document.getElementById('trailer_video').value;

    $(".error").remove();
      var spinner = $('.loader');
      spinner.show();
    if (title.length < 1) {
    $('#title').after('<span class="error">Video Title is required*</span>');
    spinner.hide();
    return false;
    }

    var selrole=$('#category');
    if(selrole.val() == 0)
    {
      $('#category').after('<span class="error"> Select a Valid  Category</span>');
      spinner.hide();
      return false;
    }
    if(price.length < 1)
    {
        $('#price').after('<span class="error"> Price is Required*</span>');
        spinner.hide();
      return false;
    }


      var image = $('#image')[0].files;
      if (image.length == 0) {
      $('#image').after('<span class="error">Trainer image is required*</span>');
      spinner.hide();
      return false;
      }


    if (inp_htmlcode.length < 1) {
      $('#inp_htmlcode').after('<span class="error">Description is required*</span>');
      spinner.hide();
      return false;
    }  
      else
      {
        let data = new FormData;
        data.append('title',title);
        data.append('category',category_id);
        data.append('page_title',page_title);
        data.append('page_description',page_description);
        data.append('description',inp_htmlcode);
        data.append('page_schema',page_schema);
        data.append('type',trailer_video);
        data.append('price',price);
        data.append('video_urls',video_urls);
        data.append('image',image[0]);
        data.append('video_uloaded',video_uloaded[0]);
        data.append('status',status);
        axios.post('{{ENV("APP_URL")}}/addnewSchool',data).then((result) => {
        if(result.data == 1)
        {
        spinner.hide(); 
        Swal.fire(
            '',
            'Video Added Successfully',
            'success'
        )
        .then((result) => {
          window.location.href = '{{ENV("APP_URL")}}/school';
        });
        }


        }).catch((err) => {
        console.log(err)
        });
      }
 }
 

 VideoType = (a)=>{
 if(a == 'Upload_video'){
  document.getElementById('video_url').style.display="none";
  document.getElementById('video_uloadedd').style.display="block";
 }
 if(a == 'video_link'){
  document.getElementById('video_url').style.display="block";
  document.getElementById('video_uloadedd').style.display="none";
 }
 if(a == 0){
  document.getElementById('video_url').style.display="none";
  document.getElementById('video_uloadedd').style.display="none";
 }
 }
</script>
  
@endsection

