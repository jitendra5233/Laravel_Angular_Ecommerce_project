@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Job Position Category List')


@section('page-script')
<script src="{{asset('assets/js/ui-toasts.js')}}"></script>
<script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" charset="utf-8"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css">
@section('content')

<style>
  .error{
    color:red;
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
</style>


<div class="row" style="align-items: center;">
  <div class="col-6">

    <h4 class="fw-bold py-3" style="margin:0">
    <span class="text-muted fw-light">Job Position /</span> Job Position Category
    </h4>
  </div>
  <div class="col-6" style="text-align:end">
    <div class="py-3">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
         New Status
      </button>
    </div>
  </div>
</div>


<div class="modal fade" id="basicModal1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Edit Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col mb-3">
            <label for="Category1" class="form-label">Name</label>
            <input type="hidden" id="statusid" value="">
            <input type="text" id="Category1" value="" class="form-control" placeholder="Enter Name">
            </div>
        </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="handelupdateSatus()">Save</button>
        </div>
    </div>
    </div>
</div>
  
<!-- Modal -->
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">New Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col mb-3">
            <label for="Category" class="form-label">Name</label>
            <input type="text" id="Category" class="form-control" placeholder="Enter Name">
            </div>
        </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="handelSaveSatus()">Save</button>
        </div>
    </div>
    </div>
</div>

<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header"> Job Position Category List</h5>

  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>Action</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0" id="table">
        <?php
            $i = 1;
        ?>
        @foreach($jobgcat as $row)
        <tr>
          <td><strong>{{$i}}</strong></td>
          <td>{{$row->name}}</td>
          <td>
            <div>
            <a>
                <span title="Delete" class="tf-icons bx bx-edit" style="cursor:pointer" onclick="EditItem({{$row->id}},'{{$row->name}}')"></span>
              </a>
              <a>
                <span title="Delete" class="tf-icons bx bx-trash" style="color:#F25F5C; cursor:pointer" onclick="deleteItem({{$row->id}})"></span>
              </a>
            </div>
          </td>
          <td>

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
<!--/ Basic Bootstrap Table -->
<div class="loader"></div>
<form action="abc" method="POST">
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js"></script>
<script>
  handelSaveSatus = () => {
    var spinner = $('.loader');
       spinner.show();
      let data  = new FormData;
     data.append('Category',document.getElementById('Category').value)
     let mycat =document.getElementById('Category').value;
    $(".error").remove();
      if (mycat.length < 1) {
      $('#Category').after('<span class="error">Job Position Category is Required*</span>');
      spinner.hide();
      return false;
      }

   else{
    axios.post('{{ENV("APP_URL")}}/api/addjobcategory',data).then((result) => {
     $('#basicModal').modal('hide');
     if(result.data == 1){
      spinner.hide();
     Swal.fire(
            'Thankyou!',
            'Category save Successfully !',
            'success',
            ).then((result) => {
              
             location.reload();
             });
     }
    }).catch((err) => {
      $('#basicModal').modal('hide');
      spinner.hide();
      console.log(err);
    });
   }
    
  }

  handelupdateSatus =() => {
    let Category =document.getElementById('Category1').value;
    $(".error").remove();
    if (Category.length < 1) {
   $('#Category1').after('<span class="error">Category is required*</span>');
   return false;
   }
   else{
        let data  = new FormData;
        data.append('name',document.getElementById('Category1').value)
        data.append('id',document.getElementById('statusid').value)
        axios.post('{{ENV("APP_URL")}}/api/Updatejobcategory',data).then((result) => {
        $('#basicModal1').modal('hide');
        if(result.data == 1){
         Swal.fire(
            'Thankyou!',
            'Category Update Successfully !',
            'success',
            ).then((result) => {
              
             location.reload();
             });
        }
        }).catch((err) => {
        $('#basicModal1').modal('hide');
        console.log(err);
        });
   }
 
  }

  EditItem = (id,name) =>{
  document.getElementById('Category1').value=name;
  document.getElementById('statusid').value=id;
  $('#basicModal1').modal('show');
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

    axios.post('{{ENV("APP_URL")}}/api/Deletejobcategory',data).then((result) => {
      if(result.data == 1){
        Swal.fire('Job Position Category Deleted!', '', 'success').then((result) => {     
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
@endsection
