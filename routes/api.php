<?php

declare(strict_types=1);

use App\Http\Controllers\ChargeController;
use App\Http\Controllers\ChargeStatusController;
use Illuminate\Support\Facades\Route;

Route::post('/charges', ChargeController::class)->name('charges');
Route::post('/charge-status', ChargeStatusController::class)->name('charge-status');
