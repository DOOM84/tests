@extends('admin.layout')
@section('title', 'Main page')

@section('body')
    <p>Всего тестов: <strong>{{\App\Models\Task::all()->count()}}</strong></p>
    <p>Всего тем: <strong>{{\App\Models\Topic::all()->count()}}</strong> (Доступных для прохождения:
        <strong>{{\App\Models\Topic::where('status', 1)->count() + 1}}</strong>) </p>
    <p>Всего ссылок на сторонние ресурсы: <strong>{{\App\Models\Source::all()->count()}}</strong></p>
    <p>Зарегистрированных пользователей: <strong>{{\App\User::all()->count()}}</strong></p>
@endsection