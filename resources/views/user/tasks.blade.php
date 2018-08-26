@extends('user.layout')
@section('content')

<main id="mainWin" role="main" class="container">
    <div class="{{--d-flex --}} p-3 my-3 text-white-50 bg-purple rounded shadow-sm ">
        @include('includes.messages')
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

@section('scriptSection')
    <script>
        //var cnt;
        $(document).ready(function () {
            $( "#sendRes" ).click(function() {
                confirm( "Are you sure?" );
                var cnt = $("input[type=radio]:checked");
                var answ = [];
                for (var i = 0; i < cnt.length; i++) {
                    answ[i] = cnt[i].value;
                }
                //console.log(answ);

                $.ajax({
                    type: "POST",
                    url: '{{route('getResult')}}',
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "answers": answ,
                        "amount": '{{$level->tasks->count()}}'
                    },
                    success: function (data) {
                            data = jQuery.parseJSON(data);

                            var contin;

                            if(data.completed){
                                contin = "<a href=\"{{route('user.index')}}\" class=\"btn btn-success\"><strong>Finish</strong></a>\n";
                            }else{
                                contin = "<a href=\"{{route('user.tasks')}}\" class=\"btn btn-success\"><strong>Continue</strong></a>\n";
                            }


                        $("#mainWin").html("<div class=\" p-3 my-3 text-white-50 bg-purple rounded shadow-sm \">\n" +
                            "<div class=\"lh-100 \">\n" +
                            "<h2 class=\"text-center mb-0 text-white lh-100\">Your result: " + data.status  + "</h2>\n" +
                            "</div>\n" +
                            "</div>" +
                            "<div class=\"my-3 p-3 bg-white rounded shadow-sm text-center\">\n" +
                            contin +
                            "</div>");
                        $(document).ready(function () {
                            $('html, body').animate({
                                scrollTop: $("#mainWin").offset().top
                            }, 500)
                        });
                    }
                });
            });
        });
    </script>
@endsection
