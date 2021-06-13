@extends('admin.layouts.app')

@section('title', 'Add a Chapter')

@section('content')
<div class="container-sm">
    <div class="card">
        <div class="card-header">
            <h4 class="p-1 card-title m-0">Add a Chapter</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.chapter.update', $chapter->slug) }}" method="POST">
                @method('PUT')
                @csrf
                <input type="hidden" name="manga_id" value="{{ $manga->id }}">
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Chapter name" value="{{ $chapter->name }}">
                            <label for="name">Chapter name <span class="text-danger">*</span></label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control @error('chapter_number') is-invalid @enderror" id="chapter_number" name="chapter_number" placeholder="Chapter number" value="{{ $chapter->chapter_number }}" step="0.1">
                            <label for="chapter_number">Chapter number <span class="text-danger">*</span></label>
                            @error('chapter_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
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
@endsection