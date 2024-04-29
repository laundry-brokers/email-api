<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/emails', [App\Http\Controllers\Api\v1\EmailController::class, 'index']);
Route::get('/filterEmails', [App\Http\Controllers\Api\v1\EmailController::class, 'filterWithEmails']);
Route::get('/filterForEmail', [App\Http\Controllers\Api\v1\EmailController::class, 'filterEmail']);
Route::post('/sendEmail', [App\Http\Controllers\Api\v1\EmailController::class, 'sendEmail']);
Route::delete('/deleteEmail', [App\Http\Controllers\Api\v1\EmailController::class, 'delete']);
