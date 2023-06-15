@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Add Class Project')

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
<script type="text/javascript" src="{{asset('assets/richtexteditor/plugins/all_plugins.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/richtexteditor/rte-upload.js')}}"></script>
@section('content')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoyZ_yVsI5N8KhjbWRyQeme1Pfz2DRYYc&libraries=places&callback=initAutocomplete"></script>
<style>
    .form-check-input[type=checkbox] {
        border: 1px solid #00000061;
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
          <h5 class="card-header">New Class</h5>
          <!-- Account -->
         <!-- {{-- <form action="{{ENV('APP_URL')}}/submit-ProjectClass" method="post" onsubmit="return checkvalidate()" enctype='multipart/form-data'> --}} -->
          <div class="card-body">
              <div class="row">
              <input value="{{ENV('APP_URL')}}/media/images/" id="imgurl" type="hidden"/>
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Class Name *</label>
                    <input class="form-control" type="text" id="name" name="name" value="" />
                  </div>
                   <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Page Title *</label>
                    <input class="form-control" type="text" id="page_title" name="page_title"  value="" />
                  </div>
                     <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Description *</label>
                    <textarea id="page_description" name="page_description" class="form-control"></textarea>
                  </div>     
                  
                   <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Schema Json *</label>
                    <textarea id="page_schema" name="page_schema" class="form-control"></textarea>
                  </div>  
                 
                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Branch Name *</label>
                    <select id="branchname" name="branchname" class="form-select"  aria-label="Default select example" onchange="getTrainer(this.value)">
                      <option value="0">Select Branch</option>
                      @foreach($tableData as $r)
                      <option value="{{$r->id}}">{{$r->name}}</option>
                      @endforeach
                    </select>
                    </select>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Batch Name *</label>
                    <select id="bacthname" name="bacthname" class="form-select"  aria-label="Default select example">
                      <option value="0">Select Batch</option>
                      <option value="1">Batch 1</option>
                      <option value="2">Batch 2</option>
                      <option value="3">Batch 3</option>
                      <option value="4">Batch 4</option>
                      <option value="5">Batch 5</option>
                      <option value="6">Batch 6</option>
                    </select>
                  </div>

                    <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Trainer Name*</label>
                    <select id="trainer_id" name="trainer_id" class="select2 form-select">
                    <option value="0">Select Trainer</option>
                    </select>
                    </div>


                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Status *</label>
                    <select id="status" name="status" class="form-select"  aria-label="Default select example">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="starttime" class="form-label">Start Time *</label>
                    <input class="form-control" type="time" id="starttime" name="starttime" value="" />
                  </div>

                  
                  <div class="mb-3 col-md-6">
                    <label for="endtime" class="form-label">End Time *</label>
                    <input class="form-control" type="time" id="endtime" name="endtime" value="" />
                  </div>


                  <div class="mb-3 col-md-6">
                    <label for="regularrate" class="form-label">Regular Rate *</label>
                    <input class="form-control" type="text" id="regularrate" name="regularrate" value="" />
                  </div>

                  
                  <div class="mb-3 col-md-6">
                    <label for="advancepayment" class="form-label">Advance Payment *</label>
                    <input class="form-control" type="text" id="advancepayment" name="advancepayment" value="" />
                  </div>

                  
                  <div class="mb-3 col-md-6">
                    <label for="gtreat" class="form-label">G-Treat *</label>
                    <input class="form-control" type="text" id="gtreat" name="gtreat" value="" />
                  </div>

                   
                  <div class="mb-3 col-md-6">
                    <label for="slots" class="form-label">Slots *</label>
                    <input class="form-control" type="text" id="slots" name="slots" value="" />
                  </div>

                    <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Class Thumbnail *</label>
                    <input type="hidden" name="oldimgArr" id="oldimgArr"/>
                    <input type="file" class="form-control" name="imgArr" id="imgArr"/>
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
                <button type="submit" class="btn btn-primary me-2"  onclick="checkvalidate()">Save changes</button>
                </div>
            </div>
        </div>
        <!-- /Notifications -->
      </div>
  </div>
<!-- </form> -->
  <!-- /Account -->
    </div>
  </div>
</div>
        </div>
      </div>
</div>
<div class="loader"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
    var editor1 = new RichTextEditor(document.getElementById("div_editor1"));

    editor1.attachEvent("change", function () {
      document.getElementById("inp_htmlcode").value = editor1.getHTMLCode();
    });


    checkvalidate = () =>{
      var spinner = $('.loader');
       spinner.show();
    
            let name = document.getElementById('name').value;
            let page_title = document.getElementById('page_title').value;
            let page_description = document.getElementById('page_description').value;
            let page_schema = document.getElementById('page_schema').value;
            let inp_htmlcode = document.getElementById("inp_htmlcode").value;
            let starttime = document.getElementById("starttime").value;
            let endtime = document.getElementById("endtime").value;
            let regularrate = document.getElementById("regularrate").value;
            let advancepayment = document.getElementById("advancepayment").value;
            let gtreat = document.getElementById("gtreat").value;
            let slots = document.getElementById("slots").value;
            let branch_id = document.getElementById('branchname').value;
            let batch_id = document.getElementById('bacthname').value;
            let trainername = document.getElementById('trainer_id').value;
            let status = document.getElementById('status').value;

          $(".error").remove();

          if(name.length < 1) {
          $('#name').after('<span class="error">This field is required*</span>');
          spinner.hide();
          return false;
          }

          var branchname=$('#branchname');
           if(branchname.val() == 0)
          {
            $('#branchname').after('<span class="error"> Select a Valid Branch Name*</span>');
            spinner.hide();
            return false;
          }
           var bacthname=$('#bacthname');
          if(bacthname.val() == 0)
          {
            $('#bacthname').after('<span class="error"> Select a Valid Batch Name*</span>');
            spinner.hide();
            return false;
          }

          var trainer_id=$('#trainer_id');
          if(trainer_id.val() == 0)
          {
            $('#trainer_id').after('<span class="error"> Select a Valid Trainer Name*</span>');
            spinner.hide();
            return false;
          }
        
          if(starttime == '') {
          $('#starttime').after('<span class="error"> Start Time  is Required*</span>');
          spinner.hide();
          return false;
          }

          if(endtime == '') {
          $('#endtime').after('<span class="error"> End Time  is Required*</span>');
          spinner.hide();
          return false;
          }

          if(regularrate.length < 1) {
          $('#regularrate').after('<span class="error">Regular Rate is required*</span>');
          spinner.hide();
          return false;
          }

          if(advancepayment.length < 1) {
          $('#advancepayment').after('<span class="error">Advance Payment is required*</span>');
          spinner.hide();
          return false;
          }

          if(gtreat.length < 1) {
          $('#gtreat').after('<span class="error">G Treat is required*</span>');
          spinner.hide();
          return false;
          }

          if(slots.length < 1) {
          $('#slots').after('<span class="error">Slots is required*</span>');
          spinner.hide();
          return false;
          }
          var imgArr = $('#imgArr')[0].files;
          if (imgArr.length == 0) {
            $('#imgArr').after('<span class="error"> Image is required*</span>');
            spinner.hide();
            return false;
          }


          if (inp_htmlcode.length < 1) {
            $('#inp_htmlcode').after('<span class="error">Description is required*</span>');
            spinner.hide();
            return false;
          }

          else{

                    let data = new FormData;
                    data.append('name',name);
                    data.append('page_title',page_title);
                    data.append('page_description',page_description);
                    data.append('page_schema',page_schema);
                    data.append('branchname',branch_id);
                    data.append('bacthname',batch_id);
                    data.append('trainer_id',trainername);
                    data.append('starttime',starttime);
                    data.append('endtime',endtime);
                    data.append('regularrate',regularrate);
                    data.append('advancepayment',advancepayment);
                    data.append('gtreat',gtreat);
                    data.append('slots',slots);
                    data.append('imgArr',imgArr[0]);
                    data.append('description',inp_htmlcode);
                    data.append('status',status);
                    axios.post('{{ENV("APP_URL")}}/submit-ProjectClass',data).then((result) => {
                    if(result.data == 1)
                    {
                    spinner.hide(); 
                    Swal.fire(
                        '',
                        'Project Class Added Successfully',
                        'success'
                    )
                    .then((result) => {
                      window.location.href = '{{ENV("APP_URL")}}/projectClassAll';
                    });
                    }


                    }).catch((err) => {
                    console.log(err)
                    });
             }


       }

        getTrainer = (id) =>{
        let userElement = document.getElementById('trainer_id')
        let data =  new FormData;
        data.append('branch_id',id);
        axios.post('{{ENV("APP_URL")}}/gettrainerbybranchid',data).then((result) => {

        var i, L = userElement.options.length - 1;

        for(i = L; i >= 0; i--) {

        userElement.remove(i);

        }

        var doption = document.createElement("option");

        doption.text = 'Select Trainer';

        doption.value = 0;

        userElement.appendChild(doption);

        result.data.map(x => {

        var option = document.createElement("option");

        option.text = x.name;

        option.value = x.id;

        userElement.appendChild(option);


        })

        }).catch((err) => {

        console.log(err)

        }); 

        }

</script>
<script>
  function init() {
    var input = document.getElementById("location");
    var autocomplete = new google.maps.places.Autocomplete(input);
  }

  google.maps.event.addDomListener(window, "load", init);
</script>

@endsection

