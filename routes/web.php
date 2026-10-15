<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/sign-up', [HomeController::class, 'signUp']);
Route::get('/dashboard', [HomeController::class, 'dashboard']);
