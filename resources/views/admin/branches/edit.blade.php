@extends('admin.layout')
@section('title', 'Edit branch')

@section('body')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('branches.index')}}">Специальности</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$branch->name}}</li>
            <li class="breadcrumb-item active" aria-current="page">Изменить</li>
        </ol>
    </nav>
    <div class="table-responsive">
        @include('includes.messages')
        <h2>Изменить специальность</h2>
        <form action="{{route('branches.update', $branch->id)}}" method="post">
            @csrf
            {{method_field('PATCH')}}

            <div class="form-group">
                <label for="name">Название специальности</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$branch->name}}" placeholder="Название специальности">
            </div>

            <div class="checkbox">
                <label>
                    <input name="status" type="checkbox" value="1" @if($branch->status) checked @endif> Опубликовано
                </label>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success">Сохранить специальность</button>
            </div>
        </form>
    </div>
@endsection