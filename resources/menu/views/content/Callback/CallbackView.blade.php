@extends('layouts/contentNavbarLayout')

@section('title', 'Basic Table')

@section('page-script')
<script src="{{asset('assets/js/ui-toasts.js')}}"></script>
@endsection
  
@section('content')
<h4 class="fw-bold py-3 mb-4">
</h4>
<style>
.start-50 {
   left : 85%!important;
}
</style>

<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header">Request Callback</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Full Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Purpose</th>
          <th>Status</th>
          <th>Action</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <?php
            $i = 1;
        ?>
        @foreach($tableData as $row)
        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$i}}</strong></td>
          <td>{{$row->name}}</td>
          <td>{{$row->email}}</td>
          <td>{{$row->phone}}</td>
          <td>{{$row->purpose == 1 ? 'Tentative' : 'Owner'}}</td>
          <!-- <td>

          </td> -->
            <?php if($row->status ==0)  { ?>
            <td><?= 'Pending'; ?></td><?php }?>
            <?php if($row->status == 1){?>
            <td><?= 'On Hold'; ?></td><?php } ?>
            <?php if($row->status == 2){ ?>
            <td><?= 'Cancled'; ?></td><?php } ?>
            <?php if($row->status == 3){?>
            <td><?= 'Completed'; ?></td><?php } ?>
            <td>
             <a href="{{ENV('APP_URL')}}/addAppointment/{{$row->id}}"><button type="button" class="btn btn-primary deactivate-account btn-sm">Make Appointment</button></a>
          </td>
          <td> <a href="{{ENV('APP_URL')}}/Getcallbackdata/{{$row->id}}"><button type="button" class="btn btn-primary deactivate-account btn-sm">View</button></a></td>
        </tr>
        <?php
            $i++;
        ?>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<script>
  updateAppointmentStatus = (id,getid) =>{
    let data = new FormData;
    data.append('id',getid);
    data.append('statusid',id);
    axios.post('{{ENV("APP_URL")}}/updateAppointmentStatus',data).then((result) => {
      if(result.data == 1){
        $('#showToastPlacement').trigger('click');
      }
    }).catch((err) => {
      console.log(err)
    });
  }
</script>

<div class="card mb-4" style="display:none">
  <div class="card-body">
    <div class="row gx-3 gy-2 align-items-center">
      <div class="col-md-3">
        <label class="form-label" for="selectTypeOpt">Type</label>
        <select id="selectTypeOpt" class="form-select color-dropdown">
          <option value="bg-success">Success</option>
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label" for="selectPlacement">Placement</label>
        <select class="form-select placement-dropdown" id="selectPlacement">
          <option value="top-0 start-50 translate-middle-x">Top center</option>
        </select>
      </div>
      <div class="col-md-3">
        <label class="form-label" for="showToastPlacement">&nbsp;</label>
        <button id="showToastPlacement" class="btn btn-primary d-block"></button>
      </div>
    </div>
  </div>
</div>
<div class="bs-toast toast toast-placement-ex m-2 fade bg-success top-0 end-0 hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
  <div class="toast-header">
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
   Status Updated Successfully.
  </div>
</div>

<!--/ Basic Bootstrap Table -->
@endsection