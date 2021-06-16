@extends('admin.layouts.app')

@section('title', 'Add a Chapter')

@section('content')
<div class="container-sm">
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center p-1">
                        <h4 class="card-title m-0">Add a Chapter</h4>
                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteChapterModal">
                            <i class="fas fa-trash fa-sm"></i>
                        </button>

                        <div class="modal fade" id="deleteChapterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete this chapter?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    The deleted chapter cannot be recovered, you can only create it back in the create chapter page.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form action="{{ route('admin.chapter.destroy', $chapter->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete it!</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="ps-2">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="{{ route('admin.manga.index') }}">Mangas</a></li>
                          <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.manga.edit', $manga->slug) }}">{{ $manga->name }}</a></li>
                          <li class="breadcrumb-item active" aria-current="page">{{ $chapter->name }}</li>
                        </ol>
                    </nav>
                    <form action="{{ route('admin.chapter.update', $chapter->slug) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="manga_id" value="{{ $manga->id }}">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Chapter name" value="{{ $chapter->name }}">
                            <label for="name">Chapter name <span class="text-danger">*</span></label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('chapter_number') is-invalid @enderror" id="chapter_number" name="chapter_number" placeholder="Chapter number" value="{{ $chapter->chapter_number }}" step="0.1">
                            <label for="chapter_number">Chapter number <span class="text-danger">*</span></label>
                            @error('chapter_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug" value="{{ $chapter->slug }}">
                            <label for="slug">Slug <span class="text-danger">*</span></label>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark btn-block">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="overflow-auto" style="max-height:720px">
            @for ($i = 0; $i < count($files); $i++)
                <img src="{{ env('DIGITALOCEAN_SPACES_URL') }}/{{ $manga->slug }}/{{ $chapter->slug }}/{{ $i+1 }}.jpg" alt="{{ $chapter->slug }}" class="img-thumbnail" >
            @endfor
            </div>
        </div>
    </div>
</div>
@endsection