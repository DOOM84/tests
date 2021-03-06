@extends('admin.layout')
@section('title', 'Users')

@section('body')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
            <li class="breadcrumb-item active" aria-current="page">Пользователи</li>
        </ol>
    </nav>
    <div class="container text-center">
        @include('includes.messages')
        <a class="btn btn-success" href="{{route('users.create')}}">Добавить пользователя</a>
    </div>
    <div class="table-responsive">


        <table id="myTable" class="table table-striped display">
            <thead>
            <tr>
                <th>№</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Уровень</th>
                <th>Группа</th>
                <th>Учебное заведение</th>
                <th>Попытки</th>
                <th>Статус</th>
                <th>Администратор</th>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{isset($user->level->level) ? $user->level->level : 'Tests passed'}}</td>
                    <td>{{isset($user->group->name) ? $user->group->name : 'Нет'}}</td>
                    <td>{{isset($user->group->institute->name) ? $user->group->institute->name : 'Нет'}}</td>
                    <td>{{$user->attempts}}</td>
                    <td>
                        {{ $user->status ? 'Активный' : 'Заблокирован' }}
                    </td>
                    <td>
                        {{ $user->is_admin ? 'Да' : 'Нет' }}
                    </td>
                    <td><a class="btn btn-primary" href="{{route('users.edit', $user->id)}}">Изменить</a></td>
                    <td>
                        <form id="delete-form-{{$user->id}}" action="{{route('users.destroy', $user->id)}}"
                              method="post" style="display:none">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                        </form>
                        <a class="btn btn-warning" href="" onclick="
                                if(confirm('Вы уверены?')){
                                event.preventDefault();
                                document.getElementById('delete-form-{{$user->id}}').submit();
                                }else{
                                event.preventDefault();
                                }">Удалить
                        </a>

                    </td>
                </tr>
            @empty
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <th>№</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Уровень</th>
                <th>Группа</th>
                <th>Учебное заведение</th>
                <th>Попытки</th>
                <th>Статус</th>
                <th>Администратор</th>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection