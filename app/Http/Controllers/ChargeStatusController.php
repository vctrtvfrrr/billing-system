<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ChargeStatusRequest;
use App\Models\Invoice;

class ChargeStatusController extends Controller
{
    public function __invoke(ChargeStatusRequest $request)
    {
        $input = $request->input();

        /** @var Invoice|null $invoice */
        $invoice = Invoice::where('debt_id', $input['debtId'])->firstOrFail();
        $invoice->paid_at = $input['paidAt'];
        $invoice->save();

        return response()->noContent();
    }
}
