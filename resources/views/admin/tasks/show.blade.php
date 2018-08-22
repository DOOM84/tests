@extends('admin.layout')

@section('body')
    <div class="container text-center">
        @include('includes.messages')
        <a class="btn btn-success" href="{{route('tasks.create')}}">Добавить тест</a>
    </div>
    <div class="table-responsive">


        <table id="myTable" class="table table-striped display">
            <thead>
            <tr>
                <th>№</th>
                <th>Текст</th>
                <th>Описание</th>
                <th>Уровень</th>
                <th>Категория</th>
                <th>Опубликовано</th>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            </thead>
            <tbody>
            @forelse($tasks as $task)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$task->body}}</td>
                    <td>{{$task->description}}</td>
                    <td>{{$task->level->level}}</td>
                    <td>{{$task->category}}</td>
                    <td>{{ $task->status ? 'Да' : 'Нет' }}</td>
                    <td><a class="btn btn-primary" href="{{route('tasks.edit', $task->id)}}">Изменить</a></td>
                    <td>
                        <form id="delete-form-{{$task->id}}" action="{{route('tasks.destroy', $task->id)}}"
                              method="post" style="display:none">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                        </form>
                        <a class="btn btn-warning" href="" onclick="
                                if(confirm('Вы уверены?')){
                                event.preventDefault();
                                document.getElementById('delete-form-{{$task->id}}').submit();
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
                <th>Текст</th>
                <th>Описание</th>
                <th>Уровень</th>
                <th>Категория</th>
                <th>Опубликовано</th>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection