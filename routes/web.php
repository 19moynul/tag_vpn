<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Theme\DashboardController;
use App\Http\Controllers\PremiumSubscriptionController;
use App\Http\Controllers\PremiumSubscriptionToUserController;

Route::get('/cache-clear', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    return 'Cache is cleared';
});

Route::get('/pass', [LoginController::class, 'pass'])->name('pass');
Route::group(['prefix' => 'admin'], function () {
    //----- Admin Auth -----
    Route::get('/login', [LoginController::class, 'adminLoginIndex'])->name('admin.login.form');
    Route::post('/login', [LoginController::class, 'adminLogin'])->name('adminLogin');

    Route::group([
        'middleware' => ['admin_auth']
    ], function () {
        Route::get('/dashboard', [DashboardController::class, 'dashboard']);
        Route::get('/logout', [LoginController::class, 'adminLogout'])->name('logout');

        // Premium Subscription
        Route::get('/premium-subscription', [PremiumSubscriptionController::class, 'index'])->name('indexPremiumSubscription');
        Route::get('/premium-subscription/add', [PremiumSubscriptionController::class, 'indexAddPremiumSubscription'])->name('indexAddPremiumSubscription');
        Route::post('/premium-subscription/store', [PremiumSubscriptionController::class, 'storePremiumSubscription'])->name('storePremiumSubscription');
        Route::get('/premium-subscription/edit/{id}', [PremiumSubscriptionController::class, 'indexEditPremiumSubscription']);
        Route::post('/premium-subscription/update', [PremiumSubscriptionController::class, 'updatePremiumSubscription'])->name('updatePremiumSubscription');
        Route::get('/premium-subscription/delete/{id}', [PremiumSubscriptionController::class, 'deletePremiumSubscription'])->name('deletePremiumSubscription');


        // Premium Subscription To User
        Route::get('/premium-sub-to-user', [PremiumSubscriptionToUserController::class, 'index'])->name('indexPremiumSubToUser');
        Route::get('/premium-sub-to-user/add', [PremiumSubscriptionToUserController::class, 'indexAddPremiumSubToUser'])->name('indexAddPremiumSubToUser');
        Route::post('/premium-sub-to-user/store', [PremiumSubscriptionToUserController::class, 'storePremiumSubToUser'])->name('storePremiumSubToUser');
        Route::get('/premium-sub-to-user/edit/{id}', [PremiumSubscriptionToUserController::class, 'indexEditPremiumSubToUser']);
        Route::post('/premium-sub-to-user/update', [PremiumSubscriptionToUserController::class, 'updatePremiumSubToUser'])->name('updatePremiumSubToUser');
        Route::get('/premium-sub-to-user/delete/{id}', [PremiumSubscriptionToUserController::class, 'deletePremiumSubToUser'])->name('deletePremiumSubToUser');

        
    });
});