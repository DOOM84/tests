@extends('user.layout')
@section('title', 'Welcome')
@section('content')

    <main role="main" class="container">
        <div class="{{--d-flex --}} p-3 my-3 text-white-50 bg-purple rounded shadow-sm ">
            @include('includes.messages')
            <div class="lh-100 ">
                <h2 class="text-center mb-0 text-white lh-100">
                    Статистика группы @auth {{Auth::user()->group->name}} @endauth
                </h2>
            </div>
        </div>

        <div class="my-3 p-3 bg-white rounded shadow-sm text-center">
            @guest
                Ви не можете бачити цю iнформацiю
            @else
                @if(Auth::user()->results->count() > 0)
                    <a class="btn btn-primary mb-2" href="{{route('user.stats.graph.group')}}">
                        Графическая информация
                    </a>
                    <div class="text-right">
                        <a href="#"><i data-feather="printer" onclick="printData()"></i></a>
                    </div>
                @else @endif
                    <div id="res">
                        <h3 id="tableName" class="d-none">Статистика группы {{Auth::user()->group->name}}</h3>
                <table class="table">
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
                    @forelse(Auth::user()->group->users->sortBy('name') as $user)
                        <thead class="thead-dark">
                        <tr>
                            <th colspan="5" scope="col">{{$user->name}}</th>
                        </tr>
                        </thead>
                        @forelse($user->results->sortByDesc('level_id') as $result)
                            <tr>
                                <td scope="col">{{$loop->iteration}}</td>
                                <td scope="col">
                                    {{isset($result->topic->name) ? $result->topic->name : 'Общий тест'}}
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
                            <td colspan="4">Нет результатов</td>
                        </tr>
                        @endforelse
                        </tbody>
                </table>
            @endguest
                    </div>

        </div>
    </main>
@endsection

@section('scriptSection')
    @include('user._print')
@endsection
