<link href="{{ asset('assets/css/payment/success.css') }}" rel="stylesheet">


<body class="">
<div class=" m-auto ">
    <div>
        <div class=" card-body">
            <div class="card-img">
                <img src="{{ asset('assets/img/payment/success.svg') }}" class=" img " alt="success">
            </div>
            <div class="card-text-body">
                <p class="card-text-first">You have already registered with following email and phone</p>
                <p class="card-text-second">Email</p>
                <input value="{{ $registration->email }}" readonly>
                <p class="card-text-second">Phone</p>
                <input value="{{ $registration->phone }}" readonly>
                <p class="card-text-third">Click here to update your registration info</p>
                <a href="{{ route('otp.generate', ['phone' => $registration->phone]) }}">Click</a>
            </div>
        </div>
    </div>
</div>
</body>


