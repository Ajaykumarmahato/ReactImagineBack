<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::prefix('free')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register-user', [AuthController::class, 'registerUser'])->name('registerUser');
    Route::get('verify-email/{email}/{id}', [AuthController::class, 'verifyEmail'])->name('verifyEmail');
});
Route::middleware(['auth:api'], function () {
});
