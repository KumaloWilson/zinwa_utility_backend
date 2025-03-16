<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MeterController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\TariffController;
use App\Http\Controllers\API\TokenController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/test', function () {
    return response()->json(['message' => 'API route working']);
});

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify');

// Payment webhook
Route::post('/payments/webhook', [PaymentController::class, 'webhook']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/email/verification-notification', [AuthController::class, 'sendVerificationEmail']);
    Route::post('/phone/verification', [AuthController::class, 'sendPhoneVerification']);
    Route::post('/phone/verify', [AuthController::class, 'verifyPhone']);

    // User profile
    Route::get('/profile', [UserController::class, 'profile']);
    Route::put('/profile', [UserController::class, 'updateProfile']);
    Route::post('/password', [UserController::class, 'changePassword']);

    // Meters
    Route::apiResource('meters', MeterController::class);
    Route::post('/meters/{meter}/validate', [MeterController::class, 'validate']);
    Route::get('/meters/{meter}/consumption', [MeterController::class, 'consumptionHistory']);

    // Tokens
    Route::get('/tokens', [TokenController::class, 'index']);
    Route::get('/meters/{meter}/tokens', [TokenController::class, 'meterTokens']);
    Route::get('/tokens/{token}', [TokenController::class, 'show']);
    Route::post('/tokens/generate', [TokenController::class, 'generate']);
    Route::post('/tokens/verify', [TokenController::class, 'verify']);

    // Payments
    Route::get('/transactions', [PaymentController::class, 'transactions']);
    Route::post('/payments/initiate', [PaymentController::class, 'initiate']);
    Route::get('/payments/verify/{reference}', [PaymentController::class, 'verify']);

    // Tariffs
    Route::get('/tariffs', [TariffController::class, 'index']);
    Route::post('/tariffs/calculate', [TariffController::class, 'calculate']);

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead']);
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead']);

    // Admin routes
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard']);
        Route::get('/users', [AdminController::class, 'users']);
        Route::put('/users/{user}/status', [AdminController::class, 'updateUserStatus']);
        Route::get('/meters', [AdminController::class, 'meters']);
        Route::put('/meters/{meter}/status', [AdminController::class, 'updateMeterStatus']);
        Route::get('/transactions', [AdminController::class, 'transactions']);
        Route::get('/tokens', [AdminController::class, 'tokens']);
        Route::get('/audit-logs', [AdminController::class, 'auditLogs']);
    });
});

