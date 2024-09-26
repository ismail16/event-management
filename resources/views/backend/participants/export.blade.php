<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index PDF</title>
    <style>
        table {

            /*padding: 2px;*/
            /*margin: 2px;*/
            text-align: center;
            border-top: 1px solid black;
            border-left: 1px solid black;
            word-break: break-all;
            /*// border-radius: 8px;*/
        }

        th {
            text-align: center;
            border-right: 1px solid black;
            border-bottom: 1px solid black;
            background-color: gray;
            color: white;

            word-break: break-all;
            /*font-weight: 600;*/
        }

        /*th:last-child,td:last-child{*/
        /*    border-right: none;*/
        /*    border-bottom: none;*/
        /*}*/
        td {

            text-align: center;
            border-right: 1px solid black;
            border-bottom: 1px solid black;
            word-break: break-all;
            /*background-color: white;*/
            /*color: black;*/
            /*font-weight: 400;*/
        }
        .box{
            inline-size: 5px;
            overflow-wrap: break-word;
        }

        .main-table td {
            word-break: break-all;
            text-wrap: normal;
        }
    </style>
</head>

<div class="">
    <div class="table-wrapper">
        <table class="table-responsive card-list-table table boder-1  main-table ">
            <thead>
            <tr style="border-bottom: 1px solid #000000;">
                <th scope="col" class="border-bottom">{{ __('Name') }}</th>
                <th scope="col">{{ __('Phone') }}</th>
                <th scope="col" style="width: 5px !important;">{{ __('Batch') }}</th>
{{--                <th scope="col">{{ __('Trx ID') }}</th>--}}
                <th scope="col">{{ __('Invoice') }}</th>
                <th scope="col">{{ __('Trx Date') }}</th>
                <th scope="col">{{ __('Status') }}</th>
                <th scope="col">{{ __('Amount') }}</th>
                <th scope="col">{{ __('Pay In') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($registrations as $registration)
                <tr>
                    <td data-title="Name">{{ $registration->name }}</td>
                    <td data-title="Phone">{{ $registration->phone }}</td>
                    <td data-title="Email" style=" width: 5px !important;">
                        <div class="box">{{ $registration->batch }}</div>
                    </td>
{{--                    <td data-title="Trx ID">{{ $registration->payment->transaction_id }}</td>--}}
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
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</div>

