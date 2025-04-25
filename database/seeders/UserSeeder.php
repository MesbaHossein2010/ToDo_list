<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(){
        User::create([
            'username' => 'MesbaHossein',
            'email' => 's.mebahossein@gmail.com',
            'password' => Hash::make('@h05531n'),
        ]);
        User::factory()->count(10)->create();
    }
}
