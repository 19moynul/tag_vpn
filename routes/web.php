<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ChangePasswordController;
use App\Http\Controllers\admin\ForgotPasswordController;
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
    Route::get('email-form', [ForgotPasswordController::class, 'emailForm']);
    Route::post('send-email', [ForgotPasswordController::class, 'sendForgotPasswordOtp'])->name('reset-password.send-email');
    Route::post('verify-otp', [ForgotPasswordController::class, 'verifyForgotPassword'])->name('reset-password.verify-otp');
    Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset-password.reset');

    Route::get('change-password', [ChangePasswordController::class, 'changePasswordForm'])->name('password.form');
    Route::post('change-password/change', [ChangePasswordController::class, 'changePassword'])->name('password.change');


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
        Route::get('/premium-sub-to-user/change/status/{id}/{status}', [PremiumSubscriptionToUserController::class, 'changeStatus'])->name('user_subscription.change_status');
        Route::get('/premium-sub-to-user/add', [PremiumSubscriptionToUserController::class, 'indexAddPremiumSubToUser'])->name('indexAddPremiumSubToUser');
        Route::post('/premium-sub-to-user/store', [PremiumSubscriptionToUserController::class, 'storePremiumSubToUser'])->name('storePremiumSubToUser');
        Route::get('/premium-sub-to-user/edit/{id}', [PremiumSubscriptionToUserController::class, 'indexEditPremiumSubToUser']);
        Route::post('/premium-sub-to-user/update', [PremiumSubscriptionToUserController::class, 'updatePremiumSubToUser'])->name('updatePremiumSubToUser');
        Route::get('/premium-sub-to-user/delete/{id}', [PremiumSubscriptionToUserController::class, 'deletePremiumSubToUser'])->name('deletePremiumSubToUser');


        Route::get('user/create', [AdminController::class, 'create'])->name('user.create');
        Route::post('user/store', [AdminController::class, 'store'])->name('user.store');
        Route::get('user/list', [AdminController::class, 'list'])->name('user.list');
        Route::get('user/edit/{id}', [AdminController::class, 'edit'])->name('user.edit');
        Route::get('user/delete/{id}', [AdminController::class, 'delete'])->name('user.delete');

    });
});
