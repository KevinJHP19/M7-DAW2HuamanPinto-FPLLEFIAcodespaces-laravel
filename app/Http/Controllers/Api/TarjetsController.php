<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tarjets;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\User;
class TarjetsController extends Controller
{
    //
    public function index()
    {
        $tarjets = Tarjets::all();
        return response()->json(['tarjets' => $tarjets], 200);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'required|url',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $tarjet = Tarjets::create([
            'name' => $request->name,
            'image' => $request->image,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(), // AÑADIMOS AL USUARIO QUE LO HA CREADO
        ]);
        return response()->json([
            'message' => 'Tarjeta creada',
            'tarjet' => $tarjet,
        ], 201);

    }
    public function show($id)
    {

        $tarjet = Tarjets::find($id);
        if (!$tarjet) {
            return response()->json(['message' => 'Tarjeta no encontrada'], 404);
        }
        return response()->json(['tarjet' => $tarjet], 200);
    }
    public function update(Request $request, $id)
    {
        $tarjet = Tarjets::find($id);
        if (!$tarjet) {
            return response()->json(['message' => 'Tarjeta no encontrada'], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'required|url',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $tarjet->update($request->all());
        return response()->json(['tarjet' => $tarjet], 200);
    }
    public function updatePartial(Request $request, $id)
    {
        $tarjet = Tarjets::find($id);
        if (!$tarjet) {
            return response()->json(['message' => 'Tarjeta no encontrada'], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'image' => 'sometimes|url',
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $tarjet->update($request->all());
        return response()->json(['tarjet' => $tarjet], 200);
    }
    public function destroy($id)
    {

        $tarjet = Tarjets::find($id);

        if (!$tarjet) {
            return response()->json(['message' => 'Tarjeta no encontrada'], 404);
        }
        
        $user = Auth::user();
        if ($tarjet->user_id !== $user->id && $user->role !== 'admin') {
            return response()->json(['message' => 'No autorizado'], 404);
        }
        $tarjet->delete();
        return response()->json(['message' => 'Tarjeta eliminada'], 200);


    }
    public function getByCategory($categoryId)
    {
        $tarjets = Tarjets::where('category_id', $categoryId)->get();

        return response()->json($tarjets);
    }
    public function myCards()
    {
        $tarjets = Tarjets::where('user_id', Auth::id())->get();

        return response()->json([
            'message' => 'Tus tarjetas',
            'data' => $tarjets
        ]);
    }

}
