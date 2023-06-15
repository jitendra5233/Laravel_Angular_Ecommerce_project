@extends('layouts/contentNavbarLayout')

@section('title','Dashboard - Add Products')

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
          <h5 class="card-header">New Product</h5>
          <!-- Account -->
          <!-- <form action="{{ENV('APP_URL')}}/addnewblog" method="post" enctype="multipart/form-data"  onsubmit="return handleSubmit()"> -->
            @csrf
          <div class="card-body">
              <div class="row">
                 <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" type="text" id="name" name="name"  value="" />
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
                    <label for="price" class="form-label">Price</label>
                    <input class="form-control" type="text" id="price" name="price"  value="" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="image" class="form-label">Product Image *</label>
                    <input type="file" class="form-control" name="image" id="image"/>
                    </div>


                    <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Status</label>
                    <select id="status" name="status" class="form-select"  aria-label="Default select example">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>
                 
                <div class="mb-3 col-md-12">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control"  name="description" id="description"></textarea>
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


    handleSubmit = () =>{

        let name = document.getElementById('name').value;
        let price = document.getElementById('price').value;
        let page_title = document.getElementById('page_title').value;
        let page_description = document.getElementById('page_description').value;
        let page_schema = document.getElementById('page_schema').value;
        let description = document.getElementById("description").value;
        let status = document.getElementById('status').value;
        var image =$('#image')[0].files;
    $(".error").remove();
      var spinner = $('.loader');
      spinner.show();
    if (name.length < 1) {
    $('#name').after('<span class="error">Name is required*</span>');
    spinner.hide();
    return false;
    }

    if (price.length < 1) {
    $('#price').after('<span class="error">Price is required*</span>');
    spinner.hide();
    return false;
    }

    if (image.length == 0) {
            $('#image').after('<span class="error">Image is required*</span>');
            spinner.hide();
            return false;
          }

    if (description.length < 1) {
      $('#description').after('<span class="error">Description is required*</span>');
      spinner.hide();
      return false;
    }  
      else
      {
        let data = new FormData;
        data.append('name',name);
        data.append('price',price);
        data.append('page_title',page_title);
        data.append('page_description',page_description);
        data.append('description',description);
        data.append('page_schema',page_schema);
        data.append('status',status);
        data.append('image',image[0]);
        axios.post('{{ENV("APP_URL")}}/addNewProduct',data).then((result) => {
        if(result.data == 1)
        {
        spinner.hide(); 
        Swal.fire(
            '',
            'Product Added Successfully',
            'success'
        )
        .then((result) => {
          window.location.href = '{{ENV("APP_URL")}}/getAllProduct';
        });
        }


        }).catch((err) => {
        console.log(err)
        });
      }
 }
 
</script>
  
@endsection

