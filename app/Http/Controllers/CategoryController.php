<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatStoreRequest;
use App\Http\Requests\CatUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('name')->where('deleted_at', null)->get();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CatStoreRequest $request)
    {
        $name = $request->input('name');

        Category::create([
            'name' => $name,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        if (!empty($category)) {
            return view('category.edit', compact('category'));
        } else {
            return redirect()->route('index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CatUpdateRequest $request, string $id)
    {
        $name = $request->input('name');

        $category = Category::find($id);
        $category->name = $name;
        $category->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->deleted_at = now();
        $category->tasks()->detach();
        $category->save();
        return redirect()->back();
    }
    public function d()
    {
        Category::query()->truncate();

        return redirect()->route('index');
    }
}
