<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreChargeRequest;
use App\Jobs\ProcessChargesFile;
use Illuminate\Http\Response;

class ChargeController extends Controller
{
    public function __invoke(StoreChargeRequest $request)
    {
        if (! $request->file('charges')->isValid()) {
            return response()->json(['error' => 'O arquivo enviado não é válido.'], Response::HTTP_BAD_REQUEST);
        }

        $request->file('charges')->store('charge_files');

        ProcessChargesFile::dispatch();

        return response()->json([
            'message' => "A lista de cobrança está sendo processada.\nVocê receberá uma notificação quando o processamento for concluído.",
        ], Response::HTTP_CREATED);
    }
}
