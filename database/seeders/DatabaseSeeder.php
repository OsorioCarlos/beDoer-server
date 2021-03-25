<?php

namespace Database\Seeders;

<<<<<<< HEAD
use App\Models\Role;
use App\Models\State;
use App\Models\Team;
use App\Models\User;
=======
>>>>>>> 4fe5c2cd4c6fdca0463cd1ce5a2fc809468318c3
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
        \App\Models\Role::factory(10)->create();
        \App\Models\Team::factory(10)->create();
        \App\Models\Member::factory(10)->create();
        \App\Models\State::factory(10)->create();
        \App\Models\Task::factory(10)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\Tag::factory(10)->create();
        \App\Models\MemberTask::factory(10)->create();
        /* \App\Models\TaskCategory::factory(10)->create(); */
        \App\Models\TagTask::factory(10)->create();

<<<<<<< HEAD
        State::Factory(10)->create();
        Role::factory(10)->create();
        Team::factory(10)->create();

        User::create([
            'name' => 'Joel',
            'email'=> 'joel@test.com',
            'password' => bcrypt('159'),
            'is_deleted' => 'false'
        ]);

        User::factory(10)->create();

=======
>>>>>>> 4fe5c2cd4c6fdca0463cd1ce5a2fc809468318c3
    }
}
