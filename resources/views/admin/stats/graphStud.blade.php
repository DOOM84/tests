@extends('admin.layout')
@section('title', $user->name.' stats')

@section('body')
    <div class="container text-center">
        @include('includes.messages')
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Панель управления</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.stats')}}">Статистика</a></li>
            <li class="breadcrumb-item">
                <a href="{{route('admin.stats.group', $user->group->id)}}">Группа {{$user->group->name}}</a>
            </li>
            <li class="breadcrumb-item"><a href="{{route('admin.stats.student', $user->id)}}">
                    {{$user->name}}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Графическая информация</li>
        </ol>
    </nav>
    <div class="container text-center">
        <div class="d-inline-flex mb-2">
            <label for="from"></label>
            <select id="from" class="custom-select w-50">
                <option value="0" selected>Выбрать от</option>
                @foreach($dates as $date)
                    <option value="{{$date}}">{{$date}}</option>
                @endforeach
            </select>
            <label for="to"></label>
            <select id="to" class="custom-select w-50 mr-2">
                <option value="0" selected>Выбрать до</option>
                @foreach($dates as $date)
                    <option value="{{$date}}">{{$date}}</option>
                @endforeach
            </select>
            <button id="showInfo" class="btn btn-info">Показать</button>
        </div>
    </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm " id="container">

        <script>
            Highcharts.chart('container', {

                chart: {
                    type: 'line'
                },

                title: {
                    text: '{{$user->name}}'
                },

                subtitle: {
                    text: 'Успеваемость за все время'
                },

                xAxis: {
                    title: {
                        text: 'Дата и время прохождения'
                    },
                    categories: [
                        @foreach($user->results/*->sortBy('updated_at')*/ as $result)
                            '{{$result->start}}',
                        @endforeach

                    ]
                },

                yAxis: {
                    max: 100,
                    title: {
                        text: 'Оценка'
                    },
                },

                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: true
                    }
                },
                series: [{
                    name: 'Успеваемость',
                    data: [
                            @foreach($user->results/*->sortBy('updated_at')*/ as $result)
                        ['Тема: {{isset($result->topic->name) ? $result->topic->name : 'Общий тест'}} ({{$result->level->level}})', {{$result->result}}],
                        @endforeach
                    ],
                    lineWidth: 3

                }],
                exporting: {
                    sourceWidth: 1000,
                    scale: 1,
                    chartOptions: {
                        chart: {
                            height: this.chartHeight
                        }
                    },
                    buttons: {
                        contextButton: {
                            menuItems: ["printChart",
                                "separator",
                                "downloadPNG",
                                "downloadJPEG",
                            ]
                        }
                    }
                },
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        chartOptions: {
                            legend: {
                                layout: 'horizontal',
                                align: 'center',
                                verticalAlign: 'bottom'
                            }
                        }
                    }]
                }

            });

        </script>
    </div>

@endsection

@section('scriptSection')
    <script>
        $('#showInfo').click(function () {
            var fromDate = $('#from').val();
            var toDate = $('#to').val();
            if(fromDate == 0 || toDate == 0) return false;
            $.ajax({
                type: "POST",
                url: '{{route('admin.stats.graphStudByDate', $user->id)}}',
                data: {
                    "_token": '{{ csrf_token() }}',
                    "from": fromDate,
                    "to": toDate
                },
                success: function (filtered) {
                    $("#container").html(filtered);
                }
            });
        });
    </script>
@endsection


