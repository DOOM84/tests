@extends('admin.layout')
@section('title', 'Edit institute')

@section('body')
    <div class="table-responsive">
        @include('includes.messages')
        <h2>Изменить учебное заведение</h2>
        <form action="{{route('institutes.update', $institute->id)}}" method="post">
            @csrf
            {{method_field('PATCH')}}

            <div class="form-group">
                <label for="name">Название группы</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$institute->name}}" placeholder="Название учебного заведения">
            </div>

            <div class="checkbox">
                <label>
                    <input name="status" type="checkbox" value="1" @if($institute->status) checked @endif> Опубликовано
                </label>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success">Сохранить учебное заведение</button>
            </div>
        </form>
    </div>
@endsection