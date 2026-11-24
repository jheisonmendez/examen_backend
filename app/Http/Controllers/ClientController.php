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
        $request->validate([
            "cedula" => "required|string|max:255",
            "direccion" => "required|string|max:255",
            "telefono" => "required|string|max:255",
        ]);
        $cliente = Client::create($request->all());
        return response()->json($cliente);
    }
    public function update(Request $request, $id){
        $request->validate([
            "cedula" => "required|string|max:255",
            "direccion" => "required|string|max:255",
            "telefono" => "required|string|max:255",
        ]);
        $cliente = Client::find($id);
        $cliente->update($request->all());
        return response()->json($cliente);
    }
    public function show($id){
        $cliente=Client::find($id);
        return response()->json($cliente);
    }
    public function destroy(Client $cliente){
        $cliente->delete();
        return response()->json($cliente);
    }

}
