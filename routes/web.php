<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\NoteController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\LinkController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\WidgetController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\AskController;
use App\Http\Controllers\Admin\DemandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\AbilityController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\PatternController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AppointmentController;

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

Route::get('/', [DashboardController::class, 'index']);
Route::get('/learn', [DashboardController::class, 'learn']);

////////////////////////////////// gallery
Route::get('/gallery', [GalleryController::class , 'index'])->middleware(['permission:گالری']);
Route::post('/upload-image', [GalleryController::class , 'upload']);
Route::post('/upload-signature/{contract}', [GalleryController::class , 'uploadSignature'])->middleware(['permission:افزودن امضا']);
Route::get('/get-image', [GalleryController::class , 'getImage']);
Route::delete('/gallery/{gallery}/delete', [GalleryController::class , 'deleteImage'])->middleware(['permission:حدف گالری']);

Route::group(['prefix' => 'customer'] , function () {
    Route::get('/', [CustomerController::class, 'index'])->middleware(['permission:مشتریان']);
    Route::get('/create', [CustomerController::class, 'create'])->middleware(['permission:افزودن مشتریان']);
    Route::post('/create', [CustomerController::class, 'store'])->middleware(['permission:افزودن مشتریان']);
    Route::get('/show', [CustomerController::class, 'show'])->middleware(['permission:جزییات مشتریان']);
    Route::get('/{CustomerId}/edit', [CustomerController::class, 'edit'])->middleware(['permission:ویرایش مشتریان']);
    Route::put('/{CustomerId}/edit', [CustomerController::class, 'update'])->middleware(['permission:ویرایش مشتریان']);
    Route::delete('/{CustomerId}/delete', [CustomerController::class, 'delete'])->middleware(['permission:حذف مشتریان']);

    ///////// ticket
    Route::get('/{CustomerId}/ticket', [TicketController::class, 'userIndex'])->middleware(['permission:تیکت']);

    ///////// file
    Route::get('/{CustomerId}/file', [GalleryController::class, 'userIndex'])->middleware(['permission:گالری']);

    //// note
    Route::get('/{CustomerId}/note', [NoteController::class, 'index'])->middleware(['permission:یادداشت']);
    Route::post('/{CustomerId}/note', [NoteController::class, 'store'])->middleware(['permission:افزودن یادداشت']);
    Route::get('/{CustomerId}/note/{note}/edit', [NoteController::class, 'edit'])->middleware(['permission:ویرایش یادداشت']);
    Route::put('/{CustomerId}/note/{note}/edit', [NoteController::class, 'update'])->middleware(['permission:ویرایش یادداشت']);

    ///// event
    Route::get('/{CustomerId}/event', [EventController::class, 'index'])->middleware(['permission:فعالیت ها']);
    Route::post('/{CustomerId}/event', [EventController::class, 'store'])->middleware(['permission:افزودن فعالیت ها']);
    Route::get('/{CustomerId}/event/{event}/edit', [EventController::class, 'edit'])->middleware(['permission:ویرایش فعالیت ها']);
    Route::put('/{CustomerId}/event/{event}/edit', [EventController::class, 'update'])->middleware(['permission:ویرایش فعالیت ها']);
    Route::delete('/{CustomerId}/event/{event}/delete', [EventController::class, 'deleteCustomer'])->middleware(['permission:حذف فعالیت ها']);

});

///// blog
Route::group(['prefix' => 'blog'] , function () {
    Route::get('/', [BlogController::class, 'index'])->middleware(['permission:بلاگ']);
    Route::get('/create', [BlogController::class, 'create'])->middleware(['permission:افزودن بلاگ']);
    Route::post('/create', [BlogController::class, 'store'])->middleware(['permission:افزودن بلاگ']);
    Route::get('/{blog}/edit', [BlogController::class, 'edit'])->middleware(['permission:ویرایش بلاگ']);
    Route::put('/{blog}/edit', [BlogController::class, 'update'])->middleware(['permission:ویرایش بلاگ']);
    Route::get('/{blog}/show', [BlogController::class, 'show'])->middleware(['permission:جزییات بلاگ']);
    Route::delete('/{blog}/delete', [BlogController::class, 'delete'])->middleware(['permission:حذف بلاگ']);
});

///// product
Route::group(['prefix' => 'product'] , function () {
    Route::get('/', [ProductController::class, 'index'])->middleware(['permission:محصول']);
    Route::get('/create', [ProductController::class, 'create'])->middleware(['permission:افزودن محصول']);
    Route::post('/create', [ProductController::class, 'store'])->middleware(['permission:افزودن محصول']);
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->middleware(['permission:ویرایش محصول']);
    Route::put('/{product}/edit', [ProductController::class, 'update'])->middleware(['permission:ویرایش محصول']);
    Route::delete('/{product}/delete', [ProductController::class, 'delete'])->middleware(['permission:حذف محصول']);
});

//////// order
Route::group(['prefix' => 'order'] , function () {
    Route::get('/', [OrderController::class, 'index'])->middleware(['permission:سفارش']);
    Route::get('/{order}/edit', [OrderController::class, 'edit'])->middleware(['permission:ویرایش سفارش']);
    Route::put('/{order}/edit', [OrderController::class, 'update'])->middleware(['permission:ویرایش سفارش']);
    Route::delete('/{order}/delete', [OrderController::class, 'delete'])->middleware(['permission:حذف سفارش']);
    Route::post('/close', [OrderController::class, 'close'])->middleware(['permission:حذف سفارش']);
});

//////// appointment
Route::group(['prefix' => 'appointment'] , function () {
    Route::get('/', [AppointmentController::class, 'index'])->middleware(['permission:نوبت']);
    Route::get('/{appointment}/edit', [AppointmentController::class, 'edit'])->middleware(['permission:ویرایش نوبت']);
    Route::put('/{appointment}/edit', [AppointmentController::class, 'update'])->middleware(['permission:ویرایش نوبت']);
    Route::delete('/{appointment}/delete', [AppointmentController::class, 'delete'])->middleware(['permission:حذف نوبت']);
    Route::post('/close', [AppointmentController::class, 'close'])->middleware(['permission:حذف نوبت']);
});

//////// ticket
Route::group(['prefix' => 'ticket'] , function () {
    Route::get('/', [TicketController::class, 'index'])->middleware(['permission:تیکت']);
    Route::post('/create', [TicketController::class, 'create'])->middleware(['permission:تیکت']);
    Route::post('/get-ticket', [TicketController::class, 'getTicket'])->middleware(['permission:تیکت']);
    Route::post('/close', [TicketController::class, 'close'])->middleware(['permission:بستن تیکت']);
});

//////// note
Route::group(['prefix' => 'note'] , function () {
    Route::get('/', [NoteController::class, 'parent'])->middleware(['permission:یادداشت']);
    Route::post('/', [NoteController::class, 'store'])->middleware(['permission:افزودن یادداشت']);
    Route::get('/{note}/edit', [NoteController::class, 'edit'])->middleware(['permission:ویرایش یادداشت']);
    Route::put('/{note}/edit', [NoteController::class, 'update'])->middleware(['permission:ویرایش یادداشت']);
    Route::delete('/{note}/delete', [NoteController::class, 'delete'])->middleware(['permission:حذف یادداشت']);
});

//////// link
Route::group(['prefix' => 'link'] , function () {
    Route::get('/', [LinkController::class, 'index'])->middleware(['permission:لینک']);
    Route::post('/', [LinkController::class, 'store'])->middleware(['permission:افزودن لینک']);
    Route::get('/{link}/edit', [LinkController::class, 'edit'])->middleware(['permission:ویرایش لینک']);
    Route::put('/{link}/edit', [LinkController::class, 'update'])->middleware(['permission:ویرایش لینک']);
    Route::delete('/{link}/delete', [LinkController::class, 'delete'])->middleware(['permission:حذف لینک']);
});

//////// widget
Route::group(['prefix' => 'widget'] , function () {
    Route::get('/', [WidgetController::class, 'index'])->middleware(['permission:ویجت']);
    Route::post('/', [WidgetController::class, 'change'])->middleware(['permission:افزودن ویجت']);
    Route::get('/create', [WidgetController::class, 'create'])->middleware(['permission:افزودن ویجت']);
    Route::post('/create', [WidgetController::class, 'store'])->middleware(['permission:افزودن ویجت']);
    Route::get('/{widget}/edit', [WidgetController::class, 'edit'])->middleware(['permission:ویرایش ویجت']);
    Route::put('/{widget}/edit', [WidgetController::class, 'update'])->middleware(['permission:ویرایش ویجت']);
    Route::delete('/{widget}/delete', [WidgetController::class, 'delete'])->middleware(['permission:حذف ویجت']);
});

///// event
Route::group(['prefix' => 'event'] , function () {
    Route::get('/', [EventController::class, 'parent'])->middleware(['permission:فعالیت ها']);
    Route::post('/', [EventController::class, 'store'])->middleware(['permission:افزودن فعالیت ها']);
    Route::get('/{event}/edit', [EventController::class, 'edit'])->middleware(['permission:ویرایش فعالیت ها']);
    Route::put('/{event}/edit', [EventController::class, 'update'])->middleware(['permission:ویرایش فعالیت ها']);
    Route::delete('/{event}/delete', [EventController::class, 'delete'])->middleware(['permission:حذف فعالیت ها']);
});

///// role
Route::group(['prefix' => 'role'] , function () {
    Route::get('/', [RoleController::class, 'index'])->middleware(['permission:مقام']);
    Route::post('/', [RoleController::class, 'store'])->middleware(['permission:افزودن مقام']);
    Route::get('/{role}/edit', [RoleController::class, 'edit'])->middleware(['permission:ویرایش مقام']);
    Route::post('/{role}/edit', [RoleController::class, 'update'])->middleware(['permission:ویرایش مقام']);
    Route::delete('/{role}/delete', [RoleController::class, 'delete'])->middleware(['permission:حذف مقام']);
});

//// employee
Route::group(['prefix' => 'employee'] , function () {
    Route::get('/', [EmployeeController::class, 'index'])->middleware(['permission:کارمندان']);
    Route::get('/create', [EmployeeController::class, 'create'])->middleware(['permission:افزودن کارمندان']);
    Route::post('/create', [EmployeeController::class, 'store'])->middleware(['permission:افزودن کارمندان']);
    Route::put('/{EmployeeId}/edit', [EmployeeController::class, 'update'])->middleware(['permission:ویرایش کارمندان']);
    Route::get('/{EmployeeId}/edit', [EmployeeController::class, 'edit'])->middleware(['permission:ویرایش کارمندان']);
    Route::delete('/{EmployeeId}/delete', [EmployeeController::class, 'delete'])->middleware(['permission:حذف کارمندان']);
    Route::get('/show', [EmployeeController::class, 'show'])->middleware(['permission:جزییات کارمندان']);

    ///////// ticket
    Route::get('/{EmployeeId}/ticket', [TicketController::class, 'userIndexEmployee'])->middleware(['permission:تیکت']);

    ///////// file
    Route::get('/{EmployeeId}/file', [GalleryController::class, 'userIndex'])->middleware(['permission:گالری']);

    //// note
    Route::get('/{EmployeeId}/note', [NoteController::class, 'indexEmployee'])->middleware(['permission:یادداشت']);
    Route::post('/{EmployeeId}/note', [NoteController::class, 'store'])->middleware(['permission:افزودن یادداشت']);
    Route::get('/{EmployeeId}/note/{note}/edit', [NoteController::class, 'edit'])->middleware(['permission:ویرایش یادداشت']);
    Route::put('/{EmployeeId}/note/{note}/edit', [NoteController::class, 'update'])->middleware(['permission:ویرایش یادداشت']);

    ///// event
    Route::get('/{EmployeeId}/event', [EventController::class, 'indexEmployee'])->middleware(['permission:فعالیت ها']);
    Route::post('/{EmployeeId}/event', [EventController::class, 'store'])->middleware(['permission:افزودن فعالیت ها']);
    Route::get('/{EmployeeId}/event/{event}/edit', [EventController::class, 'edit'])->middleware(['permission:ویرایش فعالیت ها']);
    Route::put('/{EmployeeId}/event/{event}/edit', [EventController::class, 'update'])->middleware(['permission:ویرایش فعالیت ها']);
    Route::delete('/{EmployeeId}/event/{event}/delete', [EventController::class, 'deleteCustomer'])->middleware(['permission:حذف فعالیت ها']);
});

//// setting
Route::group(['prefix' => 'setting'] , function () {
    Route::get('/seo', [SettingController::class, 'seoIndex'])->middleware(['permission:تنظیمات سئو']);
    Route::post('/seo', [SettingController::class, 'seoUpdate'])->middleware(['permission:تنظیمات سئو']);

    Route::get('/manage', [SettingController::class, 'manageIndex'])->middleware(['permission:تنظیمات سایت']);
    Route::post('/manage', [SettingController::class, 'manageUpdate'])->middleware(['permission:تنظیمات سایت']);

    Route::get('/message', [SettingController::class, 'messageIndex'])->middleware(['permission:تنظیمات پیامک']);
    Route::post('/message', [SettingController::class, 'messageUpdate'])->middleware(['permission:تنظیمات پیامک']);

    Route::get('/script', [SettingController::class, 'scriptIndex'])->middleware(['permission:تنظیمات اسکریپت']);
    Route::post('/script', [SettingController::class, 'scriptUpdate'])->middleware(['permission:تنظیمات اسکریپت']);

    Route::post('/pop-up', [SettingController::class , 'popUp'])->middleware(['permission:تنظیمات سایت']);
});

//////// page
Route::group(['prefix' => 'page'] , function () {
    Route::get('/', [PageController::class , 'index'])->middleware(['permission:برگه ها']);
    Route::delete('/{page}/delete', [PageController::class , 'delete'])->middleware(['permission:حذف برگه ها']);
    Route::put('/{page}/edit', [PageController::class , 'update'])->middleware(['permission:ویرایش برگه ها']);
    Route::get('/{page}/edit', [PageController::class , 'edit'])->middleware(['permission:ویرایش برگه ها']);
    Route::get('/create', [PageController::class , 'create'])->middleware(['permission:افزودن برگه ها']);
    Route::post('/create', [PageController::class , 'store'])->middleware(['permission:افزودن برگه ها']);
});

//////// ask
Route::group(['prefix' => 'ask'] , function () {
    Route::get('/', [AskController::class , 'index'])->middleware(['permission:سوالات متداول']);
    Route::delete('/{ask}/delete', [AskController::class , 'delete'])->middleware(['permission:حذف سوالات متداول']);
    Route::put('/{ask}/edit', [AskController::class , 'update'])->middleware(['permission:ویرایش سوالات متداول']);
    Route::get('/{ask}/edit', [AskController::class , 'edit'])->middleware(['permission:ویرایش سوالات متداول']);
    Route::get('/create', [AskController::class , 'create'])->middleware(['permission:افزودن سوالات متداول']);
    Route::post('/create', [AskController::class , 'store'])->middleware(['permission:افزودن سوالات متداول']);
});

//////// demand
Route::group(['prefix' => 'demand'] , function () {
    Route::get('/', [AskController::class , 'demandIndex'])->middleware(['permission:درخواست مشتریان']);
    Route::delete('/{demand}/delete', [AskController::class , 'deleteDemand'])->middleware(['permission:حذف درخواست مشتریان']);
    Route::get('/{demand}/edit', [AskController::class , 'changeStatus'])->middleware(['permission:درخواست مشتریان']);
});

//////// subscribe
Route::group(['prefix' => 'subscribe'] , function () {
    Route::get('/', [AskController::class , 'subscribeIndex'])->middleware(['permission:درخواست مشتریان']);
    Route::delete('/{subscribe}/delete', [AskController::class , 'subscribeDelete'])->middleware(['permission:حذف درخواست مشتریان']);
});

//////// category
Route::group(['prefix' => 'category'] , function () {
    Route::get('/', [CategoryController::class , 'index'])->middleware(['permission:تاکسونامی']);
    Route::delete('/{category}/delete', [CategoryController::class , 'delete'])->middleware(['permission:تاکسونامی']);
    Route::put('/{category}/edit', [CategoryController::class , 'update'])->middleware(['permission:تاکسونامی']);
    Route::get('/{category}/edit', [CategoryController::class , 'edit'])->middleware(['permission:تاکسونامی']);
    Route::post('/', [CategoryController::class , 'store'])->middleware(['permission:تاکسونامی']);
});

//////// tag
Route::group(['prefix' => 'tag'] , function () {
    Route::get('/', [TagController::class , 'index'])->middleware(['permission:تاکسونامی']);
    Route::delete('/{tag}/delete', [TagController::class , 'delete'])->middleware(['permission:تاکسونامی']);
    Route::put('/{tag}/edit', [TagController::class , 'update'])->middleware(['permission:تاکسونامی']);
    Route::get('/{tag}/edit', [TagController::class , 'edit'])->middleware(['permission:تاکسونامی']);
    Route::post('/', [TagController::class , 'store'])->middleware(['permission:تاکسونامی']);
});

//////// ability
Route::group(['prefix' => 'ability'] , function () {
    Route::get('/', [AbilityController::class , 'index'])->middleware(['permission:تاکسونامی']);
    Route::post('/', [AbilityController::class , 'store'])->middleware(['permission:تاکسونامی']);
    Route::delete('/{ability}/delete', [AbilityController::class , 'delete'])->middleware(['permission:تاکسونامی']);
    Route::put('/{ability}/edit', [AbilityController::class , 'update'])->middleware(['permission:تاکسونامی']);
    Route::get('/{ability}/edit', [AbilityController::class , 'edit'])->middleware(['permission:تاکسونامی']);
});

//////// service
Route::group(['prefix' => 'service'] , function () {
    Route::get('/', [ServiceController::class , 'index'])->middleware(['permission:تاکسونامی']);
    Route::post('/', [ServiceController::class , 'store'])->middleware(['permission:تاکسونامی']);
    Route::delete('/{service}/delete', [ServiceController::class , 'delete'])->middleware(['permission:تاکسونامی']);
    Route::put('/{service}/edit', [ServiceController::class , 'update'])->middleware(['permission:تاکسونامی']);
    Route::get('/{service}/edit', [ServiceController::class , 'edit'])->middleware(['permission:تاکسونامی']);
});

//////// team
Route::group(['prefix' => 'team'] , function () {
    Route::get('/', [TeamController::class , 'index'])->middleware(['permission:تاکسونامی']);
    Route::post('/', [TeamController::class , 'store'])->middleware(['permission:تاکسونامی']);
    Route::delete('/{team}/delete', [TeamController::class , 'delete'])->middleware(['permission:تاکسونامی']);
    Route::put('/{team}/edit', [TeamController::class , 'update'])->middleware(['permission:تاکسونامی']);
    Route::get('/{team}/edit', [TeamController::class , 'edit'])->middleware(['permission:تاکسونامی']);
});

///// sms
Route::group(['prefix' => 'sms'] , function () {
    Route::get('/', [PatternController::class, 'indexSms'])->middleware(['permission:پیامک']);
    Route::post('/', [PatternController::class, 'storeSms'])->middleware(['permission:افزودن پیامک']);
    Route::get('/{pattern}/edit', [PatternController::class, 'editSms'])->middleware(['permission:ویرایش پیامک']);
    Route::put('/{pattern}/edit', [PatternController::class, 'updateSms'])->middleware(['permission:ویرایش پیامک']);
    Route::delete('/{pattern}/delete', [PatternController::class, 'deleteSms'])->middleware(['permission:حذف پیامک']);
});

///// email
Route::group(['prefix' => 'email'] , function () {
    Route::get('/', [PatternController::class, 'indexEmail'])->middleware(['permission:ایمیل']);
    Route::post('/', [PatternController::class, 'storeEmail'])->middleware(['permission:افزودن ایمیل']);
    Route::get('/{pattern}/edit', [PatternController::class, 'editEmail'])->middleware(['permission:ویرایش ایمیل']);
    Route::put('/{pattern}/edit', [PatternController::class, 'updateEmail'])->middleware(['permission:ویرایش ایمیل']);
    Route::delete('/{pattern}/delete', [PatternController::class, 'deleteEmail'])->middleware(['permission:حذف ایمیل']);
});
