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
      <span class="text-muted fw-light">Blog /</span>  All Blog 
    </h4>
  </div>
  <div class="col-6" style="text-align:end">
    <div class="py-3">
    </div>
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
  <h5 class="card-header">Blog</h5>

  <div class="table-responsive text-nowrap">
  <table class="table" id="example" class="table display">
      <thead>
        <tr>
          <th>No</th>
          <th>Title</th>
          <th>Image</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <?php 
        $i=1;
        $a=0;
        ?>
        @foreach($blogs as $row)
        <tr>
        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$i}}</strong></td>
        <td>{{$row->title}}</td>
        <td>
          <img widthg="50px" height="50px" id="myImg" src="{{ENV('APP_URL')}}/media/images/{{$blogImages[$a]->url}}">
           </td>
        <td><div class="form-check form-switch mb-2">
          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" onclick="changestatus({{$row->id}});" <?php echo $row->status=='1' ? 'checked' : '' ?>>
        </div>
      </td>
            <td>
              <a href="{{url('Editblog')}}/{{$row->id}}"  data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="" type="button" class="btn btn-outline-secondry btn-sm"><span class="tf-icons bx bx-edit"></span></a>
              <button data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-html="true" title="" type="button" class="btn btn-outline-danger btn-sm" onclick="return deleteItem({{$row->id}})"><span class="tf-icons bx bx-trash"></span></button>
              </td>
          
          </td>
        </tr>
        <?php $i++;
        $a++;
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

<!-- Edit data from Table -->
<script>

editItem = (id) =>{
    let data = new FormData;
    data.append('id',id);
    axios.post('{{ENV("APP_URL")}}/Editblog',data).then((result) => {
      if(result.data == 1){
        location.reload();
      }
    }).catch((err) => {
      console.log(err)
    });
  }

deleteItem = (id) =>{
    let data = new FormData;
    data.append('id',id);
    axios.post('{{ENV("APP_URL")}}/Deleteblog',data).then((result) => {
      if(result.data == 1){
        
        location.reload();
      }
    }).catch((err) => {
      console.log(err)
    });
  }

  function changestatus(e){
    if(e){
            $.ajax({
                type:'POST',
                url: '{{ENV("APP_URL")}}/api/changeblogstatus',
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

@endsection

