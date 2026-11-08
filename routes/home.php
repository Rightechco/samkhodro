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
    Route::post('/user-portal/onboarding', [MobileServiceController::class, 'saveUserOnboarding'])->name('mob.user.onboarding');
    Route::post('/user-portal/profile', [MobileServiceController::class, 'saveUserProfile'])->name('mob.user.profile.save');

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
    Route::match(['get', 'post'], '/complaints/track', [MobileServiceController::class, 'trackComplaint'])->name('mob.complaints.track');
    Route::get('/invoice/{code?}', [MobileServiceController::class, 'showOfficialInvoice'])->name('mob.invoice.show');
    Route::get('/user-portal/invoice/{code?}', [MobileServiceController::class, 'showOfficialInvoice'])->name('mob.user.invoice');
    Route::get('/admin-portal/invoice/{code?}', [MobileServiceController::class, 'showOfficialInvoice'])->name('mob.admin.invoice');
    Route::get('/invoice-sample', [MobileServiceController::class, 'invoiceSample'])->name('mob.invoice-sample');
    Route::get('/tariff', [MobileServiceController::class, 'invoiceSample'])->name('mob.tariff');
    Route::get('/shipping-guide', [MobileServiceController::class, 'shippingGuide'])->name('mob.shipping-guide');
    Route::get('/regulations', [MobileServiceController::class, 'regulations'])->name('mob.regulations');

    // صفحات داینامیک CMS، وبلاگ و سئو
    Route::get('/about', [MobileServiceController::class, 'aboutUs'])->name('mob.about');
    Route::get('/contact', [MobileServiceController::class, 'contactUs'])->name('mob.contact');
    Route::get('/blog', [MobileServiceController::class, 'blogIndex'])->name('mob.blog');
    Route::get('/blog/{slug}', [MobileServiceController::class, 'blogShow'])->name('mob.blog.show');
    Route::get('/page/{slug}', [MobileServiceController::class, 'pageShow'])->name('mob.page.show');

    // عملیات مدیریت ادمین (تنظیمات، منوها، صفحات، وبلاگ و نظرسنجی)
    Route::post('/admin-portal/settings/update', [MobileServiceController::class, 'updateSiteSettings'])->name('mob.admin.settings.update');
    Route::post('/admin-portal/header-menu/store', [MobileServiceController::class, 'storeHeaderMenuItem'])->name('mob.admin.header-menu.store');
    Route::post('/admin-portal/header-menu/{id}/update', [MobileServiceController::class, 'updateHeaderMenuItem'])->name('mob.admin.header-menu.update');
    Route::post('/admin-portal/header-menu/{id}/delete', [MobileServiceController::class, 'deleteHeaderMenuItem'])->name('mob.admin.header-menu.delete');
    Route::post('/admin-portal/pages/store', [MobileServiceController::class, 'storePage'])->name('mob.admin.pages.store');
    Route::post('/admin-portal/pages/{id}/update', [MobileServiceController::class, 'updatePage'])->name('mob.admin.pages.update');
    Route::post('/admin-portal/pages/{id}/delete', [MobileServiceController::class, 'deletePage'])->name('mob.admin.pages.delete');
    Route::post('/admin-portal/blog/store', [MobileServiceController::class, 'storeBlogPost'])->name('mob.admin.blog.store');
    Route::post('/admin-portal/blog/{id}/update', [MobileServiceController::class, 'updateBlogPost'])->name('mob.admin.blog.update');
    Route::post('/admin-portal/blog/{id}/delete', [MobileServiceController::class, 'deleteBlogPost'])->name('mob.admin.blog.delete');
    Route::post('/admin-portal/surveys/campaign/store', [MobileServiceController::class, 'storeSurveyCampaign'])->name('mob.admin.survey-campaign.store');
    Route::post('/admin-portal/surveys/{id}/status', [MobileServiceController::class, 'updateSurveyStatus'])->name('mob.admin.survey.status');
    Route::post('/admin-portal/surveys/{id}/delete', [MobileServiceController::class, 'deleteSurvey'])->name('mob.admin.survey.delete');

// ==================== ENTERPRISE CRM ADVANCED MODULES ====================
Route::get('/admin-portal/orders/export-csv', [MobileServiceController::class, 'exportOrdersCsv'])->name('mob.admin.orders.export-csv');
Route::get('/admin-portal/orders/{code}/timeline', [MobileServiceController::class, 'getOrderTimeline'])->name('mob.admin.orders.timeline');
Route::post('/admin-portal/orders/{code}/timeline/add', [MobileServiceController::class, 'addOrderTimelineEvent'])->name('mob.admin.orders.timeline.add');
Route::get('/admin-portal/orders/{code}/qc', [MobileServiceController::class, 'getOrderQc'])->name('mob.admin.orders.qc.get');
Route::post('/admin-portal/orders/{code}/qc/save', [MobileServiceController::class, 'saveOrderQc'])->name('mob.admin.orders.qc.save');
Route::get('/admin-portal/orders/{code}/photos', [MobileServiceController::class, 'getOrderPhotos'])->name('mob.admin.orders.photos.get');
Route::post('/admin-portal/orders/{code}/photos/add', [MobileServiceController::class, 'addOrderPhoto'])->name('mob.admin.orders.photos.add');
Route::post('/admin-portal/orders/{code}/task/timer', [MobileServiceController::class, 'toggleTechnicianTaskTimer'])->name('mob.admin.orders.task.timer');
Route::post('/admin-portal/orders/{code}/update-status', [MobileServiceController::class, 'updatePortalOrderStatus'])->name('mob.admin.orders.update-status');
Route::post('/admin-portal/sms/send-quick', [MobileServiceController::class, 'sendQuickSms'])->name('mob.admin.sms.send-quick');

// =========================================================================
// REPRESENTATIVES, INTERNAL CHAT, TICKETS & AGENCY MANAGEMENT (ماده ۱۳)
// =========================================================================
Route::get('/representatives', [MobileServiceController::class, 'representatives'])->name('mob.representatives');
Route::get('/agencies', [MobileServiceController::class, 'representatives']);
Route::get('/api/agencies', [MobileServiceController::class, 'agenciesApi']);

Route::get('/tickets', [MobileServiceController::class, 'publicTickets'])->name('mob.tickets');
Route::post('/tickets/store', [MobileServiceController::class, 'storePublicTicket'])->name('mob.tickets.store');
Route::match(['get', 'post'], '/tickets/track', [MobileServiceController::class, 'trackPublicTicket'])->name('mob.tickets.track');

Route::get('/internal-chat/messages', [MobileServiceController::class, 'getChatMessages']);
Route::post('/internal-chat/send', [MobileServiceController::class, 'sendChatMessage']);

Route::post('/admin-portal/agencies/save', [MobileServiceController::class, 'storeAgency']);
Route::post('/admin-portal/agencies/{id}/update', [MobileServiceController::class, 'updateAgency']);
Route::post('/admin-portal/agencies/{id}/delete', [MobileServiceController::class, 'deleteAgency']);
Route::post('/admin-portal/agencies/{id}/toggle-status', [MobileServiceController::class, 'toggleAgencyStatus']);

Route::post('/admin-portal/tickets/{id}/reply', [MobileServiceController::class, 'replyTicket']);
Route::post('/admin-portal/tickets/{id}/status', [MobileServiceController::class, 'updateTicketStatus']);

Route::post('/admin-portal/complaints/{id}/status', [MobileServiceController::class, 'updateComplaintStatus']);
    Route::post('/admin-portal/users/store', [MobileServiceController::class, 'storeUser'])->name('mob.admin.users.store');
    Route::post('/admin-portal/users/{id}/update', [MobileServiceController::class, 'updateUser'])->name('mob.admin.users.update');
    Route::post('/admin-portal/users/{id}/delete', [MobileServiceController::class, 'deleteUser'])->name('mob.admin.users.delete');
    Route::post('/admin-portal/users/{id}/toggle-status', [MobileServiceController::class, 'toggleUserStatus'])->name('mob.admin.users.toggle-status');
Route::post('/admin-portal/profile', [MobileServiceController::class, 'saveUserProfile'])->name('mob.admin.profile.save');

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
