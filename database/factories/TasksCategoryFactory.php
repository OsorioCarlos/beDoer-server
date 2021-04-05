<?php

namespace Database\Factories;

use App\Models\TasksCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class TasksCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TasksCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'task_id' =>  random_int(1, 100),
            'category_id' => random_int(1, 3)
        ];
    }
}
