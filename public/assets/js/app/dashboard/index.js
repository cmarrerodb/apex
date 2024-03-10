$(function() {
    const opcionesFetch0 = {
        method: 'GET',
        headers: {'X-CSRF-Token': $('meta[name="_token"]').attr('content'),'Content-Type': 'application/json'},
    }
    fetch(base+'/dashboard/timeline_reservas',opcionesFetch0)
    .then(response => response.json())
    .then(response => {
        var data = {
            categories: response.map(obj =>obj.csemana_mes),
            series: [
                {
                name: 'Rseservas',
                data: response.map(obj =>obj.cant)
                }
            ]
        };
        var options = {
            chart: {
                width: 600,
                height: 400,
                title: 'Reservas por semana'
            },
            xAxis: {
                title: 'Semana'
            },
            yAxis: {
                title: 'Reservas'
            },
            series: {
                spline: true,
                showDot: true,
                showArea: true
            }
        };
        var chart = toastui.Chart.lineChart({
            el: document.getElementById('reservas_semana'),
            data: data,
            options: options
        });
        $(".toastui-chart-export-menu-title").html('Exportar a');
        $(".toastui-chart-tooltip-container").on("click",function(e) {
            e.preventDefault();
            alert("PEPE");
        })
    })
})
iconos()