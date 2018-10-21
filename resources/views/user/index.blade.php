@extends('user.layout')
@section('title', __('page.welcome'))
@section('content')

    <main role="main" class="container">
        <div class="{{--d-flex --}} p-3 my-3 text-white-50 bg-purple rounded shadow-sm ">
            @include('includes.messages')
            <div class="lh-100 ">
                <h2 class="text-center mb-0 text-white lh-100">@lang('page.welcome')</h2>
            </div>
        </div>

        <div class="my-3 p-3 bg-white rounded shadow-sm text-center">
            @guest
                <a href="{{route('user.tasks')}}" class="btn btn-success m-3"><strong>@lang('page.toTest')</strong></a>
            @else
                {{--<form action="{{route('user.tasks')}}" method="post">
                    @csrf
                    <label for="topic">Choose your level topic:</label>
                <select id="topic" class="custom-select" name="topic">
                    @forelse(Auth::user()->level->topics as $topic)
                        <option  value="{{$topic->id}}">{{$topic->name}} ({{$topic->level->level}})</option>
                        @empty
                    @endforelse

                </select>
                 <button type="submit" class="btn btn-success m-3"><strong>Go to the testing</strong></button>
                </form>--}}
                <form action="{{route('user.tasks')}}" method="post">
                    @csrf
                    @set($compl, 0)
                    {{--<label for="topic">Choose topic:</label>--}}
                    <select id="topic" class="custom-select" name="topic">
                        <option value="">@lang('page.choose')</option>
                        <option value="general">@lang('page.testName')</option>
                        @forelse($topics->sortBy('name') as $topic)
                            @foreach(Auth::user()->results as $result)
                                @if($result->topic_id == $topic->id && $result->level_id == Auth::user()->level_id
                                && isset($result->is_completed)) @set($compl, 1) @break  @endif
                            @endforeach

                            <option class="@if($compl == 1) text-green @else text-red @endif" value="{{$topic->id}}">
                                {{$topic->name}} {{--({{$topic->level->level}})--}} @if($compl == 1) (Completed) @else @endif
                            </option>
                            @set($compl, 0)
                        @empty
                        @endforelse

                    </select>
                    <button type="submit" class="btn btn-success m-3"><strong>@lang('page.toTest')</strong></button>
                </form>
            @endguest

        </div>


    </main>
@endsection
