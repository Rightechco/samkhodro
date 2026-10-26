<?php

use \App\Http\Controllers\Home\IndexController;
use \App\Http\Controllers\Home\AuthController;
use \App\Http\Controllers\Home\SingleController;
use \App\Http\Controllers\Home\ArchiveController;
use \App\Http\Controllers\Home\GoogleController;
use \App\Http\Controllers\Home\LikeController;
use \App\Http\Controllers\Home\ViewController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [IndexController::class, 'index']);
Route::get('/tire-warranty-agents', [IndexController::class, 'tireWarrantyAgents'])->name('tire-warranty-agents');
Route::post('/send-sub', [IndexController::class, 'sendSub']);
Route::post('/like', [LikeController::class, 'product']);
Route::post('/send-contact', [IndexController::class, 'sendTicket']);
Route::post('/search', [IndexController::class, 'search']);
Route::get('/page/{PageSlug}', [IndexController::class , 'page']);
Route::get('/faq', [IndexController::class , 'faq']);

Route::get('/form1', [IndexController::class , 'form1']);
Route::post('/form1', [IndexController::class , 'form1post']);
Route::get('/form2', [IndexController::class , 'form2']);
Route::post('/form2', [IndexController::class , 'form2post']);

/////////////////////////////// archive
Route::get('/blogs', [ArchiveController::class , 'blog']);
Route::get('/products', [ArchiveController::class , 'product']);
Route::get('/change/products', [ArchiveController::class , 'changeProduct']);
Route::get('/product/category/{ProductCategorySlug}', [ArchiveController::class , 'categoryProduct']);
Route::get('/change/product/category/{ProductCategorySlug}', [ArchiveController::class , 'changeCategoryProduct']);
Route::get('/blog/category/{BlogCategorySlug}', [ArchiveController::class , 'categoryBlog']);
Route::get('/blog/tag/{BlogTagSlug}', [ArchiveController::class , 'tagBlog']);

/////////////////////////////// single
Route::get('/blog/{BlogSlug}', [SingleController::class , 'blog']);
Route::get('/product/{ProductSlug}', [SingleController::class , 'product']);

///////////////////////////////////////////////////// auth
Route::get('/login', [AuthController::class , 'login'])->name('login');
Route::get('/register', [AuthController::class , 'login'])->name('register');
Route::post('/check-auth', [AuthController::class , 'checkAuth']);
Route::post('/check-code', [AuthController::class , 'checkCode']);
Route::post('/add-user', [AuthController::class , 'addUser']);
Route::post('/enter-auth', [AuthController::class , 'enterAuth']);
Route::post('/change-password', [AuthController::class , 'changePassword']);
Route::post('/check-pass-code', [AuthController::class , 'checkPassCode']);
Route::post('/change-user-password', [AuthController::class , 'changeUserPassword']);

////////////////////////////////////////////////////// google
Route::get('/google-login', [GoogleController::class, 'redirectToProvider']);
Route::get('/callback', [GoogleController::class, 'handleProviderCallback']);
Route::post('/view', [ViewController::class , 'view']);
