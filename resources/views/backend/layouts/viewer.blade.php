<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ config('app.name') }} | @yield('title', 'dashboard')</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />

   @include('backend.partials.styles')

</head>

<body>
<div id="app">
    <div class="main-wrapper">

    <!-- Main Content -->
        <div class="main-content" style = "padding-left:30px;padding-top:30px;">
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

    </div>
</div>

@include('backend.partials.scripts')
@stack('stack_js')

</body>
</html>
