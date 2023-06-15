@extends('layouts/contentNavbarLayout')

@section('title', 'Boxicons - Icons')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('content')
<style>
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
.myImg
{
  height: 100px;
}
</style>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Media /</span> All Media
</h4>

<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Media Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12 mb-3">
              <label for="imgName" class="form-label">Name</label>
              <input type="text" id="imgName" class="form-control" placeholder="Enter Name">
              <input type="hidden" id="imgid" value="">
               <input type="hidden" id="getimgurl" value="">
            </div>
            <div class="col-12 mb-3">
                <label for="imgAlt" class="form-label">Alt</label>
                <input type="text" id="imgAlt" class="form-control" placeholder="Enter Alt">
              </div>
              <div class="col-12 mb-3">
                <label for="imgCaption" class="form-label">Caption</label>
                <input type="text" id="imgCaption" class="form-control" placeholder="Enter Caption">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger deactivate-account" onclick="deletedata()">Delete</button>
          <button type="button" class="btn btn-primary" onclick="updateImgDetail()">Save changes</button>
        </div>
      </div>
    </div>
  </div>
<form method="POST" action="{{url('upload-media')}}" enctype="multipart/form-data"  onsubmit="return handleSubmit()">
    @csrf
    <div class="row">
        <div class="mb-3 col-md-6">
            <input class="form-control" type="file" id="formFile" name="file" onchange="return fileValidation()">
        </div>
        <div class="mb-3 col-md-6">
            <button type="submit" class="btn btn-primary">Upload</button>
        </div>
    </div>
</form>

<!-- Icon container -->
<div class="d-flex flex-wrap" id="icons-container">
  @foreach($allData as $row)

  <div class="card icon-card cursor-pointer text-center  mb-4 mx-2">
      <img class="myImg" src="./media/images/{{$row->url}}" onclick="imgClick({{json_encode($row)}})" data-bs-toggle="modal" data-bs-target="#basicModal" />
      <div style="padding: 10px;">
{{$row->name}}
      
      </div>
  </div>

  @endforeach
</div>
<div class="loader"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
let selectedImgId = null;

function deletedata()
{
  let id=document.getElementById('imgid').value;
  let myurl=document.getElementById('getimgurl').value;
  let data = new FormData
  data.append('id',id);
  data.append('url',myurl);
  axios.post('{{ENV('APP_URL')}}/delete-imgDetails',data).then((result) => {
            $('#basicModal').modal('hide');
            location.reload();
        }).catch((err) => {
            console.log(err)
        });  
  
}
      updateImgDetail = () => {
           let imgName=document.getElementById('imgName').value;
           let imgAlt=document.getElementById('imgAlt').value;
           let imgCaption=document.getElementById('imgCaption').value;
           $(".error").remove();

          let data = new FormData
          data.append('id',selectedImgId);
          data.append('name',document.getElementById('imgName').value);
          data.append('alt',document.getElementById('imgAlt').value);
          data.append('caption',document.getElementById('imgCaption').value);
           if(imgName.length < 1)
           {
             $('#imgName').after('<span class="error">Image Name is Required*</span>');
             return false;
           }

            if(imgAlt.length < 1)
           {
             $('#imgAlt').after('<span class="error">Image Alt is Required*</span>');
             return false;
           }
            if(imgCaption.length < 1)
           {
             $('#imgCaption').after('<span class="error">Image Caption is Required*</span>');
             return false;
           }
       else{
        axios.post('{{ENV('APP_URL')}}/update-imgDetails',data).then((result) => {
            $('#basicModal').modal('hide');
            location.reload();
        }).catch((err) => {
            console.log(err)
        });  

       }
              
    }

    imgClick = (row) => {
      selectedImgId = row.id;
      document.getElementById('imgName').value = row.name;
      document.getElementById('imgAlt').value = row.alt;
      document.getElementById('imgid').value = row.id;
      document.getElementById('imgCaption').value = row.caption;
      document.getElementById('getimgurl').value = row.url;
    }

    handleSubmit = () =>{
      $(".error").remove();
      var spinner = $('.loader');
       spinner.show();
    var fileInput = document.getElementById('formFile').value;
    if( fileInput == '' || fileInput == null){
      $('#formFile').after('<span class="error"> Please upload file having extensions .jpeg/.jpg/.png/.gif only</span>');
      spinner.hide();
      return false;
    }else{
      return true;
      spinner.hide();
    }
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
</script>

@endsection
