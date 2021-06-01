@extends('admin.layouts.app')

@section('title', 'Add a Manga')

@section('content')
<div class="container-sm">
    <div class="card">
        <div class="card-header">
            <h4 class="p-1 card-title m-0">Add a Manga</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.manga.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Manga name" name="name" value="{{ old('name') }}">
                            <label for="name">Manga name <span class="text-danger">*</span></label>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" value="{{ old('status') }}">
                                <option selected>Select a status</option>
                                <option value="ongoing" @if(old('status') == 'ongoing') selected @endif>Ongoing</option>
                                <option value="completed" @if(old('status') == 'completed') selected @endif>Completed</option>
                            </select>
                            <label for="status">Manga status <span class="text-danger">*</span></label>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Manga summary here" id="summary" name="summary" style="height: 200px">{{ old('summary') }}</textarea>
                    <label for="summary">Manga summary</label>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-dark btn-block">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection