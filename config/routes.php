<?php

use App\Application\Router\Route;
use App\Application\Controllers\RegisterController;
use App\Application\Controllers\AutherisationController;
Route::get('/', [RegisterController::class, 'show']);
Route::get('/login', [AutherisationController::class, 'show']);

Route::post('/', [RegisterController::class, 'register']);
Route::post('/login', [AutherisationController::class,'login']);