@extends('admin.layout')
@section('title', 'Branches')

@section('body')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
            <li class="breadcrumb-item active" aria-current="page">Специальности</li>
        </ol>
    </nav>
    <div class="container text-center">
        @include('includes.messages')
        <a class="btn btn-success" href="{{route('branches.create')}}">Добавить специальность</a>
    </div>
    <div class="table-responsive">


        <table id="myTable" class="table table-striped display">
            <thead>
            <tr>
                <th>№</th>
                <th>Название</th>
                <th>Опубликовано</th>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            </thead>
            <tbody>
            @forelse($branches as $branch)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$branch->name}}</td>
                    <td>{{ $branch->status ? 'Да' : 'Нет' }}</td>
                    <td><a class="btn btn-primary" href="{{route('branches.edit', $branch->id)}}">Изменить</a></td>
                    <td>
                        <form id="delete-form-{{$branch->id}}" action="{{route('branches.destroy', $branch->id)}}"
                              method="post" style="display:none">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                        </form>
                        <a class="btn btn-warning" href="" onclick="
                                if(confirm('Вы уверены?')){
                                event.preventDefault();
                                document.getElementById('delete-form-{{$branch->id}}').submit();
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
                <th>Опубликовано</th>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection