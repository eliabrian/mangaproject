@extends('admin.layouts.app')

@section('title', 'Mangas')

@section('content')
<div class="container-sm" id="admin-manga-index">
  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center p-1">
        <h4 class="card-title m-0">Mangas</h4>
        <a href="#" class="btn btn-sm btn-dark">
          <i class="fas fa-plus fa-sm me-1"></i>
          <span class="text">Add Manga</span>
        </a>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table" id="manga-datatable">
          <thead>
            <tr>
              <th>Name</th>
              <th>Created</th>
              <th>Updated</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection