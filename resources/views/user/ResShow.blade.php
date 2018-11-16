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
                        <th scope="col">#</th>
                        <th scope="col">@lang('page.quest')</th>
                        <th scope="col">@lang('page.langLevel')</th>
                        <th scope="col">@lang('page.variants')</th>
                        <th scope="col">@lang('page.answer')</th>
                        <th scope="col">@lang('page.topic')</th>
                        <th scope="col" width="12%">@lang('page.link')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($answers as $answer)
                        <tr class="{{isset($answer->is_correct) ? 'bg-correct' : 'bg-failed'}}">
                            <td>{{$loop->iteration}}</td>
                            <td scope="col">
                                {{$answer->task->body}}
                            </td>
                            <td scope="col">
                                {{$result->level->level}}
                            </td>
                            <td>
                                @forelse($answer->task->answers as $allAnswers)
                                    <ul class="list-unstyled">
                                        <li>
                                            {{$allAnswers->body}}
                                            @if(isset($allAnswers->is_correct)) <span
                                                    data-feather="check"></span> @endif
                                        </li>
                                    </ul>
                                @empty
                                    Нет информации
                                @endforelse
                            </td>
                            <td scope="col">
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
                                @endforelse
                            </td>
                            <td scope="col">
                                @forelse($answer->task->sources as $link)
                                    <ul class="list-unstyled">
                                        <li>
                                            <a class="btn btn-info" href="{{$link->url}}"
                                               target="_blank">@lang('page.link') {{$loop->iteration}}</a>
                                        </li>
                                    </ul>
                                @empty

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
