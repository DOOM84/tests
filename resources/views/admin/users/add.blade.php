@extends('admin.layout')
@section('title', 'Add user')

@section('body')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('users.index')}}">Пользователи</a></li>
            <li class="breadcrumb-item active" aria-current="page">Добавить</li>
        </ol>
    </nav>
    <div class="table-responsive">
        @include('includes.messages')
        <h2>Добавить пользователя</h2>
        <form role="form" method="POST" action="{{route('users.store')}}">
            @csrf
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Имя">
            </div>
            <div class="form-group">
                <label for="name">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="level">Уровень</label>
                <select id="level" name="level_id" class="form-control">
                    @foreach($levels as $level)
                        <option value="{{$level->ordered}}">{{$level->level}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="group">Группа</label>
                <select id="group" name="group_id" class="form-control">
                    <option value="">Нет</option>
                    @foreach($groups as $group)
                        <option value="{{$group->id}}">{{$group->name}} ({{$group->institute->name}})</option>
                    @endforeach
                </select>
            </div>

            {{--<div class="form-group">
                <label for="institute">Учебное заведение</label>
                <select id="institute" name="institute_id" class="form-control">
                    <option value="">Нет</option>
                    @foreach($institutes as $institute)
                        <option value="{{$institute->id}}">{{$institute->name}}</option>
                    @endforeach
                </select>
            </div>--}}

            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
            </div>
            <div class="form-group">
                <label for="name">Подтвердите пароль</label>
                <input type="password" class="form-control" id="password-confirm" name="password_confirmation"
                       placeholder="Подтвердите пароль">
            </div>
            <div class="checkbox">
                <label>
                    <input name="status" type="checkbox" value="1"> Активен
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input name="is_admin" type="checkbox" value="1"> Администратор
                </label>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection