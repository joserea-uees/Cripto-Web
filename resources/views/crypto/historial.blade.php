<!DOCTYPE html>
<html>
<head>
    <title>Historial</title>
</head>
<body>

<h1>Historial de Criptomonedas</h1>

<table border="1">
    <tr>
        <th>Crypto</th>
        <th>Precio</th>
        <th>Fecha</th>
    </tr>

    @foreach($datos as $d)
    <tr>
        <td>{{ $d['nombre'] }}</td>
        <td>${{ $d['precio'] }}</td>
        <td>{{ $d['fecha'] }}</td>
    </tr>
    @endforeach
</table>

<br>

<a href="/">Volver</a>
<br>
<a href="/descargar">Descargar XML</a>

<hr>

<h2>Gráfica de precios</h2>

<canvas id="grafica"></canvas>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
let labels = [];
let precios = [];

@foreach($datos as $d)
    labels.push("{{ $d['fecha'] }}");
    precios.push({{ $d['precio'] }});
@endforeach

new Chart(document.getElementById('grafica'), {
    type: 'line',
    data: {
        labels: labels,
        datasets: [{
            label: 'Precio',
            data: precios,
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: false
            }
        }
    }
});
</script>

</body>
</html>