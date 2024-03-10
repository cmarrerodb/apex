@extends('layouts.master')
@section('title')
Tablero
@endsection
@section('content')
@section('pagetitle')
Tablero
@endsection
    <div class="container">      
        <h1>Tablero </h1>
        <div class="card text-center">
            <div class="card-body">
                <div class="row">
                    <h1>CASOS POR ESTATUS</h1>
                    <hr/>
                </div>                
                <div class="row">
                    <div class="col-md-5">
                        <table id="estatus" class="table table-dark table-hover table-striped" data-toggle="table" data-show-columns="true" data-show-export="true" data-export-data-type="all" data-export-types="['csv', 'json', 'excel']" data-show-fullscreen="true">

                            <thead>
                                <tr>
                                    <th data-field="estatus">Estatus</th>
                                    <th data-field="total_casos" data-formatter="casosFormatter" data-align="right">Total de Casos</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-7">
                        <div id="chart"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="row">
                        <hr/>
                        <h1>CASOS POR MUNICIPIO Y ESTATUS</h1>
                        <hr/>
                    </div>                     
                    <div class="col-xs-12 col-sm-12 col-md-5">
                        <table id="municipio-estatus" class="table table-dark table-hover" data-toggle="table" data-show-columns="true" data-pagination="true" data-show-export="true" data-export-data-type="all" data-export-types="['csv', 'json', 'excel']" data-show-fullscreen="true">
                        <thead>
                            <tr>
                                <th data-field="municipio">Municipio</th>
                                <th data-field="estatus">Estatus</th>
                                <th data-field="total_casos" data-formatter="casosFormatter" data-align="right">Total de Casos</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-7">
                        <div id="chart2" class="chart"></div>
                </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('script')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script>
            $(document).ready(function(){
                $('#estatus').bootstrapTable();
                $('#municipio-estatus').bootstrapTable();
            })
            var jsonData11 = @json($jsonData1);
            var jsonData21 = @json($jsonData2);
            var jsonData = JSON.parse(jsonData11);
            var jsonData2 = JSON.parse(jsonData21);
            $('#estatus').bootstrapTable({
                data: jsonData
            });
            $('#municipio-estatus').bootstrapTable({
                data: jsonData2,
                search: true, // Agregar funcionalidad de búsqueda
            });
            var custColors = ['#FF5733', '#3498DB', '#27AE60', '#F39C12'];
            var options = {
                chart: {
                    type: 'bar'
                },
                plotOptions: {
                    bar: {
                horizontal: false,
                dataLabels: {
                position: 'top',
                },
            }
                },
                dataLabels: {
            enabled: true,
            offsetX: -6,
            style: {
                fontSize: '12px',
                colors: ['#000']
            }
            },
            stroke: {
            show: true,
            width: 1,
            colors: ['#fff']
            },
            tooltip: {
            shared: true,
            intersect: false
            },            
                title: {
                    text: 'Total Casos por Estatus',
                    align: 'center',
                    margin: 20,
                    offsetX: 0,
                    offsetY: 0,
                    floating: false,
                    style: {
                        fontSize: '24px',
                        fontWeight: 'bold',
                        fontFamily: 'Helvetica, Arial, sans-serif',
                        color: '#263238'
                    },
                },            
                series: [{
                    name: 'Casos',
                    data: jsonData.map(item => item.total_casos)
                }],
                xaxis: {
                    categories: jsonData.map(item => item.estatus)
                },
                colors: custColors
            };
            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
            var categories = [...new Set(jsonData2.map(item => item.municipio))]; // Obtener las categorías únicas
            var series = [...new Set(jsonData2.map(item => item.estatus))]; // Obtener las series únicas
            var chartData = series.map(serie => ({
                name: serie,
                data: categories.map(category => {
                    var matchingData = jsonData2.find(item => item.municipio === category && item.estatus === serie);
                    return matchingData ? matchingData.total_casos : 0;
                })
            }));

            var options2 = {
                title: {
                    text: 'Total Casos por Municipio y Estatus',
                    align: 'center',
                    margin: 20,
                    offsetX: 0,
                    offsetY: 0,
                    floating: false,
                    style: {
                        fontSize: '24px',
                        fontWeight: 'bold',
                        fontFamily: 'Helvetica, Arial, sans-serif',
                        color: '#263238'
                    },
                },            
                series: chartData,
                chart: {
                    type: 'bar',
                    height: 430
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        dataLabels: {
                            position: 'top',
                        }
                    }
                },
                dataLabels: {
                    enabled: true,
                    offsetX: 100,
                    style: {
                        fontSize: '8px',
                        colors: ['#000']
                    },
                    formatter: function (value, { seriesIndex, dataPointIndex, w }) {
                        return w.config.series[seriesIndex].name + ': ' + value;
                    }
                },
                stroke: {
                    show: true,
                    width: 1,
                    colors: ['#fff']
                },
                tooltip: {
                    shared: true,
                    intersect: false
                },
                xaxis: {
                    categories: categories,
                    labels: {
                        style: {
                            fontSize: '10px'
                        }
                    }            
                },
            };
            var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
            chart2.render();
            function casosFormatter(value) {
                if (value >= 1000) {
                    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                } else {
                    return value;
                }
            }
    </script>
@endsection