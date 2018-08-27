@extends('admin.layout')

@section('body')
    <div class="table-responsive">
        @include('includes.messages')
        <h2>Изменить пользователя</h2>
        <form action="{{route('users.update', $user->id)}}" method="post">
            @csrf
            {{method_field('PATCH')}}

            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" placeholder="Имя">
            </div>
            <div class="form-group">
                <label for="name">Email</label>
                <input type="email" class="form-control" value="{{$user->email}}" id="email" name="email"
                       placeholder="Email">
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
            </div>
            <div class="form-group">
                <label for="name">Подтвердите пароль</label>
                <input type="password" class="form-control" id="password-confirm" name="password_confirmation"
                       placeholder="Подтвердите пароль">
            </div>
            <div class="form-group">
                <label for="level">Уровень</label>
                <select id="level" name="level_id" class="form-control">
                    @foreach($levels as $level)
                        <option value="{{$level->ordered}}"
                                @if($level->ordered == $user->level_id) selected @endif>{{$level->level}}</option>
                    @endforeach
                </select>
            </div>
            <div class="checkbox">
                <label>
                    <input name="status" type="checkbox" value="1"
                           @if($user->status == 1)
                           checked
                            @endif
                    > Активен
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input name="is_admin" type="checkbox" value="1"
                           @if($user->is_admin == 1)
                           checked
                            @endif
                    > Администратор
                </label>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection