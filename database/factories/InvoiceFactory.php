<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id'   => Customer::factory(),
            'debt_id'       => $this->faker->randomNumber(4),
            'debt_amount'   => $this->faker->randomFloat(2, 100, 10000),
            'debt_due_date' => now()->addDays(7),
            'paid_at'       => null,
            'filename'      => 'invoices/invoice-'.$this->faker->randomNumber(4).'.pdf',
        ];
    }
}
