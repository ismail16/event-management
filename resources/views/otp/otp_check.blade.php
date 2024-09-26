@extends('backend.layouts.auth')

@section('heading', 'Login')

@section('contents')
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
            @if (session('error'))
                <div class="alert alert-danger" role="alert"> {{session('error')}}
                </div>
            @endif

        <form method="POST"
              action="{{ route('otp.verify', ['phone' => $phone]) }}"
              class="needs-validation"
              novalidate="">
            <div class="form-group">
                <p>{{ $phone }}</p>
                <p>An one time verification code was sent to your registered phone number. Verify the code within 2
                    minutes to continue.</p>
                <label for="otp">OTP</label>
                <input id="otp" type="text" class="form-control" name="otp" tabindex="1" required autofocus>
                <div class="invalid-feedback">
                    Please fill your otp
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Verify
                </button>
            </div>

            @csrf
            @method('POST')
        </form>
    </div>
@endsection
