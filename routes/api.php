<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MemberController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("/login", [AuthController::class, "login"]);
Route::post("/register", [AuthController::class, "register"]);

Route::middleware(['jwt.auth'])->group(function () {
    Route::apiResource('members', MemberController::class);
    Route::post("/logout", [AuthController::class, "logout"]);
});
