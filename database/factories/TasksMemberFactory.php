<?php

namespace Database\Factories;

use App\Models\TasksMember;
use Illuminate\Database\Eloquent\Factories\Factory;

class TasksMemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TasksMember::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'task_by' => random_int(1, 100),
            'team_user_id' => random_int(1, 60),
        ];
    }
}
