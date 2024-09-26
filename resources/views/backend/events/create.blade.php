@extends('backend.layouts.master')

@section('title', 'Create Event')

@section('heading', 'Create Event')

@section('heading_buttons')
    <a href="{{route('events.index')}}" class="btn btn-primary">All Events </a>
@endsection

@section('contents')
    <div class="card">
        <div class="card-body">
            @include('backend.partials.validation-msg')
            <form action="{{ route('events.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @include('backend.events.form')
                <button type="button" id="saveButton" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
@endsection
