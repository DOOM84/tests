@extends('admin.layout')
@section('title', 'Users')

@section('body')
    <div class="{{--d-flex --}} p-3 my-3 bg-purple rounded shadow-sm ">
        @include('includes.messages')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.stats')}}">Статистика</a></li>
                @if(isset($result->user->group->id))
                <li class="breadcrumb-item">
                    <a href="{{route('admin.stats.group', $result->user->group->id)}}">
                        Группа {{$result->user->group->name}}
                    </a>
                </li>
                @endif
                <li class="breadcrumb-item"><a href="{{route('admin.stats.student', $result->user->id)}}">
                        {{$result->user->name}}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{isset($result->topic->name) ? $result->topic->name : 'Общий тест'}} (Уровень: {{$result->level->level}})
                </li>
            </ol>
        </nav>

    </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm text-center">
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
                    <td scope="col">{{$result->detail->incorrect}}
                        @if($result->detail->incorrect > 0)
                            <a href="{{route('admin.stats.show', $result->id)}}">Показать</a>
                        @endif
                    </td>
                    <td scope="col">{{$result->value}}/{{$result->result}}</td>
                </tr>
                </tbody>
            </table>
    </div>
@endsection