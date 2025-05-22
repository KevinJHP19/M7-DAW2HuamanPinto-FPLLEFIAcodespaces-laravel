<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\pets;
use App\Http\Resources\petsResource;
use App\Http\Requests\StorepetsRequest;


class PetsController extends Controller
{
    //
    public function index()
    {
        $pets = pets::all();
        return response()->json(['pets' => $pets], 200);
    }
    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'image' => 'required|url',
            'description' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $pet = pets::create([
            'name' => $request->get('name'),
            'image' => $request->file('image')->store('pets', 'public'),
            'description' => $request->get('description'),
            'user_id' => Auth::id(), //añadimos al ususario que lo ha creado
        ]);
        return response()->json([
            'message' => 'Pet created successfully',
            'pet' => $pet,
        ], 201);
    }
    public function show($id)
    {
        $pet = pets::find($id);
        if (!$pet) {
            return response()->json([
                'message' => 'Pet not found',
            ], 404);
        }
        return response()->json([
            'message' => 'Pet retrieved successfully',
            'data' => new petsResource($pet),
        ], 200);
    }
    public function update(Request $request, $id)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $pet = pets::find($id);
        if (!$pet) {
            return response()->json([
                'message' => 'Pet not found',
            ], 404);
        }
        $pet->name = $request->get('name');
        if ($request->hasFile('image')) {
            $pet->image = $request->file('image')->store('pets', 'public');
        }
        $pet->description = $request->get('description');
        $pet->save();
        return response()->json([
            'message' => 'Pet updated successfully',
            'data' => new petsResource($pet),
        ], 200);
    }
    public function destroy($id)
    {
        $pet = pets::find($id);
        if (!$pet) {
            return response()->json([
                'message' => 'Pet not found',
            ], 404);
        }
        $pet->delete();
        return response()->json([
            'message' => 'Pet deleted successfully',
        ], 200);
    }
    public function updatePartial(Request $request, $id)
    {
        $pet = pet::find($id);
        if(!$pet){
            return response()->json(['message' => 'Pet not found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'string|max:255',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        $pet->update($request->all());
        return response()->json([
            'pet' => $pet
        ], 200);

    }
    public function mypets()
    {
        $pets = pets::where('user_id', Auth::id())->get();
        return response()->json([
            'message' => 'Tus mascotas',
            'data' =>$pets
        ]);

    }
    public function getmypet($id)
    {
        $pet = pets::where('user_id', Auth::id())->find($id);
        if (!$pet) {
            return response()->json([
                'message' => 'Pet not found',
            ], 404);
        }
        return response()->json([
            'message' => 'Pet retrieved successfully',
            'data' => new petsResource($pet),
        ], 200);
    }
    public function updatemypet(Request $request, $id)
    {
        $pet = pets::where('user_id', Auth::id())->find($id);
        if (!$pet) {
            return response()->json([
                'message' => 'Pet not found',
            ], 404);
        }
        $validator = validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $pet->name = $request->get('name');
        if ($request->hasFile('image')) {
            $pet->image = $request->file('image')->store('pets', 'public');
        }
        $pet->description = $request->get('description');
        $pet->save();
        return response()->json([
            'message' => 'Pet updated successfully',
            'data' => new petsResource($pet),
        ], 200);
    }
    public function updatePartialmypet(Request $request, $id)
    {
        $pet = pets::where('user_id', Auth::id())->find($id);
        if (!$pet) {
            return response()->json([
                'message' => 'Pet not found',
            ], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:100',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $pet->update($request->all());
        return response()->json([
            'pet' => $pet
        ], 200);

    }
    public function destroymypet($id)
    {
        $pet = pets::where('user_id', Auth::id())->find($id);
        if (!$pet) {
            return response()->json([
                'message' => 'Pet not found',
            ], 404);
        }
        $pet->delete();
        return response()->json([
            'message' => 'Pet deleted successfully',
        ], 200);
    }
}
