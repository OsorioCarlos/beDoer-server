<?php

namespace Database\Factories;

use App\Models\MemberTask;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberTaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MemberTask::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'member_id' => random_int(1, 10),
            'task_by' => random_int(1, 10),
        ];
    }
}
