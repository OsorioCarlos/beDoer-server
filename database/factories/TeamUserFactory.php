<?php

namespace Database\Factories;

use App\Models\TeamUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TeamUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' =>  random_int(2, 5),
            'team_id' =>  random_int(2, 10),
            'role_id' =>  random_int(1, 3)
        ];
    }
}
