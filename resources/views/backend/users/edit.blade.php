@extends('backend.layouts.master')

@section('title', 'Edit User')

@section('heading', 'Edit User')

@section('heading_buttons')
    <a href="{{ route('users.index') }}" class="btn btn-primary">All User </a>
@endsection

@section('contents')
    <div class="card">
        <div class="card-body">
            @include('backend.partials.validation-msg')
            <form action="{{ route('users.update', [$user->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('backend.users.form')
                <button type="button" id="saveButton" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
@endsection
