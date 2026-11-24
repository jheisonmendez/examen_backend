<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        $clientes = Client::all();
        return response()->json($clientes);
    }
    public function store(Request $request){
        $validated = $request->validate([
            "cedula" => "required|string|max:255",
            "direccion" => "required|string|max:255",
            "telefono" => "required|string|max:255",
        ]);
        $cliente = Client::create([
            "cedula" => $validated["cedula"],
            "direccion" => $validated["direccion"],
            "telefono" => $validated["telefono"],
        ]);
        return response()->json($cliente);
    }
    public function update(Request $request, Client $cliente){
        $validated = $request->validate([
            "cedula" => "required|string|max:255",
            "direccion" => "required|string|max:255",
            "telefono" => "required|string|max:255",
        ]);
        $cliente->update([
            "cedula" => $validated["cedula"],
            "direccion" => $validated["direccion"],
            "telefono" => $validated["telefono"],
        ]);
        return response()->json($cliente);
    }
    public function show(Client $cliente){
        return response()->json($cliente);
    }
    public function destroy(Client $cliente){
        $cliente->delete();
        return response()->json($cliente);
    }

}
