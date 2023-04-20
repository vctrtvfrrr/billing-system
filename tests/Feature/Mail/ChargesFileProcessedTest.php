<?php

declare(strict_types=1);

namespace Tests\Feature\Mail;

use App\Mail\ChargesFileProcessed;
use App\Models\Invoice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChargesFileProcessedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function mailable_content(): void
    {
        $invoice = Invoice::factory()->make();

        $mailable = new ChargesFileProcessed($invoice->filename);

        $mailable->assertTo(config('mail.from.address'));
        $mailable->assertHasSubject('Arquivo CSV de cobranças processado');
        $mailable->assertSeeInHtml($invoice->filename);
    }
}
