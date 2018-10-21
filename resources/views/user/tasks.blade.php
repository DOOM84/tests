@extends('user.layout')
@section('title', __('page.level').Auth::user()->level->level)
@section('content')
    <main id="mainWin" role="main" class="container">
        <div class="{{--d-flex --}} p-3 my-3 text-white-50 bg-purple rounded shadow-sm">
            @include('includes.messages')
            <div class="lh-100 ">
                <h2 class="text-center mb-0 text-white lh-100">@lang('page.level') {{Auth::user()->level->level}}.
                    @lang('page.topic'): {{isset($topic->name) ? $topic->name : __('page.testName')}}</h2>
            </div>
            <p class="text-right fixed-bottom" id="demo"></p>
        </div>
        @if(isset($tasks))
            @foreach($tasks->shuffle() as $task)
                <div class="my-3 p-3 bg-white rounded shadow-sm">
                    <h6 class="border-bottom border-gray pb-2 mb-0">{{$task->body}} </h6>
                    @foreach($task->answers->shuffle() as $answer)
                        <div class="custom-control custom-radio">
                            <input type="radio" id="{{'el'.$answer->id}}" value="{{$answer->id}}"
                                   name="{{'custom'.$task->id}}" class="custom-control-input">
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
                            <input type="radio" id="{{'el'.$answer->id}}" value="{{$answer->id}}"
                                   name="{{'custom'.$task->id}}" class="custom-control-input">
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
            <button type="button" id="sendRes" class="btn btn-success ">@lang('page.send')</button>
        </div>
        <!-- The Modal -->
        <div id="myModal" class="modal ">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p></p>
            </div>

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

                    contin = "<a href=\"{{route('user.index')}}\" class=\"btn btn-success\"><strong>@lang('page.continue')</strong></a>\n";

                    $("#mainWin").html("<div class=\" p-3 my-3 text-white-50 bg-purple rounded shadow-sm \">\n" +
                        "<div class=\"lh-100 \">\n" +
                        "<h2 class=\"text-center mb-0 text-white lh-100\">@lang('page.result') " + data.status + "</h2>\n" +
                        "</div>\n" +
                        "</div>" +
                        "<div class=\"my-3 p-3 bg-white rounded shadow-sm text-center\">\n" +
                        contin +
                        "</div>");

                    if (data.status < 90 && Object.keys(data.repeat).length > 0) {
                        $("#mainWin").append("<ul class=\"list-group\" id=\"repeatTopics\">" +
                            "<li class=\"list-group-item active\">@lang('page.repeat')</li>" +
                            "</ul>");
                        $.each(data.repeat, function (i, val) {
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

        var nowB = new Date().getTime();

        // Find the distance between now and the count down date
        var dist = countDownDate - nowB;

        var min = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60));
        var canMes = true;

        // Update the count down every 1 second
        var x = setInterval(function () {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            //var miliseconds = Math.floor((distance % (60)*10)/100);

            if (seconds == 58 && minutes == min - 1) {
                if (canMes) {
                    showMes(texMsg(mesgs1));
                    canMes = false;
                }
            }
            if (seconds == 0 && minutes == min - 2) {
                if (!$("input[type=radio]:checked").length) {
                    if (!canMes) {
                        showMes(texMsg(mesgs2));
                        canMes = true;
                    }
                }
            }

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = '<h2 style="color:red">' + minutes + "m " + seconds + "s " + '</h2>';

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
                finishTest()
            }
        }, 0);

        var triggerFunc = true;
        var currenCount = 0;

        $('input:radio[type=radio]').change(function () {
            var countAn = $("input[type=radio]:checked");

            if (countAn.length == currenCount){
                return false;
            }
            currenCount = countAn.length;

            bbb(countAn, 3);
            bbb(countAn, 4);
            bbb(countAn, 5);
            bbb(countAn, 7);
            bbb(countAn, 10);
            bbb(countAn, 18);
            bbb(countAn, 20);

            if (
                countAn.length == 3 || countAn.length == 4 || countAn.length == 5 || countAn.length == 7 ||
                countAn.length == 10 || countAn.length == 18 || countAn.length == 20 || countAn.length == 49
            ) {
                getMes(countAn, false);
            }
        });

        function triggerMes(param, message, countAn) {
            if (countAn.length == param) {
                if (param == 3 || param == 5 || param == 10 || param == 20) {
                    if (triggerFunc) {
                        showMes(message);
                        triggerFunc = false;
                    }
                } else {
                    if (!triggerFunc) {
                        showMes(message);
                        triggerFunc = true;
                    }
                }
            }
        }

        function getMes(countAn, direct) {

            var answ = [];
            for (var i = 0; i < countAn.length; i++) {
                answ[i] = countAn[i].value;
            }
            $.ajax({
                type: "POST",
                url: '{{route('getMes')}}',
                data: {
                    "_token": '{{ csrf_token() }}',
                    "answers": answ
                },
                success: function (data) {
                    //data = jQuery.parseJSON(data);
                    if(data){
                    if (direct) {
                        triggerMes(countAn.length, data, countAn)
                    }
                    else {
                        showMes(data)
                    }
                    }
                }
            });
        }

        /*function retData(data){
            return  mes = data;
        }*/
        //document.getElementById('myModal').style.display = "block";
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        };

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };

        function showMes(phrase) {
            $(".modal-content").children('p').html('<h2>' + phrase + '</h2>');
            modal.style.display = "block";
        }

        var mesgs1 = ['Break a leg!', 'Good Luck', 'Ни пуха, ни пера!',];
        var mesgs2 = ['Shake a leg!', 'Are you still here?', 'Ты все еще здесь?', 'Шевелись!'];

        function texMsg(mesgs) {
            return mesgs[(Math.random() * mesgs.length) | 0]
        }

        function bbb(countAn, param) {
            if (countAn.length - 20 == param) {
                var key = 0;
                var sliced = [];
                for (var i = 20; i < (20 + param); i++) {
                    sliced[key] = countAn[i];
                    key++
                }
                getMes(sliced, true);
            }

            /*if (countAn.length - shift == param) {
                var key = 0;
                var sliced = [];
                for (var i = shift; i < (shift + param); i++) {
                    sliced[key] = countAn[i];
                    key++
                }
                getMes(sliced, true);
            }*/
        }
    </script>

@endsection

