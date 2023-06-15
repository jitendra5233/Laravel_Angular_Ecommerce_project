@extends('layouts/contentNavbarLayout')

@section('title', 'Basic Table')

@section('page-script')
<!-- <script src="{{asset('assets/js/ui-toasts.js')}}"></script> -->
<script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" charset="utf-8"></script>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css">
@endsection
  
@section('content')

<div class="row" style="align-items: center;">
  <div class="col-6">

    <h4 class="fw-bold py-3" style="margin:0">
      <span class="text-muted fw-light">All Appointment</span>
    </h4>
  </div>

  <div class="col-6" style="text-align:end;display:flex;justify-content: flex-end;">
  @if(session('role') == 'Admin')
  <div class="py-3 mx-2">
      <a href="{{ENV('APP_URL')}}/AddManualappointment"><button type="button" class="btn btn-primary deactivate-account ">Add Appointment</button></a>
    </div>
    <div class="py-3">
    <span data-href="{{ENV("APP_URL")}}/export-appoitmentcsv" id="export" class="btn btn-primary" onclick="exportTasks(event.target);">Export</span>
    </div>
    @endif
  </div>
</div>

<style>
  #flexSwitchCheckDefault{
 cursor: pointer;
  }
  .start-50 {
   left : 85%!important;
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
  <h5 class="card-header">Appointment</h5>
  <div class="table-responsive text-nowrap">
  <table class="table" id="example" class="table display">
      <thead>
        <tr>
          <th>No</th>
          <th>Client Name</th>
          <th>Property Name</th>
          <th>Purpose</th>
          <th>Agent</th>
          <th>Date</th>
          <th>Time</th>
          <th>Status</th>
          <th></th>
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
          <td>{{$row->clientName}}</td>
          <td>{{$row->propertyName}}</td>
          <td>{{$row->propertypurpose}}</td>
          <td>{{$row->agentName}} ({{$row->agentstatus}})</td>
          <td>{{$row->date}}</td>
          <td>{{$row->time}}</td>
          <td>{{$row->tableDataStatus}}</td>
          <td> <a href="{{ENV('APP_URL')}}/Add_remark/{{$row->id}}"><button type="button" class="btn btn-primary deactivate-account btn-sm"> Submit</button></a></td>
          <td> <a href="{{ENV('APP_URL')}}/GetAppointment_single_data/{{$row->id}}"><button type="button" class="btn btn-primary deactivate-account btn-sm">View</button></a></td>
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
<div class="loader"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script  src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!--/ Basic Bootstrap Table -->
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

@endsection