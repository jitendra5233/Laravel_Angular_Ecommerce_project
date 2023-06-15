@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('page-script')
<script src="{{asset('assets/js/ui-toasts.js')}}"></script>
<script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js" charset="utf-8"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
.fa-heart{
  color:#04917a;
}
</style>
<div class="row" style="align-items: center;">
  <div class="col-6">

    <h4 class="fw-bold py-3" style="margin:0">
      <span class="text-muted fw-light">Wish List /</span> All  Wish List 
    </h4>
  </div>
</div>

<!-- This model is use for popup images with caption div -->
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img id="modal-img" class="modal-content" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQS2ol73JZj6-IqypxPZXYS3rRiPwKteoD8vezk9QsRdkjt3jEn&usqp=CAU">
    
  <div id="caption"></div>
</div>

<!-- Basic Bootstrap Table -->

<div class="card">
  <h5 class="card-header">All WishList</h5>
  <div class="table-responsive text-nowrap">
  <table class="table" id="example" class="table display">
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>Project</th>
          <th>Sub Project</th>
          <th>Agent</th>
          <th>Purpose</th>
          <th>Images</th>
          <th>Wish List</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <?php
            $i = 1;
        ?>
        @foreach($tableData as $row)
        <tr>
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$i}}</strong></td>
          <td>{{$row->name}}</td>
          <td>{{$row->projectName}}</td>
          <td>{{$row->subProjectName}}</td>
          <td>{{$row->agentName}}</td>
          <td>{{$row->purpose}}</td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              @foreach(json_decode($row->agentImages) as $row2)
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="{{$row2->name}}">
                <img  id="myImg" class="rounded-circle" src="{{ENV('APP_URL')}}/media/images/{{$row2->url}}" data-bigger-src="{{ENV('APP_URL')}}/media/images/{{$row2->url}}"
>
              </li>
              @endforeach
            </ul>
          </td>
          <?php if($row->wishlist == 1) {?>
          <td><i class="fa fa-heart" aria-hidden="true" style="cursor:pointer;" onclick="Makefavouret({{$row->id}},{{$row->wishlist}})"></i>
          </td>
          <?php } ?>
          <?php if($row->wishlist == 0) {?>
             <td><i class="fa fa-heart-o" id="field" aria-hidden="true" style="cursor:pointer;" onclick="Makefavouret({{$row->id}},{{$row->wishlist}})"></i></td>
          <?php }  ?>
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

Makefavouret =(id,wishlist)=>{
  let data = new FormData;
    data.append('id',id);
    data.append('wishlist',wishlist);
    axios.post('{{ENV("APP_URL")}}/AddWish_list',data).then((result) => {
      if(result.data == 1){
        location.reload();
      }
    }).catch((err) => {
      console.log(err)
    });

}
</script>

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
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>
<!--/ Basic Bootstrap Table -->

<script>
    function changestatus(e){
    if(e){
            $.ajax({
                type:'POST',
                url: '{{ENV("APP_URL")}}/api/changepropertystatus',
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
@endsection
