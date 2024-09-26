@extends('backend.layouts.auth')

@section('heading', 'Login')

@section('contents')
    <form method="POST" action="{{ route('otp.password.reset', ['phone' => $phone, 'code' => $code])}}" class="needs-validation" novalidate="">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="new_password">New Password</label>
            <input id="new_password" type="password" class="form-control" name="new_password" tabindex="1" required
                   autofocus>
            <div class="invalid-feedback">
                New password
            </div>
        </div>

        <div class="form-group">
            <div class="d-block">
                <label for="confirm_password" class="control-label">Confirm Password</label>
            </div>
            <input id="confirm_password" type="password" class="form-control" name="confirm_password" tabindex="2"
                   required>
            <div class="invalid-feedback">
                Confirmation Password
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                Send
            </button>
        </div>
    </form>
@endsection
