<?php

declare(strict_types=1);

namespace Tests\Feature\Services;

use App\Models\Charge;
use App\Services\InvoiceService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class InvoiceServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function handle_logic(): void
    {
        Storage::fake();

        $charge = Charge::factory()->create();

        $job = resolve(InvoiceService::class);
        $invoice = app()->call([$job, 'handle'], ['charge' => $charge]);

        Storage::assertExists($invoice->filename);
    }
}
