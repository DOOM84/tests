@extends('user.layout')
@section('content')

<main role="main" class="container">
    <div class="{{--d-flex --}} p-3 my-3 text-white-50 bg-purple rounded shadow-sm ">
        <div class="lh-100 ">
            <h2 class="text-center mb-0 text-white lh-100">Level {{$level->level}}</h2>
        </div>
    </div>
@foreach($level->tasks as $task)
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">{{$task->body}} </h6>
        {{--<div class="media text-muted pt-3">
        </div>--}}
        @foreach($task->answers as $answer)
            <div class="custom-control custom-radio {{--text-muted--}}">
                <input type="radio" id="{{'el'.$answer->id}}" value="{{$answer->id}}" name="{{'custom'.$task->id}}" class="custom-control-input">
                <label class="custom-control-label" for="{{'el'.$answer->id}}">{{$answer->body}}</label>
            </div>
        @endforeach
    </div>
    @endforeach
    <div class="container text-right">
        <button type="button" id="sendRes" class="btn btn-success ">Send</button>
    </div>

</main>
@endsection
