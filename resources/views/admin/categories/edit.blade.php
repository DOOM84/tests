@extends('admin.layout')

@section('body')
    <div class="table-responsive">
        @include('includes.messages')
        <h2>Изменить категорию</h2>
        <form action="{{route('categories.update', $category->id)}}" method="post">
            @csrf
            {{method_field('PATCH')}}

            <div class="form-group">
                <label for="name">Название категории</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}" placeholder="Название категории">
            </div>

            <div class="form-group">
                <label for="description">Описание (опционально)</label>
                <textarea class="form-control" name="description" id="description" rows="3">{{$category->description}}</textarea>
            </div>

            <div class="checkbox">
                <label>
                    <input name="status" type="checkbox" value="1" @if($category->status) checked @endif> Опубликовано
                </label>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success">Сохранить категорию</button>
            </div>
        </form>
    </div>
@endsection