<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EtudiantController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post("login", [AuthController::class, "login"]);
Route::apiResource('etudiants', EtudiantController::class)->only('index', 'show');
Route::middleware("auth")->group(
    function () {
        Route::get("logout", [AuthController::class, "logout"]);
        Route::get("refresh", [AuthController::class, "refresh"]);
        Route::apiResource('etudiants', EtudiantController::class)->only('store', 'destroy');
    }
);
