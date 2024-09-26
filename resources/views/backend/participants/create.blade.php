@extends('backend.layouts.master')

@section('title', 'Create Participants')

@section('heading', 'Create Participants')

{{-- not working selected events form previous route param --}}
@section('heading_buttons')
    <div class=" form-group d-flex">
        <a href="{{route('participants.index')}}" class="btn btn-primary">All Participants </a>
        <div>
            <select id="selected_event" name="selected_event" class="form-control select2">
                @foreach($events as $event)
                    <option
                        value="{{ $event->name }}" @if(((int) request()->get('selected_event')) == $event->id) selected @endif>{{ $event->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
@endsection

@section('contents')
    <div class="card">
        <div class="card-body">
            @include('backend.partials.validation-msg')
            <form action="{{ route('participants.store', [request()->get('selected_event') ?? $events->first->id])}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                @method('POST')
                @include('backend.participants.form')
                <button type="button" id="saveButton" class="btn btn-success">Save</button>
            </form>
        </div>
    </div>
@endsection
