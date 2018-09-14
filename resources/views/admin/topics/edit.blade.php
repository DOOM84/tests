@extends('admin.layout')
@section('title', 'Edit topic')

@section('body')
    <div class="table-responsive">
        @include('includes.messages')
        <h2>Изменить тему</h2>
        <form action="{{route('topics.update', $topic->id)}}" method="post">
            @csrf
            {{method_field('PATCH')}}

            <div class="form-group">
                <label for="name">Название темы</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$topic->name}}" placeholder="Название темы">
            </div>

            <div class="form-group">
                <label for="description">Описание (опционально)</label>
                <textarea class="form-control" name="description" id="description" rows="3">{{$topic->description}}</textarea>
            </div>

            <div class="form-group">
                <label for="level">Уровень</label>
                <select id="level" name="level_id" class="form-control">
                    <option value="">Нет</option>
                    @foreach($levels as $level)
                        <option value="{{$level->id}}"
                                @if(isset($topic->level->level) && $topic->level->level == $level->level) selected @endif>{{$level->level}}</option>
                    @endforeach
                </select>
            </div>

            <div class="checkbox">
                <label>
                    <input name="status" type="checkbox" value="1" @if($topic->status) checked @endif> Опубликовано
                </label>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success">Сохранить тему</button>
            </div>
        </form>
    </div>
@endsection