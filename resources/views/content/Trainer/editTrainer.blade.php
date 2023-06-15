

@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Edit Trainer')

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
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('assets/richtexteditor/rte_theme_default.css')}}" />
<script type="text/javascript" src="{{asset('assets/richtexteditor/rte.js')}}"></script>
<script type="text/javascript" src="{{asset(' assets/richtexteditor/plugins/all_plugins.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/richtexteditor/rte-upload.js')}}"></script>
<script type="text/javascript" src="{{asset('js/mobiscroll.javascript.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('css/mobiscroll.javascript.min.css')}}" />
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
  #ammIcon
  {
    font-family: fontAwesome;
    font-size: 12px;
    font-weight: 100;
  }
   
</style>
<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">Edit Trainer</h5>
          <!-- Account -->
          <div class="card-body">
              <div class="row">
              <input type="hidden" name="proid" id="proid" value="{{$getTrainer->id}}" />

              <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Name *</label>
                    <input class="form-control" type="text" id="name" name="name"  value="{{$getTrainer->name}}" />
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Branch Name *</label>
                    <select id="branch_id" name="branch_id" class="form-select"  aria-label="Default select example">
                      <option value="0" selected="">Select Branch</option>
                      @foreach($branch as $r)
                      <option value="{{$r->id}}" <?php echo $getTrainer->branch_id == $r->id ? 'selected' : null ?>>{{$r->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  
                  <div class="mb-3 col-md-6">
                    <label for="speciality" class="form-label">Speciality*</label>
                    <input class="form-control" type="text" id="speciality" name="speciality"  value="{{$getTrainer->speciality}}" />
                  </div>

                   <div class="mb-3 col-md-6">
                    <label for="title" class="form-label">Page Title *</label>
                    <input class="form-control" type="text" id="page_title" name="page_title"  value="{{$getTrainer->page_title}}" />
                  </div>
                     <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Description *</label>
                    <textarea id="page_description" name="page_description" class="form-control">{{$getTrainer->page_description}}</textarea>
                  </div>     
                  
                   <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Page Schema Json *</label>
                    <textarea id="page_schema" name="page_schema" class="form-control">{{$getTrainer->page_schema}}</textarea>
                  </div>  


                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Status *</label>
                    <select id="status" name="status" class="form-select"  aria-label="Default select example">
                      <option value="1" <?php echo $getTrainer->status=='1' ? 'selected' : '' ?>>Active</option>
                      <option value="0" <?php echo $getTrainer->status=='0' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                  </div>

                     <div class="mb-3 col-md-6">
                    <label for="image" class="form-label">Trainer Image *</label>
                    <input type="hidden" name="oldimage" id="oldimage" value="{{$getTrainer->image}}"/>
                    <input type="file" class="form-control" name="image" id="image"/>
                    </div>

                  <div class="mb-3 col-md-12">
              <h5 class="card-header p-0 my-3">Social Icons</h5>
              </div>

              <div class="mb-3 col-md-12">
              <div class="row my-2" style="align-items: flex-end;"> 
                <div class="col-3">
                  <label for="amIcon" class="form-label">Icon</label>
                  <input type="hidden" name="ameneties[]" id="ameneties"  value="{{$getTrainer->ameneties}}" />
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
                    @if($getTrainer->ameneties != '')
                    @foreach(json_decode($getTrainer->ameneties) as $row2)
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

//Apply Validation and send data from View to Controller here after sertisfying all condetion

checkvalidate = () =>{
    let name =document.getElementById('name').value;
    let proid =document.getElementById('proid').value;
    let speciality =document.getElementById('speciality').value;
    let page_title =document.getElementById('page_title').value;
    let page_description =document.getElementById('page_description').value;
    let page_schema =document.getElementById('page_schema').value;
    let status =document.getElementById('status').value;
    let oldimage =document.getElementById('oldimage').value;
    var ameneties =document.getElementById('ameneties').value;
    let branchname= document.getElementById('branch_id').value;
    var image =$('#image')[0].files;

    $(".error").remove();

    if(name.length < 1) {
    $('#name').after('<span class="error">This field is required*</span>');
    return false;
    }
      var branch_id=$('#branch_id');

      if(branch_id.val() == 0)
      {
      $('#branch_id').after('<span class="error">Select a Valid Branch Name*</span>');
      return false; 
      }

    if(speciality.length < 1) {
    $('#speciality').after('<span class="error">Speciality is required*</span>');
    return false;
    }
 
    if (ameneties.length < 1) {
        $('#ameneties').after('<span class="error">This field is required*</span>');
        return false;
        }

  else{

     // Send Data with axios ajax code here ...

            let data = new FormData;
            data.append('name',name);
            data.append('proid',proid);
            data.append('branchname',branchname);
            data.append('speciality',speciality);
            data.append('page_title',page_title);
            data.append('page_description',page_description);
            data.append('page_schema',page_schema);
            data.append('image',image[0]);
            data.append('oldimage',oldimage);
            data.append('status',status);
            data.append('ameneties',ameneties);
            axios.post('{{ENV("APP_URL")}}/updateTrainer',data).then((result) => {
            if(result.data == 1)
            {
            Swal.fire(
                '',
                'Trainer Update Successfully',
                'success'
            )
            .then((result) => {
              window.location.href = '{{ENV("APP_URL")}}/allTrainerView';
            });
            }


            }).catch((err) => {
            console.log(err)
            });
     }


}

</script>

<script>
  //Genrate autocomplete map code Here...
  function init() {
    var input = document.getElementById("location");
    var autocomplete = new google.maps.places.Autocomplete(input);
  }

  google.maps.event.addDomListener(window, "load", init);
</script>


@endsection

