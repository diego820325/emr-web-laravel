<?php

namespace Database\Factories;

use App\Models\CustomAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomAttributeOption>
 */
class CustomAttributeOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text' => $this->faker->word(),
            'custom_attribute_id' => CustomAttribute::factory(),
        ];
    }
}
