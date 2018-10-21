@component('mail::message')
# @lang('page.hello'), {{Auth::user()->name}}!

{!! $table !!}

@lang('page.respect'),<br>
{{ config('app.name') }}
@endcomponent