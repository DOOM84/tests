@extends('admin.layout')
@section('title', 'Add topic')

@section('body')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('topics.index')}}">Темы</a></li>
            <li class="breadcrumb-item active" aria-current="page">Добавить</li>
        </ol>
    </nav>
    <div class="table-responsive">
        @include('includes.messages')
        <h2>Добавить тему</h2>
        <form action="{{route('topics.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Название темы</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Название темы">
            </div>
            <div class="form-group">
                <label for="description">Описание (опционально)</label>
                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="level">Уровень</label>
                <select id="level" name="level_id" class="form-control">
                    @foreach($levels as $level)
                        <option value="{{$level->id}}">{{$level->level}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-4">
                <label>Уровни</label>
            @foreach($levels as $level)
            <div class="checkbox">
                <label>
                        <input id="levels" name="levels[]" type="checkbox" value="{{$level->id}}"> {{$level->level}}
                </label>
            </div>
            @endforeach
            </div>

            <div class="checkbox">
                <label>
                    <input name="status" type="checkbox" value="1"> Опубликовано
                </label>
            </div>
            <div class="form-group text-right">
            <button type="submit" class="btn btn-success">Сохранить тему</button>
            </div>
        </form>
    </div>
@endsection