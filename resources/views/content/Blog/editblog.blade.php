@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Edit Blog')

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
<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">Update Blog</h5>
          <!-- Account -->
          <!-- <form action="{{ENV('APP_URL')}}/updateblog" method="post" enctype="multipart/form-data"  onsubmit="return handleSubmit()"> -->
            @csrf
          <div class="card-body">
              <div class="row">
              <input value="{{ENV('APP_URL')}}/media/images/" id="imgurl" type="hidden"/>
              <input type="hidden" name="blogid" id="blogid" value="{{$blog->id}}" />
                  <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Blog Title/(Name)</label>
                    <input class="form-control" type="text" id="title" name="title"  value="{{$blog->title}}" />
                  </div>
                   <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Page Title</label>
                    <input class="form-control" type="text" id="page_title" name="page_title"  value="{{$blog->page_title}}" />
                  </div>
                     <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Description</label>
                    <textarea id="page_description" name="page_description" class="form-control">{{$blog->page_description}}</textarea>
                  </div>     
                  
                   <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Schema Json</label>
                    <textarea id="page_schema" name="page_schema" class="form-control">{{$blog->page_schema}}</textarea>
                  </div>  
                  
                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Blog Category</label>
                    <select id="category" name="category" class="select2 form-select"  aria-label="Default select example">
                      <option value="0">Select Blog  Category</option>
                      @foreach($blogcat as $row)
                      <option value="{{$row->id}}" <?php echo $blog->categoryId == $row->id ? 'selected' : '' ?>>{{$row->name}}</option>
                      @endforeach
                    </select>
                  </div>

                 
                 
                  <div class="mb-3 col-md-6">
                    <label for="blogimg" class="form-label">Blog Image *</label>
                    <input name="oldblogimg" id="oldblogimg" type="hidden" value="{{$blog->image}}"  />
                    <input type="file"  class="form-control" name="blogimg" id="blogimg"/>
                    </div>

                    <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select"  aria-label="Default select example">
                      <option value="1" <?php echo $blog->status=='1' ? 'selected' : '' ?>>Active</option>
                      <option value="0" <?php echo $blog->status=='0' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                  </div>

            <div class="mb-3 col-md-12">
            <label for="description" class="form-label">Blog Description</label>
            <input name="description" id="inp_htmlcode" type="hidden" value="{{$blog->postContent}}"  />
            <div id="div_editor1" class="richtexteditor"></div>
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
              let page_title = document.getElementById('page_title').value;
              let page_description = document.getElementById('page_description').value;
              let page_schema = document.getElementById('page_schema').value;
              let inp_htmlcode = document.getElementById("inp_htmlcode").value;
              let category_id = document.getElementById('category').value;
              let status = document.getElementById('status').value;
              let oldblogimg = document.getElementById('oldblogimg').value;
              var blogid =document.getElementById('blogid').value;

              $(".error").remove();
              if (title.length < 1) {
              $('#title').after('<span class="error">Blog Title is required*</span>');
              return false;
              }
              var selrole=$('#category');
              if(selrole.val() == 0)
              {
              $('#category').after('<span class="error"> Select a Valid Category</span>');
              return false;
              }

              var blogimg = $('#blogimg')[0].files;
                // if (blogimg.length == 0) {
                //   $('#blogimg').after('<span class="error">Package Thumbnail is required*</span>');
  
                //   return false;
                // }
              if (inp_htmlcode.length < 1) {
              $('#inp_htmlcode').after('<span class="error">Blog Description is required*</span>');
              return false;
              }  
              else
              {
              let data = new FormData;
              data.append('title',title);
              data.append('blogid',blogid);
              data.append('category',category_id);
              data.append('page_title',page_title);
              data.append('page_description',page_description);
              data.append('description',inp_htmlcode);
              data.append('page_schema',page_schema);
              data.append('blogimg',blogimg[0]);
              data.append('oldblogimg',oldblogimg);
              data.append('status',status);
              axios.post('{{ENV("APP_URL")}}/updateblog',data).then((result) => {
              if(result.data == 1)
              { 
              Swal.fire(
                  '',
                  'Blog update Successfully',
                  'success'
              )
              .then((result) => {
                window.location.href = '{{ENV("APP_URL")}}/blog-allblogs';
              });
              }


              }).catch((err) => {
              console.log(err)
              });
              }
}

</script>
  
@endsection
