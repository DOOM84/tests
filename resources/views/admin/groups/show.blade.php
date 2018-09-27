@extends('admin.layout')
@section('title', 'Groups')

@section('body')
    <div class="container text-center">
        @include('includes.messages')
        <a class="btn btn-success" href="{{route('groups.create')}}">Добавить группу</a>
    </div>
    <div class="table-responsive">


        <table id="myTable" class="table table-striped display">
            <thead>
            <tr>
                <th>№</th>
                <th>Название</th>
                <th>Учебное заведение</th>
                <th>Специальность</th>
                <th>Опубликовано</th>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            </thead>
            <tbody>
            @forelse($groups as $group)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$group->name}}</td>
                    <td>{{isset($group->institute->name) ? $group->institute->name : 'Нет'}}</td>
                    <td>{{isset($group->branch->name) ? $group->branch->name : 'Нет'}}</td>
                    <td>{{ $group->status ? 'Да' : 'Нет' }}</td>
                    <td><a class="btn btn-primary" href="{{route('groups.edit', $group->id)}}">Изменить</a></td>
                    <td>
                        <form id="delete-form-{{$group->id}}" action="{{route('groups.destroy', $group->id)}}"
                              method="post" style="display:none">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                        </form>
                        <a class="btn btn-warning" href="" onclick="
                                if(confirm('Вы уверены?')){
                                event.preventDefault();
                                document.getElementById('delete-form-{{$group->id}}').submit();
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
                <th>Учебное заведение</th>
                <th>Специальность</th>
                <th>Опубликовано</th>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection