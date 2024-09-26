@extends('backend.layouts.master')

@section('title', 'event List')

@section('heading', 'event List')

@section('heading_buttons')
    <a href="{{ route('events.create') }}" class="btn btn-primary">{{ __('Create Event') }}</a>
@endsection

@section('contents')
    <div class="card">
        <div class="card-header">
            <h4>All events</h4>
            <div class="card-header-form">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search"
                           value="{{ $input['search'] ?? '' }}">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-wrapper">
            <table class="table-responsive card-list-table">
                <thead>
                <tr>
                    <th scope="col">{{ __('Event Name') }}</th>
                    <th scope="col">{{ __('Email') }}</th>
                    <th scope="col">{{ __('Event Venue') }}</th>
                    <th scope="col">{{ __('Organization') }}</th>
                    <th scope="col">{{ __('Event Date') }}</th>
                    <th scope="col">{{ __('Event Admin') }}</th>
                    <th scope="col">{{ __('Image') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($events as $event)
                    <tr>
                        <td data-title="Name">{{ $event->name }}</td>
                        <td data-title="email">{{ $event->email }}</td>
                        <td data-title="venue">{{ $event->venue }}</td>
                        <td data-title="org">{{ $event->organization }}</td>
                        <td data-title="date">{{ $event->event_start_date }}</td>
                        <td data-title="date">{{ '' }}</td>
                        <td data-title="image">
                            @foreach($event->media as $image)
                                <img src="{{ $image->getFullUrl() }}" height="10%" width="10%">
                            @endforeach
                        </td>

                        <td data-title="actions">
                            <div class="row">
                                <div class="col-3">
                                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-info">
                                        {{ __('Edit') }}
                                    </a>
                                </div>
                                <div class="col-3">
                                    <form action="{{ route('events.delete', $event->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" id="deleteButton"
                                                onclick="return confirm('Are you sure to delete?')"
                                        >
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div class="dataTables_info" id="table-1_info" role="status" aria-live="polite">
                            Showing {{ $events->firstItem() }} to {{ $events->lastItem() }} of {{ $events->total() }}
                            entries
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <div class="float-right">
                            {{ $events->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
