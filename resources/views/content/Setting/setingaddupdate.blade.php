

@extends('layouts/contentNavbarLayout')

@section('title', 'Acoount - Acoount Setting')

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
  <span class="text-muted fw-light">Home Setting </span>
</h4>
<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      {{-- <h5 class="card-header">Homepage Settings</h5> --}}
      <!-- Account -->
      <!-- <form id="formAccountSettings" action="{{ENV('APP_URL')}}/updatehomepage" method="post" onsubmit="return settingformsubmit()" enctype="multipart/form-data"> -->
      @foreach($tableData as $row)
        @csrf
      <div class="card-body">
          <div class="row">
            <div class="mb-3 col-md-12">
              <h5 class="card-header p-0 my-3">Homepage</h5>
            </div>
            <input class="form-control" type="hidden" id="web_id" name="web_id"  value="{{$row->id}}" />
             <div class="mb-3 col-md-12">
                    <label for="title" class="form-label">Page Title</label>
                    <input class="form-control" type="text" id="page_title" name="page_title"  value="{{$row->page_title}}" />
                  </div>
                  <div class="mb-3 col-md-6">
                    <label for="page_description" class="form-label">Page Description</label>
                    <textarea id="page_description" name="page_description" class="form-control">{{$row->page_description}}</textarea>
                  </div>     
                  
                   <div class="mb-3 col-md-6">
                    <label for="page_schema" class="form-label">Page Schema Json</label>
                    <textarea id="page_schema" name="page_schema" class="form-control">{{$row->page_schema}}</textarea>
                  </div> 

                <div class="mb-3 col-md-6">
                <label for="abt_title" class="form-label">About Us Title</label>
                <input class="form-control" type="text" id="abt_title" name="abt_title"  value="{{$row->abt_title}}" />
                </div>

                <div class="mb-3 col-md-6">
                <label for="abt_sub_title" class="form-label">About Us Sub Title</label>
                <input class="form-control" type="text" id="abt_sub_title" name="abt_sub_title"  value="{{$row->abt_sub_title}}" />
                </div>


                  <div class="mb-3 col-md-12">
                    <label for="inp_htmlcode" class="form-label">About Us Description</label>
                    <textarea id="inp_htmlcode" name="abt_description" class="form-control">{{$row->abt_description}}</textarea>
                  </div>     
                  

                  <div class="mb-3 col-md-6">
                    <label for="banner_image" class="form-label">Home Banner Image *</label>
                    <input type="hidden" name="oldbannerimage" id="oldbannerimage" value="{{$row->banner_image}}"/>
                    <input type="file" class="form-control" name="banner_image" id="banner_image"/>
                    </div>

                  <div class="mb-3 col-md-6">
                    <label for="abt_image" class="form-label">About Us Image *</label>
                    <input type="hidden" name="oldimage" id="oldimage" value="{{$row->abt_image}}"/>
                    <input type="file" class="form-control" name="abt_image" id="abt_image"/>
                    </div>

                    <div class="mb-3 col-md-4">
                    <label for="exampleFormControlSelect1" class="form-label">Home Banner Image *</label>
                    <img  id="myImg" class="" src="{{ENV('APP_URL')}}/BannerImage/{{$row->banner_image}}" data-bigger-src="{{ENV('APP_URL')}}/BannerImage/{{$row->banner_image}}" disabled />
                    </div>

                    <div class="mb-3 col-md-4">
                    <label for="exampleFormControlSelect1" class="form-label">About Us Image *</label>
                    <img  id="myImg" class="" src="{{ENV('APP_URL')}}/AboutusImage/{{$row->abt_image}}" data-bigger-src="{{ENV('APP_URL')}}/AboutusImage/{{$row->abt_image}}" disabled />
                    </div>

            <div class="mb-3 col-md-12">
              <h5 class="card-header p-0 my-3">Footer Section</h5>
            </div>

            <div class="mb-3 col-md-12">
              <label for="footer_desc" class="form-label">G force Description</label>
              <textarea class="form-control" name="footer_desc" id="footer_desc">{{$row->footer_desc}}</textarea>
            </div>

            <div class="mb-3 col-md-12">
              <label for="dance_desc" class="form-label">Dance Center Description</label>
              <textarea class="form-control" name="dance_desc" id="dance_desc">{{$row->dance_desc}}</textarea>
            </div>

          

            <div class="mb-3 col-md-6">
              <label for="c_number" class="form-label">Footer Calling Number</label>
              <input class="form-control" type="text" name="c_number" id="c_number" value="{{$row->c_number}}" />
            </div>
              
            <div class="mb-3 col-md-6">
             <label for="w_number" class="form-label">Footer Address</label>
             <textarea class="form-control"  name="w_number" id="w_number">{{$row->w_number}}</textarea>
            </div>
          

            <div class="mb-3 col-md-12">
              <h5 class="card-header p-0 my-3">Social Icons</h5>
            </div>

            <div class="mb-3 col-md-12">
              <div class="row my-2" style="align-items: flex-end;"> 
                <div class="col-2">
                  <label for="amIcon" class="form-label">Icon</label>
                  <input type="hidden" name="ameneties" id="ameneties"  value="{{$row->ameneties}}" />
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
                <div class="col-4">
                  <label for="amText" class="form-label">URL</label>
                  <input type="text" id="amText" name="amText" class="form-control" placeholder="URL">
                </div>
                <div class="col-4">
                  <label for="amText" class="form-label">Image</label>
                  <input type="file" class="form-control" name="social_image" id="social_image" value=""/>
                </div>
                <div class="col-2">
                  <button type="button" class="btn btn-primary" onclick="addAmRow()">Add</button>
                </div>
                <div class="col-12 my-3">
                  <ol class="list-group list-group-numbered" id="amList">
                    @if($row->ameneties != '')
                    @foreach(json_decode($row->ameneties) as $row2)
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
              <h5 class="card-header p-0 my-3">Script Code</h5>
            </div>
            
            <div class="mb-3 col-md-12">
             <label for="header_code" class="form-label">Head Script Code</label>
             <textarea class="form-control"  name="header_code" id="header_code" rows="10">{{$row->header_code}} </textarea>
            </div>
            
            <div class="mb-3 col-md-12">
             <label for="footer_code" class="form-label">Body Script Code</label>
             <textarea class="form-control"  name="footer_code" id="footer_code" rows="10"> {{$row->footer_code}} </textarea>
            </div>
            
           <div class="mb-3 col-md-12">
              <h5 class="card-header p-0 my-3">Email ID</h5>
            </div>
            
            <div class="mb-3 col-md-6">
             <label for="cUsEmail" class="form-label">Email for Contact us Page</label>
             <input class="form-control" type="text" name="cUsEmail" id="cUsEmail" value="{{$row->cUsEmail}}" />
            </div>
            
            <div class="mb-3 col-md-6">
             <label for="creersEmail" class="form-label">Email for Career Page</label>
             <input class="form-control" type="text" name="creersEmail" id="creersEmail" value="{{$row->creersEmail}}" />
            </div>
            
            
          </div>
          <div class="mt-2">
            <button type="submit" class="btn btn-primary me-2" onclick="settingformsubmit()">Save changes</button>
          </div>
        <!-- </form> -->
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

// Get Editor code here  first make simple then send it to Editor Field

// var editor1 = new RichTextEditor(document.getElementById("div_editor1"));

// editor1.attachEvent("change", function () {
//     document.getElementById("inp_htmlcode").value = editor1.getHTMLCode();
// });

// $(document).ready(function() {
//     let oldhtml = document.getElementById('inp_htmlcode').value
//     editor1.insertHTML(oldhtml)

// });

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
    let social_image = document.getElementById('social_image').files[0];
    $('#amList').append(`<li class="list-group-item"><i class="${amIcon} fa-fw fa-solid"></i> ${amText}</li>`);

    amArr.push({
      id:amArr.length + 1,
      icon:amIcon,
      text:amText
    })

    document.getElementById('ammIcon').value = 0;
    document.getElementById('amText').value = '';
    document.getElementById('social_image').value = '';



    saveAmm(social_image);

  }

  saveAmm = (social_image) =>{
      let ameneties = JSON.stringify(amArr);
     let web_id =document.getElementById('web_id').value;
    document.getElementById('ameneties').value = ameneties;
    let data = new FormData;
    data.append('ameneties',ameneties);
    data.append('img',social_image);
    data.append('web_id',web_id);

    axios.post('{{ENV("APP_URL")}}/updatehomepageameneties',data).then((result) => {
      console.log(result.data);
      document.getElementById('ameneties').value=JSON.stringify(result.data);
      amArr=result.data;
    }).catch((err) => {
      console.log(err)
    });
  }

  settingformsubmit = () =>
  {

        let page_title = document.getElementById('page_title').value;
        let page_description = document.getElementById('page_description').value;
        let web_id =document.getElementById('web_id').value;
        let page_schema = document.getElementById('page_schema').value;
        let abt_title = document.getElementById('abt_title').value;
        let abt_sub_title = document.getElementById('abt_sub_title').value;
        let inp_htmlcode =document.getElementById("inp_htmlcode").value;
        let oldimage =document.getElementById('oldimage').value;
        let oldbannerimage =document.getElementById('oldbannerimage').value;
        var abt_image =$('#abt_image')[0].files;
        var banner_image =$('#banner_image')[0].files;
        var header_code =document.getElementById('header_code').value;
        var footer_code =document.getElementById('footer_code').value;
        var footer_desc =document.getElementById('footer_desc').value;
        var dance_desc =document.getElementById('dance_desc').value;
        var c_number =document.getElementById('c_number').value;
        var w_number =document.getElementById('w_number').value;
        var ameneties =document.getElementById('ameneties').value;
        var cUsEmail =document.getElementById('cUsEmail').value;
        var creersEmail =document.getElementById('creersEmail').value;
        
        $(".error").remove();
      
        
        if (abt_title.length < 1) {
          $('#abt_title').after('<span class="error">About us title is required*</span>');
          return false;
        }

        if (abt_sub_title.length < 1) {
          $('#abt_sub_title').after('<span class="error">About us sub title is required*</span>');
          return false;
        }

        if (inp_htmlcode.length < 1) {
          $('#inp_htmlcode').after('<span class="error">About us  Description is required*</span>');
          return false;
        }

        if (footer_desc.length < 1) {
          $('#footer_desc').after('<span class="error">This field is required*</span>');
          return false;
        }
        
        if (dance_desc.length < 1) {
          $('#dance_desc').after('<span class="error">This field is required*</span>');
          return false;
        }
        
        if (c_number.length < 8 || c_number.length > 13 ) {
          $('#c_number').after('<span class="error">Contact number Length Should be in Between 8 To 13 Digit*</span>');
          return false;
        }
         if (w_number.length < 1) {
          $('#w_number').after('<span class="error">Address is Required*</span>');
          return false;
        }
        
        if (cUsEmail.length < 1) {
            $('#cUsEmail').after('<span class="error">This field is required*</span>');
            return false;
        }
        
        if (creersEmail.length < 1) {
            $('#creersEmail').after('<span class="error">This field is required*</span>');
            return false;
        }
        
      
      if (ameneties.length < 1) {
        $('#ameneties').after('<span class="error">This field is required*</span>');
        return false;
        }

    else{
            let data = new FormData;
            data.append('page_title',page_title);
            data.append('page_description',page_description);
            data.append('page_schema',page_schema);
            data.append('abt_title',abt_title);
            data.append('abt_sub_title',abt_sub_title);
            data.append('abt_description',inp_htmlcode);
            data.append('abt_image',abt_image[0]);
            data.append('oldimage',oldimage);
            data.append('banner_image',banner_image[0]);
            data.append('oldbannerimage',oldbannerimage);
            data.append('web_id',web_id);
            data.append('header_code',header_code);
            data.append('footer_code',footer_code);
            data.append('footer_desc',footer_desc);
            data.append('dance_desc',dance_desc);
            data.append('c_number',c_number);
            data.append('w_number',w_number);
            data.append('ameneties',ameneties);
            data.append('cUsEmail',cUsEmail);
            data.append('creersEmail',creersEmail);
            axios.post('{{ENV("APP_URL")}}/updatehomepage',data).then((result) => {
            if(result.data == 1)
            {
            Swal.fire(
                '',
                'Setting Update Successfully',
                'success'
            )
            .then((result) => {
              window.location.href = '{{ENV("APP_URL")}}/setting';
            });
            }


            }).catch((err) => {
            console.log(err)
            });

    }  
  }
  
</script>

@endsection
