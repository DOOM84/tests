<script>
    Highcharts.chart('container', {

        chart: {
            type: 'line'
        },

        title: {
            text: '{{__('page.group')}} {{$group->name}}'
        },

        subtitle: {
            text: '{{__('page.per')}} {{__('page.PerFrom')}} {{$from}} {{__('page.PerTo')}} {{$to}}'
        },
        xAxis: {
            title: {
                text: '{{__('page.dateTime')}}'
            },
            categories: [
                @foreach($group->results/*->sortBy('updated_at')*/ as $result)
                    '{{$result->user->name}} ({{$result->updated_at}})',
                @endforeach
            ]
        },

        yAxis: {
            max: 100,
            title: {
                text: '{{__('page.rate')}}'
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
            name: '{{__('page.per')}}',
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