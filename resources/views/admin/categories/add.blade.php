@extends('admin.layout')

@section('body')
    <div class="table-responsive">
        @include('includes.messages')
        <h2>Добавить категорию</h2>
        <form action="{{route('categories.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Название категории</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Название категории">
            </div>
            <div class="form-group">
                <label for="description">Описание (опционально)</label>
                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
            </div>
            <div class="checkbox">
                <label>
                    <input name="status" type="checkbox" value="1"> Опубликовано
                </label>
            </div>
            <div class="form-group text-right">
            <button type="submit" class="btn btn-success">Сохранить категорию</button>
            </div>
        </form>
    </div>
@endsection