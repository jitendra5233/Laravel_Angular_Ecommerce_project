@extends('layouts/contentNavbarLayout')

@section('page-script')
<script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" charset="utf-8"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css">
@endsection
@section('content')
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
<div class="row" style="align-items: center;">
  <div class="col-6">

    <h4 class="fw-bold py-3" style="margin:0">
      <span class="text-muted fw-light">Clients</span>
    </h4>
  </div>
  <div class="col-6" style="text-align:end">
    <div class="py-3">
    <span data-href="{{ENV("APP_URL")}}/export-csv" id="export" class="btn btn-primary" onclick ="exportTasks (event.target);">Export</span>
      <!-- <button type="button" class="btn btn-primary" onclick="downloadexcel()">
        Export Excel
      </button> -->
    </div>
  </div>
</div>

<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header">Clients</h5>
  <div class="table-responsive text-nowrap">
  <table class="table" id="example" class="table display">
      <thead>
        <tr>
          <th>No</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Phone</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <?php
            $i = 1;
        ?>
        @foreach($tableData as $row)
        <tr>
          <td><strong>{{$i}}</strong></td>
          <td>{{$row->first_name}}</td>
          <td>{{$row->last_name}}</td>
          <td>{{$row->email}}</td>
          <td>{{$row->phone}}</td>
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
  handleUpdateStatus = (sId,aId) => {
    let data = new FormData;
    data.append('sId',sId);
    data.append('aId',aId);

    axios.post('{{ENV("APP_URL")}}/update-appointment-status',data).then((result) => {
      console.log(result.data)
    }).catch((err) => {
        console.log(err)
    });
  }
  
</script>
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
