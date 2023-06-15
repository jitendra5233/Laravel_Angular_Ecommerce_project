@extends('layouts/contentNavbarLayout')

@section('title', 'User  - Signle User Details ')

@section('page-script')
<script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('page-style')
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-icons.css')}}" />
@endsection

<link rel="stylesheet" href="{{asset('assets/richtexteditor/rte_theme_default.css')}}" />
<script type="text/javascript" src="{{asset('assets/richtexteditor/rte.js')}}"></script>
<script type="text/javascript" src='{{asset('assets/richtexteditor/plugins/all_plugins.js')}}'></script>
<script type="text/javascript" src='{{asset('assets/richtexteditor/rte-upload.js')}}'></script>
<style>
  .error{
    color:red;
  }
  #mydata
  {
    text-align:justify;
  }
</style>
@section('content')
<div class="row" style="align-items: center;">
  <div class="col-6">

    <h4 class="fw-bold py-3" style="margin:0">
      <span class="text-muted fw-light"> User </span> 
    </h4>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">User  Details</h5>
      <!-- Account -->
      <hr class="my-0">
      <div class="card-body">
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="first_name" class="form-label">First Name</label>
              <input class="form-control" type="text" id="first_name" name="first_name" value="{{$users[0]->first_name}}"  readonly/>
            </div>
            <div class="mb-3 col-md-6">
              <label for="last_name" class="form-label">Last Name</label>
              <input class="form-control" type="text" id="last_name" name="last_name" value="{{$users[0]->last_name}}"  readonly/>
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">Email</label>
              <input class="form-control" type="text" name="email" id="email" value="{{$users[0]->email}}" readonly/>
            </div>

            <div class="mb-3 col-md-6">
              <label for="phone" class="form-label">Phone</label>
              <input class="form-control" type="text" name="phone" id="phone" value="{{$users[0]->phone}}" readonly/>
            </div>
            <div class="mb-3 col-md-6">
              <label for="department" class="form-label">Department</label>
              <input class="form-control" type="text" name="department" id="department" value="{{$users[0]->department}}" readonly/>
            </div>
            <div class="mb-3 col-md-6">
              <label for="specialty" class="form-label">Specialty</label>
              <input class="form-control" type="text" name="specialty" id="specialty" value="{{$users[0]->specialty}}" readonly/>
            </div>

            <div class="mb-3 col-md-6">
              <label for="designation" class="form-label">Designation</label>
              <input class="form-control" type="text" name="designation" id="designation" value="{{$users[0]->designation}}" readonly/>
            </div>
    
            <div class="mb-3 col-md-6">
              <label class="form-label" for="location">Location</label>
              <div class="input-group input-group-merge">
                <input type="text" id="location" name="location" value="{{$users[0]->location}}" class="form-control" readonly/>
              </div>
             </div>
             <div class="mb-3 col-md-6">
              <label class="form-label" for="phoneNumber">roleName</label>
              <div class="input-group input-group-merge">
                <input type="text" id="roleName" name="roleName" value="{{$users[0]->roleName}}" class="form-control" readonly/>
              </div>
             </div>
            <div class="mb-3 col-md-6">
              <label class="form-label" for="phoneNumber">Status</label>
              <div class="input-group input-group-merge">
                <input type="text" id="status" name="status"  value="<?php echo  $users[0]->status == '1' ? "Active" : "Inactive" ?>" class="form-control" readonly/>
              </div>
          </div>
         
        <!-- </form> -->

      </div>
      <!-- /Account -->
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

@endsection
