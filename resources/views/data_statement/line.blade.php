@extends('layouts.default')

@section('css')


@stop

@section('content')

    <div class="box">
        <div class="box-body">
            <div id="container" style="min-width: 310px; height: 800px; margin: 0 auto"></div>
        </div>
    </div>

@stop

@section('js')
    <script src="{{asset('Highcharts/code/highcharts.js')}}"></script>
    <script src="{{asset('Highcharts/code/modules/exporting.js')}}"></script>
    <script type="text/javascript">

        Highcharts.chart('container', {
            chart: {
                type: 'line'
            },
            title: {
                text: '销售增长率折线图'
            },
            subtitle: {
                text: '销售增长率折线图'
            },
            xAxis: {
                categories: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月']
            },
            yAxis: {
                title: {
                    text: '增长率 (%)'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: '英国',
                data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }, {
                name: '澳大利亚',
                data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
            }]
        });
    </script>

@stop

