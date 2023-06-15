@extends('layouts/contentNavbarLayout')

@section('title', 'Student -Student Deatils')

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
  #enrollid{
    padding: 10px;
    margin: 10px;
  }
  .error{
    color:red;
  }
  #mydata
  {
    text-align:justify;
  }
  #myImg{
    height:100px;
    width:100px;
    margin-bottom:10px;
    float:right;
    margin-right:20px;
    margin-top:10px;

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
@section('content')
<div class="loader"></div>
<div class="row" style="align-items: center;">
<div class="col-4">
<h4 class="fw-bold py-3" style="margin:0">
<h5 class="card-header title">Student / Parent</h5>
</h4>
</div>
@if($student[0]->type == 1)
<div class="col-8" style="text-align:end">
<div class="py-3">
<button type="button" class="btn btn-primary me-2" onclick="StudentInfo()">Student</button>
<button type="button" class="btn btn-primary me-2" onclick="StdPurchase()">Purchase</button>
<button type="button" class="btn btn-primary me-2" onclick="StdClasses()">Enrolled Classes</button>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal1">
Enroll
</button>
</div>
</div>
@endif
</div>

<div class="row">
  <div class="col-md-12" id="firstdiv">
    <div class="card mb-4">
    <div class="row">
        @if($student[0]->type == 1)
    <div class="mb-3 col-md-6">
      <h5 class="card-header titile">Student  Details</h5>
     </div>
     @endif
        @if($student[0]->type != 1)
    <div class="mb-3 col-md-6">
      <h5 class="card-header titile">Parent  Details</h5>
     </div>
     @endif
      <div class="mb-3 col-md-6">
          <img  id="myImg" class="" src="{{ENV('APP_URL')}}/StudentImg/student.png" data-bigger-src="{{ENV('APP_URL')}}/StudentImg/student.png" disabled />
         </div>
       </div>
      <hr class="my-0">
      <div class="card-body">
        
          <div class="row">
         
          <div class="mb-3 col-md-6">
              <label for="firstname" class="form-label">First Name</label>
              <input class="form-control" type="text" id="firstname" name="firstname" value="{{$student[0]->firstname}}"  readonly/>
            </div>

            <div class="mb-3 col-md-6">
              <label for="middlename" class="form-label">Middle Name</label>
              <input class="form-control" type="text" id="middlename" name="middlename" value="{{$student[0]->middlename}}"  readonly/>
            </div>

            <div class="mb-3 col-md-6">
              <label for="lastname" class="form-label">Last Name</label>
              <input class="form-control" type="text" id="lastname" name="lastname" value="{{$student[0]->lastname}}"  readonly/>
            </div>
            <div class="mb-3 col-md-6">
              <label for="email" class="form-label">email</label>
              <input class="form-control" type="text" name="email" id="email" value="{{$student[0]->email}}" readonly/>
            </div>

            <div class="mb-3 col-md-6">
              <label for="phone" class="form-label">Phone</label>
              <input class="form-control" type="text" name="phone" id="phone" value="{{$student[0]->phone}}" readonly/>
            </div>
            
            <div class="mb-3 col-md-6">
              <label for="dob" class="form-label">Birth Date</label>
              <input class="form-control" type="text" name="dob" id="dob" value="{{$student[0]->dob}}" readonly/>
            </div>

            <div class="mb-3 col-md-6">
              <label for="gender" class="form-label">Gender</label>
              <input class="form-control" type="text" name="gender" id="gender" value="{{$student[0]->gender}}" readonly/>
            </div>
            
            <div class="mb-3 col-md-6">
              <label for="type" class="form-label">Type</label>
              <input class="form-control" type="text" name="type" id="type" value="<?php echo $student[0]->type == 1 ? "Student" :"Parent" ?>{{$student[0]->type}}" readonly/>
            </div>

            <div class="mb-3 col-md-6">
              <label class="form-label" for="phoneNumber">Status</label>
              <div class="input-group input-group-merge">
                <input type="text" id="status" name="status"  value="<?php echo  $student[0]->status == '1' ? "Active" : "Inactive" ?>" class="form-control" readonly/>
              </div>
          </div>

          <div class="mb-3 col-md-12">
              <label for="address" class="form-label">Address</label>
              <input class="form-control" type="text" name="address" id="address" value="{{$student[0]->address}}" readonly/>
            </div>
         
        <!-- </form> -->

      </div>
      <!-- /Account -->
    </div>
  </div>
  </div>
</div>
 
<div class="card">
  <div class="table-responsive text-nowrap" id="seconddiv" style="display:none";>
  <table class="table" id="example" class="table display">
      <thead>
      <tr>
          <th>No</th>
          <th>Schedule Date</th>
          <th>Class Name</th>
          <th>Page Type</th>
          <th>Price</th>
          <th>Purchase Date/Time</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0" id="mydata">
        <?php
            $i=1;
            $a=0;
        ?>
       @foreach($getStudentData as $row)
        <tr>
          <td><strong>{{$i}}</strong></td>
          <td>@foreach($row->workshopdates as $row3)
          <?php echo  date('d-M', strtotime($row3)); ?>
          @endforeach
          
         {{$row->openscheduledate}} 
        </td>
          <td>{{$row->workshopName}}  {{$row->pclassName}}  {{$row->openclassName}} {{$row->packageName}}</td>
          <td>{{$row->type}}</td>
          <td>{{$row->price}}</td>
          <td>{{$row->datatime}}</td>
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

<div class="card">
  <div class="table-responsive text-nowrap" id="thirddiv" style="display:none";>
  <div class="row" style="align-items: center;">
<div class="col-11" style="text-align:end">
<div class="py-3">
</div>
</div>
</div>
  <table class="table" id="example1" class="table display">
      <thead>
      <tr>
          <th>No</th>
          <!-- <th>Student Name</th> -->
          <th>Class Name</th>
          <th>Actual Price</th>
          <th>Discount (Rs)</th>
          <th>Final Amount</th>
          <th>Schedule Date</th>
          <th>Schedule Time</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0" id="mydata">
        <?php
            $i = 1;
            $a=0;
        ?>
       @foreach($getenrolldata as $row)
        <tr>
          <td><strong>{{$i}}</strong></td>
        {{-- <td>{{$row->studentName}}</td> --}}
          <td>{{$row->calssname}}</td>
          <td>{{$row->a_price}}</td>
          <td>{{$row->afterdiscount}}</td>
            @if($row->afterdiscount !='Na')
            <td>{{$row->discountprice}}</td>
            @else
            <td>{{$row->a_price}}</td>
            @endif
     
          <td>{{$row->scheduledate}}</td>
          <td>{{$row->scheduletime}}</td>
          <td>
            <div>
              <a>
                <span title="Delete" class="tf-icons bx bx-trash" style="color:#F25F5C; cursor:pointer" onclick="handleDelete({{$row->id}})"></span>
              </a>
            </div>
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


<div class="modal fade" id="basicModal1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Enroll Class</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col_md-12 mb-3">
            <label for="projectclass" class="form-label">Name</label>
            <select  class="form-select" id='projectclass' name='projectclass' style="margin-left:15px;" onchange="Getprice(this.value)">
            <option value="0">Select and Enroll Class</option>
            @foreach($projectclass as $r)
            <option value="{{$r->id}}">{{$r->name}}</option>
            @endforeach
            </select>
            </div>

            <div class="col-md-6 mb-3" id="actualprice" style="display:none;">
            <input type="hidden" id="student_id" value="{{$student[0]->id}}">
            <label for="a_price" class="form-label">Actual Price</label>
            <input type="number" id="a_price" class="form-control" value="" placeholder="Price" readonly>
            </div>

            <div class="col-md-6 mb-3" id="discout_price" style="display:none;">
            <label for="discout" class="form-label">Discount Percentage</label>
            <input type="number" id="discout" class="form-control" value="" placeholder="Price">
            </div>
        </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="EnrollClass()">Save</button>
        </div>
    </div>
    </div>
</div>


<div class="loader"></div> 
<script>

$(document).ready(function(){
  $("#example").DataTable({
  });
  $("#example1").DataTable({
  });
  
});
</script>
<script>
  StdPurchase =()=>{
    $('#seconddiv').show();
    $('#firstdiv').hide();
    $('#thirddiv').hide();
    $('.title').text('Student Purchase');
}
StudentInfo =()=>{
    $('#seconddiv').hide();
    $('#firstdiv').show();
    $('#thirddiv').hide();
    $('.title').text('Student Details');
}
StdClasses = ()=>{
    $('#seconddiv').hide();
    $('#firstdiv').hide();
    $('#thirddiv').show(); 
    $('.title').text('Enroll Classes');

}

EnrollClass = () =>{
          let classid=document.getElementById('projectclass').value;
          let studentid=document.getElementById('student_id').value;
          let a_price=document.getElementById('a_price').value;
          let discout=document.getElementById('discout').value;
           $(".error").remove();
            var spinner = $('.loader');
            spinner.show();
            var projectclass=$('#projectclass');
              if(projectclass.val() == 0)
              {
              $('#projectclass').after('<span class="error">Select a Valid Class*</span>');
              spinner.hide();
              return false; 
              }
         
            else
                 {
                    let data = new FormData;
                    data.append('classid',classid);
                    data.append('studentid',studentid);
                    data.append('a_price',a_price);
                    data.append('discout',discout);

                    axios.post('{{ENV("APP_URL")}}/submitenrollclass',data).then((result) => {
                    if(result.data == 1)
                    {
                    $('#basicModal1').modal('hide');
                    spinner.hide(); 
                    Swal.fire(
                        '',
                        'Enroll Successfully',
                        'success'
                    )
                    .then((result) => {
                      window.location.href = '{{ENV("APP_URL")}}/getSingleStudent/'+studentid+'/';
                    });
                    }
            
            
                    }).catch((err) => {
                    console.log(err)
                    });
                }

}


Getprice = (id) =>{
             document.getElementById("a_price").value = '';
            
            let data = new FormData;
            data.append('classid',id);
            axios.post('{{ENV("APP_URL")}}/getPrice',data).then((result) => {
            if(result.data !=''){
              $(".error").remove();
              document.getElementById("a_price").value = result.data;
              document.getElementById("actualprice").style.display="block";
              document.getElementById("discout_price").style.display="block";
              }
              else{
              document.getElementById("actualprice").style.display="none";
              document.getElementById("discout_price").style.display="none";
              }

            }).catch((err) => {
            console.log(err)
            });
}


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

    axios.post('{{ENV("APP_URL")}}/api/deleteEnrollclass',data).then((result) => {
      if(result.data == 1){
        Swal.fire('Enroll Class  Deleted!', '', 'success').then((result) => {     
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
