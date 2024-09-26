<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} | @yield('title', 'dashboard')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />
{{--    <link href="{{ asset('assets/css/payment/success.css') }}" rel="stylesheet">--}}

   @include('backend.partials.styles')

</head>

<body>
<div id="app">
    <div class="main-wrapper">
    @include('backend.partials.header')

    @include('backend.partials.sidebar')

    <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>@yield('heading', 'dashboard')</h1>

                    <div class="buttons" style="margin: 0 0 -10px 20px;">
                        @yield('heading_buttons')
                    </div>

                    @yield('breadcrumbs')

                </div>
                @include('backend.partials.alert')
                <div class="section-body">
                    @yield('contents')
                </div>
            </section>
        </div>

        @include('backend.partials.footer')
    </div>
</div>

@stack('modals')

@include('backend.partials.scripts')
@stack('stack_js')

</body>
</html>
