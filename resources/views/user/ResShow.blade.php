@extends('user.layout')
@section('title', isset($result->topic->name) ? $result->topic->name : __('page.testName'))
@section('content')

    <main role="main" class="container">
        <div class="{{--d-flex --}} p-3 my-3 text-white-50 bg-purple rounded shadow-sm ">
            @include('includes.messages')
            <div class="lh-100 ">
                <h2 class="text-center mb-0 text-white lh-100">
                    @lang('page.test'): {{isset($result->topic->name) ? $result->topic->name : __('page.testName')}}
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
                        <th scope="col">@lang('page.quest')</th>
                        <th scope="col">@lang('page.langLevel')</th>
                        <th scope="col">@lang('page.answer')</th>
                        <th scope="col">@lang('page.topic')</th>
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
                            <td scope="col">
                                @if(isset($answer->is_correct)) <i data-feather="check"></i>
                                @else
                                    {{--<i data-feather="x"></i>--}}
                                    <span class="font-italic">{{$answer->body}}</span>
                                @endif
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
            @endguest
        </div>
    </main>
@endsection
