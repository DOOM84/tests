@extends('admin.layout')

@section('body')
    <div class="table-responsive">
        @include('includes.messages')
        <h2>Добавить уровень</h2>
        <form action="{{route('levels.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="level">Название уровня</label>
                <input type="text" class="form-control" id="level" name="level" placeholder="Название уровня">
            </div>
            <div class="form-group">
                <label for="description">Описание (опционально)</label>
                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="ordered">Порядок возрастания</label>
                <select id="ordered" name="ordered" class="form-control">
                    @set($allCat, \App\Models\Level::all()->count() + 1);
                    @for ($i = 1; $i <= $allCat; $i++)
                        <option value="{{$i}}" @if($i == $allCat) selected @endif>
                            @if($i == $allCat) Последний @else {{$i}} @endif
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