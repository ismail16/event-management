<link href="{{ asset('assets/css/payment/success.css') }}" rel="stylesheet">


<body class="">
<div class=" m-auto ">
    <div>
        <div class=" card-body">
            <div class="card-img">
                <img src="{{ asset('assets/img/payment/success.svg') }}" class=" img " alt="success">
            </div>
            <div class="card-text-body">
                <p class="card-text-first">Registration Successful</p>
                <p class="card-text-second">Faujian Iftar Together ,April 1, 2023, 5PM Onwards</p>
                <p class="card-text-second">Your Invoice Number is<span
                    > {{ $payment->invoice_id ?? null }}</span> & Paid Amount
                    <span> {{ $payment->amount ?? null}} </span> by <span> {{ $payment->type ?? null }} </span>
                    was successfully received </p>
                <p class="card-text-third">Check your email for your INVOICE</p>
            </div>
        </div>
    </div>
</div>
</body>


