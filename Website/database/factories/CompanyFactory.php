<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    use WithFaker;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company,
            'company_city' => $this->faker->city,
            'company_country' => $this->faker->country,
            'company_benefits' => $this->faker->sentence,
            'company_industry' => $this->faker->word,
            'company_description' => $this->faker->paragraph,
        ];
    }
}
