@extends('layouts/contentNavbarLayout')

@section('title', 'Runner - Show Runner')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>

@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection
<link rel="stylesheet" href="{{asset('assets/richtexteditor/rte_theme_default.css')}}" />
<script type="text/javascript" src="{{asset('assets/richtexteditor/rte.js')}}"></script>
<script type="text/javascript" src="{{asset(' assets/richtexteditor/plugins/all_plugins.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/richtexteditor/rte-upload.js')}}"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/5.0.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
          crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{asset('multidatepicker/multidatespickeredit.js')}}"></script>
    <link rel="stylesheet" href="{{asset('multidatepicker/styles.css')}}" />
@section('content')
<style>
  .error{
    color:red;
  }
   #ammIcon
  {
    font-family: fontAwesome;
    font-size: 12px;
    font-weight: 100;
  }
  #myImg{
    height:100px;
    width: 100px;
  }
</style>
@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Show Runner </span>
</h4>
<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      @foreach($tableData as $row)
        @csrf
      <div class="card-body">
          <div class="row">
            <div class="mb-3 col-md-12">
              <h5 class="card-header p-0 my-3">Show Runner</h5>
            </div>
            <input class="form-control" type="hidden" id="web_id" name="web_id"  value="{{$row->id}}" />
            
                    <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Page Title</label>
                    <input class="form-control" type="text" id="page_title" name="page_title"  value="{{$row->page_title}}" />
                    </div>
                    
                  <div class="mb-3 col-md-6">
                    <label for="page_description" class="form-label">Page Description</label>
                    <textarea id="page_description" name="page_description" class="form-control">{{$row->page_description}}</textarea>
                  </div>     
                  
                   <div class="mb-3 col-md-12">
                    <label for="page_schema" class="form-label">Page Schema Json</label>
                    <textarea id="page_schema" name="page_schema" class="form-control">{{$row->page_schema}}</textarea>
                  </div> 
                
                  <div class="mb-3 col-md-4">
                    <label for="banner_image" class="form-label">Banner Image *</label>
                    <input type="hidden" name="oldbannerimage" id="oldbannerimage" value="{{$row->banner_image}}"/>
                    <input type="file" class="form-control" name="banner_image" id="banner_image"/>
                    </div>

                    <div class="mb-3 col-md-4">
                    <label for="image" class="form-label">Image 1 *</label>
                    <input type="hidden" name="oldimage" id="oldimage" value="{{$row->image}}"/>
                    <input type="file" class="form-control" name="image" id="image"/>
                    </div>

                   <div class="mb-3 col-md-4">
                    <label for="image1" class="form-label">Image 2 *</label>
                    <input type="hidden" name="oldimage1" id="oldimage1" value="{{$row->image1}}"/>
                    <input type="file" class="form-control" name="image1" id="image1"/>
                    </div>

                    <div class="mb-3 col-md-4">
                    <label for="exampleFormControlSelect1" class="form-label">Banner Image *</label>
                    <img  id="myImg" class="" src="{{ENV('APP_URL')}}/TheForceImage/{{$row->banner_image}}" data-bigger-src="{{ENV('APP_URL')}}/TheForceImage/{{$row->banner_image}}" disabled />
                    </div>

                    <div class="mb-3 col-md-4">
                    <label for="exampleFormControlSelect1" class="form-label">Image1 *</label>
                    <img  id="myImg" class="" src="{{ENV('APP_URL')}}/TheForceImage/{{$row->image}}" data-bigger-src="{{ENV('APP_URL')}}/TheForceImage/{{$row->image}}" disabled />
                    </div>

                    <div class="mb-3 col-md-4">
                    <label for="exampleFormControlSelect1" class="form-label">Image 2 *</label>
                    <img  id="myImg" class="" src="{{ENV('APP_URL')}}/TheForceImage/{{$row->image1}}" data-bigger-src="{{ENV('APP_URL')}}/TheForceImage/{{$row->image1}}" disabled />
                    </div>

                    
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2" onclick="handleSubmit()">Save changes</button>
          </div>
        @endforeach
      </div>
      <!-- /Account -->
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>


handleSubmit = () =>
  {

        let page_title = document.getElementById('page_title').value;
        let page_description = document.getElementById('page_description').value;
        let web_id =document.getElementById('web_id').value;
        let page_schema = document.getElementById('page_schema').value;;
        let oldimage =document.getElementById('oldimage').value;
        let oldimage1 =document.getElementById('oldimage1').value;
        let oldbannerimage =document.getElementById('oldbannerimage').value;
        var image =$('#image')[0].files;
        var image1 =$('#image1')[0].files;
        var banner_image =$('#banner_image')[0].files;

            let data = new FormData;
            data.append('page_title',page_title);
            data.append('page_description',page_description);
            data.append('page_schema',page_schema);
            data.append('image',image[0]);
            data.append('oldimage',oldimage);
            data.append('image1',image1[0]);
            data.append('oldimage1',oldimage1);
            data.append('banner_image',banner_image[0]);
            data.append('oldbannerimage',oldbannerimage);
            data.append('web_id',web_id);
            axios.post('{{ENV("APP_URL")}}/updateRunner',data).then((result) => {
            if(result.data == 1)
            {
            Swal.fire(
                '',
                'Runner Page Update Successfully',
                'success'
            )
            .then((result) => {
              window.location.href = '{{ENV("APP_URL")}}/pages-show_runner';
            });
            }


            }).catch((err) => {
            console.log(err)
            });
  }
  
</script>

@endsection
