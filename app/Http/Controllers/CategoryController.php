<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate(['name' => 'required|unique:categories']);
        $category = Category::create($request->only('name'));
        return response()->json(['category' => $category]);
    }

    public function update(Request $request, $id) {
        $request->validate(['name' => 'required|unique:categories,name,' . $id]);
        $category = Category::findOrFail($id);
        $category->update($request->only('name'));
        return response()->json(['category' => $category]);
    }

    public function destroy($id) {
        $category = Category::findOrFail($id);
        $category->delete();
        return response()->json(['success' => true]);
    }
}
