<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Models\Charge;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessDailyCharges implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Charge::where('debt_due_date', now()->addDays(7))
            ->chunk(100, function (Collection $charges): void {
                foreach ($charges as $charge) {
                    ChargeCustomer::dispatch($charge);
                }
            })
        ;
    }
}
