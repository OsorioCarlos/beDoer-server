<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->company,
            'description' => $this->faker->text($maxNbChars = 50),
            'expiration_date' => $this->faker->dateTimeThisYear,
            'state_id' =>  $this->faker->numberBetween($min = 10, $max = 20),
            'created_by' =>  $this->faker->numberBetween($min = 10, $max = 20),
            'teamspace' =>  $this->faker->numberBetween($min = 10, $max = 20),
            'is_deleted' => $this->boolean,



        ];
    }
}
