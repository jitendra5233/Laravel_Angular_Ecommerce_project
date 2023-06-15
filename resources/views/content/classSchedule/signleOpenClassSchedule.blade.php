@extends('layouts/contentNavbarLayout')

@section('title', 'Open Class  Schedule - View Open Class Schedule')

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
    .form-check-input[type=checkbox] {
        border: 1px solid #00000061;
    }
    .error{
      color:red;
    }
    .AceSelected{
    border: 4px solid #04917a
  }
  #myImg{
    height:100px;
  }
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
<div class="row">
    <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">Open Class Schedule</h5>
          <div class="card-body">
              <div class="row">
              <input type="hidden" name="proid" id="proid" value="{{$openClass->id}}" />
              <div class="mb-3 col-md-6">
                    <label for="classname" class="form-label">Class Name *</label>
                    <input class="form-control" type="text" id="classname" name="classname" value="{{$openClass->classname}}" disabled/>
                  </div>
                 
                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Branch Name *</label>
                    <select id="branchname" name="branchname" class="form-select"  aria-label="Default select example" disabled>
                      <option value="0" selected="">Select Branch</option>
                      @foreach($branch as $r)
                      <option value="{{$r->id}}" <?php echo $openClass->branchname == $r->id ? 'selected' : null ?>>{{$r->name}}</option>
                      @endforeach
                    </select>
                  </div> 
                  <div class="mb-3 col-md-6">
                    <label for="scheduledate" class="form-label">Schedule Date / Time*</label>
                    <input class="form-control" type="text" id="scheduledate" name="scheduledate" value="{{$openClass->scheduledate}} / {{$openClass->scheduletime}}" disabled/>
                  </div>

                  <div class="mb-3 col-md-6">
                    <label for="exampleFormControlSelect1" class="form-label">Trainer  Name *</label>
                    <select id="branchname" name="branchname" class="form-select"  aria-label="Default select example" disabled>
                      <option value="0" selected="">Select Trainer</option>
                      @foreach($trainer as $trainer)
                      <option value="{{$trainer->id}}" <?php echo $openClass->trainer_id == $trainer->id ? 'selected' : null ?>>{{$trainer->name}}</option>
                      @endforeach
                    </select>
                  </div>

                  <div class="table-responsive text-nowrap">
                  <table class="table" id="example" class="table display">
                  <thead>
                  <tr>
                    <th>S.no</th>
                  <th>Student Name</th>
                  <th>Date</th>
                  <th>Attendence</th>
                  </tr>
                  </thead>
                  <tbody class="table-border-bottom-0" id="mydata1">
                  <?php
                    $i = 1;
                    $a=0;
                    ?>
                    @foreach($attendence as $row)
                    <tr>
                      <td><strong>{{$i}}</strong></td>
                      <td>{{$row->studentName}}</td>
                      <td>{{$row->date}}</td>
                      <td>Present</td>
                  </tr>
                  <?php 
                    $i++;
                  ?>
                    @endforeach
                  </tr>
                  </tbody>
                  </table>
                  </div>

              </div>

                </div>

            </div>
              </div>
          </div>

        <!-- /Notifications -->
      </div>
  </div>
<!--</form>-->



  <!-- /Account -->
        </div>
      </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

<script>
      $(document).ready(function(){
  $("#example").DataTable({
  });
});
</script>

@endsection

