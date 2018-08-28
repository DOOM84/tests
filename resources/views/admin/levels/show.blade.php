@extends('admin.layout')
@section('title', 'Levels')

@section('body')
    <div class="container text-center">
        @include('includes.messages')
        <a class="btn btn-success" href="{{route('levels.create')}}">Добавить уровень</a>
    </div>
    <div class="table-responsive">


        <table id="myTable" class="table table-striped display">
            <thead>
            <tr>
                <th>№</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Порядок возрастания</th>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            </thead>
            <tbody>
            @forelse($levels as $level)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$level->level}}</td>
                    <td>{{$level->description}}</td>
                    <td>{{$level->ordered}}</td>
                    <td><a class="btn btn-primary" href="{{route('levels.edit', $level->id)}}">Изменить</a></td>
                    <td>
                        <form id="delete-form-{{$level->id}}" action="{{route('levels.destroy', $level->id)}}"
                              method="post" style="display:none">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                        </form>
                        <a class="btn btn-warning" href="" onclick="
                                if(confirm('Вы уверены?')){
                                event.preventDefault();
                                document.getElementById('delete-form-{{$level->id}}').submit();
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
                <th>Порядок возрастания</th>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection