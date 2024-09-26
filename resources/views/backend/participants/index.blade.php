@extends('backend.layouts.master')

@section('title', 'Participants List')

@section('heading', 'Participants List')

@section('heading_buttons')
    <div class="d-flex">
        <div>
            <button class="btn btn-primary" onclick="addParticipants({{ $events->first() }})">
                {{ __('Add Participants') }}
            </button>
        </div>
    </div>
@endsection

@section('contents')
    <div class="col-12 col-md-12 col-lg-12" style="padding: 0px">
        <div class="card card-primary">
            <div class="card-body">
                <div class="row ">
                    <form action="{{ route('participants.index') }}" class="  d-flex " style=" width: 100%">
                        <div class="form-group col-md-2 mr-5 ">
                            <label for="status">Events</label>
                            <select id="filter-event"
                                    name="filter-event"
                                    onchange="onchangeEvents(this)"
                                    class="form-control select2">
                                @foreach($events as $event)
                                    <option value="{{ $event->id }}"
                                            @if($event->id==request()->get('filter-event')) selected @endif>{{ $event->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label class="ml-3" style=" flex-basis: 40%;">From Date</label>
                            <input type="text" id="from_date" name="from_date"
                                   value="@if(request()->has('from_date')) {{ request()->get('from_date') }} @endif"
                                   class="form-control datepicker">
                        </div>
                        <div class="form-group col-md-2">
                            <label class=" ml-3" style=" flex-basis: 30%;">To Date</label>
                            <input type="text" id="to_date" name="to_date" class="form-control datepicker">
                        </div>
                        <div class="form-group col-md-2 mr-5 ">
                            <label>Payment Status</label>
                            <select id="filter-status" name="filter-status" class="form-control select1"
                            >
                                <option
                                    value="{{ \App\Models\Payment::STATUS_PROCESSING }}"
                                    @if(\App\Models\Payment::STATUS_PROCESSING==request()->get('filter-status')) selected @endif>{{ \App\Models\Payment::STATUS_PROCESSING}}</option>
                                <option
                                    value="{{ \App\Models\Payment::STATUS_PAID }}"
                                    @if(\App\Models\Payment::STATUS_PAID==request()->get('filter-status')) selected @endif>{{ \App\Models\Payment::STATUS_PAID}}</option>
                                <option
                                    value="{{ \App\Models\Payment::STATUS_PENDING }}"
                                    @if(\App\Models\Payment::STATUS_PENDING==request()->get('filter-status')) selected @endif>{{ \App\Models\Payment::STATUS_PENDING}}</option>
                                <option
                                    value="{{ \App\Models\Payment::STATUS_FAILED }}"
                                    @if(\App\Models\Payment::STATUS_FAILED==request()->get('filter-status')) selected @endif>{{ \App\Models\Payment::STATUS_FAILED}}</option>
                                <option
                                    value="{{ \App\Models\Payment::STATUS_MANUAL }}"
                                    @if(\App\Models\Payment::STATUS_MANUAL==request()->get('filter-status')) selected @endif>{{ \App\Models\Payment::STATUS_MANUAL}}</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3 d-flex align-items-center justify-content-around m-auto ">
                            <div>
                                <button type="submit" class="btn btn-success ml-2">Filter</button>
                                <button class="btn btn-danger" onclick="resetFilters()" type="button" name="reset">Reset
                                    Filters
                                </button>
                            </div>

                            <div class="dropdown">
                                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Export
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="submit" formaction="{{ route('export') }}"
                                            name="action" value="pdf">PDF
                                    </button>
                                    <button class="dropdown-item" type="submit" formaction="{{ route('export') }}"
                                            name="action" value="excel">EXCEL
                                    </button>
                                </div>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>All Participants</h4>
            <div class="card-header-form">
                <div class="input-group">
                    <form action="{{ route('participants.index') }}"  class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search"
                               value="{{ $input['search'] ?? request()->get('search') }}">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="table-wrapper">
            <table class="table-responsive card-list-table">
                <thead>
                <tr>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Phone') }}</th>
                    <th scope="col">{{ __('Batch') }}</th>
                    <th scope="col">{{ __('Trx ID') }}</th>
                    <th scope="col">{{ __('Invoice') }}</th>
                    <th scope="col">{{ __('Trx Date') }}</th>
                    <th scope="col">{{ __('Status') }}</th>
                    <th scope="col">{{ __('Amount') }}</th>
                    <th scope="col">{{ __('Pay In') }}</th>
                </tr>
                </thead>
                <tbody id="tbody">
                @foreach($registrations as $registration)
                    <tr>
                        <td data-title="Name">{{ $registration->name }}</td>
                        <td data-title="Phone">{{ $registration->phone }}</td>
                        <td data-title="Email">{{ $registration->batch }}</td>
                        <td data-title="Trx ID">{{ $registration->payment->transaction_id }}</td>
                        <td data-title="Invoice">{{ $registration->payment->invoice_id }}</td>


                        <td data-title="Trx Date">
                            {{ $registration->payment->paid_at ? $registration->payment->paid_at->toDateString() : null }}
                        </td>

                        <td data-title="Status">

                            @if($registration->payment->status == \App\Models\Payment::STATUS_FAILED)
                                <div class="badge badge-danger mr-1 mb-1">{{$registration->payment->status}}</div>
                            @elseif($registration->payment->status == \App\Models\Payment::STATUS_PENDING)
                                <div class="badge badge-warning mr-1 mb-1">{{ $registration->payment->status }}</div>
                            @elseif($registration->payment->status == \App\Models\Payment::STATUS_PAID)
                                <div class="badge badge-success mr-1 mb-1">{{ $registration->payment->status}}</div>
                            @elseif($registration->payment->status == \App\Models\Payment::STATUS_PROCESSING)
                                <div class="badge badge-info mr-1 mb-1">{{ $registration->payment->status}}</div>
                            @elseif($registration->payment->status == \App\Models\Payment::STATUS_MANUAL)
                                <div class="badge badge-info mr-1 mb-1">{{ $registration->payment->status}}</div>
                            @endif

                        </td>
                        <td data-title="Amount">{{ $registration->payment->amount }}</td>
                        <td data-title="Pay In">{{ $registration->payment->type }}</td>
                        <td data-title="actions">
                            <div class="row">
                                <div class="col-4">
                                    <button type="submit" onclick="editRegistration({{ $registration->id }})"
                                            data-id="{{ $registration->id }}" class="btn btn-sm btn-info editButton">
                                        {{ __('Edit') }}
                                    </button>
                                </div>
                                <div class="col-4">
                                    <button type="submit"
                                            onclick="return confirm('Are you sure to delete?') ? deleteRegistration({{ $registration->id }}) : ''"
                                            data-id="{{ $registration->id }}"
                                            class="btn btn-sm btn-danger deleteButton">
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="card-body" id="cardBody">
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div class="dataTables_info" id="table-1_info" role="status" aria-live="polite">
                            Showing {{ $registrations->firstItem() }} to {{ $registrations->lastItem() }}
                            of {{ $registrations->total() }}
                            entries
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <div class="float-right">
                            {{ $registrations->appends(request()->except('page'))->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()
@push('scripts')
    <script>
        let dropdownEvent = "";

        function onchangeEvents(event) {
            dropdownEvent = event.value;
        }

        function addParticipants(event) {
            let url = `{{ route('participants.create', ['selected_event' => '__dropdown_event__']) }}`;
            url = url.replace('__dropdown_event__', dropdownEvent == null || dropdownEvent === "" || dropdownEvent === undefined ? event.id : dropdownEvent);
            window.location.href = url;
        }

        function resetFilters() {
            window.location.href = `{{ route('participants.index') }}`;
        }

        $(document).ready(function () {
            @if(!request()->has('from_date') || !request()->has('to_date'))
            $('#from_date').data('daterangepicker').setStartDate('2000/01/01');
            $('#to_date').data('daterangepicker').setStartDate(moment());
            @endif
        });

        function editRegistration(registration_id) {
            let url = "{{ route('participants.edit', ':registration_id') }}";
            url = url.replace(':registration_id', registration_id);

            window.location.href = url;
        }

        function deleteRegistration(registration_id) {
            let url = "{{ route('participants.delete', ':registration_id') }}"
            url = url.replace(':registration_id', registration_id);

            $.ajax({
                url: url,
                type: "DELETE",
                success: function (res) {
                    iziToast.success({
                        timeout: 1000,
                        title: res.success,
                        position: 'topRight',
                        onClosed: function (instance, toast, closedBy) {
                            if (res.redirect_to) {
                                window.location.href = res.redirect_to;
                            }
                        }
                    });
                },
                error: function (res) {
                    iziToast.error({
                        timeout: 1000,
                        title: res.statusText ?? '',
                        position: 'topRight',
                    });
                }
            });
        }
    </script>
@endpush
