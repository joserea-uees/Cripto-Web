<!DOCTYPE html>
<html>
<head>
    <title>Crypto App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white">

<div class="min-h-screen flex flex-col items-center justify-center">

    <h1 class="text-4xl font-bold mb-6">🪙 Crypto Tracker</h1>

    <form method="POST" action="/buscar" class="bg-gray-800 p-6 rounded-2xl shadow-lg">
        @csrf
        <input 
            type="text" 
            name="crypto" 
            placeholder="bitcoin" 
            class="p-2 rounded text-black"
        >
        <button class="bg-blue-500 px-4 py-2 rounded ml-2 hover:bg-blue-600">
            Buscar
        </button>
    </form>

    @if(session('error'))
        <p class="text-red-400 mt-4">{{ session('error') }}</p>
    @endif

    @if(isset($precio))
        <div class="mt-6 bg-gray-800 p-6 rounded-2xl shadow-lg text-center">
            <h2 class="text-2xl capitalize">{{ $crypto }}</h2>
            <p class="text-3xl font-bold text-green-400">${{ $precio }}</p>
        </div>
    @endif

    <a href="/historial" class="mt-6 text-blue-400 hover:underline">
        Ver historial →
    </a>

</div>

</body>
</html>