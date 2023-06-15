@extends('layouts/contentNavbarLayout')

@section('title','Dashboard - Edit Achievement')

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
          <h5 class="card-header">Update Achievement</h5>
          <!-- Account -->
          <!-- <form action="{{ENV('APP_URL')}}/addnewblog" method="post" enctype="multipart/form-data"  onsubmit="return handleSubmit()"> -->
            @csrf
          <div class="card-body">
              <div class="row">
              <input type="hidden" name="proid" id="proid" value="{{$getAchicvement->id}}" />

                 <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Title</label>
                    <input class="form-control" type="text" id="title" name="title"  value="{{$getAchicvement->title}}" />
                  </div>         
                  
                
                    <div class="mb-3 col-md-6">
                    <label for="image" class="form-label">Achievement Image *</label>
                    <input type="hidden" name="oldimage" id="oldimage" value="{{$getAchicvement->image}}"/>
                    <input type="file" class="form-control" name="image" id="image"/>
                    </div>

                    <div class="mb-3 col-md-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="inp_htmlcode">{{$getAchicvement->description}}</textarea>
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
    
//     var editor1 = new RichTextEditor(document.getElementById("div_editor1"));

// editor1.attachEvent("change", function () {
//     document.getElementById("inp_htmlcode").value = editor1.getHTMLCode();
// });

// $(document).ready(function() {
//     let oldhtml = document.getElementById('inp_htmlcode').value
//     editor1.insertHTML(oldhtml)
// });

    handleSubmit = () =>{

        let title = document.getElementById('title').value;
        let inp_htmlcode = document.getElementById("inp_htmlcode").value;
        var image =$('#image')[0].files;
        let oldimage =document.getElementById('oldimage').value;
        var proid =document.getElementById('proid').value;



    $(".error").remove();
      var spinner = $('.loader');
      spinner.show();
    if (title.length < 1) {
    $('#title').after('<span class="error">Title is required*</span>');
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
        data.append('proid',proid);
        data.append('title',title);
        data.append('description',inp_htmlcode);
        data.append('image',image[0]);
        data.append('oldimage',oldimage);
        axios.post('{{ENV("APP_URL")}}/updateAchievement',data).then((result) => {
        if(result.data == 1)
        {
        spinner.hide(); 
        Swal.fire(
            '',
            'Update Achievement Successfully',
            'success'
        )
        .then((result) => {
          window.location.href = '{{ENV("APP_URL")}}/achievement';
        });
        }


        }).catch((err) => {
        console.log(err)
        });
      }
 }
 
</script>
  
@endsection

