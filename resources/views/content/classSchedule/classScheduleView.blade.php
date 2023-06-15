@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Class Schedule')

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
  <div class="col-4">

    <h4 class="fw-bold py-3" style="margin:0">
      <span class="text-muted fw-light">Class Schedule</span> 
    </h4>
  </div>
  <div class="col-8" style="text-align:end">
    <div class="py-3">
    <button type="button" class="btn btn-primary me-2" onclick="openclass()">Open Class Schedule</button>
    <button type="button" class="btn btn-primary me-2" onclick="projectclass()">Project Class Schedule</button>
    <button type="button" class="btn btn-primary me-2" onclick="workshop()">Workshop Schedule</button>
    </div>
  </div>
</div>
<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header" id="title">All Open Class Schedule</h5>
  <div class="table-responsive text-nowrap" id="firstdiv">
  <table class="table" id="example" class="table display">
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>Branch Name</th>
          <th>Trainer Name</th>
          <th>Schedule Date</th>
          <th>Action</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0" id="mydata">
        <?php
            $i = 1;
            $a=0;
        ?>
        @foreach($AllOpenValue as $row)
        <tr>
          <td><strong>{{$i}}</strong></td>
          <td>{{$row->classname}}</td>
          <td>{{$row->OpnebranchName}}</td>
          <td>{{$row->Opnetrainername}}</td>
          <td>{{$row->scheduledate}}</td>
          <td>
            <div>
              <a href='{{ENV('APP_URL')}}/openClassScheduleView/{{$row->openclassid}}'>
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

  <div class="table-responsive text-nowrap"  id="seconddiv" style="display:none">
  <table class="table" id="example1" class="table display">
      <thead>
        <tr>
          <th>No</th>
          <th>Class Name</th>
          <th>Branch Name</th>
          <th>Trainer Name</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0" id="mydata">
        <?php
            $i = 1;
            $a=0;
        ?>
        @foreach($AllProjectValue as $row1)
        <tr>
          <td><strong>{{$i}}</strong></td>
          <td>{{$row1->name}}</td>
          <td>{{$row1->ProjectbranchName}}</td>
          <td>{{$row1->Projecttrainername}}</td>
          <td>
            <div>
              <a href='{{ENV('APP_URL')}}/projectClassScheduleView/{{$row1->projectclassid}}'>
                <span title="Show" class="tf-icons bx bx-show" style="color:#63A375; cursor:pointer"></span>
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

  
  <div class="table-responsive text-nowrap"  id="thirddiv" style="display:none">
  <table class="table" id="example2" class="table display">
      <thead>
        <tr>
          <th>No</th>
          <th>Title</th>
          <th>Class Name</th>
          <th>Branch Name</th>
          <th>Trainer Name</th>
          <th>Workshop Date's</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0" id="mydata">
        <?php
            $i = 1;
            $a=0;
        ?>
        @foreach($getAllWorkshop as $row2)
        <tr>
          <td><strong>{{$i}}</strong></td>
          <td>{{$row2->title}}</td>
          <td>{{$row2->workshopprojectClassName}}</td>
          <td>{{$row2->workshopbranchName}}</td>
          <td>{{$row2->workshoptrainername}}</td>
          <td>
          @foreach($row2->workshopdates as $row3)
          <?php echo  date('d-M', strtotime($row3)); ?>
          @endforeach
        </td>
        
          <td>
            <div>
              <a href='{{ENV('APP_URL')}}/workshopScheduleView/{{$row2->id}}'>
                <span title="Show" class="tf-icons bx bx-show" style="color:#63A375; cursor:pointer"></span>
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




<script>
      $(document).ready(function(){
  $("#example").DataTable({
  });

  $("#example1").DataTable({
  });
  $("#example2").DataTable({
  });
  
});

projectclass =()=>{
    $('#seconddiv').show();
    $('#firstdiv').hide();
    $('#thirddiv').hide();
    $('#title').text('All Project Class Schedule');
}
openclass =()=>{
    $('#seconddiv').hide();
    $('#firstdiv').show();
    $('#thirddiv').hide();
    $('#title').text('All Open Class Schedule');
}
workshop = ()=>{
    $('#seconddiv').hide();
    $('#firstdiv').hide();
    $('#thirddiv').show(); 
    $('#title').text('All Workshop Schedule');

}

</script>
@endsection
