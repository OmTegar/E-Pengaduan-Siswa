<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Report;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Report::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sender_id' => User::factory()->state(['role_id' => 3]),
            'subject' => $this->faker->sentence,
            'message' => $this->faker->text,
            'status' => $this->faker->randomElement(['terkirim', 'dibaca', 'diproses', 'selesai']),
            'roomType' => $this->faker->randomElement(['public', 'private', 'anonim']),
        ];
    }
}
