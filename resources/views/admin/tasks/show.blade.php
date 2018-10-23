@extends('admin.layout')
@section('title', 'Tasks')

@section('body')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
            <li class="breadcrumb-item active" aria-current="page">Тесты</li>
        </ol>
    </nav>
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
                <th>Тема</th>
                {{--<th>Категория</th>--}}
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
                    <td>
                        {{ (isset($task->level->level)) ? $task->level->level : 'Нет' }}
                    </td>
                    <td>
                        @forelse($task->topics as $task_topic)
                            {{$task_topic->name}} <br>
                            @empty
                        @endforelse

                    </td>
                    {{--<td> {{ (isset($task->category->name)) ? $task->category->name : 'Нет' }} </td>--}}
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
                <th>Тема</th>
                {{--<th>Категория</th>--}}
                <th>Опубликовано</th>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection