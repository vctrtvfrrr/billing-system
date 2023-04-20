<?php

declare(strict_types=1);

namespace Tests\Feature\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChargeStatusControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function store(): void
    {
        $invoice = Invoice::factory()->create();

        $payload = [
            'debtId'     => $invoice->debt_id,
            'paidAt'     => now(),
            'paidAmount' => $invoice->debt_amount,
            'paidBy'     => $invoice->customer->name,
        ];

        $this
            ->post(route('charge-status'), $payload)
            ->assertNoContent()
        ;

        $invoice->refresh();

        $this->assertDatabaseHas('invoices', [
            'id'      => $invoice->id,
            'paid_at' => $invoice->paid_at,
        ]);
    }
}
