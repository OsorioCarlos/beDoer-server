<?php

namespace Database\Factories;

use App\Models\TagTask;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagTaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TagTask::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tag_id' => random_int(1, 10),
            'task_id' => random_int(1, 10)
        ];
    }
}
