<?php

declare(strict_types=1);

namespace Tests\Feature\Jobs;

use App\Jobs\ProcessDailyCharges;
use App\Mail\ChargeCustomer;
use App\Models\Customer;
use App\Models\Invoice;
use App\Services\InvoiceService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Mockery\MockInterface;
use Tests\TestCase;

class ChargeCustomerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function handle_logic(): void
    {
        Mail::fake();

        $this->mock(InvoiceService::class, function (MockInterface $mock): void {
            $invoice = Invoice::factory()->create();
            $mock->shouldReceive('handle')
                ->once()
                ->andReturn($invoice)
            ;
        });

        $customer = Customer::factory()->create();

        $job = resolve(ProcessDailyCharges::class, ['customer' => $customer]);
        app()->call([$job, 'handle']);

        Mail::assertQueued(ChargeCustomer::class);
    }
}
