@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Property')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

<link rel="stylesheet" href="{{asset('assets/richtexteditor/rte_theme_default.css')}}" />
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />-->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<script type="text/javascript" src="{{asset('assets/richtexteditor/rte.js')}}"></script>
<script type="text/javascript" src='{{asset('assets/richtexteditor/plugins/all_plugins.js')}}'></script>
<script type="text/javascript" src='{{asset('assets/richtexteditor/rte-upload.js')}}'></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoyZ_yVsI5N8KhjbWRyQeme1Pfz2DRYYc&libraries=places&callback=initAutocomplete"></script>


<style>

  .loader {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(0,0,0,0.75) url(../images/loading2.gif) no-repeat center center;
  z-index: 10000;
}
  .AceSelected{
    border: 4px solid #04917a;
    padding: 2px;
  }
   #ammIcon
  {
    font-family: fontAwesome;
    font-size: 12px;
    font-weight: 100;
  }
  .pac-container {
        z-index: 10000 !important;
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
  height: 120px;
  width: 150px;
  max-width: 100%;
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
.swal2-container.swal2-center.swal2-shown {
  z-index: 99999;
}
.swal2-container.swal2-top-end.swal2-shown {
  z-index: 99999;
}
.swal2-container.swal2-center.swal2-backdrop-show {
    z-index: 9999;
}

.swal2-container.swal2-top-end.swal2-backdrop-show {
    z-index: 9999;
}

/* gallery css end */
</style>

@section('content')
<div class="loader"></div>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Damac Lagoons / Venice /</span> Edit Property
</h4>

<div class="row">
  <?php
    foreach(json_decode($property->images) as $id){
      foreach($media as $m){
        if($m->id == $id){
          $m['active'] = 'true';
        }
      }
    }
  ?>
    <div class="card mb-4">
      <h5 class="card-header">Property Details</h5>
      <!-- Account -->
      <div class="card-body">
        <form action="{{ENV('APP_URL')}}/updateproperty" method="post"  onsubmit="return checkvalidate()">
            @csrf
          <div class="row">
            <?php
              $nearby = json_decode($property->nearbyJson);
            ?>
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
                    <label for="title" class="form-label">Page Title</label>
                    <input class="form-control" type="text" id="page_title" name="page_title"  value="{{$property->page_title}}" />
                  </div>
                     <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Description</label>
                    <textarea id="page_description" name="page_description" class="form-control">{{$property->page_description}}</textarea>
                  </div>     
                  
                   <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Schema Json</label>
                    <textarea id="page_schema" name="page_schema" class="form-control">{{$property->page_schema}}</textarea>
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
            <div class="mb-3 col-md-12">
              <input type="hidden" name="nearByJson" id="nearByJson" value="{{$property->nearbyJson}}" />
              <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#basicModal3">
                <span class="tf-icons bx bx-map"></span>&nbsp; Add Near By Places
              </button>
            </div>
            <div class="mb-3 col-md-12">
              <input type="hidden" name="ameneties" id="ameneties" value="{{$property->ameneties}}" />
              <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#basicModal4">
                <span class="tf-icons bx bx-map"></span>&nbsp; Add Ameneties
              </button>
            </div>
            <div class="mb-3 col-md-12">
              @if($property->imgType != 'url')
               <input type="hidden" name="imgArr" id="imgArr" value="{{$property->images}}"/>
              @endif
              @if($property->imgType == 'url')
               <input type="hidden" name="imgArr" id="imgArr" value="[]"/>
              @endif
              <input type="hidden" name="imgType" id="imgType" value="{{$property->imgType}}"/>
              <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                <span class="tf-icons bx bx-image"></span>&nbsp; Select Images
              </button>
            </div>
            <div class="mb-3 col-md-6">
              <div class="demo-inline-spacing mt-3">
                <ol class="list-group list-group-numbered" id="selectname1">
                  @foreach($media as $m)
                    @if($m->active == 'true')
                      @if($m->name != '')
                        <li class="list-group-item">{{$m->name}}</li>
                      @endif
                      @if($m->name == '')
                        <li class="list-group-item">Image</li>
                      @endif
                    @endif
                  @endforeach
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
                <button id='showAllImages' type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
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
                  {{-- <div class="d-flex flex-wrap mt-2 apendimg" id="icons-container">
                    @foreach($media as $row)
                    <div class="card icon-card cursor-pointer text-center  mb-4 mx-2">
                      <img id="img{{$row->id}}" class="myImg <?php #echo $row->active == 'true' ? 'AceSelected' :'' ; ?>" src="{{ENV('APP_URL')}}/media/images/{{$row->url}}"
                        onclick="ImgClick({{$row->id}},'{{$row->name}}')" />
                    </div>
                    @endforeach
                  </div> --}}
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

<div class="modal fade" id="updateImage" tabindex="-1" aria-hidden="true">
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

<input type="hidden" id="imglist" value="{{$media}}" />


<script>
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
      var icon = document.createElement('i');
      var t = document.createTextNode("edit");
      var titleText = document.createTextNode(images[i].title);
      var img = document.createElement('img');
      
      template.classList.add('template')
      icon.classList.add(`editButton`)
      icon.classList.add(`bx`)
      icon.classList.add(`bxs-edit`)
      button.classList.add('editButton')
      button.appendChild(t);
      
      img.classList.add('myImg') 
      
      if(images[i].active == 'true'){
        img.classList.add('AceSelected') 
      }

      img.setAttribute("src", images[i].source);
      img.setAttribute('alt', images[i].title);
      img.setAttribute('id', `img${images[i].id}`);
      img.setAttribute('onclick', `ImgClick(${images[i].id},'${images[i].title}')`);
      title.setAttribute('onclick', `ImgClick(${images[i].id},'${images[i].title}')`);
      icon.setAttribute('onclick', `ButtonClick(${images[i].id},'${images[i].title}')`);

      title.appendChild(titleText);
      template.appendChild(img);
      template.appendChild(title);
      template.appendChild(icon);
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
  $('#updateImage').modal('show');
}

updateImgDetail = () => {
      let id = document.getElementById('imgid').value
      let imgName = document.getElementById('imgName').value;
      let imgAlt = document.getElementById('imgAlt').value;
      let imgCaption = document.getElementById('imgCaption').value;

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
            $('#updateImage').modal('hide');
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
            $('#updateImage').modal('hide');
            Swal.fire('Media Deleted!', '', 'success').then((result) => {     
            });
          }
        }).catch((err) => {
          console.log(err)
        });
      }
    })
    }
</script>

@if($nearby != '')
<div class="modal fade" id="basicModal3" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel22">Near By Location</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      @foreach($nearby as $row)
      <div class="row" style="width: 100%;align-items: flex-end;">
        <div class="col-12 mx-3 my-2">
          <label for="categoryName{{$row->id}}" class="form-label">Category Name</label>
          <input value="{{$row->name}}" type="text" id="categoryName{{$row->id}}" name="categoryName{{$row->id}}" class="form-control" placeholder="Category Name" onchange="updateText('categoryName{{$row->id}}',{{$row->id}})" />
        </div>
        <div class="col-6 mx-3 my-2">
          <label for="placeName{{$row->id}}" class="form-label">Place Name</label>
          <div style="display: flex">
            <input type="text" id="placeName{{$row->id}}" name="placeName{{$row->id}}" class="form-control" placeholder="Place Name" />
            <button class="btn btn-primary mx-2" onclick="addPlaceNameArg(`{{$row->id}}`)">Add</button>
          </div>
          <div class="my-3">
            <ol class="list-group list-group-numbered" id="selectname2{{$row->id}}">
              @foreach($row->places as $row2)
              <li class="list-group-item" style="display: flex;" id="loc{{$row->id}}{{$row2->id}}">
                  <div>
                    {{$row2->name}}
                  </div>
                  <i class="fa-trash fa-fw fa-solid" style="cursor: pointer" onclick="deleteItemloc('{{$row->id}}','{{$row2->id}}')"></i>
              </li>
              @endforeach
            </ol>
          </div>
        </div>
      </div>
      <script>
          var input3 = document.getElementById('placeName{{$row->id}}');
          var autocomplete3 = new google.maps.places.Autocomplete(input3);
      </script>
      @endforeach
      <div id="newCategorydiv"></div>
      <div class="col-12 mx-3 my-2">
        <button class="btn btn-primary mx-2" onclick="appendCategory()">Add New</button>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="saveNearbyPlace()">Save</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
let categoryCount = {{$row->id + 1}} ;

var jsonData = JSON.parse(document.getElementById('nearByJson').value);

deleteItemloc = (pid,cid) =>{

  console.log(jsonData)
  
  jsonData.map(x => {
    if(x.id == pid){
      x.places = x.places.filter(y => y.id != cid)
    }
  })

  console.log(jsonData)

  document.getElementById('nearByJson').value = JSON.stringify(jsonData);
  document.getElementById(`loc${pid}${cid}`).remove();
}

appendCategory = () =>{

  let divContent = `
  <div class="row" style="width: 100%;align-items: flex-end;">
  <div class="col-12 mx-3 my-2">
    <label for="categoryName${categoryCount}" class="form-label">Category Name</label>
    <input type="text" id="categoryName${categoryCount}" name="categoryName${categoryCount}" class="form-control" placeholder="Category Name">
  </div>
  <div class="col-6 mx-3 my-2">
    <label for="placeName${categoryCount}" class="form-label">Place Name</label>
    <div style="display: flex">
      <input type="text" id="placeName${categoryCount}" name="placeName${categoryCount}" class="form-control" placeholder="Place Name">
      <button class="btn btn-primary mx-2" onclick="addPlaceNameArg(${categoryCount})">Add</button>
    </div>
    <div class="my-3">
      <ol class="list-group list-group-numbered" id="selectname2${categoryCount}">
      </ol>
    </div>
  </div>
</div>
  `;
  $('#newCategorydiv').append(divContent);
  
  jsonData.push({
    id:jsonData.length,
    name:'',
    places:[]
  })


  var input3 = document.getElementById(`placeName${categoryCount}`);
  var autocomplete3 = new google.maps.places.Autocomplete(input3);

  autocomplete3.addListener('place_changed', function() {
    var place = autocomplete3.getPlace();
    lat = place.geometry.location.lat();
    lng = place.geometry.location.lng();
  });
  
  categoryCount++;
  console.log(jsonData)
}

function updateText(id,no){
 let text =  document.getElementById(id).value;
  console.log(no)
  jsonData[no].name = text;
  console.log(jsonData)
}

function addPlaceNameA(){
    if( jsonData == 'undefined'){
       jsonData =  [{
          id:0,
          name:'',
          places:[]
        }];
    }
       let categoryName = document.getElementById('categoryName').value;
    let placeName = document.getElementById('placeName').value;
    
    jsonData[0].name = categoryName;
    
    $('#selectname2').append(`<li class="list-group-item">${placeName}</li>`);

    document.getElementById('placeName').value = '';

    jsonData[0].places.push({id:jsonData[0].places.length+1,name:placeName,lat,lng})
}

  addPlaceName = (id) =>{
    let categoryName = document.getElementById('categoryName').value;
    let placeName = document.getElementById(id).value;
    
    jsonData[0].name = categoryName;
    
    $('#selectname2').append(`<li class="list-group-item">${placeName}</li>`);

    document.getElementById(id).value = '';

    jsonData[0].places.push({id:jsonData[0].places.length+1,name:placeName,lat,lng})

  }

  addPlaceNameArg = (no) =>{
    console.log(`categoryName${no}`)
    let categoryName = document.getElementById(`categoryName${no}`).value;
    let placeName = document.getElementById(`placeName${no}`).value;
    
    jsonData[no].name = categoryName;
    
    $(`#selectname2${no}`).append(`<li class="list-group-item">${placeName}</li>`);

    document.getElementById(`placeName${no}`).value = '';

    let lastPlaceID = jsonData[no].places.length - 1

    if(jsonData[no].places.length != 0){
      let newId = jsonData[no].places[lastPlaceID].id + 1 ; 
      jsonData[no].places.push({id:newId,name:placeName,lat,lng})
    }else{
      jsonData[no].places.push({id:1,name:placeName,lat,lng})
    }
  }


  saveNearbyPlace = () => {
    let nearByJson = document.getElementById('nearByJson').value
    nearByJson = JSON.parse(nearByJson);
    document.getElementById('nearByJson').value = JSON.stringify(jsonData)
    $('#basicModal3').modal('hide');
  }
</script>
@endif
@if($nearby == '')
<div class="modal fade" id="basicModal3" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel22">Near By Location</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="row" style="width: 100%;align-items: flex-end;">
        <div class="col-12 mx-3 my-2">
          <label for="categoryName" class="form-label">Category Name</label>
          <input type="text" id="categoryName" name="categoryName" class="form-control" placeholder="Category Name">
        </div>
        <div class="col-6 mx-3 my-2">
          <label for="placeName" class="form-label">Place Name</label>
          <div style="display: flex">
            <input type="text" id="placeName" name="placeName" class="form-control" placeholder="Place Name">
            <button class="btn btn-primary mx-2" onclick="addPlaceName()">Add</button>
          </div>
          <div class="my-3">
            <ol class="list-group list-group-numbered" id="selectname2">
            </ol>
          </div>
        </div>
      </div>
      <div id="newCategorydiv"></div>
      <div class="col-12 mx-3 my-2">
        <button class="btn btn-primary mx-2" onclick="appendCategory()">Add New</button>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="saveNearbyPlace()">Save</button>
        </div>
      </div>
    </div>
  </div>
</div>


<script>

let categoryCount = 1;

let jsonData = [{
  id:0,
  name:'',
  places:[]
}];

appendCategory = () =>{
  let divContent = `
  <div class="row" style="width: 100%;align-items: flex-end;">
  <div class="col-12 mx-3 my-2">
    <label for="categoryName${categoryCount}" class="form-label">Category Name</label>
    <input type="text" id="categoryName${categoryCount}" name="categoryName${categoryCount}" class="form-control" placeholder="Category Name">
  </div>
  <div class="col-6 mx-3 my-2">
    <label for="placeName${categoryCount}" class="form-label">Place Name</label>
    <div style="display: flex">
      <input type="text" id="placeName${categoryCount}" name="placeName${categoryCount}" class="form-control" placeholder="Place Name">
      <button class="btn btn-primary mx-2" onclick="addPlaceNameArg(${categoryCount})">Add</button>
    </div>
    <div class="my-3">
      <ol class="list-group list-group-numbered" id="selectname2${categoryCount}">
      </ol>
    </div>
  </div>
</div>
  `;
  $('#newCategorydiv').append(divContent);
  
  jsonData.push({
    id:jsonData.length,
    name:'',
    places:[]
  })

  var input3 = document.getElementById(`placeName${categoryCount}`);
  var autocomplete3 = new google.maps.places.Autocomplete(input3);

  autocomplete3.addListener('place_changed', function() {
    var place = autocomplete3.getPlace();
    lat = place.geometry.location.lat();
    lng = place.geometry.location.lng();
  });
  
  categoryCount++;
  console.log(jsonData)
}


  addPlaceName = () =>{
    let categoryName = document.getElementById('categoryName').value;
    let placeName = document.getElementById('placeName').value;
    
    jsonData[0].name = categoryName;
    
    $('#selectname2').append(`<li class="list-group-item">${placeName}</li>`);

    document.getElementById('placeName').value = '';

    jsonData[0].places.push({id:jsonData[0].places.length+1,name:placeName,lat,lng})

  }

  addPlaceNameArg = (no) =>{
    let categoryName = document.getElementById(`categoryName${no}`).value;
    let placeName = document.getElementById(`placeName${no}`).value;
    
    jsonData[no].name = categoryName;
    
    $(`#selectname2${no}`).append(`<li class="list-group-item">${placeName}</li>`);

    document.getElementById(`placeName${no}`).value = '';

    jsonData[no].places.push({id:jsonData[0].places.length+1,name:placeName,lat,lng})
  }


  saveNearbyPlace = () => {
    document.getElementById('nearByJson').value = JSON.stringify(jsonData)
    $('#basicModal3').modal('hide');
  }

</script>
@endif

@if($property->ameneties != '')
<div class="modal fade" id="basicModal4" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel22">Ameneties</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="row my-2" style="width: 100%;align-items: flex-end;">
        <div class="col-3 mx-3 my-2">
          <label for="amIcon" class="form-label">Icon</label>
          {{-- <input type="text" id="amIcon" name="amIcon" class="form-control" placeholder="Icon"> --}}
        
<select class="form-select" id="ammIcon" name="amIcon">
    <option value="0">Select Icon</option>
    <option value='fab fa-500px'>&#xf26e; 500px</option>
<option value='fa-address-book'>&#xf2b9; address-book</option>
<option value='fa-address-book-o'>&#xf2ba; address-book-o</option>
<option value='fa-address-card'>&#xf2bb; address-card</option>
<option value='fa-address-card-o'>&#xf2bc; address-card-o</option>
<option value='fa-adjust'>&#xf042; adjust</option>
<option value='fab fa-adn'>&#xf170; adn</option>
<option value='fa-align-center'>&#xf037; align-center</option>
<option value='fa-align-justify'>&#xf039; align-justify</option>
<option value='fa-align-left'>&#xf036; align-left</option>
<option value='fa-align-right'>&#xf038; align-right</option>
<option value='fab fa-amazon'>&#xf270; amazon</option>
<option value='fa-ambulance'>&#xf0f9; ambulance</option>
<option value='fa-american-sign-language-interpreting'>&#xf2a3; american-sign-language-interpreting</option>
<option value='fa-anchor'>&#xf13d; anchor</option>
<option value='fa-android'>&#xf17b; android</option>
<option value='fa-angellist'>&#xf209; angellist</option>
<option value='fa-angle-double-down'>&#xf103; angle-double-down</option>
<option value='fa-angle-double-left'>&#xf100; angle-double-left</option>
<option value='fa-angle-double-right'>&#xf101; angle-double-right</option>
<option value='fa-angle-double-up'>&#xf102; angle-double-up</option>
<option value='fa-angle-down'>&#xf107; angle-down</option>
<option value='fa-angle-left'>&#xf104; angle-left</option>
<option value='fa-angle-right'>&#xf105; angle-right</option>
<option value='fa-angle-up'>&#xf106; angle-up</option>
<option value='fa-apple'>&#xf179; apple</option>
<option value='fa-archive'>&#xf187; archive</option>
<option value='fa-area-chart'>&#xf1fe; area-chart</option>
<option value='fa-arrow-circle-down'>&#xf0ab; arrow-circle-down</option>
<option value='fa-arrow-circle-left'>&#xf0a8; arrow-circle-left</option>
<option value='fa-arrow-circle-o-down'>&#xf01a; arrow-circle-o-down</option>
<option value='fa-arrow-circle-o-left'>&#xf190; arrow-circle-o-left</option>
<option value='fa-arrow-circle-o-right'>&#xf18e; arrow-circle-o-right</option>
<option value='fa-arrow-circle-o-up'>&#xf01b; arrow-circle-o-up</option>
<option value='fa-arrow-circle-right'>&#xf0a9; arrow-circle-right</option>
<option value='fa-arrow-circle-up'>&#xf0aa; arrow-circle-up</option>
<option value='fa-arrow-down'>&#xf063; arrow-down</option>
<option value='fa-arrow-left'>&#xf060; arrow-left</option>
<option value='fa-arrow-right'>&#xf061; arrow-right</option>
<option value='fa-arrow-up'>&#xf062; arrow-up</option>
<option value='fa-arrows'>&#xf047; arrows</option>
<option value='fa-arrows-alt'>&#xf0b2; arrows-alt</option>
<option value='fa-arrows-h'>&#xf07e; arrows-h</option>
<option value='fa-arrows-v'>&#xf07d; arrows-v</option>
<option value='fa-asl-interpreting'>&#xf2a3; asl-interpreting</option>
<option value='fa-assistive-listening-systems'>&#xf2a2; assistive-listening-systems</option>
<option value='fa-asterisk'>&#xf069; asterisk</option>
<option value='fa-at'>&#xf1fa; at</option>
<option value='fa-audio-description'>&#xf29e; audio-description</option>
<option value='fa-automobile'>&#xf1b9; automobile</option>
<option value='fa-backward'>&#xf04a; backward</option>
<option value='fa-balance-scale'>&#xf24e; balance-scale</option>
<option value='fa-ban'>&#xf05e; ban</option>
<option value='fa-bandcamp'>&#xf2d5; bandcamp</option>
<option value='fa-bank'>&#xf19c; bank</option>
<option value='fa-bar-chart'>&#xf080; bar-chart</option>
<option value='fa-bar-chart-o'>&#xf080; bar-chart-o</option>
<option value='fa-barcode'>&#xf02a; barcode</option>
<option value='fa-bars'>&#xf0c9; bars</option>
<option value='fa-bath'>&#xf2cd; bath</option>
<option value='fa-bathtub'>&#xf2cd; bathtub</option>
<option value='fa-battery'>&#xf240; battery</option>
<option value='fa-battery-0'>&#xf244; battery-0</option>
<option value='fa-battery-1'>&#xf243; battery-1</option>
<option value='fa-battery-2'>&#xf242; battery-2</option>
<option value='fa-battery-3'>&#xf241; battery-3</option>
<option value='fa-battery-4'>&#xf240; battery-4</option>
<option value='fa-battery-empty'>&#xf244; battery-empty</option>
<option value='fa-battery-full'>&#xf240; battery-full</option>
<option value='fa-battery-half'>&#xf242; battery-half</option>
<option value='fa-battery-quarter'>&#xf243; battery-quarter</option>
<option value='fa-battery-three-quarters'>&#xf241; battery-three-quarters</option>
<option value='fa-bed'>&#xf236; bed</option>
<option value='fa-beer'>&#xf0fc; beer</option>
<option value='fa-behance'>&#xf1b4; behance</option>
<option value='fa-behance-square'>&#xf1b5; behance-square</option>
<option value='fa-bell'>&#xf0f3; bell</option>
<option value='fa-bell-o'>&#xf0a2; bell-o</option>
<option value='fa-bell-slash'>&#xf1f6; bell-slash</option>
<option value='fa-bell-slash-o'>&#xf1f7; bell-slash-o</option>
<option value='fa-bicycle'>&#xf206; bicycle</option>
<option value='fa-binoculars'>&#xf1e5; binoculars</option>
<option value='fa-birthday-cake'>&#xf1fd; birthday-cake</option>
<option value='fab fa-bitbucket'>&#xf171; bitbucket</option>
<option value='fab fa-bitbucket-square'>&#xf172; bitbucket-square</option>
<option value='fab fa-bitcoin'>&#xf15a; bitcoin</option>
<option value='fab fa-black-tie'>&#xf27e; black-tie</option>
<option value='fab fa-blind'>&#xf29d; blind</option>
<option value='fab fa-bluetooth'>&#xf293; bluetooth</option>
<option value='fab fa-bluetooth-b'>&#xf294; bluetooth-b</option>
<option value='fa-bold'>&#xf032; bold</option>
<option value='fa-bolt'>&#xf0e7; bolt</option>
<option value='fa-bomb'>&#xf1e2; bomb</option>
<option value='fa-book'>&#xf02d; book</option>
<option value='fa-bookmark'>&#xf02e; bookmark</option>
<option value='fa-bookmark-o'>&#xf097; bookmark-o</option>
<option value='fa-braille'>&#xf2a1; braille</option>
<option value='fa-briefcase'>&#xf0b1; briefcase</option>
<option value='fa-btc'>&#xf15a; btc</option>
<option value='fa-bug'>&#xf188; bug</option>
<option value='fa-building'>&#xf1ad; building</option>
<option value='fa-building-o'>&#xf0f7; building-o</option>
<option value='fa-bullhorn'>&#xf0a1; bullhorn</option>
<option value='fa-bullseye'>&#xf140; bullseye</option>
<option value='fa-bus'>&#xf207; bus</option>
<option value='fa-buysellads'>&#xf20d; buysellads</option>
<option value='fa-cab'>&#xf1ba; cab</option>
<option value='fa-calculator'>&#xf1ec; calculator</option>
<option value='fa-calendar'>&#xf073; calendar</option>
<option value='fa-calendar-check-o'>&#xf274; calendar-check-o</option>
<option value='fa-calendar-minus-o'>&#xf272; calendar-minus-o</option>
<option value='fa-calendar-o'>&#xf133; calendar-o</option>
<option value='fa-calendar-plus-o'>&#xf271; calendar-plus-o</option>
<option value='fa-calendar-times-o'>&#xf273; calendar-times-o</option>
<option value='fa-camera'>&#xf030; camera</option>
<option value='fa-camera-retro'>&#xf083; camera-retro</option>
<option value='fa-car'>&#xf1b9; car</option>
<option value='fa-caret-down'>&#xf0d7; caret-down</option>
<option value='fa-caret-left'>&#xf0d9; caret-left</option>
<option value='fa-caret-right'>&#xf0da; caret-right</option>
<option value='fa-caret-square-o-down'>&#xf150; caret-square-o-down</option>
<option value='fa-caret-square-o-left'>&#xf191; caret-square-o-left</option>
<option value='fa-caret-square-o-right'>&#xf152; caret-square-o-right</option>
<option value='fa-caret-square-o-up'>&#xf151; caret-square-o-up</option>
<option value='fa-caret-up'>&#xf0d8; caret-up</option>
<option value='fa-cart-arrow-down'>&#xf218; cart-arrow-down</option>
<option value='fa-cart-plus'>&#xf217; cart-plus</option>
<option value='fa-cc'>&#xf20a; cc</option>
<option value='fa-cc-amex'>&#xf1f3; cc-amex</option>
<option value='fa-cc-diners-club'>&#xf24c; cc-diners-club</option>
<option value='fa-cc-discover'>&#xf1f2; cc-discover</option>
<option value='fa-cc-jcb'>&#xf24b; cc-jcb</option>
<option value='fa-cc-mastercard'>&#xf1f1; cc-mastercard</option>
<option value='fa-cc-paypal'>&#xf1f4; cc-paypal</option>
<option value='fa-cc-stripe'>&#xf1f5; cc-stripe</option>
<option value='fa-cc-visa'>&#xf1f0; cc-visa</option>
<option value='fa-certificate'>&#xf0a3; certificate</option>
<option value='fa-chain'>&#xf0c1; chain</option>
<option value='fa-chain-broken'>&#xf127; chain-broken</option>
<option value='fa-check'>&#xf00c; check</option>
<option value='fa-check-circle'>&#xf058; check-circle</option>
<option value='fa-check-circle-o'>&#xf05d; check-circle-o</option>
<option value='fa-check-square'>&#xf14a; check-square</option>
<option value='fa-check-square-o'>&#xf046; check-square-o</option>
<option value='fa-chevron-circle-down'>&#xf13a; chevron-circle-down</option>
<option value='fa-chevron-circle-left'>&#xf137; chevron-circle-left</option>
<option value='fa-chevron-circle-right'>&#xf138; chevron-circle-right</option>
<option value='fa-chevron-circle-up'>&#xf139; chevron-circle-up</option>
<option value='fa-chevron-down'>&#xf078; chevron-down</option>
<option value='fa-chevron-left'>&#xf053; chevron-left</option>
<option value='fa-chevron-right'>&#xf054; chevron-right</option>
<option value='fa-chevron-up'>&#xf077; chevron-up</option>
<option value='fa-child'>&#xf1ae; child</option>
<option value='fab fa-chrome'>&#xf268; chrome</option>
<option value='fa-circle'>&#xf111; circle</option>
<option value='fa-circle-o'>&#xf10c; circle-o</option>
<option value='fa-circle-o-notch'>&#xf1ce; circle-o-notch</option>
<option value='fa-circle-thin'>&#xf1db; circle-thin</option>
<option value='fa-clipboard'>&#xf0ea; clipboard</option>
<option value='fa-clock-o'>&#xf017; clock-o</option>
<option value='fa-clone'>&#xf24d; clone</option>
<option value='fa-close'>&#xf00d; close</option>
<option value='fa-cloud'>&#xf0c2; cloud</option>
<option value='fa-cloud-download'>&#xf0ed; cloud-download</option>
<option value='fa-cloud-upload'>&#xf0ee; cloud-upload</option>
<option value='fa-cny'>&#xf157; cny</option>
<option value='fa-code'>&#xf121; code</option>
<option value='fa-code-fork'>&#xf126; code-fork</option>
<option value='fa-codepen'>&#xf1cb; codepen</option>
<option value='fa-codiepie'>&#xf284; codiepie</option>
<option value='fa-coffee'>&#xf0f4; coffee</option>
<option value='fa-cog'>&#xf013; cog</option>
<option value='fa-cogs'>&#xf085; cogs</option>
<option value='fa-columns'>&#xf0db; columns</option>
<option value='fa-comment'>&#xf075; comment</option>
<option value='fa-comment-o'>&#xf0e5; comment-o</option>
<option value='fa-commenting'>&#xf27a; commenting</option>
<option value='fa-commenting-o'>&#xf27b; commenting-o</option>
<option value='fa-comments'>&#xf086; comments</option>
<option value='fa-comments-o'>&#xf0e6; comments-o</option>
<option value='fa-compass'>&#xf14e; compass</option>
<option value='fa-compress'>&#xf066; compress</option>
<option value='fa-connectdevelop'>&#xf20e; connectdevelop</option>
<option value='fa-contao'>&#xf26d; contao</option>
<option value='fa-copy'>&#xf0c5; copy</option>
<option value='fa-copyright'>&#xf1f9; copyright</option>
<option value='fa-creative-commons'>&#xf25e; creative-commons</option>
<option value='fa-credit-card'>&#xf09d; credit-card</option>
<option value='fa-credit-card-alt'>&#xf283; credit-card-alt</option>
<option value='fa-crop'>&#xf125; crop</option>
<option value='fa-crosshairs'>&#xf05b; crosshairs</option>
<option value='fa-css3'>&#xf13c; css3</option>
<option value='fa-cube'>&#xf1b2; cube</option>
<option value='fa-cubes'>&#xf1b3; cubes</option>
<option value='fa-cut'>&#xf0c4; cut</option>
<option value='fa-cutlery'>&#xf0f5; cutlery</option>
<option value='fa-dashboard'>&#xf0e4; dashboard</option>
<option value='fa-dashcube'>&#xf210; dashcube</option>
<option value='fa-database'>&#xf1c0; database</option>
<option value='fa-deaf'>&#xf2a4; deaf</option>
<option value='fa-deafness'>&#xf2a4; deafness</option>
<option value='fa-dedent'>&#xf03b; dedent</option>
<option value='fa-delicious'>&#xf1a5; delicious</option>
<option value='fa-desktop'>&#xf108; desktop</option>
<option value='fa-deviantart'>&#xf1bd; deviantart</option>
<option value='fa-diamond'>&#xf219; diamond</option>
<option value='fa-digg'>&#xf1a6; digg</option>
<option value='fa-dollar'>&#xf155; dollar</option>
<option value='fa-dot-circle-o'>&#xf192; dot-circle-o</option>
<option value='fa-download'>&#xf019; download</option>
<option value='fa-dribbble'>&#xf17d; dribbble</option>
<option value='fa-drivers-license'>&#xf2c2; drivers-license</option>
<option value='fa-drivers-license-o'>&#xf2c3; drivers-license-o</option>
<option value='fa-dropbox'>&#xf16b; dropbox</option>
<option value='fa-drupal'>&#xf1a9; drupal</option>
<option value='fab fa-edge'>&#xf282; edge</option>
<option value='fa-edit'>&#xf044; edit</option>
<option value='fa-eercast'>&#xf2da; eercast</option>
<option value='fa-eject'>&#xf052; eject</option>
<option value='fa-ellipsis-h'>&#xf141; ellipsis-h</option>
<option value='fa-ellipsis-v'>&#xf142; ellipsis-v</option>
<option value='fa-empire'>&#xf1d1; empire</option>
<option value='fa-envelope'>&#xf0e0; envelope</option>
<option value='fa-envelope-o'>&#xf003; envelope-o</option>
<option value='fa-envelope-open'>&#xf2b6; envelope-open</option>
<option value='fa-envelope-open-o'>&#xf2b7; envelope-open-o</option>
<option value='fa-envelope-square'>&#xf199; envelope-square</option>
<option value='fa-envira'>&#xf299; envira</option>
<option value='fa-eraser'>&#xf12d; eraser</option>
<option value='fab fa-etsy'>&#xf2d7; etsy</option>
<option value='fa-eur'>&#xf153; eur</option>
<option value='fa-euro'>&#xf153; euro</option>
<option value='fa-exchange'>&#xf0ec; exchange</option>
<option value='fa-exclamation'>&#xf12a; exclamation</option>
<option value='fa-exclamation-circle'>&#xf06a; exclamation-circle</option>
<option value='fa-exclamation-triangle'>&#xf071; exclamation-triangle</option>
<option value='fa-expand'>&#xf065; expand</option>
<option value='fa-expeditedssl'>&#xf23e; expeditedssl</option>
<option value='fa-external-link'>&#xf08e; external-link</option>
<option value='fa-external-link-square'>&#xf14c; external-link-square</option>
<option value='fa-eye'>&#xf06e; eye</option>
<option value='fa-eye-slash'>&#xf070; eye-slash</option>
<option value='fa-eyedropper'>&#xf1fb; eyedropper</option>
<option value='fa-fa'>&#xf2b4; fa</option>
<option value='fab fa-facebook'>&#xf09a; facebook</option>
<option value='fab fa-facebook-f'>&#xf09a; facebook-f</option>
<option value='fa-fast-backward'>&#xf049; fast-backward</option>
<option value='fa-fast-forward'>&#xf050; fast-forward</option>
<option value='fa-fax'>&#xf1ac; fax</option>
<option value='fa-feed'>&#xf09e; feed</option>
<option value='fa-female'>&#xf182; female</option>
<option value='fa-fighter-jet'>&#xf0fb; fighter-jet</option>
<option value='fa-file'>&#xf15b; file</option>
<option value='fa-file-archive-o'>&#xf1c6; file-archive-o</option>
<option value='fa-file-audio-o'>&#xf1c7; file-audio-o</option>
<option value='fa-file-code-o'>&#xf1c9; file-code-o</option>
<option value='fa-file-excel-o'>&#xf1c3; file-excel-o</option>
<option value='fa-file-image-o'>&#xf1c5; file-image-o</option>
<option value='fa-file-movie-o'>&#xf1c8; file-movie-o</option>
<option value='fa-file-o'>&#xf016; file-o</option>
<option value='fa-file-pdf-o'>&#xf1c1; file-pdf-o</option>
<option value='fa-file-photo-o'>&#xf1c5; file-photo-o</option>
<option value='fa-file-picture-o'>&#xf1c5; file-picture-o</option>
<option value='fa-file-powerpoint-o'>&#xf1c4; file-powerpoint-o</option>
<option value='fa-file-sound-o'>&#xf1c7; file-sound-o</option>
<option value='fa-file-text'>&#xf15c; file-text</option>
<option value='fa-file-text-o'>&#xf0f6; file-text-o</option>
<option value='fa-file-video-o'>&#xf1c8; file-video-o</option>
<option value='fa-file-word-o'>&#xf1c2; file-word-o</option>
<option value='fa-file-zip-o'>&#xf1c6; file-zip-o</option>
<option value='fa-files-o'>&#xf0c5; files-o</option>
<option value='fa-film'>&#xf008; film</option>
<option value='fa-filter'>&#xf0b0; filter</option>
<option value='fa-fire'>&#xf06d; fire</option>
<option value='fa-fire-extinguisher'>&#xf134; fire-extinguisher</option>
<option value='fa-firefox'>&#xf269; firefox</option>
<option value='fa-first-order'>&#xf2b0; first-order</option>
<option value='fa-flag'>&#xf024; flag</option>
<option value='fa-flag-checkered'>&#xf11e; flag-checkered</option>
<option value='fa-flag-o'>&#xf11d; flag-o</option>
<option value='fa-flash'>&#xf0e7; flash</option>
<option value='fa-flask'>&#xf0c3; flask</option>
<option value='fa-flickr'>&#xf16e; flickr</option>
<option value='fa-floppy-o'>&#xf0c7; floppy-o</option>
<option value='fa-folder'>&#xf07b; folder</option>
<option value='fa-folder-o'>&#xf114; folder-o</option>
<option value='fa-folder-open'>&#xf07c; folder-open</option>
<option value='fa-folder-open-o'>&#xf115; folder-open-o</option>
<option value='fa-font'>&#xf031; font</option>
<option value='fa-font-awesome'>&#xf2b4; font-awesome</option>
<option value='fa-fonticons'>&#xf280; fonticons</option>
<option value='fa-fort-awesome'>&#xf286; fort-awesome</option>
<option value='fa-forumbee'>&#xf211; forumbee</option>
<option value='fa-forward'>&#xf04e; forward</option>
<option value='fa-foursquare'>&#xf180; foursquare</option>
<option value='fa-free-code-camp'>&#xf2c5; free-code-camp</option>
<option value='fa-frown-o'>&#xf119; frown-o</option>
<option value='fa-futbol-o'>&#xf1e3; futbol-o</option>
<option value='fa-gamepad'>&#xf11b; gamepad</option>
<option value='fa-gavel'>&#xf0e3; gavel</option>
<option value='fa-gbp'>&#xf154; gbp</option>
<option value='fa-ge'>&#xf1d1; ge</option>
<option value='fa-gear'>&#xf013; gear</option>
<option value='fa-gears'>&#xf085; gears</option>
<option value='fa-genderless'>&#xf22d; genderless</option>
<option value='fa-get-pocket'>&#xf265; get-pocket</option>
<option value='fa-gg'>&#xf260; gg</option>
<!--<option value='fa-gg-circle'>&#xf261; gg-circle</option>-->
<!--<option value='fa-gift'>&#xf06b; gift</option>-->
<!--<option value='fa-git'>&#xf1d3; git</option>-->
<!--<option value='fa-git-square'>&#xf1d2; git-square</option>-->
<option value='fab fa-github'>&#xf09b; github</option>
<!--<option value='fa-github-alt'>&#xf113; github-alt</option>-->
<!--<option value='fa-github-square'>&#xf092; github-square</option>-->
<option value='fab fa-gitlab'>&#xf296; gitlab</option>
<option value='fab fa-gittip'>&#xf184; gittip</option>
<option value='fab fa-glass'>&#xf000; glass</option>
<option value='fab fa-glide'>&#xf2a5; glide</option>
<option value='fab fa-glide-g'>&#xf2a6; glide-g</option>
<option value='fab fa-globe'>&#xf0ac; globe</option>
<option value='fab fa-google'>&#xf1a0; google</option>
<option value='fab fa-google-plus'>&#xf0d5; google-plus</option>
<!--<option value='fa-google-plus-circle'>&#xf2b3; google-plus-circle</option>-->
<!--<option value='fa-google-plus-official'>&#xf2b3; google-plus-official</option>-->
<!--<option value='fa-google-plus-square'>&#xf0d4; google-plus-square</option>-->
<option value='fab fa-google-wallet'>&#xf1ee; google-wallet</option>
<option value='fa-graduation-cap'>&#xf19d; graduation-cap</option>
<option value='fa-gratipay'>&#xf184; gratipay</option>
<option value='fa-grav'>&#xf2d6; grav</option>
<option value='fa-group'>&#xf0c0; group</option>
<option value='fa-h-square'>&#xf0fd; h-square</option>
<option value='fab fa-hacker-news'>&#xf1d4; hacker-news</option>
<option value='fa-hand-grab-o'>&#xf255; hand-grab-o</option>
<option value='fa-hand-lizard-o'>&#xf258; hand-lizard-o</option>
<option value='fa-hand-o-down'>&#xf0a7; hand-o-down</option>
<option value='fa-hand-o-left'>&#xf0a5; hand-o-left</option>
<option value='fa-hand-o-right'>&#xf0a4; hand-o-right</option>
<option value='fa-hand-o-up'>&#xf0a6; hand-o-up</option>
<option value='fa-hand-paper-o'>&#xf256; hand-paper-o</option>
<option value='fa-hand-peace-o'>&#xf25b; hand-peace-o</option>
<option value='fa-hand-pointer-o'>&#xf25a; hand-pointer-o</option>
<option value='fa-hand-rock-o'>&#xf255; hand-rock-o</option>
<option value='fa-hand-scissors-o'>&#xf257; hand-scissors-o</option>
<option value='fa-hand-spock-o'>&#xf259; hand-spock-o</option>
<option value='fa-hand-stop-o'>&#xf256; hand-stop-o</option>
<option value='fa-handshake-o'>&#xf2b5; handshake-o</option>
<option value='fa-hard-of-hearing'>&#xf2a4; hard-of-hearing</option>
<option value='fa-hashtag'>&#xf292; hashtag</option>
<option value='fa-hdd-o'>&#xf0a0; hdd-o</option>
<option value='fa-header'>&#xf1dc; header</option>
<option value='fa-headphones'>&#xf025; headphones</option>
<option value='fa-heart'>&#xf004; heart</option>
<option value='fa-heart-o'>&#xf08a; heart-o</option>
<option value='fa-heartbeat'>&#xf21e; heartbeat</option>
<option value='fa-history'>&#xf1da; history</option>
<option value='fa-home'>&#xf015; home</option>
<option value='fa-hospital-o'>&#xf0f8; hospital-o</option>
<option value='fa-hotel'>&#xf236; hotel</option>
<option value='fa-hourglass'>&#xf254; hourglass</option>
<option value='fa-hourglass-1'>&#xf251; hourglass-1</option>
<option value='fa-hourglass-2'>&#xf252; hourglass-2</option>
<option value='fa-hourglass-3'>&#xf253; hourglass-3</option>
<option value='fa-hourglass-end'>&#xf253; hourglass-end</option>
<option value='fa-hourglass-half'>&#xf252; hourglass-half</option>
<option value='fa-hourglass-o'>&#xf250; hourglass-o</option>
<option value='fa-hourglass-start'>&#xf251; hourglass-start</option>
<option value='fab fa-houzz'>&#xf27c; houzz</option>
<option value='fab fa-html5'>&#xf13b; html5</option>
<option value='fa-i-cursor'>&#xf246; i-cursor</option>
<option value='fa-id-badge'>&#xf2c1; id-badge</option>
<option value='fa-id-card'>&#xf2c2; id-card</option>
<option value='fa-id-card-o'>&#xf2c3; id-card-o</option>
<option value='fa-ils'>&#xf20b; ils</option>
<option value='fa-image'>&#xf03e; image</option>
<option value='fa-imdb'>&#xf2d8; imdb</option>
<option value='fa-inbox'>&#xf01c; inbox</option>
<option value='fa-indent'>&#xf03c; indent</option>
<option value='fa-industry'>&#xf275; industry</option>
<option value='fa-info'>&#xf129; info</option>
<option value='fa-info-circle'>&#xf05a; info-circle</option>
<option value='fa-inr'>&#xf156; inr</option>
<option value='fab fa-instagram'>&#xf16d; instagram</option>
<option value='fa-institution'>&#xf19c; institution</option>
<option value='fa-internet-explorer'>&#xf26b; internet-explorer</option>
<option value='fa-intersex'>&#xf224; intersex</option>
<option value='fa-ioxhost'>&#xf208; ioxhost</option>
<option value='fa-italic'>&#xf033; italic</option>
<option value='fab fa-joomla'>&#xf1aa; joomla</option>
<option value='fa-jpy'>&#xf157; jpy</option>
<option value='fa-jsfiddle'>&#xf1cc; jsfiddle</option>
<option value='fa-key'>&#xf084; key</option>
<option value='fa-keyboard-o'>&#xf11c; keyboard-o</option>
<option value='fa-krw'>&#xf159; krw</option>
<option value='fa-language'>&#xf1ab; language</option>
<option value='fa-laptop'>&#xf109; laptop</option>
<option value='fab fa-lastfm'>&#xf202; lastfm</option>
<option value='fab fa-lastfm-square'>&#xf203; lastfm-square</option>
<option value='fa-leaf'>&#xf06c; leaf</option>
<option value='fab fa-leanpub'>&#xf212; leanpub</option>
<option value='fa-legal'>&#xf0e3; legal</option>
<option value='fa-lemon-o'>&#xf094; lemon-o</option>
<option value='fa-level-down'>&#xf149; level-down</option>
<option value='fa-level-up'>&#xf148; level-up</option>
<option value='fa-life-bouy'>&#xf1cd; life-bouy</option>
<option value='fa-life-buoy'>&#xf1cd; life-buoy</option>
<option value='fa-life-ring'>&#xf1cd; life-ring</option>
<option value='fa-life-saver'>&#xf1cd; life-saver</option>
<option value='fa-lightbulb-o'>&#xf0eb; lightbulb-o</option>
<option value='fa-line-chart'>&#xf201; line-chart</option>
<option value='fa-link'>&#xf0c1; link</option>
<option value='fab fa-linkedin'>&#xf0e1; linkedin</option>
<option value='fab fa-linode'>&#xf2b8; linode</option>
<option value='fab fa-linux'>&#xf17c; linux</option>
<option value='fa-list'>&#xf03a; list</option>
<option value='fa-list-alt'>&#xf022; list-alt</option>
<option value='fa-list-ol'>&#xf0cb; list-ol</option>
<option value='fa-list-ul'>&#xf0ca; list-ul</option>
<option value='fa-location-arrow'>&#xf124; location-arrow</option>
<option value='fa-lock'>&#xf023; lock</option>
<option value='fa-long-arrow-down'>&#xf175; long-arrow-down</option>
<option value='fa-long-arrow-left'>&#xf177; long-arrow-left</option>
<option value='fa-long-arrow-right'>&#xf178; long-arrow-right</option>
<option value='fa-long-arrow-up'>&#xf176; long-arrow-up</option>
<option value='fa-low-vision'>&#xf2a8; low-vision</option>
<option value='fa-magic'>&#xf0d0; magic</option>
<option value='fa-magnet'>&#xf076; magnet</option>
<option value='fa-mail-forward'>&#xf064; mail-forward</option>
<option value='fa-mail-reply'>&#xf112; mail-reply</option>
<option value='fa-mail-reply-all'>&#xf122; mail-reply-all</option>
<option value='fa-male'>&#xf183; male</option>
<option value='fa-map'>&#xf279; map</option>
<option value='fa-map-marker'>&#xf041; map-marker</option>
<option value='fa-map-o'>&#xf278; map-o</option>
<option value='fa-map-pin'>&#xf276; map-pin</option>
<option value='fa-map-signs'>&#xf277; map-signs</option>
<option value='fa-mars'>&#xf222; mars</option>
<option value='fa-mars-double'>&#xf227; mars-double</option>
<option value='fa-mars-stroke'>&#xf229; mars-stroke</option>
<option value='fa-mars-stroke-h'>&#xf22b; mars-stroke-h</option>
<option value='fa-mars-stroke-v'>&#xf22a; mars-stroke-v</option>
<option value='fab fa-maxcdn'>&#xf136; maxcdn</option>
<option value='fab fa-meanpath'>&#xf20c; meanpath</option>
<option value='fab fa-medium'>&#xf23a; medium</option>
<option value='fab fa-medkit'>&#xf0fa; medkit</option>
<option value='fab fa-meetup'>&#xf2e0; meetup</option>
<option value='fa-meh-o'>&#xf11a; meh-o</option>
<option value='fa-mercury'>&#xf223; mercury</option>
<option value='fa-microchip'>&#xf2db; microchip</option>
<option value='fa-microphone'>&#xf130; microphone</option>
<option value='fa-microphone-slash'>&#xf131; microphone-slash</option>
<option value='fa-minus'>&#xf068; minus</option>
<option value='fa-minus-circle'>&#xf056; minus-circle</option>
<option value='fa-minus-square'>&#xf146; minus-square</option>
<option value='fa-minus-square-o'>&#xf147; minus-square-o</option>
<option value='fa-mixcloud'>&#xf289; mixcloud</option>
<option value='fa-mobile'>&#xf10b; mobile</option>
<option value='fa-mobile-phone'>&#xf10b; mobile-phone</option>
<option value='fa-modx'>&#xf285; modx</option>
<option value='fa-money'>&#xf0d6; money</option>
<option value='fab fa-moon-o'>&#xf186; moon-o</option>
<option value='fa-mortar-board'>&#xf19d; mortar-board</option>
<option value='fa-motorcycle'>&#xf21c; motorcycle</option>
<option value='fa-mouse-pointer'>&#xf245; mouse-pointer</option>
<option value='fa-music'>&#xf001; music</option>
<option value='fa-navicon'>&#xf0c9; navicon</option>
<option value='fa-neuter'>&#xf22c; neuter</option>
<option value='fa-newspaper-o'>&#xf1ea; newspaper-o</option>
<option value='fa-object-group'>&#xf247; object-group</option>
<option value='fa-object-ungroup'>&#xf248; object-ungroup</option>
<option value='fa-odnoklassniki'>&#xf263; odnoklassniki</option>
<option value='fa-odnoklassniki-square'>&#xf264; odnoklassniki-square</option>
<option value='fa-opencart'>&#xf23d; opencart</option>
<option value='fa-openid'>&#xf19b; openid</option>
<option value='fa-opera'>&#xf26a; opera</option>
<option value='fa-optin-monster'>&#xf23c; optin-monster</option>
<option value='fa-outdent'>&#xf03b; outdent</option>
<option value='fa-pagelines'>&#xf18c; pagelines</option>
<option value='fa-paint-brush'>&#xf1fc; paint-brush</option>
<option value='fa-paper-plane'>&#xf1d8; paper-plane</option>
<option value='fa-paper-plane-o'>&#xf1d9; paper-plane-o</option>
<option value='fa-paperclip'>&#xf0c6; paperclip</option>
<option value='fa-paragraph'>&#xf1dd; paragraph</option>
<option value='fa-paste'>&#xf0ea; paste</option>
<option value='fa-pause'>&#xf04c; pause</option>
<option value='fa-pause-circle'>&#xf28b; pause-circle</option>
<option value='fa-pause-circle-o'>&#xf28c; pause-circle-o</option>
<option value='fa-paw'>&#xf1b0; paw</option>
<option value='fa-paypal'>&#xf1ed; paypal</option>
<option value='fa-pencil'>&#xf040; pencil</option>
<option value='fa-pencil-square'>&#xf14b; pencil-square</option>
<option value='fa-pencil-square-o'>&#xf044; pencil-square-o</option>
<option value='fa-percent'>&#xf295; percent</option>
<option value='fa-phone'>&#xf095; phone</option>
<option value='fa-phone-square'>&#xf098; phone-square</option>
<option value='fa-photo'>&#xf03e; photo</option>
<option value='fa-picture-o'>&#xf03e; picture-o</option>
<option value='fa-pie-chart'>&#xf200; pie-chart</option>
<option value='fa-pied-piper'>&#xf2ae; pied-piper</option>
<option value='fa-pied-piper-alt'>&#xf1a8; pied-piper-alt</option>
<option value='fa-pied-piper-pp'>&#xf1a7; pied-piper-pp</option>
<option value='fab fa-pinterest'>&#xf0d2; pinterest</option>
<option value='fab fa-pinterest-p'>&#xf231; pinterest-p</option>
<option value='fab fa-pinterest-square'>&#xf0d3; pinterest-square</option>
<option value='fa-plane'>&#xf072; plane</option>
<option value='fa-play'>&#xf04b; play</option>
<option value='fa-play-circle'>&#xf144; play-circle</option>
<option value='fa-play-circle-o'>&#xf01d; play-circle-o</option>
<option value='fa-plug'>&#xf1e6; plug</option>
<option value='fa-plus'>&#xf067; plus</option>
<option value='fa-plus-circle'>&#xf055; plus-circle</option>
<option value='fa-plus-square'>&#xf0fe; plus-square</option>
<option value='fa-plus-square-o'>&#xf196; plus-square-o</option>
<option value='fa-podcast'>&#xf2ce; podcast</option>
<option value='fa-power-off'>&#xf011; power-off</option>
<option value='fa-print'>&#xf02f; print</option>
<option value='fa-product-hunt'>&#xf288; product-hunt</option>
<option value='fa-puzzle-piece'>&#xf12e; puzzle-piece</option>
<option value='fa-qq'>&#xf1d6; qq</option>
<option value='fa-qrcode'>&#xf029; qrcode</option>
<option value='fa-question'>&#xf128; question</option>
<option value='fa-question-circle'>&#xf059; question-circle</option>
<option value='fa-question-circle-o'>&#xf29c; question-circle-o</option>
<option value='fa-quora'>&#xf2c4; quora</option>
<option value='fa-quote-left'>&#xf10d; quote-left</option>
<option value='fa-quote-right'>&#xf10e; quote-right</option>
<option value='fa-ra'>&#xf1d0; ra</option>
<option value='fa-random'>&#xf074; random</option>
<option value='fa-ravelry'>&#xf2d9; ravelry</option>
<option value='fa-rebel'>&#xf1d0; rebel</option>
<option value='fa-recycle'>&#xf1b8; recycle</option>
<option value='fa-reddit'>&#xf1a1; reddit</option>
<option value='fa-reddit-alien'>&#xf281; reddit-alien</option>
<option value='fa-reddit-square'>&#xf1a2; reddit-square</option>
<option value='fa-refresh'>&#xf021; refresh</option>
<option value='fa-registered'>&#xf25d; registered</option>
<option value='fa-remove'>&#xf00d; remove</option>
<option value='fa-renren'>&#xf18b; renren</option>
<option value='fa-reorder'>&#xf0c9; reorder</option>
<option value='fa-repeat'>&#xf01e; repeat</option>
<option value='fa-reply'>&#xf112; reply</option>
<option value='fa-reply-all'>&#xf122; reply-all</option>
<option value='fa-resistance'>&#xf1d0; resistance</option>
<option value='fa-retweet'>&#xf079; retweet</option>
<option value='fa-rmb'>&#xf157; rmb</option>
<option value='fa-road'>&#xf018; road</option>
<option value='fa-rocket'>&#xf135; rocket</option>
<option value='fa-rotate-left'>&#xf0e2; rotate-left</option>
<option value='fa-rotate-right'>&#xf01e; rotate-right</option>
<option value='fa-rouble'>&#xf158; rouble</option>
<option value='fa-rss'>&#xf09e; rss</option>
<option value='fa-rss-square'>&#xf143; rss-square</option>
<option value='fa-rub'>&#xf158; rub</option>
<option value='fa-ruble'>&#xf158; ruble</option>
<option value='fa-rupee'>&#xf156; rupee</option>
<option value='fa-s15'>&#xf2cd; s15</option>
<option value='fab fa-safari'>&#xf267; safari</option>
<option value='fa-save'>&#xf0c7; save</option>
<option value='fa-scissors'>&#xf0c4; scissors</option>
<option value='fa-scribd'>&#xf28a; scribd</option>
<option value='fa-search'>&#xf002; search</option>
<option value='fa-search-minus'>&#xf010; search-minus</option>
<option value='fa-search-plus'>&#xf00e; search-plus</option>
<option value='fa-sellsy'>&#xf213; sellsy</option>
<option value='fa-send'>&#xf1d8; send</option>
<option value='fa-send-o'>&#xf1d9; send-o</option>
<option value='fa-server'>&#xf233; server</option>
<option value='fa-share'>&#xf064; share</option>
<option value='fa-share-alt'>&#xf1e0; share-alt</option>
<option value='fa-share-alt-square'>&#xf1e1; share-alt-square</option>
<option value='fa-share-square'>&#xf14d; share-square</option>
<option value='fa-share-square-o'>&#xf045; share-square-o</option>
<option value='fa-shekel'>&#xf20b; shekel</option>
<option value='fa-sheqel'>&#xf20b; sheqel</option>
<option value='fa-shield'>&#xf132; shield</option>
<option value='fa-ship'>&#xf21a; ship</option>
<option value='fa-shirtsinbulk'>&#xf214; shirtsinbulk</option>
<option value='fa-shopping-bag'>&#xf290; shopping-bag</option>
<option value='fa-shopping-basket'>&#xf291; shopping-basket</option>
<option value='fa-shopping-cart'>&#xf07a; shopping-cart</option>
<option value='fa-shower'>&#xf2cc; shower</option>
<option value='fa-sign-in'>&#xf090; sign-in</option>
<option value='fa-sign-language'>&#xf2a7; sign-language</option>
<option value='fa-sign-out'>&#xf08b; sign-out</option>
<option value='fa-signal'>&#xf012; signal</option>
<option value='fa-signing'>&#xf2a7; signing</option>
<option value='fa-simplybuilt'>&#xf215; simplybuilt</option>
<option value='fa-sitemap'>&#xf0e8; sitemap</option>
<option value='fa-skyatlas'>&#xf216; skyatlas</option>
<option value='fa-skype'>&#xf17e; skype</option>
<option value='fa-slack'>&#xf198; slack</option>
<option value='fa-sliders'>&#xf1de; sliders</option>
<option value='fa-slideshare'>&#xf1e7; slideshare</option>
<option value='fa-smile-o'>&#xf118; smile-o</option>
<option value='fab fa-snapchat'>&#xf2ab; snapchat</option>
<option value='fab fa-snapchat-ghost'>&#xf2ac; snapchat-ghost</option>
<option value='fab fa-snapchat-square'>&#xf2ad; snapchat-square</option>
<option value='fa-snowflake-o'>&#xf2dc; snowflake-o</option>
<option value='fa-soccer-ball-o'>&#xf1e3; soccer-ball-o</option>
<option value='fa-sort'>&#xf0dc; sort</option>
<option value='fa-sort-alpha-asc'>&#xf15d; sort-alpha-asc</option>
<option value='fa-sort-alpha-desc'>&#xf15e; sort-alpha-desc</option>
<option value='fa-sort-amount-asc'>&#xf160; sort-amount-asc</option>
<option value='fa-sort-amount-desc'>&#xf161; sort-amount-desc</option>
<option value='fa-sort-asc'>&#xf0de; sort-asc</option>
<option value='fa-sort-desc'>&#xf0dd; sort-desc</option>
<option value='fa-sort-down'>&#xf0dd; sort-down</option>
<option value='fa-sort-numeric-asc'>&#xf162; sort-numeric-asc</option>
<option value='fa-sort-numeric-desc'>&#xf163; sort-numeric-desc</option>
<option value='fa-sort-up'>&#xf0de; sort-up</option>
<option value='fa-soundcloud'>&#xf1be; soundcloud</option>
<option value='fa-space-shuttle'>&#xf197; space-shuttle</option>
<option value='fa-spinner'>&#xf110; spinner</option>
<option value='fa-spoon'>&#xf1b1; spoon</option>
<option value='fa-spotify'>&#xf1bc; spotify</option>
<option value='fa-square'>&#xf0c8; square</option>
<option value='fa-square-o'>&#xf096; square-o</option>
<option value='fa-stack-exchange'>&#xf18d; stack-exchange</option>
<option value='fa-stack-overflow'>&#xf16c; stack-overflow</option>
<option value='fa-star'>&#xf005; star</option>
<option value='fa-star-half'>&#xf089; star-half</option>
<option value='fa-star-half-empty'>&#xf123; star-half-empty</option>
<option value='fa-star-half-full'>&#xf123; star-half-full</option>
<option value='fa-star-half-o'>&#xf123; star-half-o</option>
<option value='fa-star-o'>&#xf006; star-o</option>
<option value='fa-steam'>&#xf1b6; steam</option>
<option value='fa-steam-square'>&#xf1b7; steam-square</option>
<option value='fa-step-backward'>&#xf048; step-backward</option>
<option value='fa-step-forward'>&#xf051; step-forward</option>
<option value='fa-stethoscope'>&#xf0f1; stethoscope</option>
<option value='fa-sticky-note'>&#xf249; sticky-note</option>
<option value='fa-sticky-note-o'>&#xf24a; sticky-note-o</option>
<option value='fa-stop'>&#xf04d; stop</option>
<option value='fa-stop-circle'>&#xf28d; stop-circle</option>
<option value='fa-stop-circle-o'>&#xf28e; stop-circle-o</option>
<option value='fa-street-view'>&#xf21d; street-view</option>
<option value='fa-strikethrough'>&#xf0cc; strikethrough</option>
<option value='fa-stumbleupon'>&#xf1a4; stumbleupon</option>
<option value='fa-stumbleupon-circle'>&#xf1a3; stumbleupon-circle</option>
<option value='fa-subscript'>&#xf12c; subscript</option>
<option value='fa-subway'>&#xf239; subway</option>
<option value='fa-suitcase'>&#xf0f2; suitcase</option>
<option value='fa-sun-o'>&#xf185; sun-o</option>
<option value='fa-superpowers'>&#xf2dd; superpowers</option>
<option value='fa-superscript'>&#xf12b; superscript</option>
<option value='fa-support'>&#xf1cd; support</option>
<option value='fa-table'>&#xf0ce; table</option>
<option value='fa-tablet'>&#xf10a; tablet</option>
<option value='fa-tachometer'>&#xf0e4; tachometer</option>
<option value='fa-tag'>&#xf02b; tag</option>
<option value='fa-tags'>&#xf02c; tags</option>
<option value='fa-tasks'>&#xf0ae; tasks</option>
<option value='fa-taxi'>&#xf1ba; taxi</option>
<option value='fa-telegram'>&#xf2c6; telegram</option>
<option value='fa-television'>&#xf26c; television</option>
<option value='fa-tencent-weibo'>&#xf1d5; tencent-weibo</option>
<option value='fa-terminal'>&#xf120; terminal</option>
<option value='fa-text-height'>&#xf034; text-height</option>
<option value='fa-text-width'>&#xf035; text-width</option>
<option value='fa-th'>&#xf00a; th</option>
<option value='fa-th-large'>&#xf009; th-large</option>
<option value='fa-th-list'>&#xf00b; th-list</option>
<option value='fa-themeisle'>&#xf2b2; themeisle</option>
<option value='fa-thermometer'>&#xf2c7; thermometer</option>
<option value='fa-thermometer-0'>&#xf2cb; thermometer-0</option>
<option value='fa-thermometer-1'>&#xf2ca; thermometer-1</option>
<option value='fa-thermometer-2'>&#xf2c9; thermometer-2</option>
<option value='fa-thermometer-3'>&#xf2c8; thermometer-3</option>
<option value='fa-thermometer-4'>&#xf2c7; thermometer-4</option>
<option value='fa-thermometer-empty'>&#xf2cb; thermometer-empty</option>
<option value='fa-thermometer-full'>&#xf2c7; thermometer-full</option>
<option value='fa-thermometer-half'>&#xf2c9; thermometer-half</option>
<option value='fa-thermometer-quarter'>&#xf2ca; thermometer-quarter</option>
<option value='fa-thermometer-three-quarters'>&#xf2c8; thermometer-three-quarters</option>
<option value='fa-thumb-tack'>&#xf08d; thumb-tack</option>
<option value='fa-thumbs-down'>&#xf165; thumbs-down</option>
<option value='fa-thumbs-o-down'>&#xf088; thumbs-o-down</option>
<option value='fa-thumbs-o-up'>&#xf087; thumbs-o-up</option>
<option value='fa-thumbs-up'>&#xf164; thumbs-up</option>
<option value='fa-ticket'>&#xf145; ticket</option>
<option value='fa-times'>&#xf00d; times</option>
<option value='fa-times-circle'>&#xf057; times-circle</option>
<option value='fa-times-circle-o'>&#xf05c; times-circle-o</option>
<option value='fa-times-rectangle'>&#xf2d3; times-rectangle</option>
<option value='fa-times-rectangle-o'>&#xf2d4; times-rectangle-o</option>
<option value='fa-tint'>&#xf043; tint</option>
<option value='fa-toggle-down'>&#xf150; toggle-down</option>
<option value='fa-toggle-left'>&#xf191; toggle-left</option>
<option value='fa-toggle-off'>&#xf204; toggle-off</option>
<option value='fa-toggle-on'>&#xf205; toggle-on</option>
<option value='fa-toggle-right'>&#xf152; toggle-right</option>
<option value='fa-toggle-up'>&#xf151; toggle-up</option>
<option value='fa-trademark'>&#xf25c; trademark</option>
<option value='fa-train'>&#xf238; train</option>
<option value='fa-transgender'>&#xf224; transgender</option>
<option value='fa-transgender-alt'>&#xf225; transgender-alt</option>
<option value='fa-trash'>&#xf1f8; trash</option>
<option value='fa-trash-o'>&#xf014; trash-o</option>
<option value='fa-tree'>&#xf1bb; tree</option>
<option value='fa-trello'>&#xf181; trello</option>
<option value='fa-tripadvisor'>&#xf262; tripadvisor</option>
<option value='fa-trophy'>&#xf091; trophy</option>
<option value='fa-truck'>&#xf0d1; truck</option>
<option value='fa-try'>&#xf195; try</option>
<option value='fa-tty'>&#xf1e4; tty</option>
<option value='fa-tumblr'>&#xf173; tumblr</option>
<option value='fa-tumblr-square'>&#xf174; tumblr-square</option>
<option value='fa-turkish-lira'>&#xf195; turkish-lira</option>
<option value='fa-tv'>&#xf26c; tv</option>
<option value='fab fa-twitch'>&#xf1e8; twitch</option>
<option value='fab fa-twitter'>&#xf099; twitter</option>
<option value='fab fa-twitter-square'>&#xf081; twitter-square</option>
<option value='fa-umbrella'>&#xf0e9; umbrella</option>
<option value='fa-underline'>&#xf0cd; underline</option>
<option value='fa-undo'>&#xf0e2; undo</option>
<option value='fa-universal-access'>&#xf29a; universal-access</option>
<option value='fa-university'>&#xf19c; university</option>
<option value='fa-unlink'>&#xf127; unlink</option>
<option value='fa-unlock'>&#xf09c; unlock</option>
<option value='fa-unlock-alt'>&#xf13e; unlock-alt</option>
<option value='fa-unsorted'>&#xf0dc; unsorted</option>
<option value='fa-upload'>&#xf093; upload</option>
<option value='fa-usb'>&#xf287; usb</option>
<option value='fa-usd'>&#xf155; usd</option>
<option value='fa-user'>&#xf007; user</option>
<option value='fa-user-circle'>&#xf2bd; user-circle</option>
<option value='fa-user-circle-o'>&#xf2be; user-circle-o</option>
<option value='fa-user-md'>&#xf0f0; user-md</option>
<option value='fa-user-o'>&#xf2c0; user-o</option>
<option value='fa-user-plus'>&#xf234; user-plus</option>
<option value='fa-user-secret'>&#xf21b; user-secret</option>
<option value='fa-user-times'>&#xf235; user-times</option>
<option value='fa-users'>&#xf0c0; users</option>
<option value='fa-vcard'>&#xf2bb; vcard</option>
<option value='fa-vcard-o'>&#xf2bc; vcard-o</option>
<option value='fa-venus'>&#xf221; venus</option>
<option value='fa-venus-double'>&#xf226; venus-double</option>
<option value='fa-venus-mars'>&#xf228; venus-mars</option>
<option value='fa-viacoin'>&#xf237; viacoin</option>
<option value='fa-viadeo'>&#xf2a9; viadeo</option>
<option value='fa-viadeo-square'>&#xf2aa; viadeo-square</option>
<option value='fa-video-camera'>&#xf03d; video-camera</option>
<option value='fa-vimeo'>&#xf27d; vimeo</option>
<option value='fa-vimeo-square'>&#xf194; vimeo-square</option>
<option value='fa-vine'>&#xf1ca; vine</option>
<option value='fa-vk'>&#xf189; vk</option>
<option value='fa-volume-control-phone'>&#xf2a0; volume-control-phone</option>
<option value='fa-volume-down'>&#xf027; volume-down</option>
<option value='fa-volume-off'>&#xf026; volume-off</option>
<option value='fa-volume-up'>&#xf028; volume-up</option>
<option value='fa-warning'>&#xf071; warning</option>
<option value='fa-wechat'>&#xf1d7; wechat</option>
<option value='fa-weibo'>&#xf18a; weibo</option>
<option value='fa-weixin'>&#xf1d7; weixin</option>
<option value='fa-whatsapp'>&#xf232; whatsapp</option>
<option value='fa-wheelchair'>&#xf193; wheelchair</option>
<option value='fa-wheelchair-alt'>&#xf29b; wheelchair-alt</option>
<option value='fa-wifi'>&#xf1eb; wifi</option>
<option value='fa-wikipedia-w'>&#xf266; wikipedia-w</option>
<option value='fa-window-close'>&#xf2d3; window-close</option>
<option value='fa-window-close-o'>&#xf2d4; window-close-o</option>
<option value='fa-window-maximize'>&#xf2d0; window-maximize</option>
<option value='fa-window-minimize'>&#xf2d1; window-minimize</option>
<option value='fa-window-restore'>&#xf2d2; window-restore</option>
<option value='fa-windows'>&#xf17a; windows</option>
<option value='fa-won'>&#xf159; won</option>
<option value='fa-wordpress'>&#xf19a; wordpress</option>
<option value='fa-wpbeginner'>&#xf297; wpbeginner</option>
<option value='fa-wpexplorer'>&#xf2de; wpexplorer</option>
<option value='fa-wpforms'>&#xf298; wpforms</option>
<option value='fa-wrench'>&#xf0ad; wrench</option>
<option value='fa-xing'>&#xf168; xing</option>
<option value='fa-xing-square'>&#xf169; xing-square</option>
<option value='fa-y-combinator'>&#xf23b; y-combinator</option>
<option value='fa-y-combinator-square'>&#xf1d4; y-combinator-square</option>
<option value='fa-yahoo'>&#xf19e; yahoo</option>
<option value='fa-yc'>&#xf23b; yc</option>
<option value='fab fa-yc-square'>&#xf1d4; yc-square</option>
<option value='fab fa-yelp'>&#xf1e9; yelp</option>
<option value='fab fa-yen'>&#xf157; yen</option>
<option value='fab fa-yoast'>&#xf2b1; yoast</option>
<option value='fab fa-youtube'>&#xf167; youtube</option>
<option value='fab fa-youtube-play'>&#xf16a; youtube-play</option>
<option value='fab fa-youtube-square'>&#xf166; youtube-square</option>
  
  </select>
        </div>
        <div class="col-6 my-2">
          <label for="amText" class="form-label">Text</label>
          <input type="text" id="amText" name="amText" class="form-control" placeholder="Text">
        </div>
        <div class="col-2 my-2">
          <button type="button" class="btn btn-primary" onclick="addAmRow()">Add</button>
        </div>
        <div class="col-12 mx-3 my-2">
            <ol class="list-group list-group-numbered" id="amList">
              @if($property->ameneties != '')
              @foreach(json_decode($property->ameneties) as $row)
              <li class="list-group-item" id="li{{$row->id}}">
                <i class="{{$row->icon}} fa-fw fa-solid"></i><span class="mx-2">{{$row->text}}</span><i class="fa-trash fa-fw fa-solid" style="cursor: pointer
                " onclick="deleteItemAm(`{{json_encode($row->id)}}`)"></i>
              </li>
                @endforeach
                @endif
            </ol>
        </div>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="saveAmm()">Save</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>

let IconList = []

deleteItemAm = (id) =>{
  let ameneties = JSON.parse(document.getElementById('ameneties').value);
  ameneties = ameneties.filter(x=> x.id != id)
  amArr = amArr.filter(x=> x.id != id)
  document.getElementById('ameneties').value = JSON.stringify(ameneties);
  document.getElementById(`li${id}`).remove();
}

// getIcons = () =>{
//   axios.get('{{ENV('APP_URL')}}/assets/js/iconsA.json')
//   .then(res=>{
//     IconList = res.data

//     IconList.map(x=>{
//       $('#amIcon').append(`<option value='${x}'>${x}</option>`);
//     })
//   }).catch(err=>{
//     console.log(err)
//   })
// }
// getIcons()
let amArr = JSON.parse(document.getElementById('ameneties').value);

addAmRow = () =>{

  
  let ammIcon = document.getElementById('ammIcon').value;
  let amText = document.getElementById('amText').value;
  
  $('#amList').append(`<li class="list-group-item"><i class="${ammIcon} fa-fw fa-solid"></i> ${amText}</li>`);
  
  amArr.push({
    id:amArr.length + 1,
    icon:ammIcon,
    text:amText
  })
  
  console.log(amArr)

  document.getElementById('ammIcon').value = 0;
  document.getElementById('amText').value = '';

}


saveAmm = () =>{
  let ameneties = [];

  amArr.map(x => {
    ameneties.push(x);
  })

  document.getElementById('ameneties').value = JSON.stringify(ameneties);
  $('#basicModal4').modal('hide');
}
</script>
@endif
@if($property->ameneties == '')
<div class="modal fade" id="basicModal4" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel22">Ameneties</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="row my-2" style="width: 100%;align-items: flex-end;">
        <div class="col-3 mx-3 my-2">
          <label for="amIcon" class="form-label">Icon</label>
          {{-- <input type="text" id="amIcon" name="amIcon" class="form-control" placeholder="Icon"> --}}
             
         <select class="form-select" id="ammIcon" name="amIcon">
    <option value="0">Select Icon</option>
    <option value='fab fa-500px'>&#xf26e; 500px</option>
<option value='fa-address-book'>&#xf2b9; address-book</option>
<option value='fa-address-book-o'>&#xf2ba; address-book-o</option>
<option value='fa-address-card'>&#xf2bb; address-card</option>
<option value='fa-address-card-o'>&#xf2bc; address-card-o</option>
<option value='fa-adjust'>&#xf042; adjust</option>
<option value='fab fa-adn'>&#xf170; adn</option>
<option value='fa-align-center'>&#xf037; align-center</option>
<option value='fa-align-justify'>&#xf039; align-justify</option>
<option value='fa-align-left'>&#xf036; align-left</option>
<option value='fa-align-right'>&#xf038; align-right</option>
<option value='fab fa-amazon'>&#xf270; amazon</option>
<option value='fa-ambulance'>&#xf0f9; ambulance</option>
<option value='fa-american-sign-language-interpreting'>&#xf2a3; american-sign-language-interpreting</option>
<option value='fa-anchor'>&#xf13d; anchor</option>
<option value='fa-android'>&#xf17b; android</option>
<option value='fa-angellist'>&#xf209; angellist</option>
<option value='fa-angle-double-down'>&#xf103; angle-double-down</option>
<option value='fa-angle-double-left'>&#xf100; angle-double-left</option>
<option value='fa-angle-double-right'>&#xf101; angle-double-right</option>
<option value='fa-angle-double-up'>&#xf102; angle-double-up</option>
<option value='fa-angle-down'>&#xf107; angle-down</option>
<option value='fa-angle-left'>&#xf104; angle-left</option>
<option value='fa-angle-right'>&#xf105; angle-right</option>
<option value='fa-angle-up'>&#xf106; angle-up</option>
<option value='fa-apple'>&#xf179; apple</option>
<option value='fa-archive'>&#xf187; archive</option>
<option value='fa-area-chart'>&#xf1fe; area-chart</option>
<option value='fa-arrow-circle-down'>&#xf0ab; arrow-circle-down</option>
<option value='fa-arrow-circle-left'>&#xf0a8; arrow-circle-left</option>
<option value='fa-arrow-circle-o-down'>&#xf01a; arrow-circle-o-down</option>
<option value='fa-arrow-circle-o-left'>&#xf190; arrow-circle-o-left</option>
<option value='fa-arrow-circle-o-right'>&#xf18e; arrow-circle-o-right</option>
<option value='fa-arrow-circle-o-up'>&#xf01b; arrow-circle-o-up</option>
<option value='fa-arrow-circle-right'>&#xf0a9; arrow-circle-right</option>
<option value='fa-arrow-circle-up'>&#xf0aa; arrow-circle-up</option>
<option value='fa-arrow-down'>&#xf063; arrow-down</option>
<option value='fa-arrow-left'>&#xf060; arrow-left</option>
<option value='fa-arrow-right'>&#xf061; arrow-right</option>
<option value='fa-arrow-up'>&#xf062; arrow-up</option>
<option value='fa-arrows'>&#xf047; arrows</option>
<option value='fa-arrows-alt'>&#xf0b2; arrows-alt</option>
<option value='fa-arrows-h'>&#xf07e; arrows-h</option>
<option value='fa-arrows-v'>&#xf07d; arrows-v</option>
<option value='fa-asl-interpreting'>&#xf2a3; asl-interpreting</option>
<option value='fa-assistive-listening-systems'>&#xf2a2; assistive-listening-systems</option>
<option value='fa-asterisk'>&#xf069; asterisk</option>
<option value='fa-at'>&#xf1fa; at</option>
<option value='fa-audio-description'>&#xf29e; audio-description</option>
<option value='fa-automobile'>&#xf1b9; automobile</option>
<option value='fa-backward'>&#xf04a; backward</option>
<option value='fa-balance-scale'>&#xf24e; balance-scale</option>
<option value='fa-ban'>&#xf05e; ban</option>
<option value='fa-bandcamp'>&#xf2d5; bandcamp</option>
<option value='fa-bank'>&#xf19c; bank</option>
<option value='fa-bar-chart'>&#xf080; bar-chart</option>
<option value='fa-bar-chart-o'>&#xf080; bar-chart-o</option>
<option value='fa-barcode'>&#xf02a; barcode</option>
<option value='fa-bars'>&#xf0c9; bars</option>
<option value='fa-bath'>&#xf2cd; bath</option>
<option value='fa-bathtub'>&#xf2cd; bathtub</option>
<option value='fa-battery'>&#xf240; battery</option>
<option value='fa-battery-0'>&#xf244; battery-0</option>
<option value='fa-battery-1'>&#xf243; battery-1</option>
<option value='fa-battery-2'>&#xf242; battery-2</option>
<option value='fa-battery-3'>&#xf241; battery-3</option>
<option value='fa-battery-4'>&#xf240; battery-4</option>
<option value='fa-battery-empty'>&#xf244; battery-empty</option>
<option value='fa-battery-full'>&#xf240; battery-full</option>
<option value='fa-battery-half'>&#xf242; battery-half</option>
<option value='fa-battery-quarter'>&#xf243; battery-quarter</option>
<option value='fa-battery-three-quarters'>&#xf241; battery-three-quarters</option>
<option value='fa-bed'>&#xf236; bed</option>
<option value='fa-beer'>&#xf0fc; beer</option>
<option value='fa-behance'>&#xf1b4; behance</option>
<option value='fa-behance-square'>&#xf1b5; behance-square</option>
<option value='fa-bell'>&#xf0f3; bell</option>
<option value='fa-bell-o'>&#xf0a2; bell-o</option>
<option value='fa-bell-slash'>&#xf1f6; bell-slash</option>
<option value='fa-bell-slash-o'>&#xf1f7; bell-slash-o</option>
<option value='fa-bicycle'>&#xf206; bicycle</option>
<option value='fa-binoculars'>&#xf1e5; binoculars</option>
<option value='fa-birthday-cake'>&#xf1fd; birthday-cake</option>
<option value='fab fa-bitbucket'>&#xf171; bitbucket</option>
<option value='fab fa-bitbucket-square'>&#xf172; bitbucket-square</option>
<option value='fab fa-bitcoin'>&#xf15a; bitcoin</option>
<option value='fab fa-black-tie'>&#xf27e; black-tie</option>
<option value='fab fa-blind'>&#xf29d; blind</option>
<option value='fab fa-bluetooth'>&#xf293; bluetooth</option>
<option value='fab fa-bluetooth-b'>&#xf294; bluetooth-b</option>
<option value='fa-bold'>&#xf032; bold</option>
<option value='fa-bolt'>&#xf0e7; bolt</option>
<option value='fa-bomb'>&#xf1e2; bomb</option>
<option value='fa-book'>&#xf02d; book</option>
<option value='fa-bookmark'>&#xf02e; bookmark</option>
<option value='fa-bookmark-o'>&#xf097; bookmark-o</option>
<option value='fa-braille'>&#xf2a1; braille</option>
<option value='fa-briefcase'>&#xf0b1; briefcase</option>
<option value='fa-btc'>&#xf15a; btc</option>
<option value='fa-bug'>&#xf188; bug</option>
<option value='fa-building'>&#xf1ad; building</option>
<option value='fa-building-o'>&#xf0f7; building-o</option>
<option value='fa-bullhorn'>&#xf0a1; bullhorn</option>
<option value='fa-bullseye'>&#xf140; bullseye</option>
<option value='fa-bus'>&#xf207; bus</option>
<option value='fa-buysellads'>&#xf20d; buysellads</option>
<option value='fa-cab'>&#xf1ba; cab</option>
<option value='fa-calculator'>&#xf1ec; calculator</option>
<option value='fa-calendar'>&#xf073; calendar</option>
<option value='fa-calendar-check-o'>&#xf274; calendar-check-o</option>
<option value='fa-calendar-minus-o'>&#xf272; calendar-minus-o</option>
<option value='fa-calendar-o'>&#xf133; calendar-o</option>
<option value='fa-calendar-plus-o'>&#xf271; calendar-plus-o</option>
<option value='fa-calendar-times-o'>&#xf273; calendar-times-o</option>
<option value='fa-camera'>&#xf030; camera</option>
<option value='fa-camera-retro'>&#xf083; camera-retro</option>
<option value='fa-car'>&#xf1b9; car</option>
<option value='fa-caret-down'>&#xf0d7; caret-down</option>
<option value='fa-caret-left'>&#xf0d9; caret-left</option>
<option value='fa-caret-right'>&#xf0da; caret-right</option>
<option value='fa-caret-square-o-down'>&#xf150; caret-square-o-down</option>
<option value='fa-caret-square-o-left'>&#xf191; caret-square-o-left</option>
<option value='fa-caret-square-o-right'>&#xf152; caret-square-o-right</option>
<option value='fa-caret-square-o-up'>&#xf151; caret-square-o-up</option>
<option value='fa-caret-up'>&#xf0d8; caret-up</option>
<option value='fa-cart-arrow-down'>&#xf218; cart-arrow-down</option>
<option value='fa-cart-plus'>&#xf217; cart-plus</option>
<option value='fa-cc'>&#xf20a; cc</option>
<option value='fa-cc-amex'>&#xf1f3; cc-amex</option>
<option value='fa-cc-diners-club'>&#xf24c; cc-diners-club</option>
<option value='fa-cc-discover'>&#xf1f2; cc-discover</option>
<option value='fa-cc-jcb'>&#xf24b; cc-jcb</option>
<option value='fa-cc-mastercard'>&#xf1f1; cc-mastercard</option>
<option value='fa-cc-paypal'>&#xf1f4; cc-paypal</option>
<option value='fa-cc-stripe'>&#xf1f5; cc-stripe</option>
<option value='fa-cc-visa'>&#xf1f0; cc-visa</option>
<option value='fa-certificate'>&#xf0a3; certificate</option>
<option value='fa-chain'>&#xf0c1; chain</option>
<option value='fa-chain-broken'>&#xf127; chain-broken</option>
<option value='fa-check'>&#xf00c; check</option>
<option value='fa-check-circle'>&#xf058; check-circle</option>
<option value='fa-check-circle-o'>&#xf05d; check-circle-o</option>
<option value='fa-check-square'>&#xf14a; check-square</option>
<option value='fa-check-square-o'>&#xf046; check-square-o</option>
<option value='fa-chevron-circle-down'>&#xf13a; chevron-circle-down</option>
<option value='fa-chevron-circle-left'>&#xf137; chevron-circle-left</option>
<option value='fa-chevron-circle-right'>&#xf138; chevron-circle-right</option>
<option value='fa-chevron-circle-up'>&#xf139; chevron-circle-up</option>
<option value='fa-chevron-down'>&#xf078; chevron-down</option>
<option value='fa-chevron-left'>&#xf053; chevron-left</option>
<option value='fa-chevron-right'>&#xf054; chevron-right</option>
<option value='fa-chevron-up'>&#xf077; chevron-up</option>
<option value='fa-child'>&#xf1ae; child</option>
<option value='fab fa-chrome'>&#xf268; chrome</option>
<option value='fa-circle'>&#xf111; circle</option>
<option value='fa-circle-o'>&#xf10c; circle-o</option>
<option value='fa-circle-o-notch'>&#xf1ce; circle-o-notch</option>
<option value='fa-circle-thin'>&#xf1db; circle-thin</option>
<option value='fa-clipboard'>&#xf0ea; clipboard</option>
<option value='fa-clock-o'>&#xf017; clock-o</option>
<option value='fa-clone'>&#xf24d; clone</option>
<option value='fa-close'>&#xf00d; close</option>
<option value='fa-cloud'>&#xf0c2; cloud</option>
<option value='fa-cloud-download'>&#xf0ed; cloud-download</option>
<option value='fa-cloud-upload'>&#xf0ee; cloud-upload</option>
<option value='fa-cny'>&#xf157; cny</option>
<option value='fa-code'>&#xf121; code</option>
<option value='fa-code-fork'>&#xf126; code-fork</option>
<option value='fa-codepen'>&#xf1cb; codepen</option>
<option value='fa-codiepie'>&#xf284; codiepie</option>
<option value='fa-coffee'>&#xf0f4; coffee</option>
<option value='fa-cog'>&#xf013; cog</option>
<option value='fa-cogs'>&#xf085; cogs</option>
<option value='fa-columns'>&#xf0db; columns</option>
<option value='fa-comment'>&#xf075; comment</option>
<option value='fa-comment-o'>&#xf0e5; comment-o</option>
<option value='fa-commenting'>&#xf27a; commenting</option>
<option value='fa-commenting-o'>&#xf27b; commenting-o</option>
<option value='fa-comments'>&#xf086; comments</option>
<option value='fa-comments-o'>&#xf0e6; comments-o</option>
<option value='fa-compass'>&#xf14e; compass</option>
<option value='fa-compress'>&#xf066; compress</option>
<option value='fa-connectdevelop'>&#xf20e; connectdevelop</option>
<option value='fa-contao'>&#xf26d; contao</option>
<option value='fa-copy'>&#xf0c5; copy</option>
<option value='fa-copyright'>&#xf1f9; copyright</option>
<option value='fa-creative-commons'>&#xf25e; creative-commons</option>
<option value='fa-credit-card'>&#xf09d; credit-card</option>
<option value='fa-credit-card-alt'>&#xf283; credit-card-alt</option>
<option value='fa-crop'>&#xf125; crop</option>
<option value='fa-crosshairs'>&#xf05b; crosshairs</option>
<option value='fa-css3'>&#xf13c; css3</option>
<option value='fa-cube'>&#xf1b2; cube</option>
<option value='fa-cubes'>&#xf1b3; cubes</option>
<option value='fa-cut'>&#xf0c4; cut</option>
<option value='fa-cutlery'>&#xf0f5; cutlery</option>
<option value='fa-dashboard'>&#xf0e4; dashboard</option>
<option value='fa-dashcube'>&#xf210; dashcube</option>
<option value='fa-database'>&#xf1c0; database</option>
<option value='fa-deaf'>&#xf2a4; deaf</option>
<option value='fa-deafness'>&#xf2a4; deafness</option>
<option value='fa-dedent'>&#xf03b; dedent</option>
<option value='fa-delicious'>&#xf1a5; delicious</option>
<option value='fa-desktop'>&#xf108; desktop</option>
<option value='fa-deviantart'>&#xf1bd; deviantart</option>
<option value='fa-diamond'>&#xf219; diamond</option>
<option value='fa-digg'>&#xf1a6; digg</option>
<option value='fa-dollar'>&#xf155; dollar</option>
<option value='fa-dot-circle-o'>&#xf192; dot-circle-o</option>
<option value='fa-download'>&#xf019; download</option>
<option value='fa-dribbble'>&#xf17d; dribbble</option>
<option value='fa-drivers-license'>&#xf2c2; drivers-license</option>
<option value='fa-drivers-license-o'>&#xf2c3; drivers-license-o</option>
<option value='fa-dropbox'>&#xf16b; dropbox</option>
<option value='fa-drupal'>&#xf1a9; drupal</option>
<option value='fab fa-edge'>&#xf282; edge</option>
<option value='fa-edit'>&#xf044; edit</option>
<option value='fa-eercast'>&#xf2da; eercast</option>
<option value='fa-eject'>&#xf052; eject</option>
<option value='fa-ellipsis-h'>&#xf141; ellipsis-h</option>
<option value='fa-ellipsis-v'>&#xf142; ellipsis-v</option>
<option value='fa-empire'>&#xf1d1; empire</option>
<option value='fa-envelope'>&#xf0e0; envelope</option>
<option value='fa-envelope-o'>&#xf003; envelope-o</option>
<option value='fa-envelope-open'>&#xf2b6; envelope-open</option>
<option value='fa-envelope-open-o'>&#xf2b7; envelope-open-o</option>
<option value='fa-envelope-square'>&#xf199; envelope-square</option>
<option value='fa-envira'>&#xf299; envira</option>
<option value='fa-eraser'>&#xf12d; eraser</option>
<option value='fab fa-etsy'>&#xf2d7; etsy</option>
<option value='fa-eur'>&#xf153; eur</option>
<option value='fa-euro'>&#xf153; euro</option>
<option value='fa-exchange'>&#xf0ec; exchange</option>
<option value='fa-exclamation'>&#xf12a; exclamation</option>
<option value='fa-exclamation-circle'>&#xf06a; exclamation-circle</option>
<option value='fa-exclamation-triangle'>&#xf071; exclamation-triangle</option>
<option value='fa-expand'>&#xf065; expand</option>
<option value='fa-expeditedssl'>&#xf23e; expeditedssl</option>
<option value='fa-external-link'>&#xf08e; external-link</option>
<option value='fa-external-link-square'>&#xf14c; external-link-square</option>
<option value='fa-eye'>&#xf06e; eye</option>
<option value='fa-eye-slash'>&#xf070; eye-slash</option>
<option value='fa-eyedropper'>&#xf1fb; eyedropper</option>
<option value='fa-fa'>&#xf2b4; fa</option>
<option value='fab fa-facebook'>&#xf09a; facebook</option>
<option value='fab fa-facebook-f'>&#xf09a; facebook-f</option>
<option value='fa-fast-backward'>&#xf049; fast-backward</option>
<option value='fa-fast-forward'>&#xf050; fast-forward</option>
<option value='fa-fax'>&#xf1ac; fax</option>
<option value='fa-feed'>&#xf09e; feed</option>
<option value='fa-female'>&#xf182; female</option>
<option value='fa-fighter-jet'>&#xf0fb; fighter-jet</option>
<option value='fa-file'>&#xf15b; file</option>
<option value='fa-file-archive-o'>&#xf1c6; file-archive-o</option>
<option value='fa-file-audio-o'>&#xf1c7; file-audio-o</option>
<option value='fa-file-code-o'>&#xf1c9; file-code-o</option>
<option value='fa-file-excel-o'>&#xf1c3; file-excel-o</option>
<option value='fa-file-image-o'>&#xf1c5; file-image-o</option>
<option value='fa-file-movie-o'>&#xf1c8; file-movie-o</option>
<option value='fa-file-o'>&#xf016; file-o</option>
<option value='fa-file-pdf-o'>&#xf1c1; file-pdf-o</option>
<option value='fa-file-photo-o'>&#xf1c5; file-photo-o</option>
<option value='fa-file-picture-o'>&#xf1c5; file-picture-o</option>
<option value='fa-file-powerpoint-o'>&#xf1c4; file-powerpoint-o</option>
<option value='fa-file-sound-o'>&#xf1c7; file-sound-o</option>
<option value='fa-file-text'>&#xf15c; file-text</option>
<option value='fa-file-text-o'>&#xf0f6; file-text-o</option>
<option value='fa-file-video-o'>&#xf1c8; file-video-o</option>
<option value='fa-file-word-o'>&#xf1c2; file-word-o</option>
<option value='fa-file-zip-o'>&#xf1c6; file-zip-o</option>
<option value='fa-files-o'>&#xf0c5; files-o</option>
<option value='fa-film'>&#xf008; film</option>
<option value='fa-filter'>&#xf0b0; filter</option>
<option value='fa-fire'>&#xf06d; fire</option>
<option value='fa-fire-extinguisher'>&#xf134; fire-extinguisher</option>
<option value='fa-firefox'>&#xf269; firefox</option>
<option value='fa-first-order'>&#xf2b0; first-order</option>
<option value='fa-flag'>&#xf024; flag</option>
<option value='fa-flag-checkered'>&#xf11e; flag-checkered</option>
<option value='fa-flag-o'>&#xf11d; flag-o</option>
<option value='fa-flash'>&#xf0e7; flash</option>
<option value='fa-flask'>&#xf0c3; flask</option>
<option value='fa-flickr'>&#xf16e; flickr</option>
<option value='fa-floppy-o'>&#xf0c7; floppy-o</option>
<option value='fa-folder'>&#xf07b; folder</option>
<option value='fa-folder-o'>&#xf114; folder-o</option>
<option value='fa-folder-open'>&#xf07c; folder-open</option>
<option value='fa-folder-open-o'>&#xf115; folder-open-o</option>
<option value='fa-font'>&#xf031; font</option>
<option value='fa-font-awesome'>&#xf2b4; font-awesome</option>
<option value='fa-fonticons'>&#xf280; fonticons</option>
<option value='fa-fort-awesome'>&#xf286; fort-awesome</option>
<option value='fa-forumbee'>&#xf211; forumbee</option>
<option value='fa-forward'>&#xf04e; forward</option>
<option value='fa-foursquare'>&#xf180; foursquare</option>
<option value='fa-free-code-camp'>&#xf2c5; free-code-camp</option>
<option value='fa-frown-o'>&#xf119; frown-o</option>
<option value='fa-futbol-o'>&#xf1e3; futbol-o</option>
<option value='fa-gamepad'>&#xf11b; gamepad</option>
<option value='fa-gavel'>&#xf0e3; gavel</option>
<option value='fa-gbp'>&#xf154; gbp</option>
<option value='fa-ge'>&#xf1d1; ge</option>
<option value='fa-gear'>&#xf013; gear</option>
<option value='fa-gears'>&#xf085; gears</option>
<option value='fa-genderless'>&#xf22d; genderless</option>
<option value='fa-get-pocket'>&#xf265; get-pocket</option>
<option value='fa-gg'>&#xf260; gg</option>
<!--<option value='fa-gg-circle'>&#xf261; gg-circle</option>-->
<!--<option value='fa-gift'>&#xf06b; gift</option>-->
<!--<option value='fa-git'>&#xf1d3; git</option>-->
<!--<option value='fa-git-square'>&#xf1d2; git-square</option>-->
<option value='fab fa-github'>&#xf09b; github</option>
<!--<option value='fa-github-alt'>&#xf113; github-alt</option>-->
<!--<option value='fa-github-square'>&#xf092; github-square</option>-->
<option value='fab fa-gitlab'>&#xf296; gitlab</option>
<option value='fab fa-gittip'>&#xf184; gittip</option>
<option value='fab fa-glass'>&#xf000; glass</option>
<option value='fab fa-glide'>&#xf2a5; glide</option>
<option value='fab fa-glide-g'>&#xf2a6; glide-g</option>
<option value='fab fa-globe'>&#xf0ac; globe</option>
<option value='fab fa-google'>&#xf1a0; google</option>
<option value='fab fa-google-plus'>&#xf0d5; google-plus</option>
<!--<option value='fa-google-plus-circle'>&#xf2b3; google-plus-circle</option>-->
<!--<option value='fa-google-plus-official'>&#xf2b3; google-plus-official</option>-->
<!--<option value='fa-google-plus-square'>&#xf0d4; google-plus-square</option>-->
<option value='fab fa-google-wallet'>&#xf1ee; google-wallet</option>
<option value='fa-graduation-cap'>&#xf19d; graduation-cap</option>
<option value='fa-gratipay'>&#xf184; gratipay</option>
<option value='fa-grav'>&#xf2d6; grav</option>
<option value='fa-group'>&#xf0c0; group</option>
<option value='fa-h-square'>&#xf0fd; h-square</option>
<option value='fab fa-hacker-news'>&#xf1d4; hacker-news</option>
<option value='fa-hand-grab-o'>&#xf255; hand-grab-o</option>
<option value='fa-hand-lizard-o'>&#xf258; hand-lizard-o</option>
<option value='fa-hand-o-down'>&#xf0a7; hand-o-down</option>
<option value='fa-hand-o-left'>&#xf0a5; hand-o-left</option>
<option value='fa-hand-o-right'>&#xf0a4; hand-o-right</option>
<option value='fa-hand-o-up'>&#xf0a6; hand-o-up</option>
<option value='fa-hand-paper-o'>&#xf256; hand-paper-o</option>
<option value='fa-hand-peace-o'>&#xf25b; hand-peace-o</option>
<option value='fa-hand-pointer-o'>&#xf25a; hand-pointer-o</option>
<option value='fa-hand-rock-o'>&#xf255; hand-rock-o</option>
<option value='fa-hand-scissors-o'>&#xf257; hand-scissors-o</option>
<option value='fa-hand-spock-o'>&#xf259; hand-spock-o</option>
<option value='fa-hand-stop-o'>&#xf256; hand-stop-o</option>
<option value='fa-handshake-o'>&#xf2b5; handshake-o</option>
<option value='fa-hard-of-hearing'>&#xf2a4; hard-of-hearing</option>
<option value='fa-hashtag'>&#xf292; hashtag</option>
<option value='fa-hdd-o'>&#xf0a0; hdd-o</option>
<option value='fa-header'>&#xf1dc; header</option>
<option value='fa-headphones'>&#xf025; headphones</option>
<option value='fa-heart'>&#xf004; heart</option>
<option value='fa-heart-o'>&#xf08a; heart-o</option>
<option value='fa-heartbeat'>&#xf21e; heartbeat</option>
<option value='fa-history'>&#xf1da; history</option>
<option value='fa-home'>&#xf015; home</option>
<option value='fa-hospital-o'>&#xf0f8; hospital-o</option>
<option value='fa-hotel'>&#xf236; hotel</option>
<option value='fa-hourglass'>&#xf254; hourglass</option>
<option value='fa-hourglass-1'>&#xf251; hourglass-1</option>
<option value='fa-hourglass-2'>&#xf252; hourglass-2</option>
<option value='fa-hourglass-3'>&#xf253; hourglass-3</option>
<option value='fa-hourglass-end'>&#xf253; hourglass-end</option>
<option value='fa-hourglass-half'>&#xf252; hourglass-half</option>
<option value='fa-hourglass-o'>&#xf250; hourglass-o</option>
<option value='fa-hourglass-start'>&#xf251; hourglass-start</option>
<option value='fab fa-houzz'>&#xf27c; houzz</option>
<option value='fab fa-html5'>&#xf13b; html5</option>
<option value='fa-i-cursor'>&#xf246; i-cursor</option>
<option value='fa-id-badge'>&#xf2c1; id-badge</option>
<option value='fa-id-card'>&#xf2c2; id-card</option>
<option value='fa-id-card-o'>&#xf2c3; id-card-o</option>
<option value='fa-ils'>&#xf20b; ils</option>
<option value='fa-image'>&#xf03e; image</option>
<option value='fa-imdb'>&#xf2d8; imdb</option>
<option value='fa-inbox'>&#xf01c; inbox</option>
<option value='fa-indent'>&#xf03c; indent</option>
<option value='fa-industry'>&#xf275; industry</option>
<option value='fa-info'>&#xf129; info</option>
<option value='fa-info-circle'>&#xf05a; info-circle</option>
<option value='fa-inr'>&#xf156; inr</option>
<option value='fab fa-instagram'>&#xf16d; instagram</option>
<option value='fa-institution'>&#xf19c; institution</option>
<option value='fa-internet-explorer'>&#xf26b; internet-explorer</option>
<option value='fa-intersex'>&#xf224; intersex</option>
<option value='fa-ioxhost'>&#xf208; ioxhost</option>
<option value='fa-italic'>&#xf033; italic</option>
<option value='fab fa-joomla'>&#xf1aa; joomla</option>
<option value='fa-jpy'>&#xf157; jpy</option>
<option value='fa-jsfiddle'>&#xf1cc; jsfiddle</option>
<option value='fa-key'>&#xf084; key</option>
<option value='fa-keyboard-o'>&#xf11c; keyboard-o</option>
<option value='fa-krw'>&#xf159; krw</option>
<option value='fa-language'>&#xf1ab; language</option>
<option value='fa-laptop'>&#xf109; laptop</option>
<option value='fab fa-lastfm'>&#xf202; lastfm</option>
<option value='fa-lastfm-square'>&#xf203; lastfm-square</option>
<option value='fa-leaf'>&#xf06c; leaf</option>
<option value='fab fa-leanpub'>&#xf212; leanpub</option>
<option value='fa-legal'>&#xf0e3; legal</option>
<option value='fa-lemon-o'>&#xf094; lemon-o</option>
<option value='fa-level-down'>&#xf149; level-down</option>
<option value='fa-level-up'>&#xf148; level-up</option>
<option value='fa-life-bouy'>&#xf1cd; life-bouy</option>
<option value='fa-life-buoy'>&#xf1cd; life-buoy</option>
<option value='fa-life-ring'>&#xf1cd; life-ring</option>
<option value='fa-life-saver'>&#xf1cd; life-saver</option>
<option value='fa-lightbulb-o'>&#xf0eb; lightbulb-o</option>
<option value='fa-line-chart'>&#xf201; line-chart</option>
<option value='fa-link'>&#xf0c1; link</option>
<option value='fab fa-linkedin'>&#xf0e1; linkedin</option>
<option value='fab fa-linkedin-square'>&#xf08c; linkedin-square</option>
<option value='fab fa-linode'>&#xf2b8; linode</option>
<option value='fab fa-linux'>&#xf17c; linux</option>
<option value='fa-list'>&#xf03a; list</option>
<option value='fa-list-alt'>&#xf022; list-alt</option>
<option value='fa-list-ol'>&#xf0cb; list-ol</option>
<option value='fa-list-ul'>&#xf0ca; list-ul</option>
<option value='fa-location-arrow'>&#xf124; location-arrow</option>
<option value='fa-lock'>&#xf023; lock</option>
<option value='fa-long-arrow-down'>&#xf175; long-arrow-down</option>
<option value='fa-long-arrow-left'>&#xf177; long-arrow-left</option>
<option value='fa-long-arrow-right'>&#xf178; long-arrow-right</option>
<option value='fa-long-arrow-up'>&#xf176; long-arrow-up</option>
<option value='fa-low-vision'>&#xf2a8; low-vision</option>
<option value='fa-magic'>&#xf0d0; magic</option>
<option value='fa-magnet'>&#xf076; magnet</option>
<option value='fa-mail-forward'>&#xf064; mail-forward</option>
<option value='fa-mail-reply'>&#xf112; mail-reply</option>
<option value='fa-mail-reply-all'>&#xf122; mail-reply-all</option>
<option value='fa-male'>&#xf183; male</option>
<option value='fa-map'>&#xf279; map</option>
<option value='fa-map-marker'>&#xf041; map-marker</option>
<option value='fa-map-o'>&#xf278; map-o</option>
<option value='fa-map-pin'>&#xf276; map-pin</option>
<option value='fa-map-signs'>&#xf277; map-signs</option>
<option value='fa-mars'>&#xf222; mars</option>
<option value='fa-mars-double'>&#xf227; mars-double</option>
<option value='fa-mars-stroke'>&#xf229; mars-stroke</option>
<option value='fa-mars-stroke-h'>&#xf22b; mars-stroke-h</option>
<option value='fa-mars-stroke-v'>&#xf22a; mars-stroke-v</option>
<option value='fab fa-maxcdn'>&#xf136; maxcdn</option>
<option value='fab fa-meanpath'>&#xf20c; meanpath</option>
<option value='fab fa-medium'>&#xf23a; medium</option>
<option value='fab fa-medkit'>&#xf0fa; medkit</option>
<option value='fab fa-meetup'>&#xf2e0; meetup</option>
<option value='fa-meh-o'>&#xf11a; meh-o</option>
<option value='fa-mercury'>&#xf223; mercury</option>
<option value='fa-microchip'>&#xf2db; microchip</option>
<option value='fa-microphone'>&#xf130; microphone</option>
<option value='fa-microphone-slash'>&#xf131; microphone-slash</option>
<option value='fa-minus'>&#xf068; minus</option>
<option value='fa-minus-circle'>&#xf056; minus-circle</option>
<option value='fa-minus-square'>&#xf146; minus-square</option>
<option value='fa-minus-square-o'>&#xf147; minus-square-o</option>
<option value='fa-mixcloud'>&#xf289; mixcloud</option>
<option value='fa-mobile'>&#xf10b; mobile</option>
<option value='fa-mobile-phone'>&#xf10b; mobile-phone</option>
<option value='fa-modx'>&#xf285; modx</option>
<option value='fa-money'>&#xf0d6; money</option>
<option value='fab fa-moon-o'>&#xf186; moon-o</option>
<option value='fa-mortar-board'>&#xf19d; mortar-board</option>
<option value='fa-motorcycle'>&#xf21c; motorcycle</option>
<option value='fa-mouse-pointer'>&#xf245; mouse-pointer</option>
<option value='fa-music'>&#xf001; music</option>
<option value='fa-navicon'>&#xf0c9; navicon</option>
<option value='fa-neuter'>&#xf22c; neuter</option>
<option value='fa-newspaper-o'>&#xf1ea; newspaper-o</option>
<option value='fa-object-group'>&#xf247; object-group</option>
<option value='fa-object-ungroup'>&#xf248; object-ungroup</option>
<option value='fa-odnoklassniki'>&#xf263; odnoklassniki</option>
<option value='fa-odnoklassniki-square'>&#xf264; odnoklassniki-square</option>
<option value='fa-opencart'>&#xf23d; opencart</option>
<option value='fa-openid'>&#xf19b; openid</option>
<option value='fa-opera'>&#xf26a; opera</option>
<option value='fa-optin-monster'>&#xf23c; optin-monster</option>
<option value='fa-outdent'>&#xf03b; outdent</option>
<option value='fa-pagelines'>&#xf18c; pagelines</option>
<option value='fa-paint-brush'>&#xf1fc; paint-brush</option>
<option value='fa-paper-plane'>&#xf1d8; paper-plane</option>
<option value='fa-paper-plane-o'>&#xf1d9; paper-plane-o</option>
<option value='fa-paperclip'>&#xf0c6; paperclip</option>
<option value='fa-paragraph'>&#xf1dd; paragraph</option>
<option value='fa-paste'>&#xf0ea; paste</option>
<option value='fa-pause'>&#xf04c; pause</option>
<option value='fa-pause-circle'>&#xf28b; pause-circle</option>
<option value='fa-pause-circle-o'>&#xf28c; pause-circle-o</option>
<option value='fa-paw'>&#xf1b0; paw</option>
<option value='fa-paypal'>&#xf1ed; paypal</option>
<option value='fa-pencil'>&#xf040; pencil</option>
<option value='fa-pencil-square'>&#xf14b; pencil-square</option>
<option value='fa-pencil-square-o'>&#xf044; pencil-square-o</option>
<option value='fa-percent'>&#xf295; percent</option>
<option value='fa-phone'>&#xf095; phone</option>
<option value='fa-phone-square'>&#xf098; phone-square</option>
<option value='fa-photo'>&#xf03e; photo</option>
<option value='fa-picture-o'>&#xf03e; picture-o</option>
<option value='fa-pie-chart'>&#xf200; pie-chart</option>
<option value='fa-pied-piper'>&#xf2ae; pied-piper</option>
<option value='fa-pied-piper-alt'>&#xf1a8; pied-piper-alt</option>
<option value='fa-pied-piper-pp'>&#xf1a7; pied-piper-pp</option>
<option value='fa-pinterest'>&#xf0d2; pinterest</option>
<option value='fa-pinterest-p'>&#xf231; pinterest-p</option>
<opti<option value='fab fa-pinterest'>&#xf0d2; pinterest</option>
<option value='fab fa-pinterest-p'>&#xf231; pinterest-p</option>
<option value='fab fa-pinterest-square'>&#xf0d3; pinterest-square</option>
<option value='fa-plane'>&#xf072; plane</option>
<option value='fa-play'>&#xf04b; play</option>
<option value='fa-play-circle'>&#xf144; play-circle</option>
<option value='fa-play-circle-o'>&#xf01d; play-circle-o</option>
<option value='fa-plug'>&#xf1e6; plug</option>
<option value='fa-plus'>&#xf067; plus</option>
<option value='fa-plus-circle'>&#xf055; plus-circle</option>
<option value='fa-plus-square'>&#xf0fe; plus-square</option>
<option value='fa-plus-square-o'>&#xf196; plus-square-o</option>
<option value='fa-podcast'>&#xf2ce; podcast</option>
<option value='fa-power-off'>&#xf011; power-off</option>
<option value='fa-print'>&#xf02f; print</option>
<option value='fa-product-hunt'>&#xf288; product-hunt</option>
<option value='fa-puzzle-piece'>&#xf12e; puzzle-piece</option>
<option value='fa-qq'>&#xf1d6; qq</option>
<option value='fa-qrcode'>&#xf029; qrcode</option>
<option value='fa-question'>&#xf128; question</option>
<option value='fa-question-circle'>&#xf059; question-circle</option>
<option value='fa-question-circle-o'>&#xf29c; question-circle-o</option>
<option value='fa-quora'>&#xf2c4; quora</option>
<option value='fa-quote-left'>&#xf10d; quote-left</option>
<option value='fa-quote-right'>&#xf10e; quote-right</option>
<option value='fa-ra'>&#xf1d0; ra</option>
<option value='fa-random'>&#xf074; random</option>
<option value='fa-ravelry'>&#xf2d9; ravelry</option>
<option value='fa-rebel'>&#xf1d0; rebel</option>
<option value='fa-recycle'>&#xf1b8; recycle</option>
<option value='fa-reddit'>&#xf1a1; reddit</option>
<option value='fa-reddit-alien'>&#xf281; reddit-alien</option>
<option value='fa-reddit-square'>&#xf1a2; reddit-square</option>
<option value='fa-refresh'>&#xf021; refresh</option>
<option value='fa-registered'>&#xf25d; registered</option>
<option value='fa-remove'>&#xf00d; remove</option>
<option value='fa-renren'>&#xf18b; renren</option>
<option value='fa-reorder'>&#xf0c9; reorder</option>
<option value='fa-repeat'>&#xf01e; repeat</option>
<option value='fa-reply'>&#xf112; reply</option>
<option value='fa-reply-all'>&#xf122; reply-all</option>
<option value='fa-resistance'>&#xf1d0; resistance</option>
<option value='fa-retweet'>&#xf079; retweet</option>
<option value='fa-rmb'>&#xf157; rmb</option>
<option value='fa-road'>&#xf018; road</option>
<option value='fa-rocket'>&#xf135; rocket</option>
<option value='fa-rotate-left'>&#xf0e2; rotate-left</option>
<option value='fa-rotate-right'>&#xf01e; rotate-right</option>
<option value='fa-rouble'>&#xf158; rouble</option>
<option value='fa-rss'>&#xf09e; rss</option>
<option value='fa-rss-square'>&#xf143; rss-square</option>
<option value='fa-rub'>&#xf158; rub</option>
<option value='fa-ruble'>&#xf158; ruble</option>
<option value='fa-rupee'>&#xf156; rupee</option>
<option value='fa-s15'>&#xf2cd; s15</option>
<option value='fab fa-safari'>&#xf267; safari</option>
<option value='fa-save'>&#xf0c7; save</option>
<option value='fa-scissors'>&#xf0c4; scissors</option>
<option value='fa-scribd'>&#xf28a; scribd</option>
<option value='fa-search'>&#xf002; search</option>
<option value='fa-search-minus'>&#xf010; search-minus</option>
<option value='fa-search-plus'>&#xf00e; search-plus</option>
<option value='fa-sellsy'>&#xf213; sellsy</option>
<option value='fa-send'>&#xf1d8; send</option>
<option value='fa-send-o'>&#xf1d9; send-o</option>
<option value='fa-server'>&#xf233; server</option>
<option value='fa-share'>&#xf064; share</option>
<option value='fa-share-alt'>&#xf1e0; share-alt</option>
<option value='fa-share-alt-square'>&#xf1e1; share-alt-square</option>
<option value='fa-share-square'>&#xf14d; share-square</option>
<option value='fa-share-square-o'>&#xf045; share-square-o</option>
<option value='fa-shekel'>&#xf20b; shekel</option>
<option value='fa-sheqel'>&#xf20b; sheqel</option>
<option value='fa-shield'>&#xf132; shield</option>
<option value='fa-ship'>&#xf21a; ship</option>
<option value='fa-shirtsinbulk'>&#xf214; shirtsinbulk</option>
<option value='fa-shopping-bag'>&#xf290; shopping-bag</option>
<option value='fa-shopping-basket'>&#xf291; shopping-basket</option>
<option value='fa-shopping-cart'>&#xf07a; shopping-cart</option>
<option value='fa-shower'>&#xf2cc; shower</option>
<option value='fa-sign-in'>&#xf090; sign-in</option>
<option value='fa-sign-language'>&#xf2a7; sign-language</option>
<option value='fa-sign-out'>&#xf08b; sign-out</option>
<option value='fa-signal'>&#xf012; signal</option>
<option value='fa-signing'>&#xf2a7; signing</option>
<option value='fa-simplybuilt'>&#xf215; simplybuilt</option>
<option value='fa-sitemap'>&#xf0e8; sitemap</option>
<option value='fa-skyatlas'>&#xf216; skyatlas</option>
<option value='fa-skype'>&#xf17e; skype</option>
<option value='fa-slack'>&#xf198; slack</option>
<option value='fa-sliders'>&#xf1de; sliders</option>
<option value='fa-slideshare'>&#xf1e7; slideshare</option>
<option value='fa-smile-o'>&#xf118; smile-o</option>
<option value='fab fa-snapchat'>&#xf2ab; snapchat</option>
<option value='fab fa-snapchat-ghost'>&#xf2ac; snapchat-ghost</option>
<option value='fab fa-snapchat-square'>&#xf2ad; snapchat-square</option>
<option value='fa-snowflake-o'>&#xf2dc; snowflake-o</option>
<option value='fa-soccer-ball-o'>&#xf1e3; soccer-ball-o</option>
<option value='fa-sort'>&#xf0dc; sort</option>
<option value='fa-sort-alpha-asc'>&#xf15d; sort-alpha-asc</option>
<option value='fa-sort-alpha-desc'>&#xf15e; sort-alpha-desc</option>
<option value='fa-sort-amount-asc'>&#xf160; sort-amount-asc</option>
<option value='fa-sort-amount-desc'>&#xf161; sort-amount-desc</option>
<option value='fa-sort-asc'>&#xf0de; sort-asc</option>
<option value='fa-sort-desc'>&#xf0dd; sort-desc</option>
<option value='fa-sort-down'>&#xf0dd; sort-down</option>
<option value='fa-sort-numeric-asc'>&#xf162; sort-numeric-asc</option>
<option value='fa-sort-numeric-desc'>&#xf163; sort-numeric-desc</option>
<option value='fa-sort-up'>&#xf0de; sort-up</option>
<option value='fa-soundcloud'>&#xf1be; soundcloud</option>
<option value='fa-space-shuttle'>&#xf197; space-shuttle</option>
<option value='fa-spinner'>&#xf110; spinner</option>
<option value='fa-spoon'>&#xf1b1; spoon</option>
<option value='fa-spotify'>&#xf1bc; spotify</option>
<option value='fa-square'>&#xf0c8; square</option>
<option value='fa-square-o'>&#xf096; square-o</option>
<option value='fa-stack-exchange'>&#xf18d; stack-exchange</option>
<option value='fa-stack-overflow'>&#xf16c; stack-overflow</option>
<option value='fa-star'>&#xf005; star</option>
<option value='fa-star-half'>&#xf089; star-half</option>
<option value='fa-star-half-empty'>&#xf123; star-half-empty</option>
<option value='fa-star-half-full'>&#xf123; star-half-full</option>
<option value='fa-star-half-o'>&#xf123; star-half-o</option>
<option value='fa-star-o'>&#xf006; star-o</option>
<option value='fa-steam'>&#xf1b6; steam</option>
<option value='fa-steam-square'>&#xf1b7; steam-square</option>
<option value='fa-step-backward'>&#xf048; step-backward</option>
<option value='fa-step-forward'>&#xf051; step-forward</option>
<option value='fa-stethoscope'>&#xf0f1; stethoscope</option>
<option value='fa-sticky-note'>&#xf249; sticky-note</option>
<option value='fa-sticky-note-o'>&#xf24a; sticky-note-o</option>
<option value='fa-stop'>&#xf04d; stop</option>
<option value='fa-stop-circle'>&#xf28d; stop-circle</option>
<option value='fa-stop-circle-o'>&#xf28e; stop-circle-o</option>
<option value='fa-street-view'>&#xf21d; street-view</option>
<option value='fa-strikethrough'>&#xf0cc; strikethrough</option>
<option value='fa-stumbleupon'>&#xf1a4; stumbleupon</option>
<option value='fa-stumbleupon-circle'>&#xf1a3; stumbleupon-circle</option>
<option value='fa-subscript'>&#xf12c; subscript</option>
<option value='fa-subway'>&#xf239; subway</option>
<option value='fa-suitcase'>&#xf0f2; suitcase</option>
<option value='fa-sun-o'>&#xf185; sun-o</option>
<option value='fa-superpowers'>&#xf2dd; superpowers</option>
<option value='fa-superscript'>&#xf12b; superscript</option>
<option value='fa-support'>&#xf1cd; support</option>
<option value='fa-table'>&#xf0ce; table</option>
<option value='fa-tablet'>&#xf10a; tablet</option>
<option value='fa-tachometer'>&#xf0e4; tachometer</option>
<option value='fa-tag'>&#xf02b; tag</option>
<option value='fa-tags'>&#xf02c; tags</option>
<option value='fa-tasks'>&#xf0ae; tasks</option>
<option value='fa-taxi'>&#xf1ba; taxi</option>
<option value='fa-telegram'>&#xf2c6; telegram</option>
<option value='fa-television'>&#xf26c; television</option>
<option value='fa-tencent-weibo'>&#xf1d5; tencent-weibo</option>
<option value='fa-terminal'>&#xf120; terminal</option>
<option value='fa-text-height'>&#xf034; text-height</option>
<option value='fa-text-width'>&#xf035; text-width</option>
<option value='fa-th'>&#xf00a; th</option>
<option value='fa-th-large'>&#xf009; th-large</option>
<option value='fa-th-list'>&#xf00b; th-list</option>
<option value='fa-themeisle'>&#xf2b2; themeisle</option>
<option value='fa-thermometer'>&#xf2c7; thermometer</option>
<option value='fa-thermometer-0'>&#xf2cb; thermometer-0</option>
<option value='fa-thermometer-1'>&#xf2ca; thermometer-1</option>
<option value='fa-thermometer-2'>&#xf2c9; thermometer-2</option>
<option value='fa-thermometer-3'>&#xf2c8; thermometer-3</option>
<option value='fa-thermometer-4'>&#xf2c7; thermometer-4</option>
<option value='fa-thermometer-empty'>&#xf2cb; thermometer-empty</option>
<option value='fa-thermometer-full'>&#xf2c7; thermometer-full</option>
<option value='fa-thermometer-half'>&#xf2c9; thermometer-half</option>
<option value='fa-thermometer-quarter'>&#xf2ca; thermometer-quarter</option>
<option value='fa-thermometer-three-quarters'>&#xf2c8; thermometer-three-quarters</option>
<option value='fa-thumb-tack'>&#xf08d; thumb-tack</option>
<option value='fa-thumbs-down'>&#xf165; thumbs-down</option>
<option value='fa-thumbs-o-down'>&#xf088; thumbs-o-down</option>
<option value='fa-thumbs-o-up'>&#xf087; thumbs-o-up</option>
<option value='fa-thumbs-up'>&#xf164; thumbs-up</option>
<option value='fa-ticket'>&#xf145; ticket</option>
<option value='fa-times'>&#xf00d; times</option>
<option value='fa-times-circle'>&#xf057; times-circle</option>
<option value='fa-times-circle-o'>&#xf05c; times-circle-o</option>
<option value='fa-times-rectangle'>&#xf2d3; times-rectangle</option>
<option value='fa-times-rectangle-o'>&#xf2d4; times-rectangle-o</option>
<option value='fa-tint'>&#xf043; tint</option>
<option value='fa-toggle-down'>&#xf150; toggle-down</option>
<option value='fa-toggle-left'>&#xf191; toggle-left</option>
<option value='fa-toggle-off'>&#xf204; toggle-off</option>
<option value='fa-toggle-on'>&#xf205; toggle-on</option>
<option value='fa-toggle-right'>&#xf152; toggle-right</option>
<option value='fa-toggle-up'>&#xf151; toggle-up</option>
<option value='fa-trademark'>&#xf25c; trademark</option>
<option value='fa-train'>&#xf238; train</option>
<option value='fa-transgender'>&#xf224; transgender</option>
<option value='fa-transgender-alt'>&#xf225; transgender-alt</option>
<option value='fa-trash'>&#xf1f8; trash</option>
<option value='fa-trash-o'>&#xf014; trash-o</option>
<option value='fa-tree'>&#xf1bb; tree</option>
<option value='fa-trello'>&#xf181; trello</option>
<option value='fa-tripadvisor'>&#xf262; tripadvisor</option>
<option value='fa-trophy'>&#xf091; trophy</option>
<option value='fa-truck'>&#xf0d1; truck</option>
<option value='fa-try'>&#xf195; try</option>
<option value='fa-tty'>&#xf1e4; tty</option>
<option value='fa-tumblr'>&#xf173; tumblr</option>
<option value='fa-tumblr-square'>&#xf174; tumblr-square</option>
<option value='fa-turkish-lira'>&#xf195; turkish-lira</option>
<option value='fa-tv'>&#xf26c; tv</option>
<option value='fab fa-twitch'>&#xf1e8; twitch</option>
<option value='gab fa-twitter'>&#xf099; twitter</option>
<option value='fab fa-twitter-square'>&#xf081; twitter-square</option>
<option value='fa-umbrella'>&#xf0e9; umbrella</option>
<option value='fa-underline'>&#xf0cd; underline</option>
<option value='fa-undo'>&#xf0e2; undo</option>
<option value='fa-universal-access'>&#xf29a; universal-access</option>
<option value='fa-university'>&#xf19c; university</option>
<option value='fa-unlink'>&#xf127; unlink</option>
<option value='fa-unlock'>&#xf09c; unlock</option>
<option value='fa-unlock-alt'>&#xf13e; unlock-alt</option>
<option value='fa-unsorted'>&#xf0dc; unsorted</option>
<option value='fa-upload'>&#xf093; upload</option>
<option value='fa-usb'>&#xf287; usb</option>
<option value='fa-usd'>&#xf155; usd</option>
<option value='fa-user'>&#xf007; user</option>
<option value='fa-user-circle'>&#xf2bd; user-circle</option>
<option value='fa-user-circle-o'>&#xf2be; user-circle-o</option>
<option value='fa-user-md'>&#xf0f0; user-md</option>
<option value='fa-user-o'>&#xf2c0; user-o</option>
<option value='fa-user-plus'>&#xf234; user-plus</option>
<option value='fa-user-secret'>&#xf21b; user-secret</option>
<option value='fa-user-times'>&#xf235; user-times</option>
<option value='fa-users'>&#xf0c0; users</option>
<option value='fa-vcard'>&#xf2bb; vcard</option>
<option value='fa-vcard-o'>&#xf2bc; vcard-o</option>
<option value='fa-venus'>&#xf221; venus</option>
<option value='fa-venus-double'>&#xf226; venus-double</option>
<option value='fa-venus-mars'>&#xf228; venus-mars</option>
<option value='fa-viacoin'>&#xf237; viacoin</option>
<option value='fa-viadeo'>&#xf2a9; viadeo</option>
<option value='fa-viadeo-square'>&#xf2aa; viadeo-square</option>
<option value='fa-video-camera'>&#xf03d; video-camera</option>
<option value='fa-vimeo'>&#xf27d; vimeo</option>
<option value='fa-vimeo-square'>&#xf194; vimeo-square</option>
<option value='fa-vine'>&#xf1ca; vine</option>
<option value='fa-vk'>&#xf189; vk</option>
<option value='fa-volume-control-phone'>&#xf2a0; volume-control-phone</option>
<option value='fa-volume-down'>&#xf027; volume-down</option>
<option value='fa-volume-off'>&#xf026; volume-off</option>
<option value='fa-volume-up'>&#xf028; volume-up</option>
<option value='fa-warning'>&#xf071; warning</option>
<option value='fa-wechat'>&#xf1d7; wechat</option>
<option value='fa-weibo'>&#xf18a; weibo</option>
<option value='fa-weixin'>&#xf1d7; weixin</option>
<option value='fa-whatsapp'>&#xf232; whatsapp</option>
<option value='fa-wheelchair'>&#xf193; wheelchair</option>
<option value='fa-wheelchair-alt'>&#xf29b; wheelchair-alt</option>
<option value='fa-wifi'>&#xf1eb; wifi</option>
<option value='fa-wikipedia-w'>&#xf266; wikipedia-w</option>
<option value='fa-window-close'>&#xf2d3; window-close</option>
<option value='fa-window-close-o'>&#xf2d4; window-close-o</option>
<option value='fa-window-maximize'>&#xf2d0; window-maximize</option>
<option value='fa-window-minimize'>&#xf2d1; window-minimize</option>
<option value='fa-window-restore'>&#xf2d2; window-restore</option>
<option value='fa-windows'>&#xf17a; windows</option>
<option value='fa-won'>&#xf159; won</option>
<option value='fa-wordpress'>&#xf19a; wordpress</option>
<option value='fa-wpbeginner'>&#xf297; wpbeginner</option>
<option value='fa-wpexplorer'>&#xf2de; wpexplorer</option>
<option value='fa-wpforms'>&#xf298; wpforms</option>
<option value='fa-wrench'>&#xf0ad; wrench</option>
<option value='fa-xing'>&#xf168; xing</option>
<option value='fa-xing-square'>&#xf169; xing-square</option>
<option value='fa-y-combinator'>&#xf23b; y-combinator</option>
<option value='fa-y-combinator-square'>&#xf1d4; y-combinator-square</option>
<option value='fa-yahoo'>&#xf19e; yahoo</option>
<option value='fa-yc'>&#xf23b; yc</option>
<option value='fab fa-yc-square'>&#xf1d4; yc-square</option>
<option value='fab fa-yelp'>&#xf1e9; yelp</option>
<option value='fab fa-yen'>&#xf157; yen</option>
<option value='fab fa-yoast'>&#xf2b1; yoast</option>
<option value='fab fa-youtube'>&#xf167; youtube</option>
<option value='fab fa-youtube-play'>&#xf16a; youtube-play</option>
<option value='fab fa-youtube-square'>&#xf166; youtube-square</option>
  
  </select>
        </div>
        <div class="col-6 my-2">
          <label for="amText" class="form-label">Text</label>
          <input type="text" id="amText" name="amText" class="form-control" placeholder="Text">
        </div>
        <div class="col-2 my-2">
          <button type="button" class="btn btn-primary" onclick="addAmRow()">Add</button>
        </div>
        <div class="col-12 mx-3 my-2">
            <ol class="list-group list-group-numbered" id="amList">
            </ol>
        </div>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="saveAmm()">Save</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>

// let IconList = []

//   getIcons = () =>{
//     axios.get('{{ENV('APP_URL')}}/assets/js/iconsA.json')
//     .then(res=>{
//       IconList = res.data
//       IconList.map(x=>{
//         $('#amIcon').append(`<option value='${x}'>${x}</option>`);
//       })
//     }).catch(err=>{
//       console.log(err)
//     })
//   }
//   getIcons()
  let amArr = []

  addAmRow = () =>{
    let ammIcon = document.getElementById('ammIcon').value;
    let amText = document.getElementById('amText').value;

    $('#amList').append(`<li class="list-group-item"><i class="${ammIcon} fa-fw fa-solid"></i> ${amText}</li>`);

    amArr.push({
      id:amArr.length + 1,
      icon:ammIcon,
      text:amText
    })

    document.getElementById('ammIcon').value = 0;
    document.getElementById('amText').value = '';

  }


  saveAmm = () =>{
    document.getElementById('ameneties').value = JSON.stringify(amArr);
    $('#basicModal4').modal('hide');
  }
</script>

@endif

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



  let selectedImages = JSON.parse(document.getElementById('imgArr').value);
  let selectedImagesArr = [];
  let selectedFeatures = [];

  selectedImages.map(x=>selectedImagesArr.push(''))
    
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
  let img = document.getElementById(`img${id}`);
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
    // console.log(document.getElementById('imgArr').value)
    // console.log(selectedImages)
    document.getElementById('selectname1').innerHTML = '';
    document.getElementById('imgType').value = '';
    selectedImagesArr.map(x => {
      if(x == '')
      {
        $('#selectname1').append(`<li class="list-group-item">Image</li>`);
      }
     else{
      $('#selectname1').append(`<li class="list-group-item">${x}</li>`);
     }
    })
    // let oldImg = JSON.parse(document.getElementById('imgArr').value);
    // selectedImages.map(x => oldImg.push(x));
    // document.getElementById('imgArr').value = JSON.stringify(oldImg);
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
        let page_title = document.getElementById('page_title').value;
        let page_description = document.getElementById('page_description').value;
        let page_schema = document.getElementById('page_schema').value;
        let inp_htmlcode = document.getElementById("inp_htmlcode").value;
        let address = document.getElementById("address").value;
        let state =document.getElementById('state').value;
        let zipCode =document.getElementById('zipCode').value;
        let price =document.getElementById('price').value;
        let size =document.getElementById('size').value;
        let beadroom =document.getElementById('beadroom').value;
        let bathroom =document.getElementById('bathroom').value;
        $(".error").remove();

    if (name.length < 1) {
    $('#name').after('<span class="error">This field is required*</span>');
    return false;
    }
    if (page_title.length < 1) {
    $('#page_title').after('<span class="error">Page Title is required*</span>');
    return false;
    }
     if (page_description.length < 1) {
    $('#page_description').after('<span class="error">Page Description  is required*</span>');
    return false;
    }
    if (page_schema.length < 1) {
    $('#page_schema').after('<span class="error">Page Schema  is required*</span>');
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
    else{
        Swal.fire({
            title: "Thankyou!",   
            text: "Property Update Successfully !",   
            type: "success", 
            showConfirmButton: false, 
            allowOutsideClick: false, 
            timer: 4000,
            });
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
          Swal.fire({
            position: 'top-end',
            type: 'success',
            title: 'Image Uploaded',
            showConfirmButton: false,
            timer: 1500
          })
          $("#showAllImages").trigger("click");
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
</script>

<script>
var lat = 0;
var lng = 0;

  function init() {
    var input = document.getElementById("address");
    var autocomplete = new google.maps.places.Autocomplete(input);

    
    var input2 = document.getElementById("placeName");
    var autocomplete2 = new google.maps.places.Autocomplete(input2);

    autocomplete2.addListener('place_changed', function() {
      var place = autocomplete2.getPlace();
      lat = place.geometry.location.lat();
      lng = place.geometry.location.lng();
    });
  }

  google.maps.event.addDomListener(window, "load", init);
</script>
@endsection