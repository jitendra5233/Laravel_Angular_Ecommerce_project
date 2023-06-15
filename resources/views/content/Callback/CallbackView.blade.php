@extends('layouts/contentNavbarLayout')

@section('title', 'Basic Table')

@section('page-script')
<script src="{{asset('assets/js/ui-toasts.js')}}"></script>
<script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" charset="utf-8"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css">
@endsection
  
@section('content')
<h4 class="fw-bold py-3 mb-4">
</h4>
<style>
 #flexSwitchCheckDefault{
 cursor: pointer;
  }
  .start-50 {
   left : 85%!important;
}
.btn-outline-secondry {
    background: transparent;
    border-color: #2c2828;
    color: #141313;
}
.pagination>li>a, .pagination>li>span {
    position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #337ab7;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 0.625rem 1.25rem;
}

 td {
     border-spacing:0;
     white-space:nowrap;
     overflow: hidden;
     text-overflow: ellipsis;
     -ms-text-overflow:ellipsis;
     /* font-size:14px; */
 }
div.dataTables_wrapper div.dataTables_paginate ul.pagination {
    margin: 2px 0;
    white-space: nowrap;
    float: right !important;
    padding: 0.625rem 1.25rem;
}
div.dataTables_wrapper div.dataTables_info {
    padding-top: 8px;
    white-space: nowrap;
    padding: 0.625rem 1.25rem;
}
div.dataTables_wrapper div.dataTables_filter {
    text-align: right;
    padding: 0.625rem 1.25rem;
}
div.dataTables_wrapper div.dataTables_length label {
    font-weight: normal;
    text-align: left;
    white-space: nowrap;
    padding: 0.625rem 1.25rem;
}
table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after, table.dataTable thead .sorting_asc_disabled:after, table.dataTable thead .sorting_desc_disabled:after {
    position: absolute;
    bottom: 8px;
    right: 8px;
    display: block;
    font-family: 'Glyphicons Halflings';
    opacity: 0.5;
    display: none !important;
}
</style>

<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header">Request Callback</h5>
  <div class="table-responsive text-nowrap">
  <table class="table" id="example" class="table display">
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
          <td><strong>{{$i}}</strong></td>
          <td>{{$row->name}}</td>
          <td>{{$row->email}}</td>
          <td>{{$row->phone}}</td>
         <td>
            <?php
              if($row->purpose == 1){
                echo 'Tentative';
              }
              if($row->purpose == 2){
                echo 'Owner';
              }
              if($row->purpose == 3){
                echo 'Buy';
              }
              if($row->purpose == 4){
                echo 'Sell';
              }
              if($row->purpose == 5){
                echo 'Other';
              }
            ?>
          </td>
          <!-- <td>

          </td> -->
            <?php if($row->status ==0)  { ?>
            <td><?= 'Pending'; ?></td><?php }?>
            <?php if($row->status == 1){?>
            <td><?= 'Assigned'; ?></td><?php } ?>
            <?php if($row->status == 2){ ?>
            <td><?= 'Cancelled'; ?></td><?php } ?>
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

<script>
      $(document).ready(function(){
  $("#example").DataTable({
  });
});
</script>
<script>
   function exportTasks(_this) {
      let _url = $(_this).data('href');
      window.location.href = _url;
   }
</script>
<!--/ Basic Bootstrap Table -->
@endsection