<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Admin\{
    AdminAuthController,
    UserController
};

use App\Http\Controllers\Executive\{
    ExecutiveAuthController,
    CustomerController,
    OrderController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Super Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Guest Routes
    Route::controller(AdminAuthController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('login', 'login')->name('login');
        Route::post('login', 'postLogin')->name('login.post');
        Route::get('forget-password', 'showForgetPasswordForm')->name('forget.password.get');
        Route::post('forget-password', 'submitForgetPasswordForm')->name('forget.password.post');
        Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset.password.get');
        Route::post('reset-password', 'submitResetPasswordForm')->name('reset.password.post');
    });

    // Authenticated Admin Routes
    Route::middleware('admin')->controller(AdminAuthController::class)->group(function () {
        Route::get('dashboard', 'adminDashboard')->name('dashboard');
        Route::get('change-password', 'changePassword')->name('change.password');
        Route::post('update-password', 'updatePassword')->name('update.password');
        Route::get('logout', 'logout')->name('logout');
        Route::get('profile', 'adminProfile')->name('profile');
        Route::post('profile', 'updateAdminProfile')->name('update.profile');
    });

    Route::middleware('admin')->group(function () {
        // Admin Master Route
        foreach (['user','logistic'] as $resource) {
            Route::prefix($resource)->name("$resource.")->group(function () use ($resource) {
                $controller = "App\Http\Controllers\Admin\\" . ucfirst($resource) . "Controller";
                Route::get('/', [$controller, 'index'])->name('index');
                Route::get('all', [$controller, 'getall'])->name('getall');
                Route::post('store', [$controller, 'store'])->name('store');
                Route::post('status', [$controller, 'status'])->name('status');
                Route::delete('delete/{id}', [$controller, 'destroy'])->name('destroy');
                Route::get('get/{id}', [$controller, 'get'])->name('get');
                Route::post('update', [$controller, 'update'])->name('update');
            });
        }
    });

});

// Sale Executive Action
Route::prefix('executive')->name('executive.')->group(function () {
    
    // Guest Routes
    Route::controller(ExecutiveAuthController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('login', 'login')->name('login');
        Route::post('login', 'postLogin')->name('login.post');
        Route::get('forget-password', 'showForgetPasswordForm')->name('forget.password.get');
        Route::post('forget-password', 'submitForgetPasswordForm')->name('forget.password.post');
        Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset.password.get');
        Route::post('reset-password', 'submitResetPasswordForm')->name('reset.password.post');
    });

    // Authenticated Executive Routes
    Route::middleware('executive')->controller(ExecutiveAuthController::class)->group(function () {
        Route::get('dashboard', 'adminDashboard')->name('dashboard');
        Route::get('change-password', 'changePassword')->name('change.password');
        Route::post('update-password', 'updatePassword')->name('update.password');
        Route::get('logout', 'logout')->name('logout');
        Route::get('profile', 'adminProfile')->name('profile');
        Route::post('profile', 'updateAdminProfile')->name('update.profile');
    });

    Route::middleware('executive')->group(function () {
        // Admin Master Route
        foreach (['customer'] as $resource) {
            Route::prefix($resource)->name("$resource.")->group(function () use ($resource) {
                $controller = "App\Http\Controllers\Executive\\" . ucfirst($resource) . "Controller";
                Route::get('/', [$controller, 'index'])->name('index');
                Route::get('all', [$controller, 'getall'])->name('getall');
                Route::post('store', [$controller, 'store'])->name('store');
                Route::post('status', [$controller, 'status'])->name('status');
                Route::delete('delete/{id}', [$controller, 'destroy'])->name('destroy');
                Route::get('get/{id}', [$controller, 'get'])->name('get');
                Route::post('update', [$controller, 'update'])->name('update');
            });
        }

        Route::prefix('order')->name('order.')->controller(OrderController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/add', 'add')->name('add');
        });
    
    });
});

Route::middleware(['auth'])->group(function () {

});



