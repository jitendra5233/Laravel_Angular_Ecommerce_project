@extends('layouts/contentNavbarLayout')



@section('title', 'Property - Property Details ')



@section('page-script')

<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>

@endsection



@section('page-style')

<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />

@endsection



<link rel="stylesheet" href="{{asset('assets/richtexteditor/rte_theme_default.css')}}" />

<script type="text/javascript" src="{{asset('assets/richtexteditor/rte.js')}}"></script>

<script type="text/javascript" src='{{asset('assets/richtexteditor/plugins/all_plugins.js')}}'></script>

<script type="text/javascript" src='{{asset('assets/richtexteditor/rte-upload.js')}}'></script>

<style>

  .error{

    color:red;

  }

  #mydata

  {

    text-align:justify;

  }

</style>

@section('content')

<div class="row" style="align-items: center;">

  <div class="col-6">



    <h4 class="fw-bold py-3" style="margin:0">

      <span class="text-muted fw-light">Property /</span> {{$property->name}}

    </h4>

  </div>

  <div class="col-6" style="text-align:end">
  @if(session('role') == 'Admin')
    <div class="py-3">
      <a type="button" class="btn btn-primary" href="{{ url('propertyEdit') }}/{{$property->id}}}">
        Edit Property
      </a>
    </div>
@endif
  </div>

</div>

<div class="row">

  <div class="col-md-12">

    <div class="card mb-4">

      <h5 class="card-header">Property Details</h5>

      <!-- Account -->

      <!-- <form id="formAccountSettings" action="{{ENV('APP_URL')}}/updateprofile" method="post"   onsubmit="return checkvalidate()" enctype="multipart/form-data"> -->

      <hr class="my-0">

      <div class="card-body">

          <div class="row">

            <div class="mb-3 col-md-6">

              <label for="first_name" class="form-label">First Name</label>

              <input class="form-control" type="text" id="first_name" name="first_name" value="{{$property->name}}"  readonly/>

            </div>

            <div class="mb-3 col-md-6">

              <label for="last_name" class="form-label">Agent Name</label>

              <input class="form-control" type="text" name="last_name" id="last_name" value="{{$agents->first_name}}" readonly/>

            </div>

            <div class="mb-3 col-md-6">

              <label for="email" class="form-label">Project Name</label>

              <input class="form-control" type="text" id="email" name="email" value="{{$project->name}}" readonly />

            </div>

            <div class="mb-3 col-md-6">

              <label class="form-label" for="phoneNumber">Subproject Name</label>

                <input type="text" id="phone" name="phone" value="{{$subproject->name}}" class="form-control" readonly/>

            </div>

            <div class="mb-3 col-md-6">

              <label for="first_name" class="form-label">Property Types </label>

              <input class="form-control" type="text" id="first_name" name="first_name" value="{{$propertyTypes->name}}"  readonly />

            </div>

            <div class="mb-3 col-md-6">

              <label for="last_name" class="form-label">Property status</label>

              <input class="form-control" type="text" name="last_name" id="last_name" value="{{$properystatus->name}}" readonly />

            </div>

            <div class="mb-3 col-md-6">

              <label for="email" class="form-label">Address</label>

              <input class="form-control" type="text" id="email" name="email" value="{{$property->address}}"  readonly/>

            </div>

            <div class="mb-3 col-md-6">

              <label class="form-label" for="phoneNumber">Zip Code</label>

              <div class="input-group input-group-merge">

                <input type="text" id="phone" name="phone" value="{{$property->city}}" class="form-control" readonly/>

              </div>

            </div>

            <div class="mb-3 col-md-6">

              <label class="form-label" for="phoneNumber">State</label>

              <div class="input-group input-group-merge">

                <input type="text" id="phone" name="phone" value="{{$property->state}}" class="form-control" readonly />

              </div>

            </div>

            <div class="mb-3 col-md-6">

              <label class="form-label" for="phoneNumber">Country</label>

              <div class="input-group input-group-merge">

                <input type="text" id="phone" name="phone" value="{{$property->country}}" class="form-control" readonly/>

              </div>

            </div>

            <div class="mb-3 col-md-6">

              <label class="form-label" for="phoneNumber">Purpose</label>

              <div class="input-group input-group-merge">

                <input type="text" id="phone" name="phone" value="{{$property->purpose}}" class="form-control" readonly/>

              </div>

            </div>

            <div class="mb-3 col-md-6">

              <label class="form-label" for="phoneNumber">Price</label>

              <div class="input-group input-group-merge">

                <input type="text" id="phone" name="phone" value="{{$property->price}}" class="form-control" readonly/>

              </div>

            </div>

            <div class="mb-3 col-md-6">

              <label class="form-label" for="phoneNumber">Size</label>

              <div class="input-group input-group-merge">

                <input type="text" id="phone" name="phone" value="{{$property->sizeSqFt}}" class="form-control" readonly/>

              </div>

            </div>

            <div class="mb-3 col-md-6">

              <label class="form-label" for="phoneNumber">Bedroom</label>

              <div class="input-group input-group-merge">

                <input type="text" id="phone" name="phone" value="{{$property->bedroom}}" class="form-control" readonly/>

              </div>

            </div>

            <div class="mb-3 col-md-6">

              <label class="form-label" for="phoneNumber">Bathroom</label>

              <div class="input-group input-group-merge">

                <input type="text" id="phone" name="phone" value="{{$property->bathroom}}" class="form-control" readonly/>

              </div>

            </div>

            <div class="mb-3 col-md-12">

            <label for="description" class="form-label" style="font-size:15px;">Description</label>

            <input name="description" id="inp_htmlcode" type="hidden" value="{{$property->description}}" />

            <div id="mydata"></div>

          

          </div>

          </div>

        <!-- </form> -->



      </div>

      <!-- /Account -->

    </div>

  </div>

</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="stylesheet" href="sweetalert2.min.css">

<script>

$(document).ready(function() {    

  let inp_htmlcode=document.getElementById('inp_htmlcode').value;

    $("#mydata").html(inp_htmlcode);

});

// $(document).ready(function() {

//     var mydata = new RichTextEditor(document.getElementById("mydata"));

//     mydata.attachEvent("change", function () {

//     document.getElementById("inp_htmlcode").value = mydata.getHTMLCode();

//   });

//     let oldhtml = document.getElementById('inp_htmlcode').value;

//     mydata.insertHTML(oldhtml)

 

// });





</script>



@endsection

