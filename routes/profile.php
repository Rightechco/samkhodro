<?php

use \App\Http\Controllers\Profile\DashboardController;
use \App\Http\Controllers\Profile\TicketController;
use \App\Http\Controllers\Profile\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Profile\OrderController;
use App\Http\Controllers\Profile\AppointmentController;

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

Route::get('/logout',  [DashboardController::class, 'logout']);
Route::put('/change-user-info',  [DashboardController::class, 'ChangeUserInfo']);
Route::get('/',  [DashboardController::class, 'profile']);
Route::get('/like',  [DashboardController::class, 'like']);
Route::get('/order',  [DashboardController::class, 'order']);
Route::post('/newOrder',  [OrderController::class, 'storeOrder']);
Route::get('/appointment',  [DashboardController::class, 'appointment']);
Route::post('/newAppointment',  [AppointmentController::class, 'storeAppointment']);
Route::get('/comment',  [DashboardController::class, 'comment']);
Route::get('/personal-info',  [DashboardController::class, 'personalInfo']);
Route::post('/change-all-user-info',  [DashboardController::class, 'ChangeAllUserInfo']);
Route::post('/check-code',  [DashboardController::class, 'checkCode']);
Route::post('/check-email',  [DashboardController::class, 'checkEmail']);
Route::post('/upload-profile',  [DashboardController::class, 'uploadProfile']);

//////// ticket
Route::group(['prefix' => 'tickets'] , function () {
    Route::get('/', [TicketController::class, 'index']);
    Route::post('/create', [TicketController::class, 'create']);
    Route::post('/get-ticket', [TicketController::class, 'getTicket']);
    Route::post('/close', [TicketController::class, 'close']);
});

////////////////////////////////// gallery
Route::group(['prefix' => 'files'] , function () {
    Route::post('/upload-image', [GalleryController::class , 'upload']);
    Route::get('/get-image', [GalleryController::class , 'getImage']);
});
