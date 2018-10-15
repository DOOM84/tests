@extends('user.layout')
@section('title', 'Welcome')
@section('content')

    <main role="main" class="container">
        <div class="{{--d-flex --}} p-3 my-3 text-white-50 bg-purple rounded shadow-sm ">
            @include('includes.messages')

            <div class="lh-100 ">
                <h2 class="text-center mb-0 text-white lh-100">Статистика. @auth {{Auth::user()->name}} @endauth</h2>
            </div>

        </div>

        <div class="my-3 p-3 bg-white rounded shadow-sm text-center">
            @guest
                Ви не можете бачити цю iнформацiю
            @else
                @if(Auth::user()->results->count() > 0)
                    <a class="btn btn-primary mb-2 " href="{{route('user.stats.graph.student')}}">
                        Графическая информация
                    </a>
                    <div class="text-right">
                        <a href="#"><i data-feather="printer" onclick="printData()"></i></a>
                        <a href="#"><i data-feather="mail" onclick="mailData()"></i></a>
                    </div>
                @else @endif
                <div id="res">
                    <h3 id="tableName" class="d-none">Статистика. {{Auth::user()->name}}</h3>
                    @forelse(Auth::user()->results->sortByDesc('level_id')->groupBy('level_id') as $level => $results)
                        <table class="table" cellpadding="7" border="2" width="100%">
                            <thead class="thead-dark">
                            <tr>
                                <th colspan="4" scope="col" align="center">Уровень {{$results[0]->level->level}}</th>

                            </tr>
                            </thead>
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" align="center">#</th>
                                <th scope="col" align="center">Текущий тест</th>
                                <th scope="col" align="center">Дата и время работы</th>
                                <th scope="col" align="center">Текущая оценка</th>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach($results as $result)
                                <tr>
                                    <td scope="col" align="center">{{$loop->iteration}}</td>
                                    <td scope="col" align="center">
                                        <a href="{{route('user.stats.detail', $result->id)}}">{{isset($result->topic->name) ? $result->topic->name : 'Общий тест'}}</a>
                                    </td>
                                    <td scope="col" align="center">{{$result->start}} <br> (Продолжительность: {{$result->duration}})
                                    </td>
                                    <td scope="col" align="center">{{$result->result}}</td>
                                </tr>

                            @endforeach
                            <tr>
                                <td colspan="4" scope="col" align="center">Средняя оценка по уровню:
                                    {{Auth::user()->getMidRes($level)}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    @empty
                        <tr>
                            <td colspan="4" align="center">Нет результатов</td>
                        </tr>
                    @endforelse
                </div>


            @endguest


        </div>


    </main>

@endsection

@section('scriptSection')
    @include('user._printOrMail')
@endsection


