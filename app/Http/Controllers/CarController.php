<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Cloudinary\Cloudinary;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(){
        $coches = Car::with(['client'])->get();
        return response()->json($coches);
    }
    public function store(Request $request){
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo'=>'required|string|max:255',
            'color'=>'required|string|max:255',
            'precio'=>'required|string|max:255',
            'imagen'=>'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'client_id' => 'required|integer|exists:clients,id',
        ]);
        $file = $request->file('imagen');
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key' => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret')
            ],
            'url' => ['secure' => true],
        ]);
        $resultado = $cloudinary->uploadApi()->upload(
            $file->getRealPath(),
            [
                'folder'=>'paciente',
                'resource_type' => 'image',
            ]
        );
        $coches = Car::create([
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'color' =>$request->color,
            'precio' =>$request->precio,
            'imagen_url' =>$resultado['secure_url'],
            'imagen_public_id' =>$resultado['public_id'],
            'client_id'=>$request->client_id,
        ]);
        return response()->json($coches);
    }
    public function update(Request $request, Car $coche){
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo'=>'required|string|max:255',
            'color'=>'required|string|max:255',
            'precio'=>'required|string|max:255',
            'imagen'=>'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'client_id' => 'required|integer|exists:clients,id',

        ]);
    $coche->fill($request->only([
            'marca',
            'modelo',
            'color',
            'precio',
            'client_id'
        ]));

    $oldImagePublicId = null;

    if ($request->hasFile('imagen')) {
        $cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key' => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret'),
            ],
            'url' => ['secure' => true],
        ]);

        $uploaded = $cloudinary->uploadApi()->upload(
            $request->file('imagen')->getRealPath(),
            [
                'folder' => 'coche',
                'resource_type' => 'image',
            ]
        );

        $oldImagePublicId = $coche->imagen_public_id;
        $coche->fill([
            'imagen_url' => $uploaded['secure_url'],
            'imagen_public_id' => $uploaded['public_id'],
        ]);
    }

    $coche->save();

    if ($oldImagePublicId) {
        $cloudinary->uploadApi()->destroy($oldImagePublicId);
    }

    return response()->json([
        'message' => 'Elemento actualizado correctamente',
        'data' => $coche
    ]);
    }public function show($id){
        $coche=Car::find($id);
        return response()->json($coche);
    }
    public function destroy(Car $coche){
        $coche->delete();
        return response()->json($coche);
    }
}
