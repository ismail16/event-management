<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ config('app.name') }} | Login</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />

    @include('backend.partials.styles')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-social.css') }}">

</head>

<body>
<div id="app">
    @include('backend.partials.alert')

    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="{{ asset('assets/img/octaglory-logo.png') }}" alt="logo" width="300" class="shadow-light">
                    </div>

                    <div class="card card-primary">
                        <div class="card-header"><h4>@yield('heading', 'Auth')</h4></div>
                        <div class="card-body">
                            @yield('contents')
                        </div>
                    </div>


                    <div class="simple-footer">
                        Copyright &copy; Octaglory 2022
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@include('backend.partials.scripts')
</body>
</html>
