@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Privacy Policy')

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
<script type="text/javascript" src='{{asset('assets/richtexteditor/plugins/all_plugins.js')}}'></script>
<script type="text/javascript" src='{{asset('assets/richtexteditor/rte-upload.js')}}'></script>
@section('content')
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
    
</style>
<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">Privacy Policy</h5>
          <!-- Account -->
          <!--<form action="{{ENV('APP_URL')}}/updateprivacy" method="post" onsubmit="return checkvalidate()">-->
            @csrf
          <div class="card-body">
              <div class="row">
                  <div class="mb-3 col-md-12">
                    <label for="description" class="form-label">Privacy Policy</label>
                    <input name="description" id="inp_htmlcode" type="hidden" value="{{$tableData}}"  />
                    <div id="div_editor1" name='description' class="richtexteditor"></div>
                  </div>
                  </div>
            </div>
              </div>
          </div>
          <hr class="my-0">
          <div class="card-body">
              
            <div class="row">
                <div class="mt-4">
                <button type="submit" class="btn btn-primary me-2" onclick="return checkvalidate()">Save changes</button>
                </div>
            </div>
        </div>
        <!-- /Notifications -->
      </div>
  </div>
<!--</form>-->




<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
 
var editor1 = new RichTextEditor(document.getElementById("div_editor1"));

editor1.attachEvent("change", function () {
    document.getElementById("inp_htmlcode").value = editor1.getHTMLCode();
});

$(document).ready(function() {
    let oldhtml = document.getElementById('inp_htmlcode').value
    editor1.insertHTML(oldhtml)
});

    checkvalidate = () =>{
        let inp_htmlcode = document.getElementById("inp_htmlcode").value;
        let data = new FormData;
        data.append('privacy',inp_htmlcode);
        $(".error").remove();
    if (inp_htmlcode.length < 1) {
      $('#inp_htmlcode').after('<span class="error">This field is required*</span>');
      return false;
    }
    
    else{
    axios.post('{{ENV("APP_URL")}}/updateprivacy',data).then((result) => {
     if(result.data == 1){
          Swal.fire(
            'Thankyou!',
            'Privacy Update Successfully !',
            'success',
            ).then((result) => {
             location.reload();
             });
     }
    }).catch((err) => {
      console.log(err);
    });
  }
     
    }

</script>

@endsection

