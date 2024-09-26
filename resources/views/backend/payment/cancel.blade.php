<link href="{{ asset('assets/css/payment/cancel.css') }}" rel="stylesheet">

<body class="">
<div class=" m-auto ">
    <div>
        <div class=" card-body">
            <div class="card-img">
                <img src="{{ asset('assets/img/payment/cancel.png') }}" class=" img " alt="cancel">
            </div>
            <div class="card-text-body">
                <p class="card-text-first">Registration Could Not be Processed</p>
                <p class="card-text-second">Your Invoice Number is
                    <span>{{ $payment->invoice_id }}</span>
                    & Pending Amount
                    <span>{{ $payment->amount }}</span>
                    by {{ $payment->type }} is not successfully received
                </p>
                <p class="card-text-third">Please, Try Again or call 01611522671 for assistance.</p>
            </div>
        </div>
    </div>
</div>
</body>
