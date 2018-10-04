@extends('user.layout')
@section('title', 'Welcome')
@section('content')

    <main role="main" class="container">
        <div class="{{--d-flex --}} p-3 my-3 text-white-50 bg-purple rounded shadow-sm ">
            @include('includes.messages')
            <div class="lh-100 ">
                <h2 class="text-center mb-0 text-white lh-100">Статистика группы {{Auth::user()->group->name}}</h2>
            </div>
        </div>

        <div class="my-3 p-3 bg-white rounded shadow-sm text-center">
            @guest
                Ви не можете бачити цю iнформацiю
            @else

                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Языковой уровень</th>
                        <th scope="col">Дата и время работы</th>
                        <th scope="col">Результаты теста</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse(Auth::user()->group->users->sortBy('name') as $user)
                        <thead class="thead-dark">
                        <tr>
                            <th colspan="4" scope="col">{{$user->name}}</th>
                        </tr>
                        </thead>
                        @forelse($user->results->sortByDesc('level_id') as $result)
                            <tr>
                                <td scope="col">{{$loop->iteration}}</td>
                                <td scope="col">
                                    {{$result->level->level}}
                                </td>
                                <td scope="col">{{$result->updated_at}}</td>
                                <td scope="col">{{$result->result}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" scope="col">Нет результатов</td>
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
    </main>
@endsection
