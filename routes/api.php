<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
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

    Route::prefix('modules')->group(function () {
        Route::get('', [ModuleController::class, 'get'])->name('get');
    });
});


Route::middleware(['auth:api'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        Route::prefix('categories')->group(function () {
            Route::get('', [CategoryController::class, 'index'])->name('index');
            Route::post('', [CategoryController::class, 'store'])->name('store');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('delete');
            Route::post('search', [CategoryController::class, 'search'])->name('search');
        });
        Route::prefix('roles')->group(function () {
            Route::get('', [RoleController::class, 'index'])->name('index');
            Route::post('', [RoleController::class, 'store'])->name('store');
            Route::post('edit-role-permissions', [RoleController::class, 'editRolePermissions'])->name('editRolePermissions');
            Route::get('delete/{roleId}', [RoleController::class, 'delete'])->name('delete');
            Route::post('search', [RoleController::class, 'search'])->name('search');
        });
        Route::prefix('permissions')->group(function () {
            Route::get('', [PermissionController::class, 'index'])->name('index');
            Route::get('module-permissions', [PermissionController::class, 'getModulePermisson'])->name('getModulePermisson');
            Route::get('module-role-permission/{roleId}', [PermissionController::class, 'moduleRolePermission'])->name('moduleRolePermission');
        });
    });
});
