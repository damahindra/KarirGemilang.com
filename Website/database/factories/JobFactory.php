<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create(); // Create a Faker instance
        return [
            'employer_id' => $faker->randomNumber(),
            'job_title' => $faker->jobTitle,
            'job_description' => $faker->paragraph,
            'prerequisites' => $faker->sentence,
            'job_location' => $faker->city,
            'location_type' => $faker->randomElement(['remote', 'office']),
            'job_location' => $faker->address,
            'exp_level' => $faker->randomElement(['Entry', 'Intermediate', 'Senior']),
            'apply_before' => $faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'total_applicants' => $faker->numberBetween(0, 100),
        ];
    }
}
