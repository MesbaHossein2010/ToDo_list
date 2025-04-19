<?php

namespace App\Http\Controllers;

use App\Http\Requests\CatStoreRequest;
use App\Http\Requests\CatUpdateRequest;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd(8765432);
        $categories = Category::orderBy('name')->where('deleted_at', null)->get();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tasks = Task::all();
        return view('category.create', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CatStoreRequest $request)
    {
        $name = $request->input('name');
        $tasks = $request->input('tasks');
//        dd($tasks);

        $cat = Category::create([
            'name' => $name,
        ]);

        $cat->tasks()->sync($tasks);
        return redirect()->route('category.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tasks = Task::all();
        $category = Category::find($id);
        if (!empty($category)) {
            return view('category.edit', compact('category', 'tasks'));
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
        $tasks = $request->input('tasks');

        $category = Category::find($id);
        $category->name = $name;
        $category->tasks()->sync($tasks);
        $category->save();

        return redirect()->route('category.index');
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
