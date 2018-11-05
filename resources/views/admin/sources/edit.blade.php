@extends('admin.layout')
@section('title', 'Edit source')

@section('body')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('sources.index')}}">Ссылки</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$source->url}}</li>
            <li class="breadcrumb-item active" aria-current="page">Изменить</li>
        </ol>
    </nav>
    <div class="table-responsive">
        @include('includes.messages')
        <h2>Изменить ссылку</h2>
        <form action="{{route('sources.update', $source->id)}}" method="post">
            @csrf
            {{method_field('PATCH')}}

            <div class="form-group">
                <label for="name">Ссылка</label>
                <input type="text" class="form-control" id="name" name="url" value="{{$source->url}}" placeholder="Название ссылки">
            </div>

            {{--<div class="form-group">
                <label for="level">Уровень</label>
                <select id="level" name="level_id" class="form-control">
                    <option value="">Нет</option>
                    @foreach($levels as $level)
                        <option value="{{$level->id}}"
                                @if(isset($topic->level->level) && $topic->level->level == $level->level) selected @endif>{{$level->level}}</option>
                    @endforeach
                </select>
            </div>--}}

            <div class="checkbox">
                <label>
                    <input name="status" type="checkbox" value="1" @if($source->status) checked @endif> Опубликовано
                </label>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success">Сохранить ссылку</button>
            </div>
        </form>
    </div>
@endsection