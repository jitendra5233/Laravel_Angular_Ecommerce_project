@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')
@section('page-script')
<script src="{{asset('assets/js/ui-toasts.js')}}"></script>
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
<!-- <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' rel='stylesheet'> -->
 
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Users /</span> All Users
</h4>
<!-- Basic Bootstrap Table -->
<div class="card">
  <input type="hidden" id="myimgurl" value="{{ENV('APP_URL')}}/users/images/">
  <h5 class="card-header">All Users</h5>
  <div class="table-responsive text-nowrap">
    <table class="table" id="example" class="table display">
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>Photo</th>
          <th>Role</th>
          <!-- <th>Designation</th> -->
          @if(session('role') == 'Admin')
          <th>Status</th>
          <th>Actions</th>
          @endif
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0" id="mydata">
        <?php
            $i = 1;
        ?>
        @foreach($users as $row)
        <tr>
          <td><strong>{{$i}}</strong></td>
          <td>{{$row->first_name}} {{$row->last_name}}</td>
          <td>
          
            <div class="avatar {{$row->token == '' ? 'avatar-offline' : 'avatar-online'}}" >
              <img src="{{$row->photo != '' ? './users/images/'.$row->photo : 'https://www.pngitem.com/pimgs/m/22-220721_circled-user-male-type-user-colorful-icon-png.png'}}" alt="" class="w-px-40 rounded-circle">
            </div>
          </td>
          <td>{{$row->roleName}}</td>
          <!-- <td width="10%">{{$row->designation}}</td> -->
          @if(session('role') == 'Admin')
          <td><div class="form-check form-switch mb-2">
          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" onclick="changestatus({{$row->id}});" <?php echo $row->status=='1' ? 'checked' : '' ?>>
          </div></td>
        
          <td>
          <a href="{{url('Edituser')}}/{{$row->id}}"  data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="" type="button" class="btn btn-outline-secondry btn-sm"><span class="tf-icons bx bx-edit"></span></a>
          <button data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="" type="button" class="btn btn-outline-danger btn-sm" onclick="return deleteItem({{$row->id}})"><span class="tf-icons bx bx-trash"></span></button>
          </td>
          @endif
          <td> <a href="{{ENV('APP_URL')}}/GetUser_single_data/{{$row->id}}"><button type="button" class="btn btn-primary deactivate-account btn-sm">View</button></a></td>
        </tr>
        <?php
            $i++;
        ?>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
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
  
  </div>
</div>
<!--/ Basic Bootstrap Table -->

<script>
    function changestatus(e){
    if(e){
            $.ajax({
                type:'POST',
                url: '{{ENV("APP_URL")}}/api/changeuserstatus',
                data:'id='+e,
                success:function(data){
                  if(data==1)
                  {
                    $('.toast-body').html('');
                    $('#showToastPlacement').trigger('click');
                    $('.toast-body').html('You Status is Active Now.')
                    $('.bs-toast').removeClass('bg-danger');
                    $('.bs-toast').addClass('bg-success');
                  }

                  if(data==0)
                  {
                    $('.toast-body').html('');
                    $('#showToastPlacement').trigger('click');
                    $('.toast-body').append('You Status is Inactive Now.')
                    $('.bs-toast').removeClass('bg-success');
                    $('.bs-toast').addClass('bg-danger');
                  }
                 
                }
            }); 
        }else{
            return false; 
        }
    } 



function deleteItem(id) {
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

    axios.post('{{ENV("APP_URL")}}/Deleteuser',data).then((result) => {
      if(result.data == 1){
        Swal.fire('User Deleted!', '', 'success').then((result) => {     
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
