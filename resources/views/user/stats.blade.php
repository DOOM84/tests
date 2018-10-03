@extends('user.layout')
@section('title', 'Welcome')
@section('content')

    <main role="main" class="container">
        <div class="{{--d-flex --}} p-3 my-3 text-white-50 bg-purple rounded shadow-sm ">
            @include('includes.messages')
            <div class="lh-100 ">
                <h2 class="text-center mb-0 text-white lh-100">Статистика</h2>
            </div>
        </div>

        <div class="my-3 p-3 bg-white rounded shadow-sm text-center">
            @guest
                Ви не можете бачити цю iнформацiю
            @else

                @forelse(Auth::user()->results->sortByDesc('level_id')->groupBy('level_id') as $level => $results)
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th colspan="3" scope="col">Уровень {{$results[0]->level->level}}</th>

                        </tr>
                        </thead>
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Текущий тест</th>
                            <th scope="col">Текущая оценка</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($results as $result)
                            <tr>
                                <td scope="col">{{$loop->iteration}}</td>
                                <td scope="col">
                                    <a href="{{route('user.stats.detail', $result->id)}}">{{isset($result->topic->name) ? $result->topic->name : 'Общий тест'}}</a>
                                </td>
                                <td scope="col">{{$result->result}}</td>
                            </tr>

                        @endforeach
                        <tr>
                            <td colspan="3" scope="col">Средняя оценка по уровню:
                                {{Auth::user()->getMidRes($level)}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                @empty
                    Нет результатов
                @endforelse



            @endguest

        </div>


    </main>
@endsection
