@extends('backend.layouts.auth')

@section('heading', 'Login')

@section('contents')

    <form method="POST" action="{{route('auth.login')}}" class="needs-validation" novalidate="">
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="text" class="form-control" name="email" tabindex="1" required autofocus>
            <div class="invalid-feedback">
                Please fill in your email
            </div>
        </div>

        <div class="form-group">
            <div class="d-block">
                <label for="password" class="control-label">Password</label>
            </div>
            <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
            <div class="invalid-feedback">
                please fill in your password
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                Login
            </button>
        </div>

        @csrf

    </form>
@endsection
