@extends('admin.layout')
@section('title', $user->name.' stats')

@section('body')
    <div class="container text-center">
        @include('includes.messages')
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.stats')}}">Статистика</a></li>
            <li class="breadcrumb-item">
                <a href="{{route('admin.stats.group', $user->group->id)}}">Группа {{$user->group->name}}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{$user->name}}</li>
        </ol>
    </nav>

    <div class="my-3 p-3 bg-white rounded shadow-sm text-center">

        <table class="table">
            <thead>
            <tr>
                <th colspan="4" scope="col"><h5>Статистика студента: {{$user->name}} (гр. {{$user->group->name}})</h5>
                </th>

            </tr>
            </thead>
            @forelse($user->results->sortByDesc('level_id')->groupBy('level_id') as $level => $results)

                <thead class="thead-dark">
                <tr>
                    <th colspan="4" scope="col">Языковой уровень: {{$results[0]->level->level}}</th>
                </tr>
                </thead>
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Текущий тест</th>
                    <th scope="col">Дата и время работы</th>
                    <th scope="col">Текущая оценка</th>
                </tr>
                </thead>
                <tbody>
                @foreach($results as $result)
                    <tr>
                        <td scope="col">{{$loop->iteration}}</td>
                        <td scope="col">
                            <a href="{{route('admin.stats.student.detail', $result->id)}}">{{isset($result->topic->name) ? $result->topic->name : 'Общий тест'}}</a>
                        </td>
                        <td scope="col">{{$result->start}} <br> (Продолжительность: {{$result->duration}})</td>
                        <td scope="col">{{$result->result}}</td>
                    </tr>

                @endforeach
                <tr>
                    <td colspan="4" scope="col"><strong>Средняя оценка по уровню:
                            {{$user->getMidRes($level)}}</strong>
                    </td>
                </tr>
                </tbody>
            @empty
                <tr>
                    <td colspan="4" scope="col">
                        Нет результатов
                    </td>
                </tr>

            @endforelse
        </table>
        @if($user->results->count() > 0)
            <a class="btn btn-info mb-2" href="{{route('admin.stats.graph.student', $user->id)}}">
                Графическая информация
            </a>
        @else @endif

    </div>

@endsection