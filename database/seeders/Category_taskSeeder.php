<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Category_taskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 0; $i < Task::all()->count()*4; $i++) {
            DB::table('category_task')->insert([
                'category_id' => rand(1, Category::all()->count()),
                'task_id' => rand(1, Task::all()->count()),
            ]);
        }

        return redirect()->route('index');
    }
}
