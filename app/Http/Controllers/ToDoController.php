<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Category;
use App\Models\Phone;
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
        return view('index', compact('tasks'));
//        $tasks = DB::table("tasks")->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('task.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $categories = $request->input('categories');

        $task = Task::create([
            'name' => $name,
            'description' => $description
        ]);

        $task->categories()->attach($categories);

        return redirect()->route('index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $task = Task::find($id);

        if (!empty($task)) {
            return view('task.edit', compact('task', 'categories'));
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
        $categories = $request->input('categories');

        dd($categories);

        $task = Task::find($id);
        $task->name = $name;
        $task->description = $description;
        $task->categories()->sync($categories);
        $task->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
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

        return redirect()->route('dd');
    }

    public function test()
    {

    }
}
