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
        \App\Models\User::factory(10)->create();
        \App\Models\State::factory(10)->create();
        \App\Models\Role::factory(10)->create();
        \App\Models\Team::factory(10)->create();
        \App\Models\Task::factory(10)->create();
        \App\Models\Member::factory(10)->create();
        \App\Models\MemberTask::factory(10)->create();
        \App\Models\TaskCategory::factory(10)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Tag::factory(10)->create();
        \App\Models\TagTask::factory(10)->create();

    }
}
