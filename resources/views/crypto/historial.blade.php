<!DOCTYPE html>
<html>
<head>
    <title>Historial</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-10">

<h1 class="text-3xl font-bold mb-6">📊 Historial</h1>

<div class="overflow-x-auto">
<table class="w-full bg-gray-800 rounded-xl overflow-hidden">
    <thead class="bg-gray-700">
        <tr>
            <th class="p-3">Crypto</th>
            <th class="p-3">Precio</th>
            <th class="p-3">Fecha</th>
        </tr>
    </thead>
    <tbody>
        @foreach($datos as $d)
        <tr class="text-center border-t border-gray-700">
            <td class="p-3 capitalize">{{ $d['nombre'] }}</td>
            <td class="p-3 text-green-400">${{ $d['precio'] }}</td>
            <td class="p-3">{{ $d['fecha'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

<div class="mt-10 bg-gray-800 p-6 rounded-2xl">
    <h2 class="text-xl mb-4">📈 Gráfica de precios</h2>
    <canvas id="grafica"></canvas>
</div>

<div class="mt-6 flex gap-4">
    <a href="/" class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-600">
        ← Volver
    </a>

    <a href="/descargar" class="bg-green-500 px-4 py-2 rounded hover:bg-green-600">
        Descargar XML
    </a>
</div>

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
            borderWidth: 2,
            tension: 0.3
        }]
    },
    options: {
        responsive: true
    }
});
</script>

</body>
</html>