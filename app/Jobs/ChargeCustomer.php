<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Mail\ChargeCustomer as MailChargeCustomer;
use App\Models\Charge;
use App\Services\InvoiceService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ChargeCustomer implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Charge $charge)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(InvoiceService $invoiceService): void
    {
        $invoice = $invoiceService->handle($this->charge);

        Mail::queue(new MailChargeCustomer($this->charge, $invoice));
    }
}
