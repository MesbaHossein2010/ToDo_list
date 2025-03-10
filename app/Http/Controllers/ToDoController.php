<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Task;
use Illuminate\Http\Request;


class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::orderBy('name')->get();
        return view('index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('creat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        Task::create([
            'name' => $name,
            'description' => $description,
        ]);

        return redirect()->route('index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::find($id);
        if (!empty($task)) {
            return view('edit', compact('task'));
        } else {
            return redirect()->route('index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        $task = Task::find($id);
        $task->name = $name;
        $task->description = $description;
        $task->save();

        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect()->route('index');
    }

    public function complete(string $id)
    {
        $task = Task::find($id);
//        dd($task->status);
        $task->status = $task->status == 'completed' ? '2' : '1';
        $task->save();

        return redirect()->route('index');
    }

    public function search(SearchRequest $request)
    {
        $search = $request->input('search');

        // Search tasks in DB where name or description contains the search keyword (case-insensitive)
        $tasks = Task::where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->get(); // Get the results

        return view('index', compact('tasks', 'search'));
    }
}
