<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\State;
use App\Models\Task;
use App\Models\Team;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        State::Factory(10)->create();
        Role::factory(10)->create();
        Team::factory(10)->create();
        Task::factory(10)->create();
    }
}
