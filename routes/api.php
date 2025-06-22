<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;

Route::get('/', function () {
    return response()->json(['server' => 'ok'], 200);
});

// Public routes
Route::post('/send-email', [EmailController::class, 'sendEmail']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes (admin only)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/emails', [EmailController::class, 'getAllEmails']);
    Route::get('/email/{id}', [EmailController::class, 'getEmailById']);
    Route::put('/email/{id}', [EmailController::class, 'updateEmailStatus']);
    Route::delete('/email/{id}', [EmailController::class, 'deleteEmail']);
    Route::post('/email/reply/{id}', [EmailController::class, 'reply']);
    Route::get('/email/reply/{id}', [EmailController::class, 'getReplyMessage']);
});

