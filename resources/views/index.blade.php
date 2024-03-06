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
        <h1>Dashboard</h1>
        <div id="chart"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
        chart: {
            type: 'bar'
        },
        series: [{
            name: 'sales',
            data: [30,40,45,50,49,60,70,91,125]
        }],
        xaxis: {
            categories: [1991,1992,1993,1994,1995,1996,1997, 1998,1999]
        }
        }
        console.log(options);
        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>
</body>
</html>