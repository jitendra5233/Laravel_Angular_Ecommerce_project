@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

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
<script type="text/javascript" src='{{asset(' assets/richtexteditor/plugins/all_plugins.js')}}'></script>
<script type="text/javascript" src='{{asset(' assets/richtexteditor/rte-upload.js')}}'></script>
@section('content')
<style>
  .form-check-input[type=checkbox] {
    border: 1px solid #00000061;
  }

  .AceSelected {
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
    background: rgba(0, 0, 0, 0.75) url(images/loading2.gif) no-repeat center center;
    z-index: 10000;
  }
</style>
<!-- This model is use for popup images with caption div -->
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img id="modal-img" class="modal-content"
    src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQS2ol73JZj6-IqypxPZXYS3rRiPwKteoD8vezk9QsRdkjt3jEn&usqp=CAU">

  <div id="caption"></div>
</div>
<div class="loader"></div>
<!-- Basic Bootstrap Table -->
<div class="row" style="align-items: center;">
  <div class="col-6">

    <h4 class="fw-bold py-3" style="margin:0">
      <span class="text-muted fw-light">Project /</span> Property Type
    </h4>
  </div>
  <div class="col-6" style="text-align:end">
    <div class="py-3">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
        New Type
      </button>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="basicModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">New Type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input value="{{ENV('APP_URL')}}/media/images/" id="imgurl" type="hidden" />
          <div class="col mb-3">
            <label for="statusName" class="form-label">Name</label>
            <input type="text" id="statusName" class="form-control" placeholder="Enter Name">
          </div>
          <div class="mb-3 col-md-12">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#basicModal1">
              <span class="tf-icons bx bx-image"></span>&nbsp; Select Image
            </button>
            <input type="hidden" name="imgArr1" id="imgArr1" />
          </div>
          <div class="mb-3 col-md-6">
            <div class="demo-inline-spacing mt-3">
              <li class="list-group-item" id="selectname" style="display:none"> </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="handeSaveSatus()">Save</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="basicModal2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Edit Type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input value="{{ENV('APP_URL')}}/media/images/" id="imgurl" type="hidden" />
          <div class="col mb-3">
            <label for="statusName1" class="form-label">Name</label>
            <input type="text" id="statusName1" name="statusName" value="" class="form-control"
              placeholder="Enter Name">
          </div>
          <div class="mb-3 col-md-12">
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#basicModal22">
              <span class="tf-icons bx bx-image"></span>&nbsp; Select Image
            </button>
            <input type="hidden" name="imgArr1" value="" id="imgArr" />
            <input type="hidden" name="typeid" value="" id="typeid" />
          </div>
          <div class="mb-3 col-md-6">
            <div class="demo-inline-spacing mt-3">
              <li class="list-group-item" id="selectname1" style="display:none"> </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="handeSaveSatus1()">Save</button>
      </div>
    </div>
  </div>
</div>


<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header">Status</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>Image</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0" id="table">
        <?php
            $i = 1;
            $a=0;
        ?>
        @foreach($tableData as $row)
        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$i}}</strong></td>
          <td>{{$row->name}}</td>
          <td>
            <img widthg="50px" height="50px" id="myImg"
              src="{{ENV('APP_URL')}}/media/images/{{$PropertyImages[$a]->url}}">
          </td>

          <td>
            <button data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title=""
              type="button" class="btn btn-outline-secondry btn-sm"
              onclick="return EditItem({{$row->id}},'{{$row->name}}','{{$row->image}}')"><span
                class="tf-icons bx bx-edit"></span></button>
            <button data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title=""
              type="button" class="btn btn-outline-danger btn-sm" onclick="return deleteItem({{$row->id}})"><span
                class="tf-icons bx bx-trash"></span></button>
          </td>
        </tr>
        </button>
        <?php
            $i++;
            $a++;
        ?>
        @endforeach
      </tbody>
    </table>
  </div>
</div>






<!-- Modal -->
<div class="modal fade" id="basicModal1" tabindex="-1" aria-hidden="true">
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
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                  data-bs-target="#navs-top-home1" aria-controls="navs-top-home1" aria-selected="true">All
                  Images</button>
              </li>
              <li class="nav-item">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                  data-bs-target="#navs-top-profile1" aria-controls="navs-top-profile1" aria-selected="false">Upload
                  Image</button>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="navs-top-home1" role="tabpanel">
                <div class="modal-body">
                  <div class="d-flex flex-wrap mt-2 apendimg1" id="icons-container">
                    @foreach($media as $row)
                    <div class="card icon-card cursor-pointer text-center  mb-4 mx-2">
                      <img id="imgg{{$row->id}}" class="myImg1" src="{{ENV('APP_URL')}}/media/images/{{$row->url}}"
                        onclick="ImgClick1({{$row->id}},'{{$row->name}}')" />
                    </div>
                    @endforeach
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" onclick="handleImages1()">Save</button>
                </div>
              </div>
              <div class="tab-pane fade" id="navs-top-profile1" role="tabpanel">
                <div class="row">
                  <div class="mb-3 col-md-6">
                    <input class="form-control" type="file" id="formFile1" name="file1"
                      onchange="return fileValidation1()">
                  </div>
                  <div class="mb-3 col-md-6">
                    <button type="submit" class="btn btn-primary" onclick="handleSubmit1()">Upload</button>
                    <button id="resetbtn1" type="button" class="btn btn-primary" onclick="resetFile1()"> Reset
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

<div class="modal fade" id="basicModal22" tabindex="-1" aria-hidden="true">
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

<!--/ Basic Bootstrap Table -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
  // Get the image popup modal
  var modal = document.getElementById("myModal");
  var modalImg = document.getElementById("modal-img");
  var captionText = document.getElementById("caption");
  document.addEventListener("click", (e) => {
    const elem = e.target;
    if (elem.id === "myImg") {
      modal.style.display = "block";
      modalImg.src = elem.dataset.biggerSrc || elem.src;
      captionText.innerHTML = elem.alt;
    }
  })
  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];
  // When the user clicks on <span> (x), close the modal
  span.onclick = function () {
    modal.style.display = "none";
  }


</script>
<script>

  function resetFile1() {
    const file =
      document.querySelector('#formFile1');
    file.value = '';
  }

  function resetFile() {
    const file =
      document.querySelector('#formFile');
    file.value = '';
  }


  function ImgClick1(id, name) {
    let img = document.getElementById(`imgg${id}`)
    $('.AceSelected').removeClass('AceSelected');
    $(img).addClass("myImg1 AceSelected");
    document.getElementById('imgArr1').value = id;
    if (name != '') {
      $('#selectname').html(name);
      $('#selectname').show();
    }
    else {
      $('#selectname').html('Image');
      $('#selectname').show();
    }
  }
  function handleImages1() {
    $('#basicModal1').modal('hide');
    $('#basicModal').modal('show');
  }

  function fileValidation1() {
    $(".error").remove();
    var fileInput = document.getElementById('formFile1');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if (!allowedExtensions.exec(filePath)) {
      $('#formFile1').after('<span class="error"> Please upload file having extensions .jpeg/.jpg/.png/.gif only</span>');
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

  function handleImages() {
    $('#basicModal22').modal('hide');
    $('#basicModal2').modal('show');
  }



  function ImgClick(id, name) {
    let img = document.getElementById(`img${id}`)
    $('.AceSelected').removeClass('AceSelected');
    $(img).addClass("myImg AceSelected");
    document.getElementById('imgArr').value = id;
    if (name != '') {
      $('#selectname1').html(name);
      $('#selectname1').show();
    }
    else {
      $('#selectname1').html('Image');
      $('#selectname1').show();
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


  function fileValidation1() {
    $(".error").remove();
    var fileInput = document.getElementById('formFile1');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if (!allowedExtensions.exec(filePath)) {
      $('#formFile1').after('<span class="error"> Please upload file having extensions .jpeg/.jpg/.png/.gif only</span>');
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


  handleSubmit1 = () => {
    $(".error").remove();
    var spinner = $('.loader');
    spinner.show();
    var fileInput = document.getElementById('formFile1').value;
    var files = $('#formFile1')[0].files;
    let data = new FormData;
    data.append('file', files[0]);
    if (fileInput == '' || fileInput == null) {
      $('#formFile1').after('<span class="error"> Please upload file having extensions .jpeg/.jpg/.png/.gif only</span>');
      spinner.hide();
      return false;
    } else {
      axios.post('{{ENV("APP_URL")}}/AddMedia', data).then((result) => {
        if (result.data != 0) {
          var imgurl = document.getElementById('imgurl').value;
          $("#resetbtn1").trigger("click");
          spinner.hide();
          $('.apendimg1').append(`<div class="card icon-card cursor-pointer text-center  mb-4 mx-2">
      <img id="imgg${result.data[0].id}" class="myImg1" src="${imgurl}/${result.data[0].url}" onclick="ImgClick1(${result.data[0].id},'${result.data[0].name}')">
      </div>`);
        }
      }).catch((err) => {
        console.log(err);
        spinner.hide();
      });
    }
  }


  handeSaveSatus = () => {
    var spinner = $('.loader');
    spinner.show();
    let data = new FormData;
    data.append('name', document.getElementById('statusName').value);
    data.append('imgArr1', document.getElementById('imgArr1').value);
    let statusName = document.getElementById('statusName').value;
    let imgArr1 = document.getElementById('imgArr1').value;
    $(".error").remove();
    if (statusName.length < 1) {
      $('#statusName').after('<span class="error">Status Name is required*</span>');
      spinner.hide();
      return false;
    }
    if (imgArr1.length < 1) {
      $('#imgArr1').after('<span class="error">Image Selection is required*</span>');
      spinner.hide();
      return false;
    }

    else {
      axios.post('{{ENV("APP_URL")}}/SavePropertyType', data).then((result) => {
        if (result.data == 1) {
          spinner.hide();
          $('#basicModal').modal('hide');
          location.reload();

        }
      }).catch((err) => {
        $('#basicModal').modal('hide');
        console.log(err);
        spinnerr.hide();
      });
    }
  }


  EditItem = (id, name, image) => {
    document.getElementById('statusName1').value = name;
    document.getElementById('typeid').value = id;
    document.getElementById('imgArr').value = image;
    $('#basicModal2').modal('show');
  }

  handeSaveSatus1 = () => {
    let data = new FormData;
    data.append('name', document.getElementById('statusName1').value);
    data.append('imgArr1', document.getElementById('imgArr').value);
    data.append('id', document.getElementById('typeid').value);
    let statusName = document.getElementById('statusName1').value;
    let imgArr1 = document.getElementById('imgArr').value;

    $(".error").remove();
    if (statusName.length < 1) {
      $('#statusName1').after('<span class="error">Status Name is required*</span>');
      return false;
    }
    if (imgArr1.length < 1) {
      $('#imgArr').after('<span class="error">Image Selection is required*</span>');
      return false;
    }

    else {
      axios.post('{{ENV("APP_URL")}}/UpdatePropertyType', data).then((result) => {
        if (result.data == 1) {
          $('#basicModal2').modal('hide');
          location.reload();
        }
      }).catch((err) => {
        $('#basicModal2').modal('hide');
        console.log(err);

      });
    }
  }


  deleteItem = (id) => {
    let data = new FormData;
    data.append('id', id);

    axios.post('{{ENV("APP_URL")}}/DeletePropertyType', data).then((result) => {
      if (result.data == 1) {
        location.reload();
      }
    }).catch((err) => {
      console.log(err)
    });
  }
</script>

@endsection