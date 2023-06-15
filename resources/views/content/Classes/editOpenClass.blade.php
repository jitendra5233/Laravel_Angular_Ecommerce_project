

@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Edit Open Class')

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
<script type="text/javascript" src="{{asset(' assets/richtexteditor/plugins/all_plugins.js')}}"></script>
<script type="text/javascript" src="{{asset(' assets/richtexteditor/rte-upload.js')}}"></script>
@section('content')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoyZ_yVsI5N8KhjbWRyQeme1Pfz2DRYYc&libraries=places&callback=initAutocomplete"></script>
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
   
</style>
<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">Edit Open Class</h5>
          <!-- Account -->
          <!-- {{--<form action="{{ENV('APP_URL')}}/updateClassProject" method="post" onsubmit="return checkvalidate()" enctype='multipart/form-data'> --}}
            @csrf -->
          <div class="card-body">
              <div class="row">
              <input type="hidden" name="proid" id="proid" value="{{$openClass->id}}" />
              <div class="mb-3 col-md-6">
                    <label for="classname" class="form-label">Class Name *</label>
                    <input class="form-control" type="text" id="classname" name="classname" value="{{$openClass->classname}}" />
                  </div>
                   <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Page Title *</label>
                    <input class="form-control" type="text" id="page_title" name="page_title"  value="{{$openClass->page_title}}" />
                  </div>
                     <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Description *</label>
                    <textarea id="page_description" name="page_description" class="form-control">{{$openClass->page_description}}</textarea>
                  </div>     
                  
                   <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Schema Json *</label>
                    <textarea id="page_schema" name="page_schema" class="form-control">{{$openClass->page_schema}}</textarea>
                  </div>  
                  
                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Branch Name *</label>
                    <select id="branchname" name="branchname" class="form-select"  aria-label="Default select example"  onchange="getTrainer(this.value)">
                      <option value="0" selected="">Select Branch</option>
                      @foreach($branch as $r)
                      <option value="{{$r->id}}" <?php echo $openClass->branchname == $r->id ? 'selected' : null ?>>{{$r->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Trainer Name *</label>
                    <select id="trainer_id" name="trainer_id" class="form-select"  aria-label="Default select example">
                      <option value="0" selected="">Select Tainer</option>
                      @foreach($trainer as $trainer)
                      <option value="{{$trainer->id}}" <?php echo $openClass->trainer_id == $trainer->id ? 'selected' : null ?>>{{$trainer->name}}</option>
                      @endforeach
                    </select>
                  </div>

                 
                  <div class="mb-3 col-md-6">
                    <label for="scheduledate" class="form-label">Schedule Date *</label>
                    <input class="form-control" type="Date" id="scheduledate" name="scheduledate" value="{{date('Y-m-d', strtotime($openClass->scheduledate))}}"  />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="scheduletime" class="form-label">Schedule Time *</label>
                    <input class="form-control" type="time" id="scheduletime" name="scheduletime" value="{{$openClass->scheduletime}}" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Status *</label>
                    <select id="status" name="status" class="form-select"  aria-label="Default select example">
                      <option value="1" <?php echo $openClass->status=='1' ? 'selected' : '' ?>>Active</option>
                      <option value="0" <?php echo $openClass->status=='0' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="regularrate" class="form-label">Regular Rate *</label>
                    <input class="form-control" type="text" id="regularrate" name="regularrate" value="{{$openClass->regularrate}}" />
                  </div>


                  <div class="mb-3 col-md-6">
                    <div class="custom-control custom-switch mb-3">
                    <input type="checkbox" class="custom-control-input" id="f2f_switch" <?php echo $openClass->facetofaceslot !='' ? 'Checked' :'' ?> onchange="togglefacetofaceslot(this)">
                    <label class="custom-control-label" for="f2f_switch">Face to Face</label>
                    </div>
                    <div class="form-group mb-4" id="slots" name="slots">
                        <label class="mr-sm-2" for="facetofaceslot">Face to Face Slots #</label>
                        <input type="number" class="form-control" id="facetofaceslot" name="facetofaceslot" min="1" value="{{$openClass->facetofaceslot}}">

                        </div>
                  </div>

                  <div class="mb-3 col-md-6">
                    <div class="custom-control custom-switch mb-3">
                    <input type="checkbox" class="custom-control-input" id="f2f_switch"  <?php echo $openClass->zoomlink !='' ? 'Checked' :'' ?> onchange="togglezoomlink(this)">
                    <label class="custom-control-label" for="f2f_switch">Zoom</label>
                    </div>
                    <div class="form-group mb-4" id="slots" name="slots">
                        <label class="mr-sm-2" for="zoomlink"> Zoom Link #</label>
                        <input type="number" class="form-control" id="zoomlink" name="zoomlink" value="{{$openClass->zoomlink}}">

                        </div>
                  </div>
                  
                  <div class="mb-3 col-md-6">
                    <label for="advancepayment" class="form-label">Payment *</label>
                    <input class="form-control" type="text" id="advancepayment" name="advancepayment" value="{{$openClass->advancepayment}}" />
                  </div>

                    <div class="mb-3 col-md-6">
                    <label for="packagethumbmail" class="form-label">Package Thumbnail *</label>
                    <input type="hidden" name="oldpackagethumbmail" id="oldpackagethumbmail" value="{{$openClass->packagethumbmail}}"/>
                    <input type="file" class="form-control" name="packagethumbmail" id="packagethumbmail"/>
                    </div>

                    <div class="mb-3 col-md-6">
                    <label for="checkoutthumbmail" class="form-label">Checkout Thumbnail *</label>
                    <input type="hidden" name="oldcheckoutthumbmail" id="oldcheckoutthumbmail" value="{{$openClass->checkoutthumbmail}}"/>
                    <input type="file" class="form-control" name="checkoutthumbmail" id="checkoutthumbmail"/>
                    </div>
                 

                  <div class="mb-3 col-md-12">
                    <label for="description" class="form-label">Description *</label>
                    <input name="description" id="inp_htmlcode" type="hidden" value="{{$openClass->description}}"  />
                    <div id="div_editor1" name='description' class="richtexteditor"></div>
                  </div>
                </div>

            </div>
              </div>
          </div>

          <hr class="my-0">
          <div class="card-body">
              
            <div class="row">
                <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2" onclick="checkvalidate()" >Save changes</button>
              
                </div>
            </div>
        </div>
        <!-- /Notifications -->
      </div>
  </div>
<!--</form>-->



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

  
    checkvalidate = () =>{

            let classname = document.getElementById('classname').value;
            let page_title = document.getElementById('page_title').value;
            let page_description = document.getElementById('page_description').value;
            let page_schema = document.getElementById('page_schema').value;
            let inp_htmlcode = document.getElementById("inp_htmlcode").value;
            let scheduledate = document.getElementById("scheduledate").value;
            let scheduletime = document.getElementById("scheduletime").value;
            let facetofaceslot = document.getElementById("facetofaceslot").value;
            let zoomlink = document.getElementById("zoomlink").value;
            let regularrate = document.getElementById("regularrate").value;
            let advancepayment = document.getElementById("advancepayment").value;
            let branch_id = document.getElementById('branchname').value;
            let status = document.getElementById('status').value;
            let oldpackagethumbmail =document.getElementById('oldpackagethumbmail').value;
            let oldcheckoutthumbmail =document.getElementById('oldcheckoutthumbmail').value;
            let proid = document.getElementById('proid').value;
            let trainername = document.getElementById('trainer_id').value;


          $(".error").remove();

          if(classname.length < 1) {
          $('#classname').after('<span class="error">This field is required*</span>');
          return false;
          }
            var branchname=$('#branchname');
           if(branchname.val()== 0)
          {
            $('#branchname').after('<span class="error"> Select a Valid Branch Name*</span>');
            return false;
          }

          var trainer_id=$('#trainer_id');
          if(trainer_id.val() == 0)
          {
            $('#trainer_id').after('<span class="error"> Select a Valid Trainer Name*</span>');
            return false;
          }
          

          if(scheduledate == '') {
          $('#scheduledate').after('<span class="error"> Schedule Date  is Required*</span>');
          return false;
          }

          if(scheduletime == '') {
          $('#scheduletime').after('<span class="error"> End Time  is Required*</span>');
          return false;
          }

          if(regularrate.length < 1) {
          $('#regularrate').after('<span class="error">Regular Rate is required*</span>');
          return false;
          }

          if(advancepayment.length < 1) {
          $('#advancepayment').after('<span class="error">Advance Payment is required*</span>');
          return false;
          }

          if (inp_htmlcode.length < 1) {
            $('#inp_htmlcode').after('<span class="error">Description is required*</span>');
            return false;
          }
        
           else{
                    var packagethumbmail = $('#packagethumbmail')[0].files;
                    var checkoutthumbmail = $('#checkoutthumbmail')[0].files;
                    let data = new FormData;
                    data.append('proid',proid);
                    data.append('classname',classname);
                    data.append('page_title',page_title);
                    data.append('page_description',page_description);
                    data.append('page_schema',page_schema);
                    data.append('branchname',branch_id);
                    data.append('trainer_id',trainername);
                    data.append('scheduledate',scheduledate);
                    data.append('scheduletime',scheduletime);
                    data.append('facetofaceslot',facetofaceslot);
                    data.append('zoomlink',zoomlink);
                    data.append('regularrate',regularrate);
                    data.append('advancepayment',advancepayment);
                    data.append('packagethumbmail',packagethumbmail[0]);
                    data.append('checkoutthumbmail',checkoutthumbmail[0]);
                    data.append('oldpackagethumbmail',oldpackagethumbmail);
                    data.append('oldcheckoutthumbmail',oldcheckoutthumbmail);
                    data.append('description',inp_htmlcode);
                    data.append('status',status);

                    axios.post('{{ENV("APP_URL")}}/updateOpenClass',data).then((result) => {
                    if(result.data == 1)
                    {
                    Swal.fire(
                        '',
                        'Open Class  Updated Successfully',
                        'success'
                    )
                    .then((result) => {
                        window.location.href = '{{ENV("APP_URL")}}/allOpenClassesView';
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
    
    
    // Face to Face Slots Checkbox Js code Here....
       togglefacetofaceslot = (e) =>{

        if(e.checked == true)
        {
        let get = document.getElementById('facetofaceslot');
        get.disabled = false;
        }
         if(e.checked == false){
            let get = document.getElementById('facetofaceslot');
            get.disabled = true;
        }

       }

       // Zome Link Chckbox js code here

       togglezoomlink = (e) =>{
        if(e.checked == true)
        {
        let get = document.getElementById('zoomlink');
        get.disabled = false;
        }
         if(e.checked == false){
            let get = document.getElementById('zoomlink');
            get.disabled = true;
        }

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

