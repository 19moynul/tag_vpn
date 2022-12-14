<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\PremiumSubscriptionController;
use App\Http\Controllers\Api\ServerController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::POST('registration',[AuthController::class,'register']);
Route::POST('login',[AuthController::class,'login']);
Route::post('social/login', [AuthController::class, 'socialLogin']);
Route::POST('forgot-password/send-otp',[AuthController::class,'sendForgotPasswordOtp']);
Route::POST('forgot-password/verify-otp',[AuthController::class,'verifyForgotPassword']);
Route::POST('forgot-password/reset-password',[AuthController::class,'resetPassword']);
Route::POST('forgot-password/reset-password',[AuthController::class,'resetPassword']);

Route::middleware(['jwtauth'])->group(function(){
    Route::POST('change-password',[AuthController::class,'changePassword']);
    Route::GET('premium-subscription/list',[PremiumSubscriptionController::class,'list']);
    Route::GET('premium-subscription/buy/{sbscription_id}',[PremiumSubscriptionController::class,'buySubscription']);
    Route::get('logout', [HomeController::class, 'logout'])->name('logout');
    Route::get('home', [HomeController::class, 'home'])->name('home');
    Route::get('server/list', [ServerController::class, 'serverList'])->name('serverList');
    Route::get('server/details/{id}', [ServerController::class, 'serverDetails'])->name('serverDetails');
});

