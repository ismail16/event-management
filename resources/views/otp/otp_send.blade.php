@extends('backend.layouts.auth')

@section('heading', 'Login')

@section('contents')

    <form method="POST" action="{{route('otp.generate')}}" class="needs-validation" novalidate="">
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="text" class="form-control" name="email" tabindex="1" required autofocus>
            <div class="invalid-feedback">
                Please fill in your email
            </div>
        </div>

        <div class="form-group">
            <div class="d-block">
                <label for="phone" class="control-label">Phone</label>
            </div>
            <input id="phone" type="phone" class="form-control" name="phone" tabindex="2" required>
            <div class="invalid-feedback">
                please fill in your phone Number
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                Send
            </button>
        </div>

        @csrf

    </form>
@endsection
