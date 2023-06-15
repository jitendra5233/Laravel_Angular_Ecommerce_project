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



  <!-- Basic Bootstrap Table -->
  <div class="card">
    <div class="table-responsive text-nowrap">
        <div class="my-5" style="text-align: center">
            <h3>Invalid CSV File</h3>
        </div>
        <div style="text-align: center">
            <img src="{{ENV('APP_URL')}}/assets/img/illustrations/invalidfile.jpg" style="width: 50%" />
        </div>
        <div class="my-5" style="text-align: center">
            <a type="button" class="btn btn-primary" href="{{ENV('APP_URL')}}/project-bulkupload">
               Upload Again
             </a>
        </div>
    </div>
  </div>


@endsection
