<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReportReciver>
 */
class ReportReciverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'report_id' => Report::factory(),
            'reciver_id' => User::factory()->state(['role_id' => 2]),
        ];
    }
}
