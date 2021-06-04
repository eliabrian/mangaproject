@extends('admin.layouts.app')

@section('title', 'Mangas')

@section('content')
<div class="container-sm" id="admin-manga-index">
  @if(session('status'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('status') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  <div class="card shadow">
    <div class="card-header">
      <div class="d-flex justify-content-between align-items-center p-1">
        <h4 class="card-title m-0">Mangas</h4>
        <a href="{{ route('admin.manga.create') }}" class="btn btn-sm btn-dark">
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
              <th style="width: 15px">Action</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection