<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        if(!User::where("is_admin", 1)->first()){
            User::factory(1)->create();
        }
        return [
            "body" => fake()->text(500),
            "title" => fake()->text(30),
            "user_id" => User::where("is_admin", 1)->first()->id,
        ];
    }
}
