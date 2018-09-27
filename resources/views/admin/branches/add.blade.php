@extends('admin.layout')
@section('title', 'Add branch')

@section('body')
    <div class="table-responsive">
        @include('includes.messages')
        <h2>Добавить специальность</h2>

        <form action="{{route('branches.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Название специальности</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Название специальности">
            </div>

            <div class="checkbox">
                <label>
                    <input name="status" type="checkbox" value="1"> Опубликовано
                </label>
            </div>
            <div class="form-group text-right">
            <button type="submit" class="btn btn-success">Сохранить специальность</button>
            </div>
        </form>
    </div>
@endsection