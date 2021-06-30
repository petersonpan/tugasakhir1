<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'username' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make("r3wr1t1ng"), // password
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
