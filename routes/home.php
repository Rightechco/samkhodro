<?php

use \App\Http\Controllers\Home\IndexController;
use \App\Http\Controllers\Home\AuthController;
use \App\Http\Controllers\Home\SingleController;
use \App\Http\Controllers\Home\ArchiveController;
use \App\Http\Controllers\Home\GoogleController;
use \App\Http\Controllers\Home\LikeController;
use \App\Http\Controllers\Home\ViewController;
use \App\Http\Controllers\Home\MobileServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| سام موبایل (mob.taminkanisam.co.ir) - سامانه رسمی خدمات پس از فروش و گارانتی
|--------------------------------------------------------------------------
*/
$registerMobileRoutes = function () {
    Route::get('/', [MobileServiceController::class, 'index'])->name('mob.index');
    
    // ورود، ثبت‌نام و تایید پیامکی (OTP)
    Route::get('/login', [MobileServiceController::class, 'showLogin'])->name('mob.login');
    Route::post('/login/send-otp', [MobileServiceController::class, 'sendOtp'])->name('mob.login.send-otp');
    Route::post('/login/verify-otp', [MobileServiceController::class, 'verifyOtp'])->name('mob.login.verify-otp');
    Route::post('/login/password', [MobileServiceController::class, 'loginPassword'])->name('mob.login.password');
    Route::match(['get', 'post'], '/logout', [MobileServiceController::class, 'logout'])->name('mob.logout');

    // پنل‌های تخصصی سامانه خدمات
    Route::get('/service-portal', [MobileServiceController::class, 'servicePortal'])->name('mob.service-portal');
    Route::get('/user-portal', [MobileServiceController::class, 'userPortal'])->name('mob.user-portal');
    Route::get('/user-portal/{section}', [MobileServiceController::class, 'userPortal'])->name('mob.user-portal.section');
    Route::get('/admin-portal', [MobileServiceController::class, 'adminPortal'])->name('mob.admin-portal');
    Route::get('/admin-portal/{section}', [MobileServiceController::class, 'adminPortal'])->name('mob.admin-portal.section');
    Route::post('/user-portal/store-order', [MobileServiceController::class, 'storeUserOrder'])->name('mob.user.store-order');
    Route::post('/user-portal/order', [MobileServiceController::class, 'storeUserOrder'])->name('mob.user-order.store');
    Route::post('/user-portal/send-ticket', [MobileServiceController::class, 'storeUserTicket'])->name('mob.user.send-ticket');
    Route::post('/user-portal/ticket', [MobileServiceController::class, 'storeUserTicket'])->name('mob.ticket.store');

    // عملیات کارشناسی و ماده ۱۳
    Route::post('/service-portal/send-sms', [MobileServiceController::class, 'sendManualSms'])->name('mob.portal.send-sms');
    Route::post('/service-portal/store', [MobileServiceController::class, 'storeReception'])->name('mob.portal.store');
    Route::post('/service-portal/reception', [MobileServiceController::class, 'storeReception'])->name('mob.reception.store');
    Route::post('/service-portal/{id}/update-status', [MobileServiceController::class, 'updateOrderStatus'])->name('mob.portal.update-status');
    Route::post('/service-portal/{id}/order-part', [MobileServiceController::class, 'orderPart'])->name('mob.portal.order-part');
    Route::post('/service-portal/{id}/complete', [MobileServiceController::class, 'completeService'])->name('mob.portal.complete');
    
    // رهگیری و صفحات عمومی
    Route::get('/track', [MobileServiceController::class, 'trackOrder'])->name('mob.track');
    Route::get('/customer-rights', [MobileServiceController::class, 'customerRights'])->name('mob.customer-rights');
    Route::get('/warranty-terms', [MobileServiceController::class, 'warrantyTerms'])->name('mob.warranty-terms');
    Route::get('/survey', [MobileServiceController::class, 'survey'])->name('mob.survey');
    Route::post('/survey/store', [MobileServiceController::class, 'storeSurvey'])->name('mob.survey.store');
    Route::get('/complaints', [MobileServiceController::class, 'complaints'])->name('mob.complaints');
    Route::post('/complaints/store', [MobileServiceController::class, 'storeComplaint'])->name('mob.complaints.store');
    Route::get('/complaints/track', [MobileServiceController::class, 'trackComplaint'])->name('mob.complaints.track');
    Route::get('/invoice-sample', [MobileServiceController::class, 'invoiceSample'])->name('mob.invoice-sample');
    Route::get('/shipping-guide', [MobileServiceController::class, 'shippingGuide'])->name('mob.shipping-guide');
    Route::get('/regulations', [MobileServiceController::class, 'regulations'])->name('mob.regulations');
};

// شناسایی هوشمند هاست: چنانچه ساب‌دومین mob باشد فقط روت‌های سام موبایل در ریشه لود می‌شوند
$currentHttpHost = isset($_SERVER['HTTP_HOST']) ? strtolower($_SERVER['HTTP_HOST']) : '';
if (strpos($currentHttpHost, 'mob.') === 0) {
    $registerMobileRoutes();
    return;
}

// Subdomain matching برای کلاینت‌هایی که از روتینگ استاندارد لاراول استفاده می‌کنند
Route::domain('mob.taminkanisam.co.ir')->group($registerMobileRoutes);
Route::domain('www.mob.taminkanisam.co.ir')->group($registerMobileRoutes);

// دسترسی مستقیم از طریق پیشوند مسیر اصلی: https://taminkanisam.co.ir/mob
Route::prefix('mob')->group($registerMobileRoutes);

/*
|--------------------------------------------------------------------------
| وب‌سایت اصلی خودرو (taminkanisam.co.ir)
|--------------------------------------------------------------------------
*/
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

/////////////////
