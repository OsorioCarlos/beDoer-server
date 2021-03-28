<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\TasksCategory;
use App\Models\TasksMember;
use App\Models\TasksTag;
use App\Models\Category;
use App\Models\Member;
use App\Models\Role;
use App\Models\State;
use App\Models\Tag;
use App\Models\Task;
use App\Models\Team;
use App\Models\User;

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

        User::create([
            'id' => 1,
            'name' => 'Joel',
            'email' => 'joel@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('159'),
            // 'deleted' => 'false',
            'remember_token' => Str::random(10)
        ]);

        State::create([
            'id' => 1,
            'name' => 'not state'
        ]);

        State::create([
            'id' => 2,
            'name' => 'to do'
        ]);

        State::create([
            'id' => 3,
            'name' => 'doing'
        ]);

        State::create([
            'id' => 4,
            'name' => 'done'
        ]);

        User::factory(10)->create();
        Role::factory(10)->create();
        Team::factory(10)->create();
        Member::factory(10)->create();
        Task::factory(10)->create();
        Category::factory(10)->create();
        Tag::factory(10)->create();
        TasksMember::factory(10)->create();
        TasksTag::factory(10)->create();
        TasksCategory::factory(10)->create();
    }
}
