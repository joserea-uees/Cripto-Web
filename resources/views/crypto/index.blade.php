<!DOCTYPE html>
<html>
<head>
    <title>Crypto App</title>
</head>
<body>

<h1>Buscar Criptomoneda</h1>

<form method="POST" action="/buscar">
    @csrf
    <input type="text" name="crypto" placeholder="bitcoin">
    <button type="submit">Buscar</button>
</form>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

@if(isset($precio))
    <h2>{{ $crypto }}</h2>
    <p>Precio: ${{ $precio }}</p>
@endif

<br>
<a href="/historial">Ver historial</a>

</body>
</html>