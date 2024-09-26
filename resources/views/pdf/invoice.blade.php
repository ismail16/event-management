<!DOCTYPE html>
<html>
<head>
    <title>Invoice | Protichobi</title>
    <style>
        body {
            font-family: freeserif, "Times New Roman", sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            padding: 0;
        }

        table.signatures td, th {
            padding-top: 100px;
            border: none;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 5px;
            font-size: 12px;
        }

        .number {
            text-align: right;
        }

        .title {
            font-size: 14px;
        }
        .subtitle {
            font-size: 13px;
        }
        @media print {
            .page-break {
                page-break-before: always;
                box-decoration-break: slice;
            }
        }
        /*.content {*/
        /*position: absolute;*/
        /*}*/
    </style>
</head>
<body>
<table>
    <tr>
        <td width="50%">
            <div>
                <p>{{ $payment->created_at }}</p>
                <br>
                <h4><strong>Customer</strong></h4>
                <p>
                    {{ strtoupper(data_get($payment, 'customer.name')) }}<br>
                    Mobile: {{ data_get($payment, 'customer.phone') }}<br>
                </p>
            </div>
        </td>
        <td>
            <div>
                <h3><strong>INVOICE: {{ $payment->invoice_id }}</strong></h3>
                <h6>Amount: {{ $payment->amount }}</h6>
                <h6>Transaction Fee: {{ $payment->transaction_fee }}</h6>
                <h6>Total: {{ $payment->total }}</h6>
            </div>
        </td>
    </tr>
</table>
</body>
</html>
