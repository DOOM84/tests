<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="">

    <title>{{config('app.name')}} — @yield('title')</title>

    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/offcanvas.css')}}" rel="stylesheet">
    @if(Request::segment(2) == 'graph')
        <script src="{{asset('js/highcharts.js')}}"></script>
       {{-- <script src="https://code.highcharts.com/modules/series-label.js"></script>--}}
        <script src="{{asset('js/exporting.js')}}"></script>
        <script src="{{asset('js/export-data.js')}}"></script>
    @endif
</head>

<body class="bg-light">

@include('user._header')


@yield('content')


@include('user._footer')
@section('scriptSection')
@show
</body>
</html>
