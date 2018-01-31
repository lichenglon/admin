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
                text: '@lang("data_statement.Sales_growth_rate")'
            },
            subtitle: {
                text: '@lang("data_statement.Sales_growth_rate")'
            },
            xAxis: {
                categories: ['@lang("data_statement.In_January")', '@lang("data_statement.In_February")', '@lang("data_statement.In_march")',
                             '@lang("data_statement.April")', '@lang("data_statement.In_may")', '@lang("data_statement.In_June")',
                             '@lang("data_statement.In_July")', '@lang("data_statement.In_August")', '@lang("data_statement.September")',
                             '@lang("data_statement.October")', '@lang("data_statement.In_November")', '@lang("data_statement.December")']
            },
            yAxis: {
                title: {
                    text: '@lang("data_statement.The_growth_rate_of") (%)'
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
                name: '@lang("data_statement.The_British")',
                data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
            }]
        });
    </script>

@stop

