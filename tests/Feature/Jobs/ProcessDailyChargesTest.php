<?php

declare(strict_types=1);

namespace Tests\Feature\Jobs;

use App\Jobs\ChargeCustomer;
use App\Jobs\ProcessDailyCharges;
use App\Models\Charge;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class ProcessDailyChargesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function handle_logic(): void
    {
        Queue::fake();

        Charge::factory()->count(3)->create();

        $job = resolve(ProcessDailyCharges::class);
        app()->call([$job, 'handle']);

        Queue::assertPushed(ChargeCustomer::class, 3);
    }
}
