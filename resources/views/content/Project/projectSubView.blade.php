@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')

<div class="row" style="align-items: center;">
  <div class="col-6">

    <h4 class="fw-bold py-3" style="margin:0">
      <span class="text-muted fw-light">{{$oldBreadName}} /</span>  {{$currentBreadName}}
    </h4>
  </div>
  <div class="col-6" style="text-align:end">
    <div class="py-3">
      <a type="button" class="btn btn-primary" href="{{url('project-sub-add')}}">
      New Sub Project
      </a>
    </div>
  </div>
</div>

<!-- Basic Bootstrap Table -->
<div class="card">
  <h5 class="card-header">All Sub Projects</h5>
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>Project</th>
          <th>Sub Project</th>
          <th>Agent</th>
          <th>Images</th>
          <th>Status</th>
          <th>Actions</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <?php
            $i = 1;
        ?>
        @foreach($tableData as $row)
        <tr>
          <td><strong>{{$i}}</strong></td>
          <td>{{$row->name}}</td>
          <td>{{$row->projectName}}</td>
          <td>{{$row->subProjectName}}</td>
          <td>{{$row->agentName}}</td>
          <td>
            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
              @foreach(json_decode($row->agentImages) as $row2)
              <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="{{$row2->name}}">
                <img src="{{ENV('APP_URL')}}/media/images/{{$row2->url}}" alt="Avatar" class="rounded-circle">
              </li>
              @endforeach
            </ul>
          </td>
          <td><span class="badge bg-label-primary me-1">Active</span></td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a>
              </div>
            </div>
          </td>
          <td>
            <a type="button" class="btn btn-sm btn-primary" href="/project-singlePropertiesView/{{$row->id}}">View</a>
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
