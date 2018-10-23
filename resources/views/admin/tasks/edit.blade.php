@extends('admin.layout')
@section('title', 'Edit task')

@section('body')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('tasks.index')}}">Тесты</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$task->body}}</li>
            <li class="breadcrumb-item active" aria-current="page">Изменить</li>
        </ol>
    </nav>
    <div class="table-responsive">
        @include('includes.messages')
        <h2>Изменить тест</h2>
        <form action="{{route('tasks.update', $task->id)}}" method="post">
            @csrf
            {{method_field('PATCH')}}
            <div class="form-group">
                <label for="body">Текст задания</label>
                <textarea class="form-control" name="body" id="body" rows="3">{{$task->body}}</textarea>
            </div>
            <div class="form-group text-right">
                <a href="#" class="btn btn-info" id="addAnswer">Добавить еще поле для ответа</a>
            </div>
            <div id="answers">
                @forelse($task->answers as $answer)
                    <div class="form-group">
                        <label for="body">Ответ:</label>
                        <textarea class="form-control" data-info="answer" name="answer[{{$loop->iteration}}][body]"
                                  id="body" rows="3">{{$answer->body}}</textarea>
                        <label> Правильный ответ
                            <input name="answer[{{$loop->iteration}}][is_correct]" type="checkbox" value="1"
                                   @if($answer->is_correct) checked @endif>
                        </label>
                        <a class="btn btn-warning float-right m-1" href="{{route('admin.deleteAnswer', $answer->id)}}"
                           onclick="
                                if(confirm('Вы уверены?')){
                                return true;
                                }else{
                                event.preventDefault();
                                }">Удалить ответ
                        </a>
                    </div>
                @empty
                    Нет информации
                @endforelse
            </div>
            <div class="form-group">
                <label for="description">Описание (опционально)</label>
                <textarea class="form-control" name="description" id="description"
                          rows="3">{{$task->description}}</textarea>
            </div>

            {{--<div class="form-group">
                <label for="category">Категория (опционально)</label>
                <select id="category" name="category_id" class="form-control">
                    <option value="">Нет</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"
                                @if(isset($task->category->id) && $task->category->id == $category->id) selected @endif>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>--}}

            <div class="form-group">
                <label for="level">Уровень</label>
                <select id="level" name="level_id" class="form-control">
                    @foreach($levels as $level)
                        <option value="{{$level->id}}"
                                @if(isset($task->level->level) && $task->level->level == $level->level) selected @endif>{{$level->level}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="topic">Тема</label>
                <select id="topic" name="topics[]" class="form-control" multiple size='20'>
                    @foreach($topics->sortBy('name') as $topic)
                        <option value="{{$topic->id}}"
                                @foreach($task->topics as $task_topic)
                                @if($task_topic->id == $topic->id)
                                selected
                                @endif
                                @endforeach

                        >{{$topic->name}} {{--({{isset($topic->level->level) ? $topic->level->level : ''}})--}}</option>
                    @endforeach
                </select>
            </div>

            <div class="checkbox">
                <label>
                    <input name="status" type="checkbox" value="1" @if($task->status) checked @endif> Опубликовано
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