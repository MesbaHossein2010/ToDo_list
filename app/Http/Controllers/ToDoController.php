<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::orderBy('name')->where('deleted_at', null)->get();
//        $tasks = DB::table("tasks")->get();
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
            'description' => $description
        ]);

//        DB::table("tasks")->insert([
//            'name' => $name,
//            'description' => $description
//        ]);

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

//        $task = DB::table('tasks')->select('*')->where('id', $id)->get();
//        $task = $task[0];
//        return view('edit', compact('task'));

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

//        DB::table("tasks")->where('id', $id)->update([
//            'name' => $name,
//            'description' => $description
//        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $task = Task::find($id);
        $task->deleted_at = now();
        $task->save();

//        DB::table("tasks")->where('id', $id)->delete();

        return redirect()->back();
    }

    public function complete(string $id)
    {
        $task = Task::find($id);
        $task->status = $task->status == 'completed' ? '2' : '1';
        $task->save();

//        $task = DB::table('tasks')->select('status')->where('id', $id)->get();
//        $task = $task[0]->status == 'completed'? 'not completed': 'completed';
//        DB::table("tasks")->where('id', $id)->update([
//            'status' => "$task"
//        ]);

        return redirect()->route('index');
    }

    public function search(SearchRequest $request)
    {
        $search = $request->input('search');
        $tasks = Task::where('name', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->get();

//        $tasks = DB::table("tasks")->where('name', 'like', '%' . $search . '%')->get();

        return view('index', compact('tasks', 'search'));
    }

    public function d()
    {
        Task::query()->truncate();

        return redirect()->route('index');
    }

    public function test()
    {
        $task = Task::find(1);
        return $task->phone ;
    }
}
