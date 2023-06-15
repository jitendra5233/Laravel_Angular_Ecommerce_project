@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<style>
    .form-check-input[type=checkbox] {
        border: 1px solid #00000061;
    }
    .error{
      color:red;
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
<div class="row">
    <div class="col-md-12">
    <?php
            $access =  json_decode($row->access,true);
            $calid= $row->id;
        ?>
        <div class="card mb-4">
          <h5 class="card-header">Oraganization Calender</h5>
          <!-- Account -->
          {{-- <form action="/submit-role" method="post">
            @csrf --}}
          <div class="card-body">
              <div class="row">
                  <!-- <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Role Name</label>
                    <input class="form-control" type="text" id="roleName" name="roleName" value="" autofocus />
                  </div> -->
              </div>
          </div>
          <hr class="my-0">
          <div class="card-body">
              <div class="row">
                <!-- Notifications -->
                <!-- <h5 class="card-header">Role Access</h5> -->
                <div class="card-body">
                    <span>You can Manage Your Oraganization Calender According to Your Weak Off.</span>
                    <div class="error"></div>
                    <p1 id="message"></p>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless border-bottom">
                    <thead>
                        <tr>
                        <th class="text-nowrap">Days</th>
                        <th class="text-nowrap text-center">Status</th>
                        </tr>
                    </thead>
                     <tbody>
                        <tr>
                        <td class="text-nowrap">Monday</td>
                        <td>
                            <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" id="d1" <?php echo $access['d1'] ? 'checked' : '' ?>  />
                            <input class="form-check-input" type="hidden" id="calid" value="<?php echo  $calid; ?>"/>


                            </div>
                        </td>
                        </tr>
                        <tr>
                        <td class="text-nowrap">Tuesday</td>
                        <td>
                            <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" id="d2" <?php echo $access['d1'] ? 'checked' : '' ?> />
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <td class="text-nowrap">Wednesday</td>
                        <td>
                            <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" id="d3" <?php echo $access['d3'] ? 'checked' : '' ?>  />
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <td class="text-nowrap">Thursday</td>
                        <td>
                            <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" id="d4"  <?php echo $access['d4'] ? 'checked' : '' ?> />
                            </div>
                        </td>
                       
                        </tr>

                        <tr>
                        <td class="text-nowrap">Friday</td>
                        <td>
                            <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" id="d5" <?php echo $access['d5'] ? 'checked' : '' ?>  />
                            </div>
                        </td>
                       
                        </tr>
                        <tr>
                        <td class="text-nowrap">Saturday</td>
                        <td>
                            <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" id="d6" <?php echo $access['d6'] ? 'checked' : '' ?>   />
                            </div>
                        </td>
                       
                        </tr>

                        <tr>
                        <td class="text-nowrap">Sunday</td>
                        <td>
                            <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" id="d7" <?php echo $access['d7'] ? 'checked' : '' ?>   />
                            </div>
                        </td>
                       
                        </tr>
                    </tbody>
                    </table>
                </div>
                <div class="card-body">
              
                    <div class="row">
                        <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2" onclick="handleAddRole({{$row->id}})">Save changes</button>
                        <button type="reset" class="btn btn-outline-secondary">Discard</button>
                        </div>
                    </div>
                </div>
                <!-- /Notifications -->
              </div>
          </div>
        {{-- </form> --}}
          <!-- /Account -->
        </div>
      </div>
</div>
<div class="loader"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script>

// $(document).ready(function(){
//   $("#p4").click(function(){
//     $('#p1').prop('checked', true);
//   });
//   $("#d3").click(function(){
//     $('#p1').prop('checked', true);
//   });
//   $("#p2").click(function(){
//     $('#p1').prop('checked', true);
//   });


//   $("#b4").click(function(){
//     $('#b1').prop('checked', true);
//   });
//   $("#b3").click(function(){
//     $('#b1').prop('checked', true);
//   });
//   $("#b2").click(function(){
//     $('#b1').prop('checked', true);
//   });

// });
    handleAddRole = () =>{
        
        let d1 = document.getElementById('d1').checked;
        let d2 = document.getElementById('d2').checked;
        let d3 = document.getElementById('d3').checked;
        let d4 = document.getElementById('d4').checked;
        let d5 = document.getElementById('d5').checked;
        let d6 = document.getElementById('d6').checked;
        let d7 = document.getElementById('d7').checked;
        let calid=document.getElementById('calid').value;
        let accessArr = {d1, d2, d3, d4, d5, d6, d7};
        let data = new FormData;
        data.append('access', JSON.stringify(accessArr));
        data.append('id',calid);
        axios.post('{{ENV("APP_URL")}}/update-organization_cal',data).then((result) => {
            console.log(result.data);
            Swal.fire(
                '',
                'Calender Updated Successfully',
                'success'
            )
            // .then((result) => {
            //  location.reload();
            //  });
            
        }).catch((err) => {
            console.log(err)
        });
    }
       
    // }

</script>

@endsection

