@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Achievement List')

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
      <span class="text-muted fw-light">Achievement List /</span> All Achievement List
    </h4>
  </div>
  <div class="col-6" style="text-align:end">
    <div class="py-3">
      <!--<a type="button" class="btn btn-primary" href="{{ url('add_achievement') }}">-->
    <!--    Add Achievement-->
    <!--  </a>-->
    </div>
  </div>
</div>
<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header">All Achievement List</h5>
  <div class="table-responsive text-nowrap">
  <table class="table" id="example" class="table display">
      <thead>
        <tr>
          <th>No</th>
          <th>Title</th>
          <th>Image</th>
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
          <td>{{$row->title}}</td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="{{$row->image}}">
               <img  id="myImg" class="rounded-circle" src="{{ENV('APP_URL')}}/AchievementImage/{{$row->image}}" data-bigger-src="{{ENV('APP_URL')}}/AchievementImage/{{$row->image}}">
              </li>
            </ul>
          </td>
          <td>
            <div>
              <a href='{{ENV('APP_URL')}}/editAchievement/{{$row->id}}'>
                <span title="Edit" class="tf-icons bx bx-edit" style="color:#2589BD; cursor:pointer"></span>
              </a>
              <!--<a>-->
              <!--  <span title="Delete" class="tf-icons bx bx-trash" style="color:#F25F5C; cursor:pointer" onclick="deleteItem({{$row->id}})"></span>-->
              <!--</a>-->
              <a href='{{ENV('APP_URL')}}/AchievementView/{{$row->id}}'>
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

<!-- This model is use for popup images with caption div -->
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img id="modal-img" class="modal-content" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQS2ol73JZj6-IqypxPZXYS3rRiPwKteoD8vezk9QsRdkjt3jEn&usqp=CAU">
    
  <div id="caption"></div>
</div>
<!--/ Basic Bootstrap Table -->

<script>
  // Get the image popup modal
var modal = document.getElementById("myModal");
var modalImg = document.getElementById("modal-img");
var captionText = document.getElementById("caption");
document.addEventListener("click", (e) => {
  const elem = e.target;
  if (elem.id==="myImg") {
    modal.style.display = "block";
    modalImg.src = elem.dataset.biggerSrc || elem.src;
    captionText.innerHTML = elem.alt; 
  }
})
var span = document.getElementsByClassName("close")[0];
span.onclick = function() { 
  modal.style.display = "none";
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
    axios.post('{{ENV("APP_URL")}}/api/deleteAchievement',data).then((result) => {
      if(result.data == '1'){
        Swal.fire('Achievement is  Deleted!', '', 'success').then((result) => {     
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
