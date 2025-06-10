<?php

use App\Application\Controllers\ProfilController;
use App\Application\Router\Route;
use App\Application\Controllers\RegisterController;
use App\Application\Controllers\AutherisationController;
Route::get('/register', [RegisterController::class, 'show']);
Route::get('/', [AutherisationController::class, 'show']);
Route::get('/profil', [ProfilController::class, 'show'], true);
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/', [AutherisationController::class,'login']);