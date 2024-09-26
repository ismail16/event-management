@extends('backend.layouts.master')

@section('title', 'Edit Event')

@section('heading', 'Edit Event')

@section('heading_buttons')
    <a href="{{ route('events.index') }}" class="btn btn-primary">All Event </a>
@endsection

@section('contents')
    <div class="card">
        <div class="card-body">
            @include('backend.partials.validation-msg')
            <form action="{{ route('events.update', [$event->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('backend.events.form')
                <button type="button" id="saveButton" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
@endsection
