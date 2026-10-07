<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\CreditoController;

Route::apiResource('products', ProductController::class);

Route::apiResource('clientes', ClienteController::class);

Route::apiResource('creditos', CreditoController::class);