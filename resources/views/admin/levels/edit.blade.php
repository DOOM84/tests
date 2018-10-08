@extends('admin.layout')
@section('title', 'Edit level')

@section('body')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('levels.index')}}">Уровни</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$level->level}}</li>
            <li class="breadcrumb-item active" aria-current="page">Изменить</li>
        </ol>
    </nav>
    <div class="table-responsive">
        @include('includes.messages')
        <h2>Изменить уровень</h2>
        <form action="{{route('levels.update', $level->id)}}" method="post">
            @csrf
            {{method_field('PATCH')}}

            <div class="form-group">
                <label for="name">Название уровня</label>
                <input type="text" class="form-control" id="name" name="level" value="{{$level->level}}"
                       placeholder="Название уровня">
            </div>

            <div class="form-group">
                <label for="description">Описание (опционально)</label>
                <textarea class="form-control" name="description" id="description"
                          rows="3">{{$level->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="ordered">Порядок возрастания</label>
                <select id="ordered" name="ordered" class="form-control">
                    @for ($i = 1; $i <= \App\Models\Level::all()->max('ordered'); $i++)
                        <option value="{{$i}}" @if($i == $level->ordered) selected @endif>
                            {{$i}}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success">Сохранить уровень</button>
            </div>
        </form>
    </div>
@endsection