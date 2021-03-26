<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Member;
use App\Models\MemberTask;
use App\Models\Role;
use App\Models\State;
use App\Models\Tag;
use App\Models\TagTask;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\Team;
use App\Models\User;
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
        User::factory(10)->create();
        Role::factory(10)->create();
        Team::factory(10)->create();
        Member::factory(10)->create();
        State::factory(10)->create();
        Task::factory(10)->create();
        Category::factory(10)->create();
        Tag::factory(10)->create();
        MemberTask::factory(10)->create();
        TaskCategory::factory(10)->create();
        TagTask::factory(10)->create();

        State::Factory(3)->create();
        Role::factory(5)->create();
        Team::factory(10)->create();

        User::create([
            'name' => 'Joel',
            'email' => 'joel@test.com',
            'password' => bcrypt('159'),
            'deleted' => 'false'
        ]);

        User::factory(10)->create();
    }
}
