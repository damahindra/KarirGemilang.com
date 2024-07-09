<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Employer;

class JobFactory extends Factory
{
    use WithFaker;
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
        $employer = Employer::first();
        return [
            'employer_id' => $employer->employer_id,
            'job_title' => $this->faker->jobTitle,
            'apply_before' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'exp_level' => $this->faker->randomElement(['Entry', 'Intermediate', 'Senior']),
            'job_description' => $this->faker->paragraph,
            'location_type' => $this->faker->randomElement(['remote', 'office']),
            'job_location' => $this->faker->city,
            'prerequisites' => $this->faker->sentence,
            'total_applicants' => $this->faker->numberBetween(0, 100),
        ];
    }
}
