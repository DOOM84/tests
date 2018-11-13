@extends('admin.layout')
@section('title', 'Edit group')

@section('body')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('groups.index')}}">Группы</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$group->name}}</li>
            <li class="breadcrumb-item active" aria-current="page">Изменить</li>
        </ol>
    </nav>
    <div class="table-responsive">
        @include('includes.messages')
        <h2>Изменить группу</h2>
        <form action="{{route('groups.update', $group->id)}}" method="post">
            @csrf
            {{method_field('PATCH')}}

            <div class="form-group">
                <label for="name">Название группы</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$group->name}}" placeholder="Название группы">
            </div>

            <div class="form-group">
                <label for="institute">Учебное заведение</label>
                <select id="institute" name="institute_id" class="form-control">
                    <option value="">Нет</option>
                    @foreach($institutes as $institute)
                        <option value="{{$institute->id}}"
                                @foreach($institute->groups as $institute_group)
                                @if($institute_group->id == $group->id) selected @endif
                                @endforeach
                                >{{$institute->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="institute">Специальность</label>
                <select id="institute" name="branch_id" class="form-control">
                    <option value="">Нет</option>
                    @foreach($branches as $branch)
                        <option value="{{$branch->id}}"
                                @foreach($branch->groups as $branch_group)
                                @if($branch_group->id == $group->id) selected @endif
                                @endforeach
                        >{{$branch->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="checkbox">
                <label>
                    <input name="status" type="checkbox" value="1" @if($group->status) checked @endif> Опубликовано
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input name="can_pass" type="checkbox" value="1" @if($group->can_pass) checked @endif> Доступ для прохождения теста
                </label>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success">Сохранить группу</button>
            </div>
        </form>
    </div>
@endsection