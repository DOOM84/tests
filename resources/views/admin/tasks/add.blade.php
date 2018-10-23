@extends('admin.layout')
@section('title', 'Add task')

@section('body')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('tasks.index')}}">Тесты</a></li>
            <li class="breadcrumb-item active" aria-current="page">Добавить</li>
        </ol>
    </nav>
    <div class="table-responsive">
        @include('includes.messages')
        <h2>Добавить тест</h2>
        <form action="{{route('tasks.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="body">Текст задания</label>
                <textarea class="form-control" name="body" id="body" rows="3"></textarea>
            </div>
            <div class="form-group text-right">
                <a href="#" class="btn btn-info" id="addAnswer">Добавить еще поле для ответа</a>
            </div>
            <div id="answers">
                @for( $i = 1; $i <= 3; $i++)
                    <div class="form-group">
                        <label for="body">Ответ:</label>
                        <textarea class="form-control" data-info="answer" name="answer[{{$i}}][body]" id="body" rows="3"></textarea>
                        <label> Правильный ответ
                            <input name="answer[{{$i}}][is_correct]" type="checkbox" value="1">
                        </label>
                    </div>
                    @endfor
            </div>
            <div class="form-group">
                <label for="description">Описание (опционально)</label>
                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
            </div>

            {{--<div class="form-group">
                <label for="category">Категория (опционально)</label>
                <select id="category" name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>--}}

            <div class="form-group">
                <label for="level">Уровень</label>
                <select id="level" name="level_id" class="form-control">
                    @foreach($levels as $level)
                        <option value="{{$level->id}}">{{$level->level}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="topic">Тема</label>
                <select id="topic" name="topics[]" class="form-control" multiple size='20'>
                    @foreach($topics->sortBy('name') as $topic)
                        <option value="{{$topic->id}}">{{$topic->name}} {{--({{isset($topic->level->level) ? $topic->level->level : ''}})--}}</option>
                    @endforeach
                </select>
            </div>

            <div class="checkbox">
                <label>
                    <input name="status" type="checkbox" value="1"> Опубликовано
                </label>
            </div>
            <div class="form-group text-right">
            <button type="submit" class="btn btn-success">Сохранить тест</button>
            </div>
        </form>
    </div>
@endsection

@section('scriptSection')
    <script>
        $("#addAnswer").click(function () {
            var cnt = $('textarea[data-info="answer"]').length + 1;
            var oldDiv = $("#answers");
            var newdiv = $('<div class="form-group"></div>');
            var label = $('<label for="body">Ответ:</label>');
            var textAr = $('<textarea class="form-control" data-info="answer" id="body" rows="3"></textarea>');
            $(textAr).attr('name', 'answer[' + cnt + '][body]');
            var label2 = $('<label>Правильный ответ </label>');
            var correct = $('<input type="checkbox" value="1"> ');
            $(correct).attr('name', 'answer[' + cnt + '][is_correct]');
            label2.append(correct);
            newdiv.append(label, textAr, label2);
            oldDiv.append(newdiv);
            //console.log(cnt);
            //alert( "Handler for .click() called." );
        });
    </script>
@endsection