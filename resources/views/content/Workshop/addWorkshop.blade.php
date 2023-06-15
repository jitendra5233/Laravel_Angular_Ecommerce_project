@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Add Workshop')

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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/5.0.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
          crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{asset('multidatepicker/multidatespicker.js')}}"></script>
    <link rel="stylesheet" href="{{asset('multidatepicker/styles.css')}}" />

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
          <h5 class="card-header">New Workshop</h5>
          <!-- Account -->
          
          <div class="card-body">
              <div class="row">
              <input value="{{ENV('APP_URL')}}/media/images/" id="imgurl" type="hidden"/>
              <div class="mb-3 col-md-12">
                  <label for="selectedValues" class="form-label">WorkShop Dates*</label>
              <input type="text" id="selectedValues"  class="date-values" readonly/>
              <div style="margin:20px;">
               <div id="parent" class="container" style="display:none;">
                <div class="row header-row">
                <div class="col-xs previous">
                    <a href="#" id="previous" onclick="previous()" style="float:left !important;">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="card-header month-selected col-sm" id="monthAndYear">
                </div>
                <div class="col-sm">
                    <select class="form-control col-xs-6" name="month" id="month" onchange="change()"></select>
                </div>
                <div class="col-sm">
                    <select class="form-control col-xs-6" name="year" id="year" onchange="change()"></select>
                </div>
                <div class="col-xs next">
                    <a href="#" id="next" onclick="next()" style="float:right !important;">
                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            <table id="calendar">
                <thead>
                    <tr>
                        <th>S</th>
                        <th>M</th>
                        <th>T</th>
                        <th>W</th>
                        <th>T</th>
                        <th>F</th>
                        <th>S</th>
                    </tr>
                </thead>
                <tbody id="calendarBody"></tbody>
            </table>
        </div>
    </div>
              </div>

              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="mb-3 col-md-6">
                    <label for="class_id" class="form-label">Project Class Name*</label>
                    <select id="class_id" name="class_id" class="form-select"  aria-label="Default select example">
                      <option value="0">Select Class</option>
                      @foreach($projectClass as $class)
                      <option value="{{$class->id}}">{{$class->name}}</option>
                     @endforeach
                    </select>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Branch Name *</label>
                    <select id="branch_id" name="branch_id" class="form-select"  aria-label="Default select example" onchange="getTrainer(this.value)">
                      <option value="0">Select Branch</option>
                      @foreach($tableData as $r)
                      <option value="{{$r->id}}">{{$r->name}}</option>
                      @endforeach
                    </select>
                    </select>
                  </div>

                 <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Trainer Name*</label>
                    <select id="trainer_id" name="trainer_id" class="select2 form-select">
                    <option value="0">Select Trainer</option>
                    </select>
                    </div>

                  <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Workshop Title *</label>
                    <input class="form-control" type="text" id="title" name="title"  value="" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="paymenttitle" class="form-label">Payment Title *</label>
                    <input class="form-control" type="text" id="paymenttitle" name="paymenttitle"  value="" />
                  </div>

                   <div class="mb-3 col-md-6">
                    <label for="page_title" class="form-label">Page Title *</label>
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
                    <label for="price" class="form-label">Price *</label>
                    <input class="form-control" type="text" id="price" name="price" value="" />
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
                    <label for="image" class="form-label">WorkShop Image *</label>
                    <input type="file" class="form-control" name="image" id="image"/>
                    </div>

                  <div class="mb-3 col-md-12">
                    <label for="short_description" class="form-label">Short Description</label>
                    <textarea id="short_description" name="short_description" class="form-control"></textarea>
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
<script async src="//jsfiddle.net/atn8upt5/1/embed/js,result/"></script>


<script>

    var editor1 = new RichTextEditor(document.getElementById("div_editor1"));

    editor1.attachEvent("change", function () {
      document.getElementById("inp_htmlcode").value = editor1.getHTMLCode();
    });


    checkvalidate = () =>{

            var spinner = $('.loader');
            spinner.show();
            let workshopdates = document.getElementById("selectedValues").value;
            let classname = document.getElementById("class_id").value;
            let branchname = document.getElementById("branch_id").value;
            let title = document.getElementById('title').value;
            let paymenttitle = document.getElementById('paymenttitle').value;
            let page_title = document.getElementById('page_title').value;
            let page_description = document.getElementById('page_description').value;
            let page_schema = document.getElementById('page_schema').value;
            let price = document.getElementById("price").value;
            let starttime = document.getElementById("starttime").value;
            let endtime = document.getElementById("endtime").value;
            let short_description = document.getElementById("short_description").value;
            let inp_htmlcode = document.getElementById("inp_htmlcode").value;
            let status = document.getElementById('status').value;
            let trainername = document.getElementById('trainer_id').value;

              $(".error").remove();
              
              if(workshopdates == '') {
              $('#calendar').after('<span class="error"> Workshop Date is Required*</span>');
              spinner.hide();
              return false;
              }

              var class_id=$('#class_id');
              if(class_id.val() == 0) {
              $('#class_id').after('<span class="error">This field is required*</span>');
              spinner.hide();
              return false;
              }

              var branch_id =$('#branch_id');
              if(branch_id.val() == 0)
              {
                $('#branch_id').after('<span class="error"> Select a Valid Branch Name*</span>');
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

              if(title.length < 1) {
              $('#title').after('<span class="error">Workshop Title is required*</span>');
              spinner.hide();
              return false;
              }

              if(paymenttitle.length < 1) {
              $('#paymenttitle').after('<span class="error">Payment Title is required*</span>');
              spinner.hide();
              return false;
              }
              
              if(price.length < 1) {
              $('#price').after('<span class="error">Price is required*</span>');
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
              
              var image = $('#image')[0].files;
              if (image.length == 0) {
                $('#image').after('<span class="error">Workshop image is required*</span>');
                spinner.hide();
                return false;
              }

              if(short_description.length < 1) {
              $('#short_description').after('<span class="error">Regular Rate is required*</span>');
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
                      data.append('classname',classname);
                      data.append('branchname',branchname);
                      data.append('trainer_id',trainername);
                      data.append('title',title);
                      data.append('paymenttitle',paymenttitle);
                      data.append('page_title',page_title);
                      data.append('page_description',page_description);
                      data.append('page_schema',page_schema);
                      data.append('workshopdates',workshopdates);
                      data.append('starttime',starttime);
                      data.append('endtime',endtime);
                      data.append('price',price);
                      data.append('short_description',short_description);
                      data.append('image',image[0]);
                      data.append('description',inp_htmlcode);
                      data.append('status',status);
                      axios.post('{{ENV("APP_URL")}}/submit-Workshop',data).then((result) => {
                      if(result.data == 1)
                      {
                      spinner.hide(); 
                      Swal.fire(
                          '',
                          'Workshop Added Successfully',
                          'success'
                      )
                      .then((result) => {
                        window.location.href = '{{ENV("APP_URL")}}/allWorkshopView';
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
        axios.post('{{ENV("APP_URL")}}/gettrainerbybranchidfromworkshop',data).then((result) => {

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

//Select Multiple Dtaes Or Single dates Code Here....


</script>

<script>
  function init() {
    var input = document.getElementById("location");
    var autocomplete = new google.maps.places.Autocomplete(input);
  }

  google.maps.event.addDomListener(window, "load", init);
</script>

@endsection

