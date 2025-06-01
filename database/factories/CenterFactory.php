<?php

namespace Database\Factories;

use App\Models\Center;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Center>
 */
class CenterFactory extends Factory
{
    protected $model = Center::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company().' '. fake()->randomElement(['Institute', 'Academy', 'School', 'College']),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'logo_url' => fake()->imageUrl(),
            'status' => fake()->randomElement(['pending', 'active', 'suspended']),
            'parent_id' => null
        ];
    }

    public function branch(Center $parentCenter): Factory
    {
        return $this->state(function (array $attributes) use ($parentCenter) {
            return [
                'parent_id' => $parentCenter->id,
            ];
        });
    }


}
