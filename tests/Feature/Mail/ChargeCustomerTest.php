<?php

declare(strict_types=1);

namespace Tests\Feature\Mail;

use App\Mail\ChargeCustomer;
use App\Models\Invoice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ChargeCustomerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function mailable_content(): void
    {
        $invoice = Invoice::factory()->create();

        Storage::fake();
        Storage::put(
            $invoice->filename,
            file_get_contents(base_path('tests/data/example_data.csv'))
        );

        $mailable = new ChargeCustomer($invoice);

        $mailable->assertTo($invoice->customer->email);
        $mailable->assertHasSubject('Sua fatura chegou');
        $mailable->assertSeeInHtml($invoice->customer->name);
        $mailable->assertSeeInHtml($invoice->customer->government_id);
        // $mailable->assertHasAttachmentFromStorage($invoice->filename); # Laravel bug
    }
}
