<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>{{config('app.name')}} Dashboard — @yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('admin/css/adminapp.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/jquery.dataTables.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('admin/css/dashboard.css')}}" rel="stylesheet">
    @if(Request::segment(3) == 'graph')
        <script src="https://code.highcharts.com/highcharts.js"></script>
        {{--<script src="https://code.highcharts.com/modules/series-label.js"></script>--}}
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
    @endif
</head>

<body>
{{--<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{route('admin.home')}}">{{env('APP_NAME')}}</a>
    --}}{{--<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">--}}{{--
    <ul class="list-inline">
        <li class=" list-inline-item">
            <span class="nav-link text-white">Welcome, {{Auth::user()->name}}</span>
        </li>
        <li class="list-inline-item">
            <a class="nav-link text-white" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>--}}

<nav class="navbar navbar-dark bg-dark navbar-expand-md sticky-top p-0">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('user.index')}}">{{env('APP_NAME')}}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class=" list-inline-item">
                    <span class="nav-link text-white">Welcome, {{Auth::user()->name}}</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                <li class="nav-item d-md-none"><a href="#" class="nav-link menu">Спрятать/показать левую панель</a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{Request::segment(2) == 'home' ? 'active' : ''}}"
                           href="{{route('admin.home')}}">
                            <span data-feather="home"></span>
                            Панель управления
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{Request::segment(2) == 'topics' ? 'active' : ''}}"
                           href="{{route('topics.index')}}">
                            <span data-feather="book-open"></span>
                            Темы
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{Request::segment(2) == 'tasks' ? 'active' : ''}}"
                           href="{{route('tasks.index')}}">
                            <span data-feather="file"></span>
                            Тесты
                        </a>
                    </li>
                    {{--<li class="nav-item">
                        <a class="nav-link {{Request::segment(2) == 'categories' ? 'active' : ''}}"
                           href="{{route('categories.index')}}">
                            <span data-feather="layers"></span>
                            Категории
                        </a>
                    </li>--}}

                    <li class="nav-item">
                        <a class="nav-link {{Request::segment(2) == 'levels' ? 'active' : ''}}"
                           href="{{route('levels.index')}}">
                            <span data-feather="bar-chart-2"></span>
                            Уровни
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{Request::segment(2) == 'institutes' ? 'active' : ''}}"
                           href="{{route('institutes.index')}}">
                            <span data-feather="globe"></span>
                            Учебные заведения
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{Request::segment(2) == 'branches' ? 'active' : ''}}"
                           href="{{route('branches.index')}}">
                            <span data-feather="map"></span>
                            Специальности
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{Request::segment(2) == 'groups' ? 'active' : ''}}"
                           href="{{route('groups.index')}}">
                            <span data-feather="list"></span>
                            Группы
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{Request::segment(2) == 'users' ? 'active' : ''}}"
                           href="{{route('users.index')}}">
                            <span data-feather="users"></span>
                            Пользователи
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{Request::segment(2) == 'stats' ? 'active' : ''}}"
                           href="{{route('admin.stats')}}">
                            <span data-feather="activity"></span>
                            Статистика
                        </a>
                    </li>
                </ul>

            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 p-0 main-page">
            <h1 class="h2 text-center">Панель управления</h1>
            <hr>
            @yield('body')


        </main>
    </div>
</div>

@include('admin._scripts')
<script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>

<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });

    $(function () {
        $('.menu').on('click', function () {
            if ($('.sidebar').is(':visible')) {
                $('.sidebar').animate({'width': '0px'}, 'slow', function () {
                    $('.sidebar').hide();
                });
                $('.main-page').animate({'padding-left': '0px'}, 'slow');
            } else {
                $('.sidebar').show();
                $('.sidebar').animate({'width': '240px'}, 'slow');
                $('.main-page').animate({'padding-left': '240px'}, 'slow');
            }
        });
    });
</script>


@section('scriptSection')

@show

</body>
</html>
