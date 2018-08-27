@extends('admin.layout')

@section('body')
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
                    <td>{{$user->level->level}}</td>
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
                <th>Статус</th>
                <th>Администратор</th>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection