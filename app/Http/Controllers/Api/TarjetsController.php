<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Tarjets;
use Illuminate\Support\Facades\Validator;
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
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $tarjet = Tarjets::create($request->all());
        return response()->json(['tarjet' => $tarjet], 201);

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
        $tarjet->delete();
        return response()->json(['message' => 'Tarjeta eliminada'], 200);


    }

}
