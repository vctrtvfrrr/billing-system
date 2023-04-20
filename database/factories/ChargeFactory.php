<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Charge>
 */
class ChargeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'debt_id'       => $this->faker->randomNumber(4),
            'name'          => $this->faker->name(),
            'government_id' => $this->faker->cpf(false),
            'email'         => $this->faker->safeEmail(),
            'debt_amount'   => $this->faker->randomFloat(2, 100, 10000),
            'debt_due_date' => now()->addDays(7),
        ];
    }
}
