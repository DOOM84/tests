@extends('admin.layout')
@section('title', 'Institutes')

@section('body')
    <div class="container text-center">
        @include('includes.messages')
        <a class="btn btn-success" href="{{route('institutes.create')}}">Добавить учебное заведение</a>
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
            @forelse($institutes as $institute)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$institute->name}}</td>
                    <td>{{ $institute->status ? 'Да' : 'Нет' }}</td>
                    <td><a class="btn btn-primary" href="{{route('institutes.edit', $institute->id)}}">Изменить</a></td>
                    <td>
                        <form id="delete-form-{{$institute->id}}" action="{{route('institutes.destroy', $institute->id)}}"
                              method="post" style="display:none">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                        </form>
                        <a class="btn btn-warning" href="" onclick="
                                if(confirm('Вы уверены?')){
                                event.preventDefault();
                                document.getElementById('delete-form-{{$institute->id}}').submit();
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