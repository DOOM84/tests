@extends('admin.layout')
@section('title', 'Users')

@section('body')
    <div class="{{--d-flex --}} p-3 my-3 bg-purple rounded shadow-sm ">
        @include('includes.messages')

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.stats')}}">Статистика</a></li>
                <li class="breadcrumb-item">
                    <a href="{{route('admin.stats.group', $result->user->group->id)}}">
                        Группа {{$result->user->group->name}}
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('admin.stats.student', $result->user->id)}}">
                        {{$result->user->name}}</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{route('admin.stats.student.detail', $result->id)}}">
                        {{isset($result->topic->name) ? $result->topic->name : 'Общий тест'}} (Уровень: {{$result->level->level}})
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Детализация теста
                </li>
            </ol>
        </nav>

    </div>
    <div class="my-3 p-3 bg-white rounded shadow-sm text-center">
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Вопрос</th>
                    <th scope="col">Языковой уровень</th>
                    <th scope="col">Варианты ответа</th>
                    <th scope="col">Ответ студента</th>
                    <th scope="col">Тема</th>
                </tr>
                </thead>
                <tbody>
                @foreach($result->detail->answers as $id)
                    @set($answer, \App\Models\Answer::findOrFail($id))
                    <tr class="{{isset($answer->is_correct) ? 'bg-correct' : 'bg-failed'}}">
                        <td scope="col">
                            {{$answer->task->body}}
                        </td>
                        <td scope="col">
                            {{$answer->task->level->level}}
                        </td>
                        <td>
                            @forelse($answer->task->answers as $allAnswers)
                                <ul class="list-unstyled">
                                    <li>
                                        {{$allAnswers->body}}
                                        @if(isset($allAnswers->is_correct)) <span data-feather="check"></span> @endif
                                    </li>
                                </ul>
                            @empty
                                Нет информации
                            @endforelse
                        </td>
                        <td scope="col">
                                {{--<i data-feather="x"></i>--}}
                                <span class="font-italic">{{$answer->body}}</span>

                        </td>
                        <td scope="col">
                            @forelse($answer->task->topics as $topic)
                                <ul class="list-unstyled">
                                    <li>
                                        {{$topic->name}}
                                    </li>
                                </ul>
                            @empty
                                Нет информации
                            @endforelse
                        </td>


                    </tr>
                @endforeach
                </tbody>
            </table>
    </div>
@endsection