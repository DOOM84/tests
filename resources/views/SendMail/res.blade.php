@component('mail::message')
# Здравствуйте!
# Результат теста: {{$res->topic ? $res->topic->name : 'Общий тест'}}. Уровень: {{$res->level->level}}.

@component('mail::table')
    | Тест                                              | Время работы         |  Кол-во правильных ответов  | Кол-во неправильных ответов  | Оценка/Балл                      |
    | ------------------------------------------------- |:--------------------:|:---------------------------:|:----------------------------:|---------------------------------:|
    | {{$res->topic ? $res->topic->name : 'Общий тест'}}| {{$res->duration}}   | {{$res->detail->correct}}   | {{$res->detail->incorrect}}  | {{$res->value}}/{{$res->result}} |

@endcomponent

@if($res->detail->incorrect > 0)
@component('mail::button', ['url' => route('user.stats.show', $res->id)])
    Детальнее
@endcomponent
@endif

С уважением,<br>
{{ config('app.name') }}
@endcomponent