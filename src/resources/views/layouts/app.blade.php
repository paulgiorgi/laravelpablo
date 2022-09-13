<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- CSFR TOKEN --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="/css/tailwind.css" rel="stylesheet">
        <link href="/css/bootstrap.css" rel="stylesheet">
        <link href="{{cache_bs('/css/scss.css')}}" rel="stylesheet">

        <script>baseUrl = "<?php echo url('/'); ?>";</script>

        <!-- Styles -->
        @yield('style')

   </head>
    <body class="bg-light vh-100">

        @include('layouts.navigation')

        <!-- Page Content -->
        <main class="main-content container mt-lg-4 mt-2">
            @yield('content')
        </main>

        @include('layouts.script')

        @yield('script')
        @stack('scripts')

    </body>
</html>
