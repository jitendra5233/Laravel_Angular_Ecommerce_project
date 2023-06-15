@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Property')

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
</style>

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Damac Lagoons / Venice /</span> Edit Property
</h4>

<div class="row">
    <div class="card mb-4">
      <h5 class="card-header">Property Details</h5>
      <!-- Account -->
      <div class="card-body">
        <form action="{{ENV('APP_URL')}}/updateproperty" method="post"  onsubmit="return checkvalidate()">
            @csrf
          <div class="row">
            <input type="hidden" name="typeId" id="propid" value="{{$property->typeId}}"/>
            <input type="hidden" name="propertyid" id="propertyid" value="{{$property->id}}"/>
            <input type="hidden" name="categoryId" id="cetegory" value="{{$property->categoryId}}"/>
            <input type="hidden" name="featuresId[]" id="featuresId" value="{{$property->features}}"/>
            <input type="hidden" name="propertyListingStatus" id="propertyListingStatus" value="{{$property->propertyListingStatus}}"/>
            <div class="mb-3 col-md-6">
              <label for="name" class="form-label">Name</label>
              <input class="form-control" type="text" id="name" name="name" placeholder="Name" value="{{$property->name}}" autofocus />
            </div>
            <div class="mb-3 col-md-6">
              <label for="agent" class="form-label">Agent</label>
              <select id="agent" name="UserId" class="select2 form-select">
                <option value="0">Select</option>
                @foreach($agents as $row)
                <option value="{{$row->id}}" <?php echo $property->userId == $row->id ? 'selected' : '' ?>>{{$row->first_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3 col-md-6">
                <label for="project" class="form-label">Project</label>
                <select id="project" name="projectId" class="select2 form-select" onchange="changeProject(event.target.value)">
                  <option value="0">Select</option>
                  @foreach($project as $row)
                  <option value="{{$row->id}}" <?php echo $property->typeId == $row->id ? 'selected' : '' ?>>{{$row->name}}</option>
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
              <input type="text" class="form-control" id="address" name="address" value="{{$property->address}}" placeholder="Address" />
            </div>
            <div class="mb-3 col-md-6" style="display:none">
              <label for="state" class="form-label">State</label>
              <input class="form-control" type="text" id="state" name="state" value="{{$property->state}}" placeholder="Dubai" />
            </div>
            <div class="mb-3 col-md-6" style="display:none">
              <label for="zipCode" class="form-label">Zip Code</label>
              <input type="text" class="form-control" id="zipCode" name="zipCode" value="{{$property->city}}"  placeholder="231465" maxlength="6" />
            </div>
            <div class="mb-3 col-md-6" style="display:none">
              <label class="form-label" for="country">Country</label>
              <select id="country" name="country" class="select2 form-select">
                <option value="0">Select</option>
                <option value="{{$property->country}}" <?php echo 'selected'?> >{{$property->country}}</option>
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
                <input type="text" class="form-control" id="price" name="price" value="{{$property->price}}" placeholder="Enter Price"  />
            </div>
            <div class="mb-3 col-md-6">
              <label for="size" class="form-label">Size</label>
              <input type="text" class="form-control" id="size" name="size" value="{{$property->sizeSqFt}}" placeholder="Enter SizeSqFt"  />
            </div>
            <div class="mb-3 col-md-6">
                <label for="beadroom" class="form-label">Bedroom</label>
                <input type="text" class="form-control" id="beadroom" name="beadroom" value="{{$property->bedroom}}" placeholder="Enter Beadroom"  />
            </div>
            <div class="mb-3 col-md-6">
                <label for="bathroom" class="form-label">Bathroom</label>
                <input type="text" class="form-control" id="bathroom" name="bathroom" value="{{$property->bathroom}}" placeholder="Enetr Bathroom"  />
            </div>
            <div class="mb-3 col-md-6">
                <label for="status" class="form-label">Purpose</label>
                <select id="purpose" name="purpose" class="select2 form-select">
                <option value="0">Select Purpose</option>
                  <option value="Buy" <?php echo $property->purpose == 'Buy' ? 'Selected' : "null" ?>>Buy</option>
                  <option value="Rent" <?php echo $property->purpose == 'Rent' ? 'Selected' : "null" ?>>Rent</option>
                </select>
            </div>
            <div class="mb-3 col-md-6">
              <label for="agent" class="form-label">Property Type</label>
              <select id="propertytype" name="propertytype" class="select2 form-select">
                <option value="0">Select</option>
                @foreach($propertyTypes as $row)
                <option value="{{$row->id}}" <?php echo $property->propertytypeId == $row->id ? 'selected' : ''; ?> >{{$row->name}}</option>
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
                      <option value="1" <?php echo $property->status=='1' ? 'selected' : '' ?>>Active</option>
                      <option value="0" <?php echo $property->status=='0' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                  </div>
            <div class="mb-3 col-md-6">
              <label for="features" class="form-label">Features</label>
              <div class="">
                <input type="hidden" id="propertyFeatures" name="propertyFeatures"  value="{{$property->features}}"/>
                <button type="button" style="text-align: left" class="select2 form-select" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Features
                </button>
                <div class="dropdown-menu dropdown-menu-end w-px-300 p-4" style="">
                  <label for="features" class="form-label">Select Features</label>
                  <div id="featureDiv"></div>
                  <div class="pt-2">
                  <div class="form-check">
                  @foreach($features as $row1)
                  <?php $myval=$property->features;
                    $final=str_split($myval);
                    ?>
                    <input class="form-check-input" type="checkbox" name="mycheck[]" value="{{$row1->id}}"  id="mycheck" <?php echo  array_search($row1->id, $final) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="mycheck">{{$row1->name}}</label>
                   <br>
                   @endforeach
                  </div>
                  </div>

                </div>
              </div>
            </div>
            <div class="mb-3 col-md-12">
              <input type="hidden" name="imgArr" id="imgArr" value="{{$property->images}}"/>
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
            <input name="description" id="inp_htmlcode" type="hidden" value="{{$property->description}}" />
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
        <h5 class="modal-title" id="exampleModalLabel22">Images</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="row">
        <div class="col-xl-12">
          <div class="nav-align-top mb-12">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                  data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">All
                  Images</button>
              </li>
              <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                  data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">Upload
                  Image</button>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                <div class="modal-body">
                  <div class="d-flex flex-wrap mt-2 apendimg" id="icons-container">
                    @foreach($media as $row)
                    <div class="card icon-card cursor-pointer text-center  mb-4 mx-2">
                      <img id="img{{$row->id}}" class="myImg" src="{{ENV('APP_URL')}}/media/images/{{$row->url}}"
                        onclick="ImgClick({{$row->id}},'{{$row->name}}')" />
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
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <input class="form-control" type="file" id="formFile" name="file"
                      onchange="return fileValidation()">
                  </div>
                  <div class="mb-3 col-md-6">
                    <button type="submit" class="btn btn-primary" onclick="handleSubmit()">Upload</button>
                    <button id="resetbtn" type="button" class="btn btn-primary" onclick="resetFile()"> Reset
                      file</button>
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



<div class="modal fade" id="basicModal2" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">New Feature</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="featureName" class="form-label">Name</label>
            <input type="text" id="featureName" name="featureName" class="form-control" placeholder="Enter Name">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="saveNewFeature()">Save</button>
      </div>
    </div>
  </div>
</div>

<script>
   function resetFile() {
            const file =
                document.querySelector('#formFile');
            file.value = '';
        }
getAllData = () => {
  let statusElement = document.getElementById('status');
  let StatusId = document.getElementById('propertyListingStatus').value
  axios.post('{{ENV('APP_URL')}}/getAllPropetyStatus').then((result) => {
    result.data.map(x => {
      if(x.id == StatusId){
                var option = document.createElement("option");
                option.text = x.name;
                option.value = x.id;
                option.selected = 'selected';
                statusElement.appendChild(option);
            }
            else{
                var option = document.createElement("option");
                option.text = x.name;
                option.value = x.id;
                statusElement.appendChild(option);
            }
    })
  }).catch((err) => {
    console.log(err);
  });

  axios.post('{{ENV('APP_URL')}}/getAllPropetyFeatures').then((result) => {
    result.data.map(x => {
      // let content  = `<div class="form-check">
      //               <input class="form-check-input" type="checkbox" value="" onclick="addFeatureToAdrr(${x.id})" id="defaultCheck${x.id}">
      //               <label class="form-check-label" for="defaultCheck${x.id}">
      //                 ${x.name}
      //               </label>
      //             </div>`;

      // $("#featureDiv").append(content);
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

  $(document).ready(function() {
    let propid = document.getElementById('propid').value;
    let oldhtml = document.getElementById('inp_htmlcode').value;
    // let id = document.getElementById('propertyFeatures').value;
    editor1.insertHTML(oldhtml)
    changeProject(propid)
    // addFeatureToAdrr(id)
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

  changeProject = (id) => {
    let subPojectElement = document.getElementById('subproject')
    let SubProjectId = document.getElementById('cetegory').value
    let data =  new FormData;
    data.append('id',id)
    axios.post('{{ENV('APP_URL')}}/getSubProjectById',data).then((result) => {
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
            if(x.id == SubProjectId){
                var option = document.createElement("option");
                option.text = x.name;
                option.value = x.id;
                option.selected = 'selected';
                subPojectElement.appendChild(option);
            }else{
                var option = document.createElement("option");
                 option.text = x.name;
                 option.value = x.id;
                subPojectElement.appendChild(option);
            }
        })
        var options = $('#subproject option');
        var categoryId=document.getElementById('cetegory').value;
    }).catch((err) => {
      console.log(err)
    });

  }


  saveNewFeature = () => {
    let name = document.getElementById('featureName').value;

    let data = new FormData;
    data.append('name',name);

    axios.post('{{ENV('APP_URL')}}/saveNewFeature',data).then((result) => {
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
        $(".error").remove();

    if (name.length < 1) {
    $('#name').after('<span class="error">This field is required*</span>');
    return false;
    }
    var agent = $("#agent");
    if (agent.val() == 0) {
    $('#agent').after('<span class="error">Select a Valid Agent*</span>');
    return false;
    }
    var project =$('#project');
    if(project.val() == 0)
    {
      $('#project').after('<span class="error">Select a Valid Project*</span>');
      return false;
    }
    var subproject =$('#subproject');
    if(subproject.val() == 0){
      $('#subproject').after('<span class="error">Select a Valid Sub Project*</span>');
      return false; 
    }
   
    if (address.length < 1) {
    $('#address').after('<span class="error">Address is required*</span>');
    return false;
    }
    if (price.length < 1) {
    $('#price').after('<span class="error">Price is required*</span>');
    return false;
    }
    if (size.length < 1) {
    $('#size').after('<span class="error">Size is required*</span>');
    return false;
    }
    if (beadroom.length < 1) {
    $('#beadroom').after('<span class="error">Beadroom is required*</span>');
    return false;
    }
    if (bathroom.length < 1) {
    $('#bathroom').after('<span class="error">Bathroom is required*</span>');
    return false;
    }
    var purpose=$('#purpose');

    if(purpose.val() == 0)
    {
      $('#purpose').after('<span class="error">Select a Valid Purpose*</span>');
      return false; 
    }
    
    var propertytype=$('#propertytype');

    if(propertytype.val() == 0)
    {
      $('#propertytype').after('<span class="error">Select a Valid Property Type*</span>');
      return false; 
    }
    var status =$('#status');
    if(status.val() == 0)
    {
      $('#status').after('<span class="error">Select a Valid Status*</span>');
      return false; 
    }
    if (inp_htmlcode.length < 1) {
      $('#inp_htmlcode').after('<span class="error">This field is required*</span>');
      return false;
    }
    if (inp_htmlcode.length < 1) {
      $('#inp_htmlcode').after('<span class="error">This field is required*</span>');
      return false;
    }
    if (propertyFeatures.length < 1) {
      $('#propertyFeatures').after('<span class="error">This field is required*</span>');
      return false;
    }
    

    else{
      return true;
    }
     
    }

    function fileValidation() {
    $(".error").remove();
    var fileInput = document.getElementById('formFile');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if (!allowedExtensions.exec(filePath)) {
      $('#formFile').after('<span class="error"> Please upload file having extensions .jpeg/.jpg/.png/.gif only</span>');
      fileInput.value = '';
      return false;
    } else {
      //Image preview
      if (fileInput.files && fileInput.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
        };
        reader.readAsDataURL(fileInput.files[0]);
      }
    }
  }

  handleSubmit = () => {
    $(".error").remove();
    var spinner = $('.loader');
    spinner.show();
    var fileInput = document.getElementById('formFile').value;
    var files = $('#formFile')[0].files;
    let data = new FormData;
    data.append('file', files[0]);
    if (fileInput == '' || fileInput == null) {
      $('#formFile').after('<span class="error"> Please upload file having extensions .jpeg/.jpg/.png/.gif only</span>');
      spinner.hide();
      return false;
    } else {
      axios.post('{{ENV("APP_URL")}}/AddMedia', data).then((result) => {
        if (result.data != 0) {
          var imgurl = document.getElementById('imgurl').value;
          $("#resetbtn").trigger("click");
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
</script>

<script>
  function init() {
    var input = document.getElementById("address");
    var autocomplete = new google.maps.places.Autocomplete(input);
  }

  google.maps.event.addDomListener(window, "load", init);
</script>
@endsection