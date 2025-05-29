<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Tarjets;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::with('tarjets')->get(); //opcional
    }
    public function cards()
    {
        return $this->hasMany(Tarjets::class);
    }
    public function store(Request $request)
{
    $request->validate(['name' => 'required|string|max:100']);

    return Category::create($request->all());
}

public function update(Request $request, Category $category)
{
    $request->validate(['name' => 'required|string|max:100']);

    $category->update($request->all());
    return $category;
}

public function destroy(Category $category)
{
    $category->delete();
    return response()->json(['message' => 'Categoria eliminada']);
}
public function getcategoryById($id)
{
    $category = Category::find($id);
    if (!$category) {
        return response()->json(['message' => 'Categoria no encontrada'], 404);
    }
    return response()->json($category);

}
public function patchcategory(Request $request, $id)
{
    $category = Category::find($id);
    if (!$category) {
        return response()->json(['message' => 'Categoria no encontrada'], 404);
    }
    $request->validate(['name' => 'required|string|max:100']);
    $category->update($request->all());
    return response()->json(['message' => 'Categoria actualizada', 'data' => $category]);
}

    //
}
