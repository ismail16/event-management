@extends('backend.layouts.master')

@section('title', 'Settings | Password Update')

@section('heading', 'Password Update')

@section('contents')
        <div class="card">
          <div class="card-body">
              <form method="post" action="{{ route('restaurant-admin.password.confirmation') }}">
                  @csrf
                  <div class="form-group">
                      <label for="old_password">Old Password</label>
                      <input type="password" class="form-control" id="old_password" name="old_password">
                  </div>
                  <div class="form-group">
                      <label for="current_password">Password</label>
                      <input type="password" class="form-control" name="password" id="password">
                  </div>
                  <div class="form-group">
                      <label for="password_confirmation">Confirm Password</label>
                      <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                  </div>

                  <button type="submit" class="btn btn-primary">Submit</button>
              </form>
          </div>
        </div>
@endsection
