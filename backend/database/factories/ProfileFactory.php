<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Profile;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->first_name,
            'phone'     => $this->faker->phoneNumber,
            'last_name'  => $this->faker->last_name,
            'address'   => $this->faker->address
        ];
    }
}
