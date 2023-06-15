@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Role /</span> All Roles
</h4>

<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header">Roles</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
          {{-- <th>Status</th> --}}
          <th>Actions</th>
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
          {{-- <td><span class="badge bg-label-primary me-1">Active</span></td> --}}
          <td>
            <a href="{{url('View-Role')}}/{{$row->id}}" type="button" class="btn btn-primary me-2 btn-sm">View</a>
            {{-- <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
              </div>
            </div> --}}
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
@endsection
