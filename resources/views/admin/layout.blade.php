
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/jquery.dataTables.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('admin/css/dashboard.css')}}" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">{{env('APP_NAME')}}</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="#">Выход</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('admin.home')}}">
                            <span data-feather="home"></span>
                            Панель управления
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('tasks.index')}}">
                            <span data-feather="file"></span>
                            Тесты
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('categories.index')}}">
                            <span data-feather="layers"></span>
                            Категории
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('levels.index')}}">
                            <span data-feather="bar-chart-2"></span>
                            Уровни
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('users.index')}}">
                            <span data-feather="users"></span>
                            Пользователи
                        </a>
                    </li>
                </ul>

            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <h1 class="h2 text-center">Панель управления</h1>
            <hr>
                @yield('body')


        </main>
    </div>
</div>

@include('admin._scripts')
<script src="{{asset('admin/js/jquery.dataTables.min.js')}}"> </script>

<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    } );
</script>

<script>
    $( "#addAnswer" ).click(function() {
        var cnt = $('textarea[data-info="answer"]').length + 1;
        var oldDiv =  $("#answers");
        var newdiv = $('<div class="form-group"></div>');
        var label = $('<label for="body">Ответ:</label>');
        var textAr = $('<textarea class="form-control" data-info="answer" id="body" rows="3"></textarea>');
        $(textAr).attr('name', 'answer['+ cnt +'][body]');
        var label2 = $('<label>Правильный ответ </label>');
        var correct = $('<input type="checkbox" value="1"> ');
        $(correct).attr('name', 'answer['+ cnt +'][is_correct]');
        label2.append(correct);
        newdiv.append(label, textAr, label2);
        oldDiv.append(newdiv);
        //console.log(cnt);
        //alert( "Handler for .click() called." );
    });
</script>

</body>
</html>