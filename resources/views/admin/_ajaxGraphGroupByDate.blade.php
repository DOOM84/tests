<script>
    Highcharts.chart('container', {

        chart: {
            type: 'line'
        },

        title: {
            text: 'Группа {{$group->name}}'
        },

        subtitle: {
            text: 'Успеваемость c {{$from}} по {{$to}}'
        },

        xAxis: {
            title: {
                text: 'Дата и время прохождения'
            },
            categories: [
                @foreach($group->results/*->sortBy('updated_at')*/ as $result)
                    '{{$result->user->name}} ({{$result->start}})',
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