@extends('layouts.master')
@section('title')Tablero @endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/tui-chart/tui-chart.min.css') }}" rel="stylesheet">
@endsection
@section('content')
@section('pagetitle')Tablero @endsection
    <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-7 col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title" style="font-size:200%;">Tablero</h1>
                    </div>
                    <div class="card-body">
                        <div id="bar-charts" data-colors='["#FFA500", "#0000FF", "#008000", "#FF0000"]' dir="ltr"></div>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/tui-chart/tui-chart.min.js') }}"></script>
<script>
    var jsonData21 = @json($jsonData2);
    var jsonData2 = JSON.parse(jsonData21);
    var categories = [...new Set(jsonData2.map(item => item.municipio))];
    var series = [...new Set(jsonData2.map(item => item.estatus))];
    var data = {
        categories: categories,
        series: series.map(function(estatus) {
            var color;
            switch (estatus) {
                case 'EN PROCESO':
                    color = '#FFA500'; // Naranja
                    break;
                case 'ASIGNADO':
                    color = '#0000FF'; // Azul
                    break;
                case 'ATENDIDO':
                    color = '#008000'; // Verde
                    break;
                case 'POR SOLUCIONAR':
                    color = '#FF0000'; // Rojo
                    break;
                default:
                    color = '#000000'; // Color predeterminado
            }
            return {
                name: estatus,
                data: categories.map(function(municipio) {
                    var matchingData = jsonData2.find(item => item.estatus === estatus && item.municipio === municipio);
                    return matchingData ? matchingData.total_casos : 0;
                }),
                color: color // Personalizar el color de la serie
            };
        })
    };
    var container = document.getElementById('bar-charts');
    var maxXValue = Math.max(...jsonData2.map(item => item.total_casos)); // Obtener el valor máximo de total_casos en jsonData2    
    var options = {
        chart: {
            width: container.offsetWidth,
            height: 380,
            title: 'Casos por municipio y estatus',
            format: '1,000'
        },
        yAxis: {
            title: 'Casos'
        },
        xAxis: {
            title: 'Cantidad',
            min: 0,
            max: maxXValue,
        },
        series: {
            showLabel: false
        }
    };
    var theme = {
        chart: {
            background: {
                color: '#fff',
                opacity: 0
            }
        },
        title: {
            color: '#000000' // Cambiar el color del título a negro
        },
        xAxis: {
            title: {
                color: '#000000' // Cambiar el color del título del eje X a negro
            },
            label: {
                color: '#000000' // Cambiar el color del texto del eje X a negro
            },
            tickColor: '#000000' // Cambiar el color de las marcas del eje X a negro
        },
        yAxis: {
            title: {
                color: '#000000' // Cambiar el color del título del eje Y a negro
            },
            label: {
                color: '#000000' // Cambiar el color del texto del eje Y a negro
            },
            tickColor: '#000000' // Cambiar el color de las marcas del eje Y a negro
        },
        plot: {
            lineColor: 'rgba(166, 176, 207, 0.1)'
        },
        legend: {
            label: {
                color: '#000000' // Cambiar el color del texto de la leyenda a negro
            }
        }
    };
    tui.chart.registerTheme('myTheme', theme);
    options.theme = 'myTheme';
    var barChart = tui.chart.barChart(container, data, options);
    window.onresize = function () {
        barChart.resize({
            width: container.offsetWidth,
            height: 350
        });
    };
</script>
@endsection
