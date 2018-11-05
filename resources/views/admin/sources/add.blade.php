@extends('admin.layout')
@section('title', 'Add source')

@section('body')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('sources.index')}}">Ссылки</a></li>
            <li class="breadcrumb-item active" aria-current="page">Добавить</li>
        </ol>
    </nav>
    <div class="table-responsive">
        @include('includes.messages')
        <h2>Добавить ссылку</h2>
        <form action="{{route('sources.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Ссылка</label>
                <input type="text" class="form-control" id="name" name="url" placeholder="Название ссылки">
            </div>

            <div class="checkbox">
                <label>
                    <input name="status" type="checkbox" value="1"> Опубликовано
                </label>
            </div>
            <div class="form-group text-right">
            <button type="submit" class="btn btn-success">Сохранить ссылку</button>
            </div>
        </form>
    </div>
@endsection