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
</style>
<div class="row">
    <div class="col-md-12">
        <?php
            $access =  json_decode($row->access,true);
        ?>
        <div class="card mb-4">
          <h5 class="card-header">View Role</h5>
          <!-- Account -->
          {{-- <form action="/submit-role" method="post">
            @csrf --}}
          <div class="card-body">
              <div class="row">
                  <div class="mb-3 col-md-6">
                    <label for="firstName" class="form-label">Role Name</label>
                    <input class="form-control" type="text" id="roleName" name="roleName" value="{{$row->name}}" />
                  </div>
              </div>
          </div>
          <hr class="my-0">
          <div class="card-body">
              <div class="row">
                <!-- Notifications -->
                <h5 class="card-header">Role Access</h5>
                <div class="card-body">
                    <span>You can Manage the Access to the Role.</span>
                    <div class="error"></div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-borderless border-bottom">
                    <thead>
                        <tr>
                        <th class="text-nowrap">Type</th>
                        <th class="text-nowrap text-center">Properties</th>
                        <th class="text-nowrap text-center">Blogs</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td class="text-nowrap">View</td>
                        <td>
                            <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" id="p1" <?php echo $access['p1'] ? 'checked' : '' ?>  />
                            </div>
                        </td>
                        <td>
                            <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" id="b1"  <?php echo $access['b1'] ? 'checked' : '' ?>  />
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <td class="text-nowrap">Create</td>
                        <td>
                            <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" id="p2" <?php echo $access['p2'] ? 'checked' : '' ?>  />
                            </div>
                        </td>
                        <td>
                            <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" id="b2" <?php echo $access['b2'] ? 'checked' : '' ?>  />
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <td class="text-nowrap">Edit</td>
                        <td>
                            <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" id="p3" <?php echo $access['p3'] ? 'checked' : '' ?>  />
                            </div>
                        </td>
                        <td>
                            <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" id="b3" <?php echo $access['b3'] ? 'checked' : '' ?>  />
                            </div>
                        </td>
                        </tr>
                        <tr>
                        <td class="text-nowrap">Delete</td>
                        <td>
                            <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" id="p4" <?php echo $access['p4'] ? 'checked' : '' ?>  />
                            </div>
                        </td>
                        <td>
                            <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" id="b4" <?php echo $access['b4'] ? 'checked' : '' ?>  />
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script>
    handleAddRole = (id) => {

    
        let p1 = document.getElementById('p1').checked;
        let p2 = document.getElementById('p2').checked;
        let p3 = document.getElementById('p3').checked;
        let p4 = document.getElementById('p4').checked;

        let b1 = document.getElementById('b1').checked;
        let b2 = document.getElementById('b2').checked;
        let b3 = document.getElementById('b3').checked;
        let b4 = document.getElementById('b4').checked;

        let name = document.getElementById('roleName').value;
        
        let accessArr = {p1, p2, p3, p4, b1, b2, b3, b4};

        let roleName = document.getElementById('roleName').value;
    $(".error").remove();
    if (roleName.length < 1) {
    $('#roleName').after('<span class="error">Role Name is required*</span>');
    }
    else{
        let data = new FormData;
        data.append('id', id);
        data.append('name', name);
        data.append('access', JSON.stringify(accessArr));

        axios.post('{{ENV("APP_URL")}}/update-role',data).then((result) => {
            console.log(result.data);
            Swal.fire(
                '',
                'Role Upadted Successfully',
                'success'
            )
        }).catch((err) => {
            console.log(err)
        });
    }
       
    }
</script>

@endsection