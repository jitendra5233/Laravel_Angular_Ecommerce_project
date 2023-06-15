@extends('layouts/contentNavbarLayout')

@section('title', 'Client - Call Back Details ')

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
      <span class="text-muted fw-light">Call Back </span> 
    </h4>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Call Back  Details</h5>
      <!-- Account -->
      <hr class="my-0">
      <div class="card-body">
          <div class="row">
            <div class="mb-3 col-md-6">
              <label for="first_name" class="form-label">First Name</label>
              <input class="form-control" type="text" id="first_name" name="first_name" value="{{$callback->name}}"  readonly/>
            </div>
            <div class="mb-3 col-md-6">
              <label for="last_name" class="form-label">Email</label>
              <input class="form-control" type="text" name="email" id="email" value="{{$callback->email}}" readonly/>
            </div>
    
            <div class="mb-3 col-md-4">
              <label class="form-label" for="phoneNumber">Phone</label>
              <div class="input-group input-group-merge">
                <input type="text" id="phone" name="phone" value="{{$callback->phone}}" class="form-control" readonly/>
              </div>
             </div>
            <div class="mb-3 col-md-4">
              <label class="form-label" for="phoneNumber">Purpose</label>
              <div class="input-group input-group-merge">
                <input type="text" id="phone" name="phone" value="<?php echo $callback->purpose == 1 ? 'Tentative' : 'Owner' ?>" class="form-control" readonly/>
              </div>
            </div>
            <div class="mb-3 col-md-4">
              <label class="form-label" for="phoneNumber">Call Back Status</label>
              <div class="input-group input-group-merge">
                  <?php if($callback->status == 3){?>
                <input type="text" id="phone" name="phone" value="Completed" class="form-control" readonly/>
             <?php } ?>
             <?php if($callback->status == 0){?>
                <input type="text" id="phone" name="phone" value="Pending" class="form-control" readonly/>
             <?php } ?>
             <?php if($callback->status == 1){?>
                <input type="text" id="phone" name="phone" value="On Hold" class="form-control" readonly/>
             <?php } ?>
             <?php if($callback->status == 2){?>
                <input type="text" id="phone" name="phone" value="Canceled" class="form-control" readonly/>
             <?php } ?>
            </div>
            </div>
            <div class="mb-3 col-md-12">
            <label for="description" class="form-label" style="font-size:15px;">Remark</label>
            <textarea name="remark" id="remark" cols="5" rows="5" class="form-control" readonly>{{$callback->remark}}</textarea>
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
