<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CampaignTransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;


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

Route::prefix('campaigns')->middleware('jwt.verify')->group(function () {
    Route::get('/', [CampaignController::class, 'index']);
    Route::get('/{id}', [CampaignController::class, 'detail']);
    Route::get('/history/{id}', [CampaignController::class, 'history']);
});

Route::prefix('campaigntransactions')->middleware('jwt.verify')->group(function () {
    Route::get('/{id}', [CampaignTransactionController::class, 'index']);
    Route::get('/detail/{id}', [CampaignTransactionController::class, 'detail']);
});

Route::prefix('users')->middleware('jwt.verify')->group(function () {
    Route::get('/', [UserController::class, 'me']);
    Route::get('/profile', [UserController::class, 'profile']);
});
Route::prefix('donate')->middleware('jwt.verify')->group(function () {
    route::post('/', [DonationController::class, 'makeDonation']);
});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me'])->middleware('jwt.verify');
});
