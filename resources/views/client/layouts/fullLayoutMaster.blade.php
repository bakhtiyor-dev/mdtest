<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <link rel="shortcut icon" href="{{url('images/plane.png')}}" type="image/png">

        {{-- Include core + vendor Styles --}}
        @include('client/panels/styles')

    </head>

    <body class="vertical-layout vertical-menu-modern 1-column" data-menu="vertical-menu-modern" data-col="1-column">

        <!-- BEGIN: Content-->
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-body">

                    {{-- Include Startkit Content --}}
                    @yield('content')

                </div>
            </div>
        </div>
        <!-- End: Content-->

        {{-- include default scripts --}}
        @include('client/panels/scripts')

    </body>
</html>
