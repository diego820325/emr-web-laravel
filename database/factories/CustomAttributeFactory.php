<?php

namespace Database\Factories;

use App\Models\CustomAttributeType;
use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomAttribute>
 */
class CustomAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence(),
            'custom_attribute_type_id' => CustomAttributeType::factory(),
            'section_id' => Section::factory(),
        ];
    }
}
