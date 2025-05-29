<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PetsController extends Controller
{
    public function index()
    {
        $pets = Pets::all();
        return response()->json(['pets' => $pets], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'image' => 'required|url|max:2048',
            'description' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $pet = new Pets();
        $pet->name = $request->get('name');
        $pet->image = $request->get('image');
        $pet->description = $request->get('description');
        $pet->user_id = Auth::id();
        $pet->save();
        return response()->json([
            'message' => 'Pet created successfully',
            'data' => $pet,
        ], 201);
    }

    public function show($id)
    {
        $pet = Pets::find($id);
        if (!$pet) {
            return response()->json(['message' => 'Pet not found'], 404);
        }
        return response()->json([
            'message' => 'Pet retrieved successfully',
            'data' => $pet,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'image' => 'required|url|max:2048',
            'description' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $pet = Pets::find($id);
        if (!$pet) {
            return response()->json(['message' => 'Pet not found'], 404);
        }
        $pet->name = $request->get('name');
        $pet->image = $request->get('image');
        $pet->description = $request->get('description');
        $pet->save();
        return response()->json([
            'message' => 'Pet updated successfully',
            'data' => $pet,
        ], 200);
    }

    public function destroy($id)
    {
        $pet = Pets::find($id);
        if (!$pet) {
            return response()->json(['message' => 'Pet not found'], 404);
        }
        $pet->delete();
        return response()->json(['message' => 'Pet deleted successfully'], 200);
    }

    public function updatePartial(Request $request, $id)
    {
        $pet = Pets::find($id);
        if (!$pet) {
            return response()->json(['message' => 'Pet not found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:100',
            'image' => 'url|max:2048',
            'description' => 'string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $pet->update($request->only(['name', 'image', 'description']));
        return response()->json(['pet' => $pet], 200);
    }

    public function mypets()
    {
        $pets = Pets::where('user_id', Auth::id())->get();
        return response()->json([
            'message' => 'Tus mascotas',
            'data' => $pets
        ]);
    }

    public function getmypet($id)
    {
        $pet = Pets::where('user_id', Auth::id())->find($id);
        if (!$pet) {
            return response()->json(['message' => 'Pet not found'], 404);
        }
        return response()->json([
            'message' => 'Pet retrieved successfully',
            'data' => $pet,
        ], 200);
    }

    public function updatemypet(Request $request, $id)
    {
        $pet = Pets::where('user_id', Auth::id())->find($id);
        if (!$pet) {
            return response()->json(['message' => 'Pet not found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'image' => 'required|url|max:2048',
            'description' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $pet->name = $request->get('name');
        $pet->image = $request->get('image');
        $pet->description = $request->get('description');
        $pet->save();
        return response()->json([
            'message' => 'Pet updated successfully',
            'data' => $pet,
        ], 200);
    }

    public function updatePartialmypet(Request $request, $id)
    {
        $pet = Pets::where('user_id', Auth::id())->find($id);
        if (!$pet) {
            return response()->json(['message' => 'Pet not found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:100',
            'image' => 'url|max:2048',
            'description' => 'string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $pet->update($request->only(['name', 'image', 'description']));
        return response()->json(['pet' => $pet], 200);
    }

    public function destroymypet($id)
    {
        $pet = Pets::where('user_id', Auth::id())->find($id);
        if (!$pet) {
            return response()->json(['message' => 'Pet not found'], 404);
        }
        $pet->delete();
        return response()->json(['message' => 'Pet deleted successfully'], 200);
    }
}
