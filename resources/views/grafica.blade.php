<!DOCTYPE html>
<html>
<head>
    <title>1x10</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Roboto);

        body {
        font-family: Roboto, sans-serif;
        }
        #chart {
        max-width: 650px;
        margin: 35px auto;
        }
    </style>
</head>
<body>
    <div class="container">      
        <h1>Tablero</h1>
        <div id="chart"></div>
        <div id="chart2"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var jsonData11 = @json($jsonData1);
        var jsonData21 = @json($jsonData2);
        var jsonData = JSON.parse(jsonData11);
        var jsonData2 = JSON.parse(jsonData21);
        console.log(jsonData2);
        var customColors = ['#FF5733', '#3498DB', '#27AE60', '#F39C12'];
        var options = {
            chart: {
                type: 'bar',
                stacked: false
            },
            plotOptions: {
                bar: {
                    horizontal: true
                }
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
                name: 'total_casos',
                data: jsonData.map(item => item.total_casos)
            }],
            xaxis: {
                categories: jsonData.map(item => item.estatus)
            },
            colors: customColors
        };
        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();

        var options2 = {
            chart: {
                type: 'bar'
                // stacked: false
            },
            plotOptions: {
                bar: {
                    horizontal: false
                }
            },
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
            series: [{
                name: 'total_casos',
                data: jsonData2.map(item => item.total_casos)
            }],
            xaxis: {
                categories: jsonData2.map(item => item.municipio + ' - ' + item.estatus)
            },
            colors: customColors
        };
        
        var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
        chart2.render();
        
    </script>
</body>
</html>
