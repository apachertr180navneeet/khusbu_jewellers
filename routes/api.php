<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    UserController,
    ExicutiveController,
    ContactController,
    AuthController,
    OrderController

};

Route::get('/splash-screen', [AuthController::class, 'splashScreens']);
Route::get('/timezones', [AuthController::class, 'getTimeZones']);
Route::post('/contact', [ContactController::class, 'submitContact']);

Route::group(['prefix'=>'auth'], function(){
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('jwt.verify')->group(function() {
    Route::post('/send-phone-otp', [AuthController::class, 'sendPhoneOtp']);
    Route::post('/verify-phone-otp', [AuthController::class, 'verifyPhoneOtp']);
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    Route::post('/update-profile', [AuthController::class, 'updateProfile']);     
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::delete('/delete-account', [AuthController::class, 'deleteAccount']);
    Route::get('/dashboard', [ExicutiveController::class, 'dashboard']);
    Route::get('/order/list', [ExicutiveController::class, 'orderList']);
    Route::post('/order/detail', [ExicutiveController::class, 'orderdetail']);

    // Create Order Api
    Route::post('/create/order/type', [OrderController::class, 'orderType']);
    Route::post('/create/order/product/detail', [OrderController::class, 'productDetail']);
    Route::post('/get/costomer', [OrderController::class, 'getCustomer']);
    Route::get('/get/product-founder', [OrderController::class, 'getProductFounder']);
    Route::post('/costomer/detail', [OrderController::class, 'customerDetail']);
    Route::post('/payment/detail', [OrderController::class, 'paymentDetail']);
    Route::post('/product/delete', [OrderController::class, 'productDelete']);
    Route::post('/product/add/image', [OrderController::class, 'productAddImage']);
    Route::post('/product/delete/image', [OrderController::class, 'productDeleteImage']);  
});
