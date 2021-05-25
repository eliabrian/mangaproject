@extends('admin.layouts.app')

@section('title', 'Mangas')

@section('content')
<div class="container-sm">
  <div class="row">
    <div class="col-12 card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
          <h4 class="card-title m-0">Mangas</h4>
          <a href="#" class="btn btn-sm btn-dark">
            <i class="fas fa-plus fa-sm me-1"></i>
            <span class="text">Add Manga</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection