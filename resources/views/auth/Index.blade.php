@extends('layout.auth_layout')

@section('title', 'Login')

@section('content')
    <div class="card-body text-center">
        <h4 class="fw-bold">Get Started Now</h4>
        <p class="mb-0">Enter your credentials to login your account</p>
    </div>

    <form class="row g-3 my-2" method="POST" action="{{ route('login.store') }}">
        @csrf
        <div class="col-12">
            <label for="email" class="form-label">Email/Username</label>
            <input type="text" name="email" class="form-control" placeholder="Masukkan Username/Email" required
                autofocus>
        </div>
        <div class="col-12">
            <label for="password" class="form-label">Password</label>
            <div class="input-group" id="show_hide_password">
                <input type="password" name="password" class="form-control border-end-0" placeholder="Masukkan Password"
                    required>
                <a href="javascript:;" class="input-group-text bg-transparent"><i class="bi bi-eye-slash-fill"></i></a>
            </div>
        </div>
        <div class="col-md-6 text-end">
            {{-- <a href="{{ route('reset') }}">Forgot Password?</a> --}}
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-grd-primary w-100">Login</button>
        </div>
        <div class="col-12 text-center">
            {{-- <p class="mb-0">Don't have an account? <a href="{{ route('register') }}">Sign up here</a></p> --}}
        </div>
    </form>
@endsection
