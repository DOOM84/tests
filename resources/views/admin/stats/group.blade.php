@extends('admin.layout')
@section('title', 'Users')

@section('body')
    <div class="container text-center">
        @include('includes.messages')

    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.stats')}}">Статистика</a></li>
            <li class="breadcrumb-item active" aria-current="page">Группа {{$group->name}} ({{$group->institute->name}}
                )
            </li>
        </ol>
    </nav>


    <div class="my-3 p-3 bg-white rounded shadow-sm text-center">
        @if($group->users->count() > 0)
            <a class="btn btn-info mb-2" href="{{route('admin.stats.graph.group', $group->id)}}">
                Графическая информация
            </a>
        @else @endif
        <div class="table-responsive">

            <table class="table">
                <thead>
                <tr>
                    <th colspan="5" scope="col"><h5>Статистика группы: {{$group->name}}
                            ({{$group->institute->name}})</h5>
                    </th>

                </tr>
                </thead>
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Текущий тест</th>
                    <th scope="col">Языковой уровень</th>
                    <th scope="col">Дата и время работы</th>
                    <th scope="col">Результаты теста</th>
                </tr>
                </thead>
                <tbody>
                @forelse($group->users->sortBy('name') as $user)
                    <thead class="thead-dark">
                    <tr>
                        <th colspan="5" scope="col" class="text-center">
                            <a class="text-white" href="{{route('admin.stats.student', $user->id)}}">{{$user->name}}</a>
                        </th>
                    </tr>
                    </thead>
                    @forelse($user->results->sortByDesc('level_id') as $result)
                        <tr>
                            <td scope="col">{{$loop->iteration}}</td>
                            <td scope="col">
                                <a href="{{route('admin.stats.student.detail', $result->id)}}">
                                    {{isset($result->topic->name) ? $result->topic->name : 'Общий тест'}}
                                </a>
                            </td>
                            <td scope="col">
                                {{$result->level->level}}
                            </td>
                            <td scope="col">{{$result->updated_at}}</td>
                            <td scope="col">{{$result->result}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" scope="col">Нет результатов</td>
                        </tr>

                    @endforelse
                @empty
                    <tr>
                        <td colspan="5">Нет результатов</td>
                    </tr>
                    @endforelse
                    </tbody>
            </table>

        </div>

    </div>
@endsection