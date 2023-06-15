@extends('layouts/contentNavbarLayout')

@section('title', 'Founding Director - Founding Director')

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>

@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection
<link rel="stylesheet" href="{{asset('assets/richtexteditor/rte_theme_default.css')}}" />
<script type="text/javascript" src="{{asset('assets/richtexteditor/rte.js')}}"></script>
<script type="text/javascript" src="{{asset(' assets/richtexteditor/plugins/all_plugins.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/richtexteditor/rte-upload.js')}}"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/5.0.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
          crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{asset('multidatepicker/multidatespickeredit.js')}}"></script>
    <link rel="stylesheet" href="{{asset('multidatepicker/styles.css')}}" />
@section('content')
<style>
  .error{
    color:red;
  }
   #ammIcon
  {
    font-family: fontAwesome;
    font-size: 12px;
    font-weight: 100;
  }
  #myImg{
    height:100px;
    width: 100px;
  }
</style>
@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Founding Director </span>
</h4>
<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      @foreach($tableData as $row)
        @csrf
      <div class="card-body">
          <div class="row">
            <div class="mb-3 col-md-12">
              <h5 class="card-header p-0 my-3">Founding Director</h5>
            </div>
            <input class="form-control" type="hidden" id="web_id" name="web_id"  value="{{$row->id}}" />
            


            <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" type="text" id="name" name="name"  value="{{$row->name}}" />

                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="speciality" class="form-label">Speciality</label>
                    <input class="form-control" type="text" id="speciality" name="speciality"  value="{{$row->speciality}}" />
                  </div>

                   <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Page Title</label>
                    <input class="form-control" type="text" id="page_title" name="page_title"  value="{{$row->page_title}}" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="page_description" class="form-label">Page Description</label>
                    <textarea id="page_description" name="page_description" class="form-control">{{$row->page_description}}</textarea>
                  </div>

                  <div class="mb-3 col-md-12">
              <h5 class="card-header p-0 my-3">Social Icons</h5>
              </div>

              <div class="mb-3 col-md-12">
              <div class="row my-2" style="align-items: flex-end;"> 
                <div class="col-2">
                  <label for="amIcon" class="form-label">Icon</label>
                  <input type="hidden" name="ameneties[]" id="ameneties"  value="{{$row->socialLinks}}" />
                  <select class="form-select" id="ammIcon" name="amIcon">
                  <option value="0">Select Icon</option>
                  <option value='fab fa-tiktok'>&#xF6CC; tik-tok</option>
                  <option value='fab fa-twitch'>&#xf1e8; twitch</option>
                  <option value='fab fa-twitter'>&#xf099; twitter</option>
                  <option value='fab fa-instagram'>&#xf16d; instagram</option>
                  <option value='fab fa-linkedin'>&#xf0e1; linkedin</option>
                  <option value='fab fa-facebook'>&#xf09a; facebook</option>
                  <option value='fab fa-facebook-f'>&#xf09a; facebook-f</option>
                  <option value='fab fa-whatsapp'>&#xf232; whatsapp</option>
                  <option value='fab fa-google'>&#xf1a0; google</option>
                  <option value='fab fa-google-plus'>&#xf0d5; google-plus</option>
                  <option value='fab fa-youtube'>&#xf167; youtube</option>
                  <option value='fab fa-youtube-play'>&#xf16a; youtube-play</option>
                  <option value='fab fa-youtube-square'>&#xf166; youtube-square</option>
                  <option value='fab fa-pinterest'>&#xf0d2; pinterest</option>
                  <option value='fab fa-pinterest-p'>&#xf231; pinterest-p</option>
                  <option value='fab fa-pinterest-square'>&#xf0d3; pinterest-square</option>
                  <option value='fab fa-github'>&#xf09b; github</option>
                  <option value='fab fa-gitlab'>&#xf296; gitlab</option>
                  <option value='fa-phone'>&#xf095; phone</option>
                  <option value='fa-phone-square'>&#xf098; phone-square</option>
               </select>
                </div>

                <div class="col-6">
                  <label for="amText" class="form-label">URL</label>
                  <input type="text" id="amText" name="amText" class="form-control" placeholder="URL">
                </div>
                <div class="col-2">
                  <button type="button" class="btn btn-primary" onclick="addAmRow()">Add</button>
                </div>
                <div class="col-12 my-3">
                  <ol class="list-group list-group-numbered" id="amList">
                    @if($row->socialLinks != '')
                    @foreach(json_decode($row->socialLinks) as $row2)
                    <li class="list-group-item" id="li{{$row2->id}}">
                      <i class="{{$row2->icon}} fa-fw fa-solid"></i><span class="mx-2">{{$row2->text}}</span><i class="fa-trash fa-fw fa-solid" style="cursor: pointer
                      " onclick="deleteItemAm(`{{json_encode($row2->id)}}`)"></i>
                    </li>
                      @endforeach
                      @endif
                  </ol>
                </div>
              </div>
            </div>


  
                     
                  
                   <div class="mb-3 col-md-12">
                    <label for="page_schema" class="form-label">Page Schema Json</label>
                    <textarea id="page_schema" name="page_schema" class="form-control">{{$row->page_schema}}</textarea>
                  </div> 
                
                  <div class="mb-3 col-md-4">
                    <label for="banner_image" class="form-label">Banner Image *</label>
                    <input type="hidden" name="oldbannerimage" id="oldbannerimage" value="{{$row->banner_image}}"/>
                    <input type="file" class="form-control" name="banner_image" id="banner_image"/>
                    </div>

                   <div class="mb-3 col-md-4">
                    <label for="image" class="form-label">Image *</label>
                    <input type="hidden" name="oldimage" id="oldimage" value="{{$row->image}}"/>
                    <input type="file" class="form-control" name="image" id="image"/>
                    </div>

                    <div class="mb-3 col-md-4">
                    <label for="image" class="form-label">Multiple Images *</label>
                    <input type="hidden" name="oldfilenames" id="oldfilenames" value="{{$row->multipleImage}}"/>
                    <input type="file" name="filenames[]" id="filenames" class="myfrm form-control" multiple>
                    </div>

                  

                    <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Banner Image *</label>
                    <img  id="myImg" class="" src="{{ENV('APP_URL')}}/TheForceImage/{{$row->banner_image}}" data-bigger-src="{{ENV('APP_URL')}}/TheForceImage/{{$row->banner_image}}" disabled />
                    </div>

                    <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Image *</label>
                    <img  id="myImg" class="" src="{{ENV('APP_URL')}}/TheForceImage/{{$row->image}}" data-bigger-src="{{ENV('APP_URL')}}/TheForceImage/{{$row->image}}" disabled />
                    </div>

                    <div class="mb-3 col-md-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-control">{{$row->description}}</textarea>
                  </div>  
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2" onclick="handleSubmit()">Save changes</button>
          </div>
        @endforeach
      </div>
      <!-- /Account -->
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>

deleteItemAm = (id) =>{
  let ameneties = JSON.parse(document.getElementById('ameneties').value);
  ameneties = ameneties.filter(x=> x.id != id)
  amArr = amArr.filter(x=> x.id != id)
  document.getElementById('ameneties').value = JSON.stringify(ameneties);
  document.getElementById(`li${id}`).remove();
}

  
  let amArr = JSON.parse(document.getElementById('ameneties').value);

  addAmRow = () =>{
    let amIcon = document.getElementById('ammIcon').value;
    let amText = document.getElementById('amText').value;

    $('#amList').append(`<li class="list-group-item"><i class="${amIcon} fa-fw fa-solid"></i> ${amText}</li>`);

    amArr.push({
      id:amArr.length + 1,
      icon:amIcon,
      text:amText
    })

    document.getElementById('ammIcon').value = 0;
    document.getElementById('amText').value = '';

    saveAmm();

  }

  saveAmm = () =>{
    document.getElementById('ameneties').value = JSON.stringify(amArr);
  }

handleSubmit = () =>
  {

        let page_title = document.getElementById('page_title').value;
        let name = document.getElementById('name').value;
        let speciality = document.getElementById('speciality').value;
        let page_description = document.getElementById('page_description').value;
        let web_id =document.getElementById('web_id').value;
        let page_schema = document.getElementById('page_schema').value;;
        let description =document.getElementById("description").value;
        let oldimage =document.getElementById('oldimage').value;
        let oldbannerimage =document.getElementById('oldbannerimage').value;
        let oldfilenames =document.getElementById('oldfilenames').value;
        var ameneties =document.getElementById('ameneties').value;

        var filenames =$('#filenames')[0].files;
        
        var image =$('#image')[0].files;
        var banner_image =$('#banner_image')[0].files;

        $(".error").remove();
      
        
         
        if (name.length < 1) {
          $('#name').after('<span class="error">Name is required*</span>');
          return false;
        }

        if (speciality.length < 1) {
          $('#speciality').after('<span class="error">Speciality is required*</span>');
          return false;
        }

        if (ameneties.length < 1) {
              $('#ameneties').after('<span class="error">This field is required*</span>');
              return false;
              }

        if (description.length < 1) {
          $('#description').after('<span class="error">Description is required*</span>');
          return false;
        }

       

    else{

            let data = new FormData;
            var totalfiles = document.getElementById('filenames').files.length;
            for (var index = 0; index < totalfiles; index++) {
            data.append("filenames[]", document.getElementById('filenames').files[index]);
            }
            data.append('page_title',page_title);
            data.append('name',name);
            data.append('speciality',speciality);
            data.append('page_description',page_description);
            data.append('page_schema',page_schema);
            data.append('description',description);
            data.append('image',image[0]);
            data.append('oldimage',oldimage);
            data.append('banner_image',banner_image[0]);
            data.append('oldbannerimage',oldbannerimage);
            data.append('oldfilenames',oldfilenames);
            data.append('web_id',web_id);
            data.append('socialLinks',ameneties);
            axios.post('{{ENV("APP_URL")}}/updateFounder',data).then((result) => {
            if(result.data == 1)
            {
            Swal.fire(
                '',
                'Founder Page Update Successfully',
                'success'
            )
            .then((result) => {
              window.location.href = '{{ENV("APP_URL")}}/pages-founding_director';
            });
            }


            }).catch((err) => {
            console.log(err)
            });

    }  
  }
  
</script>

@endsection
