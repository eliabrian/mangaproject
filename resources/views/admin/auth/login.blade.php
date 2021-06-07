@extends('admin.layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="p-1 card-title m-0">Login</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.login.authenticate') }}" method="POST">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="name@example.com" id="email" name="email" autocomplete="email" required autofocus value="{{ old('email') }}">
                            <label for="email">Email address</label>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" id="password" name="password" value="{{ old('password') }}">
                            <label for="password">Password</label>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark btn-block">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection