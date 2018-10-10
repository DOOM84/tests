@extends('admin.layout')
@section('title', 'Users')

@section('body')
    <div class="container text-center">
        @include('includes.messages')
    </div>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
            <li class="breadcrumb-item active" aria-current="page">Статистика</li>
        </ol>
    </nav>
    <div class="table-responsive">


        <table id="myTable" class="table table-striped display">
            <thead>
            <tr>
                <th>№</th>
                <th>ФИО</th>
                <th>Уровень</th>
                <th>Группа</th>
                <th>Учебное заведение</th>
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
            </tr>
            </tfoot>
        </table>
    </div>
@endsection