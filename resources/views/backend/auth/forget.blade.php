@extends('backend.layouts.auth')


@section('heading', 'Forgot Password')

@section('contents')

    <p class="text-muted">We will send a link to reset your password</p>
    <form method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control" name="email" tabindex="1" required="" autofocus="">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                Forgot Password
            </button>
        </div>
    </form>

@endsection

