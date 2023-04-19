<?php

declare(strict_types=1);

use App\Http\Controllers\ChargeController;
use Illuminate\Support\Facades\Route;

Route::post('/charges', ChargeController::class)->name('charges');
