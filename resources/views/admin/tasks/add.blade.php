@extends('admin.layout')

@section('body')
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

            <div class="form-group">
                <label for="category">Категория (опционально)</label>
                <select id="category" name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="level">Уровень</label>
                <select id="level" name="level_id" class="form-control">
                    @foreach($levels as $level)
                        <option value="{{$level->level}}">{{$level->level}}</option>
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