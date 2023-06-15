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
    /* gallery css start */
    /* body {
  font-family: Arial, sans-serif;
  text-align: center;
  max-width: 1170px;
  margin: 3rem auto;
  background-color: #101010;
  color: #fff;
}

* { box-sizing: border-box } */

h1 {
  margin-bottom: 3rem;
}

.images {
  width: 100%;
  margin: 0 auto;
  height: 100%;
  display: grid;
  grid-gap: 5px;
  grid-template-columns: 50% 50%;
}

@media (min-width: 580px) {
  .images {
    grid-template-columns: 25% 25% 25% 25%;
  }
}
.template>img {
  height: 100%;
  width: 100%;
  max-width: 100%;
  max-height: 200px;
  vertical-align: middle;
}
.template {
  transition: all 0.8s cubic-bezier(0.455, 0.03, 0.515, 0.955);
  opacity: 0;
  position: relative;
  cursor: pointer;
  /* background: #707070; */
}

.template p {
  position: absolute;
  left: 0;
  bottom: 0;
  color: #fff;
  text-transform: uppercase;
  font-size: 13px;
  letter-spacing: 1px;
  margin: 0;
  width: 100%;
  background: linear-gradient(rgba(0,0,0,0), rgba(0,0,0,0.5));
  padding: 25px 10px 10px 10px;
}

.template.animate {
  transform: scale(1);
    opacity: 1;
}

#gallery-pagination {
  margin: 30px 0 0;
}

#btnNext,
#btnPrevious{
  background: transparent;
  color: #609ea5;
  padding: 8px 28px;
  border: 0;
  font-size: 18px;
  cursor: pointer;
  outline: none;
}

#gallery-pagination #page {
  margin-left: 15px;
  margin-right: 15px;
  color: #707070;
  font-style: italic;
  font-size: 13px
}

.sr-only {
  position: absolute !important;
  overflow: hidden;
  clip: rect(0 0 0 0);
  height: 1px;
  width: 1px;
  margin: -1px;
  padding: 0;
  border: 0;
}

#gallery-dots {
  margin-bottom: 15px
}

.gallery-dot {
  background: #609ea5;
  border:0;
  padding:0;
  width: 50px;
  height: 8px;
  margin: 5px;
  opacity: 0.4;
  outline: none;
  cursor: pointer;
}

.gallery-dot.active {
  opacity: 1;
}

#gallery-pagination {
  display: grid;
  grid-template-columns: 1fr 3fr 1fr;
  align-items: start;
}

.editButton{
  position: absolute;
  top:7;
  right:7;
  color: black;
  background: #ffffff87;
  padding: 3px 3px 3px 3px;
  border-radius: 10px;
}

.editButton{
  position: absolute;
  top:7;
  right:7;
  color: black;
  background: #ffffff87;
  padding: 3px 3px 3px 3px;
  border-radius: 10px;
}

.editButton:hover{
  /* background: aquamarine; */
  background: #048872;
  color: white;
}
.swal2-container.swal2-center.swal2-backdrop-show {
    z-index: 99999;
}

/* gallery css end */
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
{{-- <form method="POST" action="{{url('upload-media')}}" enctype="multipart/form-data"  onsubmit="return handleSubmit()"> --}}
    {{-- @csrf --}}
    <div class="row">
        <div class="mb-3 col-md-6">
                    <input class="form-control" type="file" id="formFile" name="file"
                      onchange="return fileValidation()">
        </div>
        <div class="mb-3 col-md-6">
            <button type="submit" class="btn btn-primary" onclick="handleSubmit()">Upload</button>
        </div>
    </div>
{{-- </form> --}}

<!-- Icon container -->
{{-- <div class="d-flex flex-wrap" id="icons-container">
  @foreach($allData as $row)

  <div class="card icon-card cursor-pointer text-center  mb-4 mx-2">
      <img class="myImg" src="./media/images/{{$row->url}}" onclick="imgClick({{json_encode($row)}})" data-bs-toggle="modal" data-bs-target="#basicModal" />
      <div style="padding: 10px;">
{{$row->name}}
      
      </div>
  </div>

  @endforeach
</div> --}}
<div class="gallery" style="text-align: center">
  <main id="image-gallery" class="images"></main>
  <footer id="gallery-pagination">
    <button id="btnPrevious">&larr; <span class="sr-only">Previous</span></button>
    <div>
      <div id="gallery-dots"></div>
      <span id="page"></span>
    </div>
    <button id="btnNext"><span class="sr-only">Next </span>&rarr;</button>
  </footer>
</div>
<div class="loader"></div>
<input type="hidden" id="imglist" value="{{$allData}}" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
let selectedImgId = null;

var previous = document.getElementById('btnPrevious')
var next = document.getElementById('btnNext')
var gallery = document.getElementById('image-gallery')
var pageIndicator = document.getElementById('page')
var galleryDots = document.getElementById('gallery-dots');

var images = [];
var images2 = JSON.parse(document.getElementById('imglist').value);
// for (var i = 0; i < 36; i++) {
  // images.push({
  //   title: "Image " + (i + 1),
  //   source: "https://picsum.photos/500/500?random&img=" + i
  // });
// }


images2.map(x =>{
  if(x.alt != 'no image'){
    if(x.active == 'true'){
      images.push({
        id:x.id,
        title: x.name,
        source: `{{ENV('APP_URL')}}/media/images/${x.url}`,
        active: x.active == 'true' ? 'true' : 'false'
      });
    }
  }
})

images2.map(x =>{
  if(x.alt != 'no image'){
    if(x.active != 'true'){
      images.push({
        id:x.id,
        title: x.name,
        source: `{{ENV('APP_URL')}}/media/images/${x.url}`,
        active: x.active == 'true' ? 'true' : 'false'
      });
    }
  }
})

var perPage = 8;
var page = 1;
var pages = Math.ceil(images.length / perPage)


// Gallery dots
for (var i = 0; i < pages; i++){
  var dot = document.createElement('button')
  var dotSpan = document.createElement('span')
  var dotNumber = document.createTextNode(i + 1)
  dot.classList.add('gallery-dot');
  dot.setAttribute('data-index', i);
  dotSpan.classList.add('sr-only');
  
  dotSpan.appendChild(dotNumber);
  dot.appendChild(dotSpan)
  
  dot.addEventListener('click', function(e) {
    var self = e.target
    goToPage(self.getAttribute('data-index'))
  })
  
  galleryDots.appendChild(dot)
}

// Previous Button
previous.addEventListener('click', function() {
  if (page === 1) {
    page = 1;
  } else {
    page--;
    showImages();
  }
})

// Next Button
next.addEventListener('click', function() {
  if (page < pages) {
    page++;
    showImages();
  }
})

// Jump to page
function goToPage(index) {
  index = parseInt(index);
  page =  index + 1;
  
  showImages();
}


// Load images
function showImages() {

  // console.log(images2);

  while(gallery.firstChild) gallery.removeChild(gallery.firstChild)
  
  var offset = (page - 1) * perPage;
  var dots = document.querySelectorAll('.gallery-dot');
  
  for (var i = 0; i < dots.length; i++){
    dots[i].classList.remove('active');
  }
  
  dots[page - 1].classList.add('active');
  
  for (var i = offset; i < offset + perPage; i++) {
    if ( images[i] ) {
      var template = document.createElement('div');
      var title = document.createElement('p');
      var button = document.createElement('button');
      // var icon = document.createElement('i');
      var t = document.createTextNode("edit");
      var titleText = document.createTextNode(images[i].title);
      var img = document.createElement('img');
      
      template.classList.add('template')
      // icon.classList.add(`editButton`)
      // icon.classList.add(`bx`)
      // icon.classList.add(`bxs-edit`)
      button.classList.add('editButton')
      button.appendChild(t);
      
      img.classList.add('myImg') 
      
      if(images[i].active == 'true'){
        img.classList.add('AceSelected') 
      }

      img.setAttribute("src", images[i].source);
      img.setAttribute('alt', images[i].title);
      img.setAttribute('id', `img${images[i].id}`);
      img.setAttribute('onclick', `ButtonClick(${images[i].id},'${images[i].title}')`);
      title.setAttribute('onclick', `ButtonClick(${images[i].id},'${images[i].title}')`);
      // icon.setAttribute('onclick', `ButtonClick(${images[i].id},'${images[i].title}')`);

      title.appendChild(titleText);
      template.appendChild(img);
      template.appendChild(title);
      // template.appendChild(icon);
      gallery.appendChild(template);      
    }
  }
  
  // Animate images
  var galleryItems = document.querySelectorAll('.template')
  for (var i = 0; i < galleryItems.length; i++) {
    var onAnimateItemIn = animateItemIn(i);
    setTimeout(onAnimateItemIn, i * 100);
  }
  
  function animateItemIn(i) {
    var item = galleryItems[i];
    return function() {
      item.classList.add('animate');
    }
  }
  
  // Update page indicator
  pageIndicator.textContent = "Page " + page + " of " + pages;
  
}

showImages();

function ButtonClick(id,name){
  images2.map(x =>{
    if(x.id == id){
      document.getElementById('imgName').value = name;
      document.getElementById('imgAlt').value = x.alt;
      document.getElementById('imgid').value = id;
      document.getElementById('imgCaption').value = x.caption;
      document.getElementById('getimgurl').value = x.url;
    }
  })
  $('#basicModal').modal('show');
}


   function deletedata() {

      let id = document.getElementById('imgid').value;

      images = images.filter(x => x.id != id)

      showImages();

    Swal.fire({
      title: 'Do you want to delete it?',
      showCancelButton: true,
      confirmButtonText: 'Delete',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.value) {
      let id=document.getElementById('imgid').value;
      let myurl=document.getElementById('getimgurl').value;
      let data = new FormData
      data.append('id',id);
      data.append('url',myurl);

        axios.post('{{ENV("APP_URL")}}/delete-imgDetails',data).then((result) => {
          if(result.data == 1){
            images = images.filter(x => x.id != id)
            showImages();
            $('#basicModal').modal('hide');
            Swal.fire('Media Deleted!', '', 'success').then((result) => {     
            });
          }
        }).catch((err) => {
          console.log(err)
        });
      }
    })
    }
      updateImgDetail = () => {
           let id = document.getElementById('imgid').value
           let imgName=document.getElementById('imgName').value;
           let imgAlt=document.getElementById('imgAlt').value;
           let imgCaption=document.getElementById('imgCaption').value;
           $(".error").remove();

          let data = new FormData
          data.append('id',document.getElementById('imgid').value);
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
            // location.reload();
            images.map(x => {
              if(x.id == id){
                x.title = imgName
              }
            })
            images2.map(x => {
              if(x.id == id){
                x.name = imgName
                x.alt = imgAlt
                x.caption = imgCaption
              }
            })
            showImages();
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
          let newImg = result.data[0]

          for(let i = 0; i< images.length;i++){
            if(images[i].active == 'false'){           
              images.splice(i, 0, {
                id: newImg.id,
                title: newImg.name,
                source: `{{ENV('APP_URL')}}/media/images/${newImg.url}`,
                active: 'false'
              });
              break;
            }
          }

          showImages();
          // Swal.fire({
          //   position: 'top-end',
          //   type: 'success',
          //   title: 'Image Uploaded',
          //   showConfirmButton: false,
          //   timer: 1500
          // })
          Swal.fire(
            'Thankyou!',
            'Media Added Successfully !',
            'success',
          )
          $("#showAllImages").trigger("click");
          document.getElementById('formFile').value='';
          // $('.apendimg').append(`<div class="card icon-card cursor-pointer text-center  mb-4 mx-2">
          // <img id="img${result.data[0].id}" class="myImg" src="${imgurl}/${result.data[0].url}" onclick="ImgClick(${result.data[0].id},'${result.data[0].name}')">
          // </div>`);
          spinner.hide();
        }
      }).catch((err) => {
        console.log(err);
      });
    }
  }

//     handleSubmit = () =>{
//       $(".error").remove();
//       var spinner = $('.loader');
//        spinner.show();
//     var fileInput = document.getElementById('formFile').value;
//     if( fileInput == '' || fileInput == null){
//       $('#formFile').after('<span class="error"> Please upload file having extensions .jpeg/.jpg/.png/.gif only</span>');
//       spinner.hide();
//       return false;
//     }else{
//     spinner.hide();
//      Swal.fire(
//             'Thankyou!',
//             'Media Added Successfully !',
//             'success',
//             )
//       return true;
//     }
// }
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
