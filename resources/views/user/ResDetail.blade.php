@extends('user.layout')
@section('title', isset($result->topic->name) ? $result->topic->name : __('page.testName'))
@section('content')

    <main role="main" class="container">
        <div class="{{--d-flex --}} p-3 my-3 text-white-50 bg-purple rounded shadow-sm ">
            @include('includes.messages')
            <div class="lh-100 ">
                <h2 class="text-center mb-0 text-white lh-100">
                    @lang('page.test'): {{isset($result->topic->name) ? $result->topic->name : __('page.testName')}}.
                    @lang('page.level') {{$result->level->level}}
                </h2>
            </div>
        </div>

        <div class="my-3 p-3 bg-white rounded shadow-sm text-center">
            @guest
                @lang('page.cantSee')
            @else

                <table class="table">
                    <thead class="thead-light">
                    <tr>
                        <th scope="col">@lang('page.test')</th>
                        <th scope="col">@lang('page.duration')</th>
                        <th scope="col">@lang('page.correct')</th>
                        <th scope="col">@lang('page.incorrect')</th>
                        <th scope="col">@lang('page.rate')/@lang('page.score')</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td scope="col">
                            {{isset($result->topic->name) ? $result->topic->name : __('page.testName')}}
                        </td>
                        <td scope="col">
                            {{$result->duration}}
                        </td>
                        <td scope="col">{{$result->detail->correct}}</td>
                        <td scope="col">{{$result->detail->incorrect}}
                            @if($result->detail->incorrect > 0)
                                <a href="{{route('user.stats.show', $result->id)}}">@lang('page.show')</a>
                            @endif
                        </td>
                        <td scope="col">{{$result->value}}/{{$result->result}}</td>
                    </tr>
                    </tbody>
                </table>
            @endguest
        </div>


    </main>
@endsection
