@extends('backend.layouts.master')

@section('title', 'Edit Event')

@section('heading', 'Edit Event')

@section('heading_buttons')

    <div class="d-flex">
    <a href="{{ route('participants.index') }}" class="btn btn-primary">All Participant </a>
    <div>
{{--        <input readonly value="{{ $event->name ?? 'Not event found' }}"/>--}}
        <select id="selected_event" name="selected_event" class="form-control select2" disabled="disabled">

                <option
                    value="{{ $event->name }}" @if(((int) request()->get('selected_event')) == $event->id) selected @endif>{{ $event->name }}
                </option>

        </select>
    </div>
    </div>
@endsection

@section('contents')
    <div class="card">
        <div class="card-body">
            @include('backend.partials.validation-msg')
            <form action="{{ route('participants.update', [$registration->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('backend.participants.form')
                <button type="button" id="saveButton" class="btn btn-success">Update</button>
            </form>
        </div>
    </div>
@endsection
