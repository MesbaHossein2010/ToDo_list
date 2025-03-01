<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreRequest;
use Illuminate\Http\Request;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = $request->session()->get('tasks');
        $tasks = collect($tasks)->sortBy('name');
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

        if ($request->session()->has('tasks')) {
            $id = count($request->session()->get('tasks')) + 1;
        } else {
            $id = 1;
        }

        $task = ['id' => $id, 'name' => $name, 'description' => $description, 'status' => 0];

        $request->session()->push('tasks', $task);
        return redirect()->route('index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        $tasks = $request->session()->get('tasks');
        foreach ($tasks as $task) {
            if ($task['id'] == $id) {
                return view('edit', compact('task'));
            }
        }
        return redirect()->route('index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $tasks = $request->session()->get('tasks');

        foreach ($tasks as &$task) {
            if ($task['id'] == $id) {
                $task['name'] = $name;
                $task['description'] = $description;
            }
        }

        $request->session()->forget('tasks');
        $request->session()->put('tasks', $tasks);

        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $DTask = null;
        $tasks = $request->session()->get('tasks');

        foreach ($tasks as $task) {
            if ($task['id'] == $id) {
                $DTask = array_search($task, $tasks);
            }
        }

        $request->session()->forget('tasks');
        unset($tasks[$DTask]);
        $request->session()->put('tasks', $tasks);
        return redirect()->route('index');

    }

    public function complete(string $id, Request $request)
    {
        $tasks = $request->session()->get('tasks');

        foreach ($tasks as &$task) {
            if ($task['id'] == $id) {
                if ($task['status'] == 1) {
                    $task['status'] = 0;
                } else {
                    $task['status'] = 1;
                }
            }
        }

        $request->session()->forget('tasks');
        $request->session()->put('tasks', $tasks);

        return redirect()->route('index');
    }

    public function search(SearchRequest $request)
    {
        $tasks = $request->session()->get('tasks');
        $search = $request->input('search');
        $sr = true;

        $tasks = array_filter($tasks, function ($task) use ($search) {
            $InSearch = null;
            if (stripos($task['name'], $search)) {
                return true;
            } else {
                if (stripos($task['description'], $search)) {
                    return true;
                }else{
                    return false;
                }
            }
        });

        return view('index', compact('tasks', 'sr'));
    }
}
