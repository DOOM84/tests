@extends('user.layout')
@section('title', 'Charts')
@section('content')

    <main role="main" class="container">
        <div class="{{--d-flex --}} p-3 my-3 text-white-50 bg-purple rounded shadow-sm ">
            @include('includes.messages')
            <div class="lh-100 ">
                <h2 class="text-center mb-0 text-white lh-100">
                    Графическая информация. Группа: {{$group->name}}
                </h2>
            </div>
        </div>

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
                <button id="showInfo" class="btn btn-primary">Показать</button>
            </div>
        </div>

        <div class="my-3 p-3 bg-white rounded shadow-sm " id="container">

            <script>
                Highcharts.chart('container', {

                    chart: {
                        type: 'line'
                    },

                    title: {
                        text: 'Группа {{$group->name}}'
                    },

                    subtitle: {
                        text: 'Успеваемость за все время'
                    },

                    xAxis: {
                        title: {
                            text: 'Дата и время прохождения'
                        },
                        categories: [
                            @foreach($group->results/*->sortBy('updated_at')*/ as $result)
                                '{{$result->user->name}} ({{$result->updated_at}})',
                            @endforeach

                        ],
                        labels: {

                            style: {
                                font: '10px Arial, sans-serif'

                            }}
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
                                @foreach($group->results/*->sortBy('updated_at')*/ as $result)
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
    </main>
@endsection

@section('scriptSection')
    <script>
        $('#showInfo').click(function () {
            var fromDate = $('#from').val();
            var toDate = $('#to').val();
            if(fromDate == 0 || toDate == 0) return false;
            $.ajax({
                type: "POST",
                url: '{{route('user.stats.graphGroupByDate')}}',
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
