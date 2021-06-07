@extends('admin.layouts.app')

@section('title', 'Edit a Manga')

@section('content')
<div class="container-sm">
    @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="p-1 card-title m-0">Manga Details</h4>
                    <input type="hidden" value="{{ $manga->id }}" id="manga-id">
                </div>
                <div class="card-body">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="ps-2">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{ route('admin.manga.index') }}">Mangas</a></li>
                          <li class="breadcrumb-item active" aria-current="page">{{ $manga->name }}</li>
                        </ol>
                    </nav>
                    <form action="{{ route('admin.manga.update', $manga->slug) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Manga name" name="name" value="{{ $manga->name }}">
                                    <label for="name">Manga name <span class="text-danger">*</span></label>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" value="{{ old('status') }}">
                                        <option selected>Select a status</option>
                                        <option value="ongoing" @if($manga->status == 'ongoing') selected @endif>Ongoing</option>
                                        <option value="completed" @if($manga->status == 'completed') selected @endif>Completed</option>
                                    </select>
                                    <label for="status">Manga status <span class="text-danger">*</span></label>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="cover" class="form-label">Cover</label>
                                @if (!empty($manga->cover))    
                                    <div class="mb-3">
                                        <img src="{{ $manga->cover }}" alt="{{ $manga->slug }}" class="img-thumbnail" >
                                    </div>
                                @endif
                                <input type="file" name="cover" class="form-control" accept="image/*">
                                @error('cover')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Manga summary here" id="summary" name="summary" style="height: 400px">{{ $manga->summary }}</textarea>
                            <label for="summary">Manga summary</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark btn-block">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card shadow" id="admin-chapter-index">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center p-1">
                        <h4 class="card-title m-0">Chapters</h4>
                        <a href="{{ route('admin.chapter.create', $manga->slug) }}" class="btn btn-sm btn-dark">
                          <i class="fas fa-plus fa-sm"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="chapter-datatable">
                            <thead>
                                <tr>
                                    <th style="width: 15px">#</th>
                                    <th>Name</th>
                                    <th style="width: 15px">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection