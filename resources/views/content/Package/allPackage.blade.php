@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

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
      <span class="text-muted fw-light">Packages /</span> All Packages
    </h4>
  </div>
  <div class="col-6" style="text-align:end">
    @if(session('role') == 'Admin')
    <div class="py-3">
      <a type="button" class="btn btn-primary" href="{{ url('addPackage') }}">
         New Package
      </a>
    </div>
    @endif
  </div>
</div>
<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header">All Package</h5>
  <div class="table-responsive text-nowrap">
  <table class="table" id="example" class="table display">
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>Class Name</th>
          <th>Branch</th>
          <th>Price</th>
          <th>Credit</th>
          <th>Package Limit</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0" id="mydata">
        <?php
            $i = 1;
            $a = 0;
        ?>
        @foreach($package as $row)
        <tr id="row{{$row->id}}">
          <td>{{$i}}</td>
          <td>{{$row->name}}</td>
          <td>{{$row->className}}</td>
          <td>{{$row->branchName}}</td>
          <td>{{$row->price}}</td>
          <td>{{$row->credit}}</td>
          <td>{{$row->package_limit}}</td>
          <td>
            <div>
              <a href='{{ENV('APP_URL')}}/editPackage/{{$row->id}}'>
                <span title="Edit" class="tf-icons bx bx-edit" style="color:#2589BD; cursor:pointer"></span>
              </a>
              <a>
                <span title="Delete" class="tf-icons bx bx-trash" style="color:#F25F5C; cursor:pointer" onclick="handleDelete({{$row->id}})"></span>
              </a>
              <a href='{{ENV('APP_URL')}}/viewPackage/{{$row->id}}'>
                <span title="Show" class="tf-icons bx bx-show" style="color:#63A375; cursor:pointer"></span>
              </a>
            </div>
          </td>
        </tr>
        <?php
            $i++;
        ?>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- This model is use for popup images with caption div -->
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img id="modal-img" class="modal-content" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQS2ol73JZj6-IqypxPZXYS3rRiPwKteoD8vezk9QsRdkjt3jEn&usqp=CAU">
    
  <div id="caption"></div>
</div>
<!--/ Basic Bootstrap Table -->
<script>

 handleDelete = (id)=> {
event.preventDefault(); // prevent form submit
var form = event.target.form; // storing the form
Swal.fire({
  title: 'Do you want to delete it?',
  showCancelButton: true,
  confirmButtonText: 'Delete',
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    let data = new FormData;
    data.append('id',id);

    axios.post('{{ENV("APP_URL")}}/api/deletePackage',data).then((result) => {
      if(result.data == 1){
        Swal.fire('Package  Deleted!', '', 'success').then((result) => {     
       location.reload();
        });
      }
    }).catch((err) => {
      console.log(err)
    });
  }
})
}
</script>
<script>
      $(document).ready(function(){
  $("#example").DataTable({
  });
});
</script>
@endsection
