<?php

namespace Database\Factories;

use App\Models\Center;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @extends Factory<Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $center = Center::factory(1)->create();
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'gender' => fake()->randomElement(['male', 'female']),
            'dob' => fake()->date(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'document' => Str::random(8),
            'document_type' => fake()->randomElement(['dni', 'pasaporte', 'nie']),
            'type' => fake()->randomElement(['person', 'company']),
            'center_id' => $center[0]->id,
        ];
    }
}
