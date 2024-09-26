<?php


use App\Http\Controllers\Api\AuthOtpController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\EventRegistrationController;
use App\Http\Controllers\Api\SslCommerzPaymentController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/{event_id}/registration', [EventRegistrationController::class, 'store']);
Route::patch('/{registration_id}/update', [EventRegistrationController::class, 'update']);
Route::get('/registration/update', [EventRegistrationController::class, 'registration']);

// event
Route::get('/events', [EventController::class, 'index']);
Route::get('/event/{event_id}', [EventController::class, 'event']);
Route::get('/events/search', [EventController::class, 'search']);

// payment
Route::post('/pay', [SslCommerzPaymentController::class, 'pay']);

//
Route::post('/registration/exist',[AuthOtpController::class,'exist']);
Route::get('/registration/exist',[AuthOtpController::class,'getExistingRegistration']);
Route::post('/registration/otp',[AuthOtpController::class,'checkOtp']);
