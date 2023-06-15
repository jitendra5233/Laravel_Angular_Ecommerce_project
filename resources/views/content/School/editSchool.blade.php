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
  .loader {
  display: none;
  School: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(0,0,0,0.75) url(images/loading2.gif) no-repeat center center;
  z-index: 10000;
}
.changebackroud {
background-color:#f06f38 !important;
}
}
    
</style>
<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">Update School Video</h5>
          <!-- Account -->
          <!-- <form action="{{ENV('APP_URL')}}/updateblog" method="post" enctype="multipart/form-data"  onsubmit="return handleSubmit()"> -->
            @csrf
          <div class="card-body">
              <div class="row">
              <input value="{{ENV('APP_URL')}}/media/images/" id="imgurl" type="hidden"/>
              <input type="hidden" name="Schoolid" id="Schoolid" value="{{$School->id}}" />
                  <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Video Title/(Name)</label>
                    <input class="form-control" type="text" id="title" name="title"  value="{{$School->title}}" />
                  </div>
                   <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Page Title</label>
                    <input class="form-control" type="text" id="page_title" name="page_title"  value="{{$School->page_title}}" />
                  </div>
                     <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Description</label>
                    <textarea id="page_description" name="page_description" class="form-control">{{$School->page_description}}</textarea>
                  </div>     
                  
                   <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Schema Json</label>
                    <textarea id="page_schema" name="page_schema" class="form-control">{{$School->page_schema}}</textarea>
                  </div>  
                  
                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Category</label>
                    <select id="category" name="category" class="select2 form-select"  aria-label="Default select example">
                      <option value="0">Select Category</option>
                      @foreach($schoolcat as $row)
                      <option value="{{$row->id}}" <?php echo $School->school_category == $row->id ? 'selected' : '' ?>>{{$row->name}}</option>
                      @endforeach
                    </select>
                  </div>

                    <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select"  aria-label="Default select example">
                      <option value="1" <?php echo $School->status=='1' ? 'selected' : '' ?>>Active</option>
                      <option value="0" <?php echo $School->status=='0' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="price" class="form-label">Price</label>
                    <input class="form-control" type="text" id="price" name="price"  value="{{$School->price}}" />
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
                    <label for="image" class="form-label">Thumbnail*</label>
                    <input type="hidden" name="oldimage" id="oldimage" value="{{$School->image}}"/>
                    <input type="file" class="form-control" name="image" id="image"/>
                    </div>

                    <div class="mb-3 col-md-6" id="video_url" style="display:none;">
                    <label for="video_urls" class="form-label">Trailer Video Url</label>
                    <input class="form-control" type="text" id="video_urls" placeholder="Enter Your Video url here.." name="video_urls" value="<?php echo $School->type =='video_link' ? $School->trailer_video : ""   ?>"/>
                  </div>
                    
                  <div class="mb-3 col-md-6" id="video_uloadedd" style="display:none;">
                    <label for="video_uloaded" class="form-label">Trailer Video Upload</label>
                    <input type="hidden" class="form-control" name="old_trailer_video" id="old_trailer_video" value="{{$School->trailer_video}}"/>
                    <input type="file" class="form-control" name="video_uloaded" id="video_uloaded" value=""/>
                  </div>

            <div class="mb-3 col-md-12">
            <label for="description" class="form-label">Description</label>
            <input name="description" id="inp_htmlcode" type="hidden" value="{{$School->description}}"  />
            <div id="div_editor1" class="richtexteditor"></div>
          </div>
                  
              </div>
          </div>
          <hr class="my-0">
          <div class="card-body">
              
            <div class="row">
                <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2 changebackroud" onclick="handleSubmit()">Save changes</button>
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

$(document).ready(function() {
    let oldhtml = document.getElementById('inp_htmlcode').value
    editor1.insertHTML(oldhtml)
});

function resetFile1() {
            const file =
                document.querySelector('#formFile1');
            file.value = '';
        }

        handleSubmit = () =>{

              let title = document.getElementById('title').value;
              var trailer_video =document.getElementById('trailer_video').value;
              let page_title = document.getElementById('page_title').value;
              let page_description = document.getElementById('page_description').value;
              let page_schema = document.getElementById('page_schema').value;
              let inp_htmlcode = document.getElementById("inp_htmlcode").value;
              let category_id = document.getElementById('category').value;
              let status = document.getElementById('status').value;
              var Schoolid =document.getElementById('Schoolid').value;
              var price =document.getElementById('price').value;
              var  old_trailer_video =document.getElementById('old_trailer_video').value;
              let video_urls =document.getElementById('video_urls').value;
              let oldimage =document.getElementById('oldimage').value;
              var image =$('#image')[0].files;
              var video_uloaded =$('#video_uloaded')[0].files;
              $(".error").remove();
              if (title.length < 1) {
              $('#title').after('<span class="error">Video Title is required*</span>');
              return false;
              }
             

              var selrole=$('#category');
              if(selrole.val() == 0)
              {
              $('#category').after('<span class="error"> Select a Valid Category</span>');
              return false;
              }

              if (price.length < 1) {
              $('#price').after('<span class="error">Price  is required*</span>');
              return false;
              }
               
              if (inp_htmlcode.length < 1) {
              $('#inp_htmlcode').after('<span class="error">Description is required*</span>');
              return false;
              }  
              else
              {
              let data = new FormData;
              data.append('title',title);
              data.append('Schoolid',Schoolid);
              data.append('category',category_id);
              data.append('price',price);
              data.append('page_title',page_title);
              data.append('page_description',page_description);
              data.append('description',inp_htmlcode);
              data.append('page_schema',page_schema);
              data.append('video_urls',video_urls);
              data.append('video_uloaded',video_uloaded[0]);
              data.append('old_trailer_video',old_trailer_video);
              data.append('type',trailer_video);
              data.append('image',image[0]);
              data.append('oldimage',oldimage);
              data.append('status',status);
              axios.post('{{ENV("APP_URL")}}/updateschoolVideo',data).then((result) => {
              if(result.data == 1)
              { 
              Swal.fire(
                  '',
                  'Video update Successfully',
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

</script>
  
@endsection
