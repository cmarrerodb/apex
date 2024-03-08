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
        <div id="chart3" class="chart"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
    var jsonData31 = @json($jsonData3); // Convertir los datos de PHP a JSON para usar en JavaScript
    var jsonData3 = JSON.parse(jsonData31);
    var categories = [...new Set(jsonData3.map(item => item.municipio))]; // Obtener las categorías únicas
    var series = [...new Set(jsonData3.map(item => item.estatus))]; // Obtener las series únicas

    var chartData = series.map(serie => ({
        name: serie,
        data: categories.map(category => {
            var matchingData = jsonData3.find(item => item.municipio === category && item.estatus === serie);
            return matchingData ? matchingData.total_casos : 0;
        })
    }));

    var options3 = {
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

    var chart3 = new ApexCharts(document.querySelector("#chart3"), options3);
    chart3.render();
</script>

  </body>
</html>
