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
            <div class="card">
                <div class="card-header">
                    <h4 class="p-1 card-title m-0">Edit a Manga</h4>
                </div>
                <div class="card-body">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="ps-2">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{ route('admin.manga.index') }}">Mangas</a></li>
                          <li class="breadcrumb-item active" aria-current="page">{{ $manga->name }}</li>
                        </ol>
                    </nav>
                    <form action="{{ route('admin.manga.update', $manga->slug) }}" method="POST">
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
    </div>
</div>
@endsection