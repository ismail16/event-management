@extends('backend.layouts.master')

@section('title', 'Create User')

@section('heading', 'Create User')

@section('heading_buttons')
    <a href="{{route('users.index')}}" class="btn btn-primary">All User </a>
@endsection

@section('contents')
    <div class="card">
        <div class="card-body">
            @include('backend.partials.validation-msg')
            <form action="{{ route('users.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @include('backend.users.form')
                <button type="button" id="saveButton" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
@endsection
