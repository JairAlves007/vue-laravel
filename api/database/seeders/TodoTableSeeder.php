<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Seeder;

class TodoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::all();

        $user->each(function($user) {
            $user->todos()->createMany(Todo::factory(10)->make()->toArray());
        });

    }
}
