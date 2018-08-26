
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>Welcome to our test system!</title>

    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link href="{{asset('css/offcanvas.css')}}" rel="stylesheet">

</head>

<body class="bg-light">

@include('user._header')


@yield('content')


@include('user._footer')
@section('scriptSection')
@show
</body>
</html>
