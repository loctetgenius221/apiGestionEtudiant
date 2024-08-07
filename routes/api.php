<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\EvaluationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post("login", [AuthController::class, "login"]);
Route::middleware("auth")->group(
    function () {
        Route::get("logout", [AuthController::class, "logout"]);
        Route::get("refresh", [AuthController::class, "refresh"]);
        Route::apiResource('etudiants', EtudiantController::class)->only('index', 'show', 'store', 'destroy');
        Route::post('etudiants/{etudiant}', [EtudiantController::class, 'update']);

        Route::post('/evaluations', [EvaluationController::class, 'store']);
        Route::post('/evaluations/{evaluation}', [EvaluationController::class, 'update']);
        Route::delete('/evaluations/{evaluation}', [EvaluationController::class, 'destroy']);
    }
);
