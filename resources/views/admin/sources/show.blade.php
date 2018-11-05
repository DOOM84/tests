@extends('admin.layout')
@section('title', 'Categories')

@section('body')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
            <li class="breadcrumb-item active" aria-current="page">Ссылки</li>
        </ol>
    </nav>
    <div class="container text-center">
        @include('includes.messages')
        <a class="btn btn-success" href="{{route('sources.create')}}">Добавить ссылку</a>
    </div>
    <div class="table-responsive">

        <table id="myTable" class="table table-striped display">
            <thead>
            <tr>
                <th>№</th>
                <th>Ссылка</th>
                <th>Опубликовано</th>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            </thead>
            <tbody>
            @forelse($sources as $source)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td><a href="{{$source->url}}" target="_blank">{{$source->url}}</a></td>
                    <td>{{$source->status ? 'Да' : 'Нет' }}</td>
                    <td><a class="btn btn-primary" href="{{route('sources.edit', $source->id)}}">Изменить</a></td>
                    <td>
                        <form id="delete-form-{{$source->id}}" action="{{route('sources.destroy', $source->id)}}"
                              method="post" style="display:none">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                        </form>
                        <a class="btn btn-warning" href="" onclick="
                                if(confirm('Вы уверены?')){
                                event.preventDefault();
                                document.getElementById('delete-form-{{$source->id}}').submit();
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
                <th>Ссылка</th>
                <th>Опубликовано</th>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection