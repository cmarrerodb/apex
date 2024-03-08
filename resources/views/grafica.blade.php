<!DOCTYPE html>
<html>
<head>
    <title>1x10</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.22.3/dist/bootstrap-table.min.css">

    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto);

        body {
        font-family: Roboto, sans-serif;
        }
        .chart {
        max-width: 500px;
        margin: 35px auto;
        }
    </style>
</head>
<body>
    <div class="container">      
        <h1>Tablero</h1>
        <div id="chart" class="chart"></div>
        <div id="chart2" class="chart"></div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    var jsonData11 = @json($jsonData1);
    var jsonData21 = @json($jsonData2);
    var jsonData = JSON.parse(jsonData11);
    var jsonData2 = JSON.parse(jsonData21);
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
</script>
</body>
</html>
