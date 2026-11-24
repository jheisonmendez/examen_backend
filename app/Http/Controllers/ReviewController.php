<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(){
        $revisiones = Review::with('car.client')->get();
        return response()->json($revisiones);
    }
    public function store(Request $request){
        $request->validate([
            "codigo" => "required|string|max:255",
            "aceite" => "required|boolean",
            "filtro" => "required|boolean",
            "frenos" => "required|boolean",
            'car_id' => 'required|integer|exists:cars,id',
            
        ]);
        $revision = Review::create($request->all());
        return response()->json($revision);
    }
    public function update(Request $request, Review $revision){
        $request->validate([
            "codigo" => "required|string|max:255",
            "aceite" => "required|boolean",
            "filtro" => "required|boolean",
            "frenos" => "required|boolean",
            'car_id' => 'required|integer|exists:cars,id',
            
        ]);
        $revision->update($request->only(["codigo", "aceite", "filtro", "frenos", "car_id"]));
        return response()->json($revision);
    }
    public function show(Review $revision){
        return response()->json($revision);
    }
    public function destroy(Review $revision){
        $revision->delete();
        return response()->json($revision);
    }
}
