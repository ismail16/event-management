<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthOtpController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRegistrationController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [AuthController::class, 'loginPage'])->name('auth.login.page');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');


Route::middleware(['auth'])->group(function () {
    /** Route For Setup User Section */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');


    Route::prefix('events')->name('events.')->group(static function () {
        Route::get('', [EventController::class, 'index'])->name('index');
        Route::post('', [EventController::class, 'store'])->name('store');
        Route::get('create', [EventController::class, 'create'])->name('create');

        Route::prefix('{event_id}')->group(static function () {
            Route::put('', [EventController::class, 'update'])->name('update');
            Route::delete('', [EventController::class, 'destroy'])->name('delete');
            Route::get('edit', [EventController::class, 'edit'])->name('edit');
        });
    });
    Route::prefix('participants')->name('participants.')->group(static function () {
        Route::get('', [EventRegistrationController::class, 'index'])->name('index');
        Route::post('{event_id}', [EventRegistrationController::class, 'store'])->name('store');
        Route::get('create', [EventRegistrationController::class, 'create'])->name('create');

        Route::prefix('{participant_id}')->group(static function () {
            Route::put('', [EventRegistrationController::class, 'update'])->name('update');
            Route::delete('', [EventRegistrationController::class, 'destroy'])->name('delete');
            Route::get('edit', [EventRegistrationController::class, 'edit'])->name('edit');
        });
    });
});

//Export EXCEL
Route::get('participants/export/', [ExcelController::class, 'export'])->name('export');
//Export PDF
Route::get('participants/pdf/', [ExcelController::class, 'pdf'])->name('pdf');


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END


////otp
Route::get('/registration/exist', [EventRegistrationController::class, 'exist'])->name('registration.exist');
Route::get('/otp/generate', [AuthOtpController::class,'generate'])->name('otp.generate');
Route::get('/otp/check', [AuthOtpController::class, 'check'])->name('otp.check');
Route::post('/otp/verify', [AuthOtpController::class, 'verify'])->name('otp.verify');
Route::post('/password/reset', [AuthController::class, 'passwordReset'])->name('otp.password.reset');
