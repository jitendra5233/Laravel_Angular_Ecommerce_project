@extends('layouts/contentNavbarLayout')

@section('title','Dashboard - Add Job Position')

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
          <h5 class="card-header">New Job Position</h5>
          <!-- Account -->
          <!-- <form action="{{ENV('APP_URL')}}/addnewblog" method="post" enctype="multipart/form-data"  onsubmit="return handleSubmit()"> -->
            @csrf
          <div class="card-body">
              <div class="row">
                 <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Job Position Title/(Name)</label>
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
                    <label for="exampleFormControlSelect1" class="form-label">Job Position Category</label>
                    <select id="category" name="category" class="form-select"  aria-label="Default select example">
                      <option value="0">Select Job Position  Category</option>
                      @foreach($blogcat as $row)
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
                 

                  <div class="mb-3 col-md-12">
                    <label for="description" class="form-label">Job Description</label>
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
        let status = document.getElementById('status').value;
    $(".error").remove();
      var spinner = $('.loader');
      spinner.show();
    if (title.length < 1) {
    $('#title').after('<span class="error">Job Title is required*</span>');
    spinner.hide();
    return false;
    }
   
    var selrole=$('#category');
    if(selrole.val() == 0)
    {
      $('#category').after('<span class="error"> Select a Valid Job Category</span>');
      spinner.hide();
      return false;
    }

    if (inp_htmlcode.length < 1) {
      $('#inp_htmlcode').after('<span class="error">Blog Description is required*</span>');
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
        data.append('status',status);
        axios.post('{{ENV("APP_URL")}}/addnewjobposition',data).then((result) => {
        if(result.data == 1)
        {
        spinner.hide(); 
        Swal.fire(
            '',
            'Job Position Added Successfully',
            'success'
        )
        .then((result) => {
          window.location.href = '{{ENV("APP_URL")}}/jobposition-alljobposition';
        });
        }


        }).catch((err) => {
        console.log(err)
        });
      }
 }
 
</script>
  
@endsection

