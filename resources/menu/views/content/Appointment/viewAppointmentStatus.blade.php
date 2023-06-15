@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

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
      <span class="text-muted fw-light">Appointment /</span> Appointment Status
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
            <label for="statusName" class="form-label">Name</label>
            <input type="text" id="statusName" class="form-control" placeholder="Enter Name">
            </div>
        </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="handeSaveSatus()">Save</button>
        </div>
    </div>
    </div>
</div>

<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header">Status</h5>

  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0" id="table">
        <?php
            $i = 1;
        ?>
        @foreach($tableData as $row)
        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$i}}</strong></td>
          <td>{{$row->name}}</td>
        <?php if($row->name !='visit pending') { ?>
          <td><button data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="" data-bs-original-title="<span>Delete</span>" type="button" class="btn btn-outline-danger btn-sm" onclick="deleteItem({{$row->id}})"><span class="tf-icons bx bx-trash"></span></button></td>
          <?php } ?>
        </tr>
        </button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>
  handeSaveSatus = () => {
    var spinner = $('.loader');
       spinner.show();
    let data  = new FormData;
    data.append('name',document.getElementById('statusName').value)
    let statusName =document.getElementById('statusName').value;
    $(".error").remove();
    if (statusName.length < 1) {
   $('#statusName').after('<span class="error">Status Name is required*</span>');
   spinner.hide();
   return false;
   }

   else{
    axios.post('{{ENV("APP_URL")}}/SaveAppointmentStatus',data).then((result) => {
     $('#basicModal').modal('hide');
     if(result.data == 1){
       spinner.hide();
      location.reload();
     }
    }).catch((err) => {
      $('#basicModal').modal('hide');
      spinner.hide();
      console.log(err);
    });
   }
   
  }

  deleteItem = (id) =>{
    let data = new FormData;
    data.append('id',id);

    axios.post('{{ENV("APP_URL")}}/deleteAppointmentStatus',data).then((result) => {
      if(result.data == 1){
        location.reload();
      }
    }).catch((err) => {
      console.log(err)
    });
  }
</script>
@endsection