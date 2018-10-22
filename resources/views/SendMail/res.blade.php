@component('mail::message')
# @lang('page.hello')!
# @lang('page.testRes'): {{$res->topic ? $res->topic->name : __('page.testName')}}. @lang('page.level') {{$res->level->level}}.

@component('mail::table')
    | @lang('page.test')                                       | @lang('page.duration') |  @lang('page.correct')      | @lang('page.incorrect')      | @lang('page.rate')/@lang('page.score') |
    | ---------------------------------------------------------|:----------------------:|:---------------------------:|:----------------------------:|---------------------------------------:|
    | {{$res->topic ? $res->topic->name : __('page.testName')}}| {{$res->duration}}     | {{$res->detail->correct}}   | {{$res->detail->incorrect}}  | {{$res->value}}/{{$res->result}}       |

@endcomponent

@if($res->detail->incorrect > 0)
@component('mail::button', ['url' => route('user.stats.show', $res->id)])
    @lang('page.detail')
@endcomponent
@endif

@lang('page.respect'),<br>
{{ config('app.name') }}
@endcomponent