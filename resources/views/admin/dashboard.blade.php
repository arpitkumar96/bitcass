@extends('admin.layouts.app')
@section('content')
@push('css')
    <style>
        #seven_day_deposite_amount {
            width: 100%;
            height: 500px;
            margin-bottom: 50px
        }
        #seven_day_withdrawal_amount {
            width: 100%;
            height: 500px;
            margin-bottom: 50px
        }
    </style>
@endpush
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-success float-right">Total</span>
                        </div>
                        <h5>Game Played</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><i class="fa fa-gamepad"></i> {{moneyFormatIndia($total_played_games)}}</h1>
                        <small>Total Game Played</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-info float-right">Total</span>
                        </div>
                        <h5>Amount Deposit</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><i class="fa fa-rupee-sign"></i> {{moneyFormatIndia($total_deposite_amount)}}</h1>
                        <small>Total Amount Deposit</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-primary float-right">Total</span>
                        </div>
                        <h5>Withdrawal Amount</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><i class="fa fa-rupee-sign"></i> {{moneyFormatIndia($total_withdrawal_amount)}}</h1>
                        <small>Total Withdrawal Amount</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-danger float-right">Total</span>
                        </div>
                        <h5>Registred User</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><i class="fa fa-users"></i> {{moneyFormatIndia($total_registered_users)}}</h1>
                        <small>Total Registred User</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-warning float-right">Total</span>
                        </div>
                        <h5>Wallet Amount</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><i class="fa fa-rupee-sign"></i> {{moneyFormatIndia($total_current_wallet_amount)}}</h1>
                        <small>Available Wallet Amount</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-9"></div>
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        7 Day Deposit Amount
                    </div>
                    <div class="ibox-content">
                        <div id="seven_day_deposite_amount"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        7 Day Withdrawal Amount
                    </div>
                    <div class="ibox-content">
                        <div id="seven_day_withdrawal_amount"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')

        <script src="{{asset('backend/assets/js/chart/index.js')}}"></script>
        <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
        <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

        <script>
            am5.ready(function() {
                var root = am5.Root.new("seven_day_deposite_amount");
                root.setThemes([
                    am5themes_Animated.new(root)
                ]);
                var chart = root.container.children.push(am5xy.XYChart.new(root, {
                    panX: false,
                    panY: false,
                    wheelX: false,
                    wheelY: false,
                    pinchZoomX: false,
                    paddingLeft:0,
                    paddingRight:1
                }));
                var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                cursor.lineY.set("visible", false);
                var xRenderer = am5xy.AxisRendererX.new(root, {
                    minGridDistance: 30,
                    minorGridEnabled: true
                });

                xRenderer.labels.template.setAll({
                    rotation: -45,
                    centerY: am5.p50,
                    centerX: am5.p100,
                    paddingRight: 15
                });

                xRenderer.grid.template.setAll({
                    location: 1
                })

                var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                    maxDeviation: 0.3,
                    categoryField: "day",
                    renderer: xRenderer,
                    tooltip: am5.Tooltip.new(root, {})
                }));

                var yRenderer = am5xy.AxisRendererY.new(root, {
                    strokeOpacity: 0.1
                })

                var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                    maxDeviation: 0.3,
                    renderer: yRenderer
                }));
                var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                    name: "Series 1",
                    xAxis: xAxis,
                    yAxis: yAxis,
                    valueYField: "value",
                    sequencedInterpolation: true,
                    categoryXField: "day",
                    tooltip: am5.Tooltip.new(root, {
                        labelText: "{valueY}"
                    })
                }));

                series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5, strokeOpacity: 0 });
                series.columns.template.adapters.add("fill", function (fill, target) {
                    return chart.get("colors").getIndex(series.columns.indexOf(target));
                });

                series.columns.template.adapters.add("stroke", function (stroke, target) {
                    return chart.get("colors").getIndex(series.columns.indexOf(target));
                });

                var data = [
                                @foreach ($last_seven_dates as $date_key => $last_seven_date)
                                    {
                                        day: "{{$last_seven_date}}",
                                        value: {{$last_seven_date_deposite_amounts[$date_key]}}
                                    },
                                @endforeach
                            ];

                xAxis.data.setAll(data);
                series.data.setAll(data);
                series.appear(1000);
                chart.appear(1000, 100);

            });

        </script>

    <script>
        am5.ready(function() {
            var root = am5.Root.new("seven_day_withdrawal_amount");
            root.setThemes([
                am5themes_Animated.new(root)
            ]);
            var chart = root.container.children.push(am5xy.XYChart.new(root, {
                panX: false,
                panY: false,
                wheelX: false,
                wheelY: false,
                pinchZoomX: false,
                paddingLeft:0,
                paddingRight:1
            }));
            var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
            cursor.lineY.set("visible", false);
            var xRenderer = am5xy.AxisRendererX.new(root, {
                minGridDistance: 30,
                minorGridEnabled: true
            });

            xRenderer.labels.template.setAll({
                rotation: -45,
                centerY: am5.p50,
                centerX: am5.p100,
                paddingRight: 15
            });

            xRenderer.grid.template.setAll({
                location: 1
            })

            var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                maxDeviation: 0.3,
                categoryField: "day",
                renderer: xRenderer,
                tooltip: am5.Tooltip.new(root, {})
            }));

            var yRenderer = am5xy.AxisRendererY.new(root, {
                strokeOpacity: 0.1
            })

            var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                maxDeviation: 0.3,
                renderer: yRenderer
            }));
            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: "Series 1",
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: "value",
                sequencedInterpolation: true,
                categoryXField: "day",
                tooltip: am5.Tooltip.new(root, {
                    labelText: "{valueY}"
                })
            }));

            series.columns.template.setAll({ cornerRadiusTL: 5, cornerRadiusTR: 5, strokeOpacity: 0 });
            series.columns.template.adapters.add("fill", function (fill, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            series.columns.template.adapters.add("stroke", function (stroke, target) {
                return chart.get("colors").getIndex(series.columns.indexOf(target));
            });

            var data = [
                            @foreach ($last_seven_dates as $date_key => $last_seven_date)
                                {
                                    day: "{{$last_seven_date}}",
                                    value: {{$last_seven_date_withdrawal_amounts[$date_key]}}
                                },
                            @endforeach
                        ];

            xAxis.data.setAll(data);
            series.data.setAll(data);
            series.appear(1000);
            chart.appear(1000, 100);

        });

    </script>

    @endpush
@endsection
