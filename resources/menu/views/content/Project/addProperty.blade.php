@extends('layouts/contentNavbarLayout')

@section('title', 'Add Property')

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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoyZ_yVsI5N8KhjbWRyQeme1Pfz2DRYYc&libraries=places&callback=initAutocomplete"></script>

<style>
  .AceSelected{
    border: 4px solid #04917a
  }
  .form-check-input[type=checkbox] {
    border: 1px solid #00000061;
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

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Damac Lagoons / Venice /</span> New Property
</h4>

<div class="row">
    <div class="card mb-4">
      <h5 class="card-header">Property Details</h5>
      <!-- Account -->
      <div class="card-body">
        <form action="{{ENV('APP_URL')}}/submit-add-property" method="post"  onsubmit="return checkvalidate()">
            @csrf
          <div class="row">
          <input value="{{ENV('APP_URL')}}/media/images/" id="imgurl" type="hidden"/>
            <div class="mb-3 col-md-6">
              <label for="firstName" class="form-label">Name</label>
              <input class="form-control" type="text" id="name" name="name" placeholder="Name" value="" autofocus />
            </div>
            <div class="mb-3 col-md-6">
              <label for="agent" class="form-label">Agent</label>
              <select id="agent" name="agent" class="select2 form-select">
                <option value="0">Select</option>
                @foreach($agents as $row)
                <option value="{{$row->id}}">{{$row->first_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 col-md-6">
                <label for="project" class="form-label">Project</label>
                <select id="project" name="project" class="select2 form-select" onchange="changeProject(event.target.value)">
                  <option value="0">Select</option>
                  @foreach($project as $row)
                  <option value="{{$row->id}}">{{$row->name}}</option>
                  @endforeach
                  <option value="no_project">No Project</option>
                </select>
              </div>
              <div class="mb-3 col-md-6">
                <label for="subproject" class="form-label">Sub project</label>
                <select id="subproject" name="subproject" class="select2 form-select">
                  <option value="0">Select</option>
                  <option value="no_sub_project">No Sub Project</option>
                </select>
              </div>
            <div class="mb-3 col-md-12">
              <label for="address" class="form-label">Address</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Address" />
            </div>
            <div class="mb-3 col-md-6" style="display: none">
              <label for="state" class="form-label">State</label>
              <input class="form-control" type="text" id="state" name="state" placeholder="Dubai" value='' />
            </div>
            <div class="mb-3 col-md-6" style="display: none">
              <label for="zipCode" class="form-label">Zip Code</label>
              <input type="text" class="form-control" id="zipCode" name="zipCode" placeholder="231465" maxlength="6" value='' />
            </div>
            <div class="mb-3 col-md-6" style="display: none">
              <label class="form-label" for="country">Country</label>
              <select id="country" name="country" class="select2 form-select">
                <option value="0">Select</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="Australia">Australia</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Belarus">Belarus</option>
                <option value="Brazil">Brazil</option>
                <option value="Canada">Canada</option>
                <option value="China">China</option>
                <option value="France">France</option>
                <option value="Germany">Germany</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Japan">Japan</option>
                <option value="Korea">Korea, Republic of</option>
                <option value="Mexico">Mexico</option>
                <option value="Philippines">Philippines</option>
                <option value="Russia">Russian Federation</option>
                <option value="South Africa">South Africa</option>
                <option value="Thailand">Thailand</option>
                <option value="Turkey">Turkey</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
              </select>
            </div>
            <div class="mb-3 col-md-6">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="" />
            </div>
            <div class="mb-3 col-md-6">
              <label for="size" class="form-label">Size</label>
              <input type="text" class="form-control" id="size" name="size" placeholder="" />
            </div>
            <div class="mb-3 col-md-6">
                <label for="beadroom" class="form-label">Bedroom</label>
                <input type="text" class="form-control" id="beadroom" name="beadroom" placeholder="" />
            </div>
            <div class="mb-3 col-md-6">
                <label for="bathroom" class="form-label">Bathroom</label>
                <input type="text" class="form-control" id="bathroom" name="bathroom" placeholder="" />
            </div>
            <div class="mb-3 col-md-6">
                <label for="status" class="form-label">Purpose</label>
                <select id="purpose" name="purpose" class="select2 form-select">
                <option value="0">Select Purpose</option>
                  <option value="Buy">Buy</option>
                  <option value="Rent">Rent</option>
                </select>
            </div>

            <div class="mb-3 col-md-6">
              <label for="propertytype" class="form-label">Property  Type</label>
              <select id="propertytype" name="propertytype" class="form-select" Propertyclass="select2 form-select">
                <option value="0">Select</option>
                @foreach($projectType as $row)
                <option value="{{$row->id}}">{{$row->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="mb-3 col-md-6">
                <label for="status" class="form-label">Property Status</label>
                <select id="status" name="status" class="select2 form-select">
                  <option value="0">Select</option>
                </select>
            </div>

            <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Status</label>
                    <select id="chkstatus" name="chkstatus" class="form-select"  aria-label="Default select example">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                  </div>

           
            <div class="mb-3 col-md-6">
              <label for="features" class="form-label">Features</label>
              <div class="">
                <input type="hidden" id="propertyFeatures" name="propertyFeatures" />
                <button type="button" style="text-align: left" class="select2 form-select" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Features
                </button>
                <div class="dropdown-menu dropdown-menu-end w-px-300 p-4" style="">
                  <label for="features" class="form-label">Select Features</label>
                  <div id="featureDiv"></div>
                  <div class="pt-2">
                    {{-- <button type="button" class="btn btn-primary me-2 btn-sm" style="width: 100%" data-bs-toggle="modal" data-bs-target="#basicModal2">Add New</button> --}}
                  </div>

                </div>
              </div>
            </div>
            <div class="mb-3 col-md-12">
              <input type="hidden" name="imgArr" id="imgArr" />
              <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                <span class="tf-icons bx bx-image"></span>&nbsp; Select Images
              </button>
            </div>
            <div class="mb-3 col-md-6">
              <div class="demo-inline-spacing mt-3">
                <ol class="list-group list-group-numbered" id="selectname1">
                </ol>
              </div>
            </div>
              </div>
          </div>
          <div class="mb-3 col-md-12">
            <label for="description" class="form-label">Description</label>
            <input name="description" id="inp_htmlcode" type="hidden" />
            <div id="div_editor1" class="richtexteditor"></div>
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2">Save changes</button>
            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
          </div>
        </form>
      </div>
      <!-- /Account -->
    </div>
  </div>
</div>

<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Images</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="row">
        <div class="col-xl-12">
          <div class="nav-align-top mb-12">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">All Images</button>
              </li>
              <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">Upload Image</button>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
              <div class="modal-body">
              <div class="d-flex flex-wrap mt-2 apendimg" id="icons-container">
                @foreach($media as $row)
                <div class="card icon-card cursor-pointer text-center  mb-4 mx-2">
                    <img id="img{{$row->id}}" class="myImg" src="{{ENV('APP_URL')}}/media/images/{{$row->url}}" onclick="ImgClick({{$row->id}},'{{$row->name}}')" />
                </div>
                @endforeach
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" onclick="handleImages()">Save</button>
            </div>
              </div>
              <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
          @csrf
          <div class="row">
              <div class="mb-3 col-md-6">
                  <input class="form-control" type="file" id="formFile" name="file" onchange="return fileValidation()">
              </div>
              <div class="mb-3 col-md-6">
                  <button type="submit" class="btn btn-primary" onclick="handleSubmit()">Upload</button>
                  <button id="resetbtn"  type="button" class="btn btn-primary" onclick="resetFile()"> Reset file</button>
              </div>
          </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="loader"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>

function resetFile() {
const file =
document.querySelector('#formFile');
file.value = '';
}


getAllData = () => {
  let statusElement = document.getElementById('status');

  axios.post('getAllPropetyStatus').then((result) => {
    result.data.map(x => {
      var option = document.createElement("option");
      option.text = x.name;
      option.value = x.id;
      statusElement.appendChild(option);
    })
  }).catch((err) => {
    console.log(err);
  });

  axios.post('getAllPropetyFeatures').then((result) => {
    result.data.map(x => {

      let content  = `<div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" onclick="addFeatureToAdrr(${x.id})" id="defaultCheck${x.id}">
                    <label class="form-check-label" for="defaultCheck${x.id}">
                      ${x.name}
                    </label>
                  </div>`;

      $("#featureDiv").append(content);
    })
  }).catch((err) => {
    console.log(err);
  });
  
}

getAllData()



  let selectedImages = [];
  let selectedImagesArr = [];
  let selectedFeatures = [];
    
  var editor1 = new RichTextEditor(document.getElementById("div_editor1"));
    editor1.attachEvent("change", function () {
    document.getElementById("inp_htmlcode").value = editor1.getHTMLCode();
  });


  ImgClick = (id,name) => {
    let img = document.getElementById(`img${id}`)
    if(img.className.indexOf('AceSelected') > 0){
      selectedImages = selectedImages.filter((x) => x != id)
      selectedImagesArr = selectedImagesArr.filter((x) => x != name)
      img.className = 'myImg';
    }else{
      selectedImages.push(id)
      selectedImagesArr.push(name)
      img.className = 'myImg AceSelected';
    }
  }

  handleImages = () => {
    document.getElementById('selectname1').innerHTML = '';
    selectedImagesArr.map(x => {
      if(x == '')
      {
        $('#selectname1').append(`<li class="list-group-item">Image</li>`);
      }
     else{
      $('#selectname1').append(`<li class="list-group-item">${x}</li>`);
     }
    })
    document.getElementById('imgArr').value = JSON.stringify(selectedImages);
    $('#basicModal').modal('hide');
  }

  function fileValidation(){
      $(".error").remove();
    var fileInput = document.getElementById('formFile');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!allowedExtensions.exec(filePath)){
      $('#formFile').after('<span class="error"> Please upload file having extensions .jpeg/.jpg/.png/.gif only</span>');
        fileInput.value = '';
        return false;
    }else{
        //Image preview
        if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
            };
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
}

handleSubmit = () =>{
      $(".error").remove();
      var spinner = $('.loader');
       spinner.show();
    var fileInput = document.getElementById('formFile').value;
    var files = $('#formFile')[0].files;
    let data =  new FormData;
    data.append('file',files[0]);
    if( fileInput == '' || fileInput == null){
      $('#formFile').after('<span class="error"> Please upload file having extensions .jpeg/.jpg/.png/.gif only</span>');
      spinner.hide();
      return false;
    }else{
      axios.post('{{ENV("APP_URL")}}/AddMedia',data).then((result) => {
     if(result.data != 0){
      var imgurl= document.getElementById('imgurl').value;
      $( "#resetbtn" ).trigger( "click" );
      $('.apendimg').append(`<div class="card icon-card cursor-pointer text-center  mb-4 mx-2">
      <img id="img${result.data[0].id}" class="myImg" src="${imgurl}/${result.data[0].url}" onclick="ImgClick(${result.data[0].id},'${result.data[0].name}')">
      </div>`);
      spinner.hide();
     }
    }).catch((err) => {
      console.log(err);
    });
    }
}


  changeProject = (id) => {
    let subPojectElement = document.getElementById('subproject')
    let data =  new FormData;
    data.append('id',id)
    axios.post('getSubProjectById',data).then((result) => {
      var i, L = subPojectElement.options.length - 1;
      for(i = L; i >= 0; i--) {
        subPojectElement.remove(i);
      }
      var doption = document.createElement("option");
        doption.text = 'Select';
        doption.value = 0;
        subPojectElement.appendChild(doption);
        var doption2 = document.createElement("option");
        doption2.text = 'No Sub Project';
        doption2.value = 'no_sub_project';
        subPojectElement.appendChild(doption2);
        result.data.map(x => {
          var option = document.createElement("option");
          option.text = x.name;
          option.value = x.id;
          subPojectElement.appendChild(option);
        })
    }).catch((err) => {
      console.log(err)
    });
  }


  saveNewFeature = () => {
    let name = document.getElementById('featureName').value;

    let data = new FormData;
    data.append('name',name);

    axios.post('/saveNewFeature',data).then((result) => {
      $('#basicModal2').modal('hide');
      console.log(result.data);
    }).catch((err) => {
      $('#basicModal2').modal('hide');
      console.log(err);
    });
  }

  addFeatureToAdrr = (id) => {
    let box = document.getElementById(`defaultCheck${id}`)
    if(!box.checked){
      selectedFeatures = selectedFeatures.filter(x => x != id);
    }else{
      selectedFeatures.push(id);
    }
    document.getElementById('propertyFeatures').value = JSON.stringify(selectedFeatures);
  }

</script>
<script>
 

    checkvalidate = () =>{
      var spinner = $('.loader');
      spinner.show();
        let name = document.getElementById('name').value;
        let inp_htmlcode = document.getElementById("inp_htmlcode").value;
        let address = document.getElementById("address").value;
        let state =document.getElementById('state').value;
        let zipCode =document.getElementById('zipCode').value;
        let price =document.getElementById('price').value;
        let size =document.getElementById('size').value;
        let beadroom =document.getElementById('beadroom').value;
        let bathroom =document.getElementById('bathroom').value;
        let propertyFeatures =document.getElementById('propertyFeatures').value;
        let imgArr = document.getElementById('imgArr').value;
        $(".error").remove();

    if (name.length < 1) {
    $('#name').after('<span class="error">This field is required*</span>');
    spinner.hide();
    return false;
    }
    var agent = $("#agent");
    if (agent.val() == 0) {
    $('#agent').after('<span class="error">Select a Valid Agent*</span>');
    spinner.hide();
    return false;
    }
    var project =$('#project');
    if(project.val() == 0)
    {
      $('#project').after('<span class="error">Select a Valid Project*</span>');
      spinner.hide();
      return false;
    }
    var subproject =$('#subproject');
    if(subproject.val() == 0){
      $('#subproject').after('<span class="error">Select a Valid Sub Project*</span>');
      spinner.hide();
      return false; 
    }
    if (address.length < 1) {
    $('#address').after('<span class="error">Address is required*</span>');
    spinner.hide();
    return false;
    }
    
    if (price.length < 1) {
    $('#price').after('<span class="error">Price is required*</span>');
    spinner.hide();
    return false;
    }
    if (size.length < 1) {
    $('#size').after('<span class="error">Size is required*</span>');
    spinner.hide();
    return false;
    }
    if (beadroom.length < 1) {
    $('#beadroom').after('<span class="error">Beadroom is required*</span>');
    spinner.hide();
    return false;
    }
    if (bathroom.length < 1) {
    $('#bathroom').after('<span class="error">Bathroom is required*</span>');
    spinner.hide();
    return false;
    }

    var purpose=$('#purpose');

    if(purpose.val() == 0)
    {
      $('#purpose').after('<span class="error">Select a Valid Purpose*</span>');
      spinner.hide();
      return false; 
    }
    
    var propertytype=$('#propertytype');

    if(propertytype.val() == 0)
    {
      $('#propertytype').after('<span class="error">Select a Valid Property Type*</span>');
      spinner.hide();
      return false; 
    }

    var status =$('#status');
    if(status.val() == 0)
    {
      $('#status').after('<span class="error">Select a Valid Status*</span>');
      spinner.hide();
      return false; 
    }


    if (propertyFeatures.length < 1) {
      $('#propertyFeatures').after('<span class="error">Features is required*</span>');
      spinner.hide();
      return false;
    }
    if (imgArr.length < 1) {
      $('#imgArr').after('<span class="error">Slider Images Selection is required*</span>');
      spinner.hide();
      return false;
    }
    if (inp_htmlcode.length < 1) {
      $('#inp_htmlcode').after('<span class="error">Description is required*</span>');
      spinner.hide();
      return false;
    }
    
    else{
      return true;
      spinner.hide();
    }
     
    }
</script>
<script>
  function init() {
    var input = document.getElementById("address");
    var autocomplete = new google.maps.places.Autocomplete(input);
  }

  google.maps.event.addDomListener(window, "load", init);
</script>
@endsection