<!DOCTYPE html>
<html>
<head>
    <title>Gráfica Tipo Donut</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>
    <div id="donutChart"></div>
    <script>
        var jsonData = @json($jsonData);
        var data = JSON.parse(jsonData);
        var estatus = data.map(item => item.estatus);
        var totalCasos = data.map(item => item.total_casos);
        var options = {
            chart: {
                type: 'donut',
                width: 400,
                height: 400
            },
            series: totalCasos,
            labels: estatus,
            colors: [
                '#FF6384',
                '#36A2EB',
                '#FF0000',
                '#00ff00',
                '#36A2EB',
            ],
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
            legend: {
                position: 'top',
            },
        };
        var donutChart = new ApexCharts(document.querySelector("#donutChart"), options);
        donutChart.render();
    </script>
</body>
</html>