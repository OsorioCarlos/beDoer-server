<?php

namespace Database\Factories;

use App\Models\TasksTag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TasksTagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TasksTag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'task_id' => random_int(1, 10),
            'tag_id' => random_int(1, 10)
        ];
    }
}
