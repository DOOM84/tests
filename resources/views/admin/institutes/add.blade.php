@extends('admin.layout')
@section('title', 'Add institute')

@section('body')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('institutes.index')}}">Учебные заведения</a></li>
            <li class="breadcrumb-item active" aria-current="page">Добавить</li>
        </ol>
    </nav>
    <div class="table-responsive">
        @include('includes.messages')
        <h2>Добавить учебное заведение</h2>
        <form action="{{route('institutes.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Название учебного заведения</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Название учебного заведения">
            </div>
            <div class="checkbox">
                <label>
                    <input name="status" type="checkbox" value="1"> Опубликовано
                </label>
            </div>
            <div class="form-group text-right">
            <button type="submit" class="btn btn-success">Сохранить учебное заведение</button>
            </div>
        </form>
    </div>
@endsection