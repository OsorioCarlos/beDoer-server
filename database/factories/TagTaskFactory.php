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
<<<<<<< HEAD
            'tad_id' => $this->faker->randomDigitNotNull,
            'task_id' => $this->faker->randomDigitNotNull,
            'id_delete' => $this->faker->boolean
=======
            'tag_id' =>  random_int(1, 10),
            'task_id' => random_int(1, 10),
>>>>>>> 4fe5c2cd4c6fdca0463cd1ce5a2fc809468318c3
        ];
    }
}
