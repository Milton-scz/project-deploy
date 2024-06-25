<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoAdminController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'categoria_id' => 'required|integer|exists:categorias,id',
            'marca_id' => 'required|integer|exists:marcas,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $destinationPath = 'resources/images/';
            $filename = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path($destinationPath), $filename);
            $imageUrl = url('resources/images/' . $filename);
            $producto = Producto::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'stock' => $request->stock,
                'imagen' => $imageUrl,
                'categoria_id' => $request->categoria_id,
                'marca_id' => $request->marca_id,
            ]);

            return response()->json(['success' => 'Producto creado exitosamente', 'producto' => $producto]);
        }

        return response()->json(['error' => 'Error al subir la imagen'], 400);
    }
}
