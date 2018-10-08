@extends('admin.layout')
@section('title', 'Users')

@section('body')
    <div class="container text-center">
        @include('includes.messages')
    </div>
    <div class="lh-100 ">
        <h4 class="text-center mb-0 lh-100">Статистика</h4>
    </div>
    <div class="table-responsive">


        <table id="myTable" class="table table-striped display">
            <thead>
            <tr>
                <th>№</th>
                <th>ФИО</th>
                <th>Уровень</th>
                <th>Группа</th>
                <th>Учебное заведение</th>
                <th>Результаты теста</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><a href="{{route('admin.stats.student', $user->id)}}">{{$user->name}}</a></td>
                    <td>{{isset($user->level->level) ? $user->level->level : 'Tests passed'}}</td>
                    <td>
                        @if(isset($user->group->name) )
                            <a href="{{route('admin.stats.group', $user->group->id)}}">{{$user->group->name}}</a>
                        @else
                            Нет
                        @endif
                    </td>
                    <td>{{isset($user->group->institute->name) ? $user->group->institute->name : 'Нет'}}</td>
                    <td>{{$user->results->count() > 0 ? $user->getFinalRes() : 'Нет информации'}}</td>

                </tr>
            @empty
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <th>№</th>
                <th>ФИО</th>
                <th>Уровень</th>
                <th>Группа</th>
                <th>Учебное заведение</th>
                <th>Результаты теста</th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection