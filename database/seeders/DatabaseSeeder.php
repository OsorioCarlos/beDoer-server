<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

use App\Models\Category;
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
        State::create(['id' => 1, 'name' => 'not state']);
        State::create(['id' => 2, 'name' => 'to do']);
        State::create(['id' => 3, 'name' => 'doing']);
        State::create(['id' => 4,'name' => 'done']);

        Role::create(['name' => 'Scrum Master']);
        Role::create(['name' => 'Product Owner']);
        Role::create(['name' => 'Developer']);

        Tag::factory(5)->create();
        Category::factory(5)->create();

        User::create([
            // 'id' => 1,
            'name' => 'Joel',
            'email' => 'joel@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('1234567')
        ]);
        User::factory(10)->create()->each(function ($user) {
            $number_tasks = rand(1, 11);

            for ($i=0; $i < $number_tasks; $i++) {
                $user->tasks()->save(Task::factory()->make());
            }
        });

        Team::factory(5)->create()->each(function ($team) {
            $number_tasks = rand(1, 11);

            for ($i=0; $i < $number_tasks; $i++) {
                $team->tasks()->save(Task::factory()->make());
            }

            $team->users()->attach($this->array(rand(2, 11)));
        });
    }

    public function array($max)
    {
        $values = [];

        for ($i=2; $i <= $max; $i++) {
            $values[] = $i;
        }

        return $values;
    }
}
