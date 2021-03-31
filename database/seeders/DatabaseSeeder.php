<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
// use App\Models\TasksCategory;
// use App\Models\TasksMember;
// use App\Models\TasksTag;
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

        User::create([
            // 'id' => 1,
            'name' => 'Joel',
            'email' => 'joel@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('159'),
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

        Role::factory(3)->create();
        Tag::factory(5)->create();
        Category::factory(5)->create();
        
        User::factory(5)->create()->each(function ($user) {
            $number_tasks = rand(1, 11);

            for ($i=0; $i < $number_tasks; $i++) { 
                $user->tasks()->save(Task::factory()->make());
            }
            
        });

        Team::factory(10)->create()->each(function ($team) {
            $number_tasks = rand(1, 11);

            for ($i=0; $i < $number_tasks; $i++) { 
                $team->tasks()->save(Task::factory()->make());
            }
            
        });

        Member::factory(30)->create();
        
        
        //TasksMember::factory(600)->create();
        //TasksTag::factory(500)->create();
        //TasksCategory::factory(500)->create();
    }
}
