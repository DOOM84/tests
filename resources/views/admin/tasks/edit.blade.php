@extends('admin.layout')
@section('title', 'Edit task')

@section('body')
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

            <div class="form-group">
                <label for="category">Категория (опционально)</label>
                <select id="category" name="category_id" class="form-control">
                    <option value="">Нет</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"
                                @if(isset($task->category->id) && $task->category->id == $category->id) selected @endif>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="level">Уровень</label>
                <select id="level" name="level_id" class="form-control">
                    <option value="">Нет</option>
                    @foreach($levels as $level)
                        <option value="{{$level->id}}"
                                @if(isset($task->level->level) && $task->level->level == $level->level) selected @endif>{{$level->level}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="topic">Тема</label>
                <select id="topic" name="topic_id" class="form-control">
                    <option value="">Нет</option>
                    @foreach($topics as $topic)
                        <option value="{{$topic->id}}"
                                @if(isset($task->topic->name) &&  $topic->id == $task->topic->id ) selected @endif>{{$topic->name}} ({{isset($topic->level->level) ? $topic->level->level : ''}})</option>
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