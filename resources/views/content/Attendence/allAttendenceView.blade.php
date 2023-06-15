@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Attendance List')

@section('page-script')
<script src="{{asset('assets/js/ui-toasts.js')}}"></script>
<script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" charset="utf-8"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
@endsection

@section('content')
<style>
  #flexSwitchCheckDefault{
 cursor: pointer;
  }
  .start-50 {
   left : 85%!important;
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
     font-size:14px;
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


<div class="row" style="align-items: center;">
  <div class="col-6">

    <h4 class="fw-bold py-3" style="margin:0">
      <span class="text-muted fw-light">Attendance List /</span> All Attendance History
    </h4>
  </div>
  <div class="col-6" style="text-align:end">
    <!-- <div class="py-3">
      <a type="button" class="btn btn-primary" href="{{ url('workshopAdd') }}">
        Add Workshop
      </a>
    </div> -->
  </div>
</div>
<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header">All Attendance List</h5>
  <div class="table-responsive text-nowrap">
  <table class="table" id="example" class="table display">
      <thead>
        <tr>
          <th>No</th>
          <th>STD Name</th>
          <th>Class Name</th>
          <th>Class Type</th>
          <th>Date</th>
          <th>Time</th>
          <th>Actions</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0" id="mydata">
        <?php
            $i = 1;
            $a=0;
        ?>
        @foreach($tableData as $row)
        <tr>
          <td><strong>{{$i}}</strong></td>
          <td>{{$row->studentName}}</td>
          <td>{{$row->workshopName}} {{$row->pclassName}} {{$row->openclassName}}  {{$row->packageName}} </td>
          <td><?php 
          if($row->type == 'workshop'){
            echo "workshop";
          }
          if($row->type == 'p_class'){
            echo "Project Class";
          }

          if($row->type == 'open_class')
          {
          echo "Open Class";
          }

         if($row->type == 'package')
          {
          echo "Package";
          }
          ?></td>
          <td>{{$row->date}}</td>
          <td>{{$row->time}}</td>
          <td>
            <div>
              <a href='{{ENV('APP_URL')}}/AttendenceView/{{$row->id}}'>
                <span title="Show" class="tf-icons bx bx-show" style="color:#63A375; cursor:pointer"></span>
              </a>
            </div>
          </td>
          <td>
        </td>

        </tr>
        <?php
            $i++;
            $a++;
        ?>
        @endforeach
      </tbody>
    </table>
  </div>
</div>


<script>
      $(document).ready(function(){
  $("#example").DataTable({
  });
});
</script>
@endsection
