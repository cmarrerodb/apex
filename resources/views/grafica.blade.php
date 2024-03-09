<!DOCTYPE html>
<html>
<head>
    <title>1x10</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.10.2/css/tableexport.min.css"> -->

<style>
        @import url(https://fonts.googleapis.com/css?family=Roboto);
        body {
        font-family: Roboto, sans-serif;
        }
        /* .chart {
        max-width: 500px;
        margin: 35px auto;
        } */
        .card {
            /* display: flex;
            justify-content: center;
            align-items: center; */
            text-align: center;
            /* height: 200px; Ajusta la altura según tus necesidades */
        }
  </style>
    </style>
</head>
<body>
    <div class="container">      
        <h1>Tablero</h1>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <h1>CASOS POR ESTATUS</h1>
                    <hr/>
                </div>                
                <div class="row">
                    <div class="col-md-5">
                        <table id="estatus"  class="table table-dark table-hover table-striped" data-toggle="table" data-show-columns="true">
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
                        <!-- <table id="municipio-estatus" class="table table-dark table-hover" data-toggle="table" data-show-columns="true" data-pagination="true" data-show-export="true" data-export-data-type="all" data-export-types="['csv', 'json', 'excel']" >
                        -->
                        <table id="municipio-estatus" class="table table-dark table-hover" data-toggle="table" data-show-columns="true" data-pagination="true" >
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

    <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.22.3/dist/bootstrap-table.min.js"></script>
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
        // $('#municipio-estatus').bootstrapTable('enableExport', {
        //     type: 'csv',
        //     filename: 'municipio-estatus-data',
        //     customize: function (xhr, config) {
        //         config.fields = [
        //         { field: 'municipio', title: 'Municipio' },
        //         { field: 'estatus', title: 'Estatus' },
        //         { field: 'total_casos', title: 'Total de Casos' }
        //         ];
        //     }
        //     });        
    </script>
    <!-- <link rel="stylesheet" href="https://raw.githubusercontent.com/wenzhixin/bootstrap-table/master/src/extensions/export/bootstrap-table-export.js"></script>
    <script src="https://raw.githubusercontent.com/wenzhixin/bootstrap-table/master/src/extensions/export/bootstrap-table-export.css"></script> -->
</body>
</html>
