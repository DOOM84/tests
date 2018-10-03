@extends('user.layout')
@section('title', 'Level: '.Auth::user()->level->level)
@section('content')

    <main id="mainWin" role="main" class="container">
        <div class="{{--d-flex --}} p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
            @include('includes.messages')
            <div class="lh-100 ">
                <h2 class="text-center mb-0 text-white lh-100">Level {{Auth::user()->level->level}}.
                    {{isset($topic->name) ? 'Topic: ' .$topic->name : ''}}</h2>
            </div>
            <p class="text-right fixed-bottom" id="demo"></p>
        </div>
        @if(isset($tasks))
            @foreach($tasks->shuffle() as $task)
                <div class="my-3 p-3 bg-white rounded shadow-sm">
                    <h6 class="border-bottom border-gray pb-2 mb-0">{{$task->body}} </h6>
                    @foreach($task->answers->shuffle() as $answer)
                        <div class="custom-control custom-radio">
                            <input type="radio" id="{{'el'.$answer->id}}" value="{{$answer->id}}" name="{{'custom'.$task->id}}" class="custom-control-input">
                            <label class="custom-control-label" for="{{'el'.$answer->id}}">{{$answer->body}}</label>
                        </div>
                    @endforeach
                </div>
            @endforeach
            @else

            @foreach($topic->tasks->shuffle() as $task)
                <div class="my-3 p-3 bg-white rounded shadow-sm">
                    <h6 class="border-bottom border-gray pb-2 mb-0">{{$task->body}} </h6>
                    {{--<div class="media text-muted pt-3">
                    </div>--}}
                    @foreach($task->answers->shuffle() as $answer)
                        <div class="custom-control custom-radio">
                            <input type="radio" id="{{'el'.$answer->id}}" value="{{$answer->id}}" name="{{'custom'.$task->id}}" class="custom-control-input">
                            <label class="custom-control-label" for="{{'el'.$answer->id}}">{{$answer->body}}</label>
                        </div>
                    @endforeach

                    {{--@foreach($task->answers->shuffle() as $answer)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" id="{{'el'.$answer->id}}" value="{{$answer->id}}"
                                   name="{{'custom'.$task->id}}" class="custom-control-input">
                            <label class="custom-control-label" for="{{'el'.$answer->id}}">{{$answer->body}}</label>
                        </div>
                        @if($answer->is_correct)
                            @set($rightAns, $rightAns + 1)
                        @endif
                    @endforeach--}}

                </div>
            @endforeach

            @endif
        <div class="container text-right">
            <button type="button" id="sendRes" class="btn btn-success ">Send</button>
        </div>

    </main>
@endsection

@section('scriptSection')
    <script>
        //var cnt;
        $(document).ready(function () {
            $("#sendRes").click(function () {
                if (!confirm("Are you sure?")) return false;
                finishTest()
            });
        });

        var start = Math.round((new Date()).getTime() / 1000);

        function finishTest() {
            var cnt = $("input[type=radio]:checked");
            var answ = [];
            for (var i = 0; i < cnt.length; i++) {
                answ[i] = cnt[i].value;
            }
            var end = Math.round((new Date()).getTime() / 1000);
            var duration = end - start;

            $.ajax({
                type: "POST",
                url: '{{route('getResult')}}',
                data: {
                    "_token": '{{ csrf_token() }}',
                    "answers": answ,
                    "amount": '{{isset($topic->name) ? $topic->tasks->count() : $tasks->count()}} ',
                    "topic_id": '{{isset($topic->name) ? $topic->id : Null }}',
                    "level_id": '{{Auth::user()->level->id}}',
                    "duration": duration,
                    "start": start
                },
                success: function (data) {
                    data = jQuery.parseJSON(data);

                    var contin;
                    clearInterval(x);

                    contin = "<a href=\"{{route('user.index')}}\" class=\"btn btn-success\"><strong>Continue</strong></a>\n";


                    $("#mainWin").html("<div class=\" p-3 my-3 text-white-50 bg-purple rounded shadow-sm \">\n" +
                        "<div class=\"lh-100 \">\n" +
                        "<h2 class=\"text-center mb-0 text-white lh-100\">Your result: " + data.status + "</h2>\n" +
                        "</div>\n" +
                        "</div>" +
                        "<div class=\"my-3 p-3 bg-white rounded shadow-sm text-center\">\n" +
                        contin +
                        "</div>");

                    if (data.status < 90 && Object.keys(data.repeat).length > 0) {
                        $("#mainWin").append("<ul class=\"list-group\" id=\"repeatTopics\">" +
                            "<li class=\"list-group-item active\">Вам необходимо повторить следующие темы:</li>" +
                            "</ul>");
                        $.each( data.repeat, function( i, val ) {
                            $("#repeatTopics").append("<li class=\"list-group-item\">" + val + "</li>");
                        });
                    }

                    $('html, body').animate({
                        scrollTop: $("#mainWin").offset().top
                    }, 500);
                }
            });
        }

        // Set the date we're counting down to
        var countDownDate = new Date().getTime() + '{{isset($topic->name) ? $topic->tasks->count() : $tasks->count()}}' * 1000 * 60;

        // Update the count down every 1 second
        var x = setInterval(function () {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = '<h2 style="color:red">' + minutes + "m " + seconds + "s " + '</h2>';

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
                finishTest()
            }
        }, 0);
    </script>

@endsection
