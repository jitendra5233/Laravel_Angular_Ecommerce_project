@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<style>
    .form-check-input[type=checkbox] {
        border: 1px solid #00000061;
    }
    .error{
      color:red;
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
          <h5 class="card-header">Edit Package</h5>
          <div class="card-body">
            <!--<form action="{{ENV('APP_URL')}}/updatePackage" method="post" onsubmit="return handleSubmit()">-->
              <!--@csrf-->
              @foreach($package as $row)
              <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="packageName" class="form-label">Package Name</label>
                    <input class="form-control" type="text" id="packageName" name="packageName" value="{{$row->name}}" autofocus />
                    <input class="form-control" type="hidden" id="packageID" name="packageID" value="{{$row->id}}" autofocus />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="price" class="form-label">Price</label>
                    <input class="form-control" type="text" id="price" name="price" value="{{$row->price}}" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="credit" class="form-label">Credit</label>
                    <input class="form-control" type="text" id="credit" name="credit" value="{{$row->credit}}" autofocus />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="expire" class="form-label">Expire</label>
                    <input class="form-control" type="text" id="expire" name="expire" value="{{$row->expire}}" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="pro_class" class="form-label">Class</label>
                    <select  class="form-select" id='pro_class' name='pro_class'>
                        <option value="0">Select Class</option>
                      @foreach($allProjectClass as $projectclass)
                      <option value="{{$projectclass->id}}"  <?php echo $projectclass->id == $row->class_id ? 'selected' : null ?>>{{$projectclass->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="branch" class="form-label">Branch</label>
                    <select  class="form-select" id='branch' name='branch'>
                      @foreach($branch as $r)
                      <option value="{{$r->id}}" <?php echo $row->branch == $r->id ? 'selected' : null ?>>{{$r->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="image" class="form-label">Image</label>
                     <input class="form-control" type="hidden" id="oldimage" name="oldimage" value="{{$row->image}}" />
                    <input class="form-control" type="file" id="image" name="image" value="" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="limit" class="form-label">Package Limit</label>
                    <input class="form-control" type="text" id="limit" name="limit" value="{{$row->package_limit}}" />
                  </div>
                  <div class="mb-3 col-md-12">
                    <label for="description" class="form-label">Description</label>
                   <textarea class="form-control" id="description" name="description">{{$row->description}}</textarea>
                  </div>
                  <div class="mb-3 col-md-12">
                     <button type="submit" class="btn btn-primary me-2" onclick="handleSubmit()">Add Package</button>
                  </div>
              </div>
              @endforeach
            <!--</form>-->
          </div>
        </div>
      </div>
</div>
<div class="loader"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoyZ_yVsI5N8KhjbWRyQeme1Pfz2DRYYc&libraries=places&callback=initAutocomplete"></script>

<script>
    handleSubmit = () =>{
        let packageName = document.getElementById('packageName').value;
        let price = document.getElementById('price').value;
        let credit = document.getElementById('credit').value;
        let expire = document.getElementById('expire').value;
        let branch_id = document.getElementById('branch').value;
        var image = $('#image')[0].files;
        var oldimage =document.getElementById('oldimage').value;
        let description = document.getElementById('description').value;
        let limit = document.getElementById('limit').value;
        let packageID =document.getElementById('packageID').value;
        let class_id =document.getElementById('pro_class').value;

        
            $(".error").remove();
            
            if (packageName.length < 1) {
            $('#packageName').after('<span class="error">Package Name is required*</span>');
            return false;
            }
             if (price.length < 1) {
            $('#price').after('<span class="error">Price is required*</span>');
            return false;
            }
             if (credit.length < 1) {
            $('#credit').after('<span class="error">Credit is required*</span>');
            return false;
            }
             if (expire.length < 1) {
            $('#expire').after('<span class="error">Expire is required*</span>');
            return false;
            }

            var pro_class=$('#pro_class');
            if(pro_class.val() == 0)
            {
              $('#pro_class').after('<span class="error"> Select a Valid Class</span>');
              spinner.hide();
              return false;
            }
           
            var selrole=$('#branch');
            if(selrole.val() == 0)
            {
              $('#branch').after('<span class="error"> Select a Valid Branch</span>');
              return false;
            }
         
          if (limit.length < 1) {
            $('#limit').after('<span class="error">Package Limit is required*</span>');
            return false;
            }
        
            if (description.length < 1) {
              $('#description').after('<span class="error">Package Description is required*</span>');
              return false;
            }  
           else
                 {
                    let data = new FormData;
                    data.append('packageID',packageID);
                    data.append('packageName',packageName);
                    data.append('price',price);
                    data.append('credit',credit);
                    data.append('expire',expire);
                    data.append('class_id',class_id);
                    data.append('branch',branch_id);
                    data.append('limit',limit);
                    data.append('image',image[0]);
                    data.append('oldimage',oldimage);
                    data.append('description',description);
                    axios.post('{{ENV("APP_URL")}}/updatePackage',data).then((result) => {
                    if(result.data == 1)
                    {
                    Swal.fire(
                        '',
                        'Package Update Successfully',
                        'success'
                    )
                    .then((result) => {
                      window.location.href = '{{ENV("APP_URL")}}/allPackage';
                    });
                    }
                    }).catch((err) => {
                    console.log(err)
                    });
                }
    }
</script>

@endsection

