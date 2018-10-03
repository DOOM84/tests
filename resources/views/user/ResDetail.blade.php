@extends('user.layout')
@section('title', 'Welcome')
@section('content')

    <main role="main" class="container">
        <div class="{{--d-flex --}} p-3 my-3 text-white-50 bg-purple rounded shadow-sm ">
            @include('includes.messages')
            <div class="lh-100 ">
                <h2 class="text-center mb-0 text-white lh-100">Тест: {{isset($result->topic->name) ? $result->topic->name : 'Общий тест'}}</h2>
            </div>
        </div>

        <div class="my-3 p-3 bg-white rounded shadow-sm text-center">
            @guest
                Ви не можете бачити цю iнформацiю
            @else

                    <table class="table">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">Тест</th>
                            <th scope="col">Время работы</th>
                            <th scope="col">Кол-во правильных ответов</th>
                            <th scope="col">Кол-во неправильных ответов</th>
                            <th scope="col">Оценка/Балл</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td scope="col">
                                    {{isset($result->topic->name) ? $result->topic->name : 'Общий тест'}}
                                </td>
                                <td scope="col">
                                    {{$result->duration}}
                                </td>
                                <td scope="col">{{$result->detail->correct}}</td>
                                <td scope="col">{{$result->detail->incorrect}}</td>
                                <td scope="col">{{$result->value}}/{{$result->result}}</td>
                            </tr>
                        </tbody>
                    </table>
            @endguest
        </div>


    </main>
@endsection
