<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = $request->session()->get('tasks');
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
    public function store(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');

        if($request->session()->has('tasks')) {
            $id = count($request->session()->get('tasks')) + 1;
        }else{
            $id = 1;
        }

        $task = ['id' => $id, 'name' => $name, 'description' => $description];

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

        foreach($tasks as $task) {
            if ($task['id'] == $id) {
                $task['name'] = $name;
                $task['description'] = $description;
            }
        }

//        dd($tasks);

        session()->forget('tasks');

        session()->push('tasks', $tasks);

        return redirect()->route('index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
