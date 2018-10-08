@extends('admin.layout')
@section('title', 'Categories')

@section('body')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
            <li class="breadcrumb-item active" aria-current="page">Темы</li>
        </ol>
    </nav>
    <div class="container text-center">
        @include('includes.messages')
        <a class="btn btn-success" href="{{route('topics.create')}}">Добавить тему</a>
    </div>
    <div class="table-responsive">


        <table id="myTable" class="table table-striped display">
            <thead>
            <tr>
                <th>№</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Уровень</th>
                <th>Опубликовано</th>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            </thead>
            <tbody>
            @forelse($topics as $topic)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$topic->name}}</td>
                    <td>{{$topic->description}}</td>
                    <td>{{ isset($topic->level->level) ? $topic->level->level : '' }}</td>
                    <td>{{ $topic->status ? 'Да' : 'Нет' }}</td>
                    <td><a class="btn btn-primary" href="{{route('topics.edit', $topic->id)}}">Изменить</a></td>
                    <td>
                        <form id="delete-form-{{$topic->id}}" action="{{route('topics.destroy', $topic->id)}}"
                              method="post" style="display:none">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                        </form>
                        <a class="btn btn-warning" href="" onclick="
                                if(confirm('Вы уверены?')){
                                event.preventDefault();
                                document.getElementById('delete-form-{{$topic->id}}').submit();
                                }else{
                                event.preventDefault();
                                }">Удалить
                        </a>

                    </td>
                </tr>
                @empty
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <th>№</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Уровень</th>
                <th>Опубликовано</th>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection