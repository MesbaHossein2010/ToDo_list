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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @noinspection PhpUndefinedFieldInspection
     */
    public function index()
    {
        $user = Auth::user();

        $query = Task::whereNull('deleted_at');

        // If user is logged in, prioritize their tasks
        if ($user) {
            $query->orderByRaw("CASE WHEN user_id = ? THEN 0 ELSE 1 END", [$user->id]);
            $user = Auth::user()->username;
        }

        // Always order by name
        $tasks = $query->orderBy('name')->get();

        return view('index', compact('tasks', 'user'));
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
            'description' => $description,
            'user_id' => Auth::id()
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $categories = $request->input('categories');

        $task = Task::find($id);
        $task->name = $name;
        $task->description = $description;
        $task->categories()->sync($categories);
        $task->save();

        return redirect()->route('index');
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
        $user = Auth::user();

        $query = Task::whereNull('deleted_at')
            ->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });

        // If user is logged in, prioritize their tasks in search results too
        if ($user) {
            $query->orderByRaw("CASE WHEN user_id = ? THEN 0 ELSE 1 END", [$user->id]);
            $user = Auth::user()->username;
        }

        $tasks = $query->orderBy('name')->get();

        return view('index', compact('tasks', 'user', 'search'));
    }

    public function d()
    {
        Task::query()->truncate();
        Category::query()->truncate();
        User::query()->truncate();
        DB::table('category_task')->truncate();

        return redirect()->route('index');
    }

    public function test()
    {

    }
}
