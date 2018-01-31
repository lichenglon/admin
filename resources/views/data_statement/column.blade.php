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

        $(function () {
            var chart = Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: '@lang("data_statement.Growth_rate_of_rental_housing")'
                },
                subtitle: {
                    text: '@lang("data_statement.Slide_the_mouse_over_the_bar_to_view_the_growth_rate")'
                },
                xAxis: {
                    categories: ['@lang("data_statement.In_January")', '@lang("data_statement.In_February")', '@lang("data_statement.In_march")', '@lang("data_statement.April")',
                        '@lang("data_statement.In_may")', '@lang("data_statement.In_June")', '@lang("data_statement.In_July")', '@lang("data_statement.In_August")',
                        '@lang("data_statement.September")', '@lang("data_statement.October")', '@lang("data_statement.In_November")', '@lang("data_statement.December")']
                },
                yAxis: {
                    labels: {
                        x: -15
                    },
                    title: {
                        text: '@lang("data_statement.housing")'
                    }
                },
                series: [{
                    name: '@lang("data_statement.Rental_growth")',
                    data: [434, 523, 345, 785, 565, 843, 726, 590, 665, 434, 312, 432]
                }],
                responsive: {
                    rules: [{
                        condition: {
                            maxWidth: 500
                        },
                        // Make the labels less space demanding on mobile
                        chartOptions: {
                            xAxis: {
                                labels: {
                                    formatter: function () {
                                        return this.value.replace('月', '131')
                                    }
                                }
                            },
                            yAxis: {
                                labels: {
                                    align: 'left',
                                    x: 0,
                                    y: -2
                                },
                                title: {
                                    text: ''
                                }
                            }
                        }
                    }]
                }
            });
            $('#small').click(function () {
                chart.setSize(400, 300);
            });
            $('#large').click(function () {
                chart.setSize(800, 300);
            });
        });

    </script>

@stop


