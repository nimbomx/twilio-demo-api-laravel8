<?php

namespace Database\Factories;

use App\Models\Providers;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProvidersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Providers::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'type' => $this->faker->randomElement(['person' ,'agency']),
            'contracted' => $this->faker->boolean,
            'phone' => '+1 (210) 791-6676', //+1 210 791 6676
            'status' => $this->faker->randomElement(['contacting','talked','scheduled','signed','cancel'])
        ];

    }
}
