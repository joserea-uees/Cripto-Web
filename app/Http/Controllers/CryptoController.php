<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CryptoController extends Controller
{
    public function index()
    {
        return view('crypto.index');
    }

    public function buscar(Request $request)
    {
        $crypto = strtolower($request->input('crypto'));

        $response = Http::get('https://api.coingecko.com/api/v3/simple/price', [
            'ids' => $crypto,
            'vs_currencies' => 'usd'
        ]);

        $data = $response->json();

        if (!isset($data[$crypto])) {
            return back()->with('error', 'Criptomoneda no encontrada');
        }

        $precio = $data[$crypto]['usd'];

        $this->guardarXML($crypto, $precio);

        return view('crypto.index', compact('crypto', 'precio'));
    }

    private function guardarXML($nombre, $precio)
    {
        $ruta = storage_path('app/historial.xml');

        if (file_exists($ruta)) {
            $xml = simplexml_load_file($ruta);
        } else {
            $xml = new \SimpleXMLElement('<criptomonedas/>');
        }

        $crypto = $xml->addChild('crypto');
        $crypto->addChild('nombre', $nombre);
        $crypto->addChild('precio', $precio);
        $crypto->addChild('fecha', date('Y-m-d H:i:s'));

        $xml->asXML($ruta);
    }

    public function historial()
    {
        $ruta = storage_path('app/historial.xml');

        $datos = [];

        if (file_exists($ruta)) {
            $xml = simplexml_load_file($ruta);

            foreach ($xml->crypto as $c) {
                $datos[] = [
                    'nombre' => (string)$c->nombre,
                    'precio' => (string)$c->precio,
                    'fecha' => (string)$c->fecha
                ];
            }
        }

        return view('crypto.historial', compact('datos'));
    }

    public function descargar()
    {
        return response()->download(storage_path('app/historial.xml'));
    }
}