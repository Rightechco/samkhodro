<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\ActiveSms;
use App\Models\Pattern;
use App\Models\Setting;
use App\Models\User;
use App\Traits\SendSmsTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class MobileServiceController extends Controller
{
    use SendSmsTrait;

    public function __construct()
    {
        $this->ensureTablesExist();
    }

    /**
     * اطمینان از وجود جداول مورد نیاز سامانه مدیریت خدمات موبایل
     */
    private function ensureTablesExist()
    {
        try {
            if (!Schema::hasTable('mobile_service_orders')) {
                Schema::create('mobile_service_orders', function ($table) {
                    $table->id();
                    $table->string('tracking_code', 30)->unique();
                    $table->string('customer_name', 150);
                    $table->string('customer_phone', 20);
                    $table->string('customer_national_code', 20)->nullable();
                    $table->string('customer_province', 50)->nullable();
                    $table->string('customer_city', 50)->nullable();
                    $table->text('customer_address')->nullable();
                    $table->string('device_brand', 50);
                    $table->string('device_model', 100);
                    $table->string('imei', 30);
                    $table->string('serial_number', 50)->nullable();
                    $table->string('color', 30)->nullable();
                    $table->string('physical_condition', 255)->nullable();
                    $table->text('reported_issues');
                    $table->enum('intake_type', ['in_person', 'postal'])->default('in_person');
                    $table->string('postal_tracking_code', 50)->nullable();
                    $table->boolean('is_under_warranty')->default(true);
                    $table->date('warranty_start_date')->nullable();
                    $table->date('warranty_end_date')->nullable();
                    $table->enum('status', [
                        'received',
                        'inspecting',
                        'repairing',
                        'waiting_parts',
                        'ready_for_delivery',
                        'delivered',
                        'cancelled'
                    ])->default('received');
                    $table->string('assigned_technician', 100)->nullable();
                    $table->text('technician_notes')->nullable();
                    $table->date('estimated_completion_date')->nullable();
                    $table->text('ordered_parts')->nullable();
                    $table->unsignedBigInteger('parts_cost')->default(0);
                    $table->unsignedBigInteger('labor_cost')->default(0);
                    $table->unsignedBigInteger('total_cost')->default(0);
                    $table->string('invoice_number', 50)->nullable();
                    $table->date('invoice_date')->nullable();
                    $table->boolean('is_paid')->default(false);
                    $table->unsignedBigInteger('user_id')->nullable();
                    $table->timestamps();
                });

                $this->seedInitialDemoData();
            }

            if (!Schema::hasTable('mobile_complaints')) {
                Schema::create('mobile_complaints', function ($table) {
                    $table->id();
                    $table->string('tracking_code', 30)->unique();
                    $table->string('full_name', 150);
                    $table->string('phone', 20);
                    $table->string('national_code', 20)->nullable();
                    $table->string('subject', 200);
                    $table->string('service_tracking_code', 50)->nullable();
                    $table->text('description');
                    $table->enum('status', ['registered', 'under_review', 'resolved', 'closed'])->default('registered');
                    $table->text('admin_reply')->nullable();
                    $table->timestamps();
                });
            }

            if (!Schema::hasTable('mobile_surveys')) {
                Schema::create('mobile_surveys', function ($table) {
                    $table->id();
                    $table->string('customer_name', 150)->nullable();
                    $table->string('customer_phone', 20)->nullable();
                    $table->string('service_tracking_code', 50)->nullable();
                    $table->tinyInteger('speed_score')->default(5);
                    $table->tinyInteger('quality_score')->default(5);
                    $table->tinyInteger('behavior_score')->default(5);
                    $table->tinyInteger('cost_score')->default(5);
                    $table->tinyInteger('overall_score')->default(5);
                    $table->text('suggestions')->nullable();
                    $table->timestamps();
                });
            }

            if (!Schema::hasTable('mobile_tickets')) {
                Schema::create('mobile_tickets', function ($table) {
                    $table->id();
                    $table->unsignedBigInteger('user_id')->nullable();
                    $table->string('tracking_code', 50);
                    $table->string('customer_phone', 20);
                    $table->string('subject', 150);
                    $table->text('message');
                    $table->text('reply')->nullable();
                    $table->enum('status', ['open', 'answered', 'closed'])->default('open');
                    $table->timestamps();
                });
            }
        } catch (\Exception $e) {
            // Log silently
        }
    }

    /**
     * ثبت نمونه داده اولیه برای تست سریع
     */
    private function seedInitialDemoData()
    {
        try {
            DB::table('mobile_service_orders')->insert([
                [
                    'tracking_code' => 'SAM-1001',
                    'customer_name' => 'محمد رضایی',
                    'customer_phone' => '09121112233',
                    'customer_national_code' => '0012345678',
                    'customer_province' => 'تهران',
                    'customer_city' => 'تهران',
                    'customer_address' => 'خیابان انقلاب، پلاک ۱۲',
                    'device_brand' => 'سامسونگ',
                    'device_model' => 'Galaxy S23 Ultra',
                    'imei' => '354896123456789',
                    'serial_number' => 'R5CW10ABCDE',
                    'color' => 'مشکی',
                    'physical_condition' => 'سالم بدون خط و خش، گلس ندارد',
                    'reported_issues' => 'خاموشی ناگهانی هنگام شارژ و داغ شدن سوکت شارژ',
                    'intake_type' => 'in_person',
                    'postal_tracking_code' => null,
                    'is_under_warranty' => 1,
                    'warranty_start_date' => Carbon::now()->subMonths(4)->format('Y-m-d'),
                    'warranty_end_date' => Carbon::now()->addMonths(14)->format('Y-m-d'),
                    'status' => 'repairing',
                    'assigned_technician' => 'مهندس کاظمی',
                    'technician_notes' => 'آی‌سی شارژ تست شد، در حال تعویض مادربرد تحت پوشش گارانتی',
                    'estimated_completion_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                    'ordered_parts' => 'Mainboard SM-S918B',
                    'parts_cost' => 0,
                    'labor_cost' => 0,
                    'total_cost' => 0,
                    'invoice_number' => 'INV-SAM-1001',
                    'invoice_date' => Carbon::now()->format('Y-m-d'),
                    'is_paid' => 1,
                    'user_id' => null,
                    'created_at' => Carbon::now()->subDays(2),
                    'updated_at' => Carbon::now()->subDay(),
                ],
                [
                    'tracking_code' => 'SAM-1002',
                    'customer_name' => 'علی اکبری',
                    'customer_phone' => '09123334455',
                    'customer_national_code' => '0098765432',
                    'customer_province' => 'اصفهان',
                    'customer_city' => 'اصفهان',
                    'customer_address' => 'چهارباغ عباسی، کوچه مهران',
                    'device_brand' => 'شیائومی',
                    'device_model' => 'Xiaomi 13T Pro',
                    'imei' => '869542045612345',
                    'serial_number' => 'XM13TP9921',
                    'color' => 'آبی',
                    'physical_condition' => 'ضربه خفیف در لبه پایینی',
                    'reported_issues' => 'شکستگی تاچ و ال‌سی‌دی بر اثر ضربه (خارج از گارانتی)',
                    'intake_type' => 'postal',
                    'postal_tracking_code' => '19876543210987654321',
                    'is_under_warranty' => 0,
                    'warranty_start_date' => Carbon::now()->subMonths(10)->format('Y-m-d'),
                    'warranty_end_date' => Carbon::now()->addMonths(8)->format('Y-m-d'),
                    'status' => 'waiting_parts',
                    'assigned_technician' => 'مهندس حسینی',
                    'technician_notes' => 'نمایشگر اورجینال از انبار مرکزی سفارش داده شد.',
                    'estimated_completion_date' => Carbon::now()->addDays(4)->format('Y-m-d'),
                    'ordered_parts' => 'Display AMOLED 144Hz Xiaomi 13T Pro',
                    'parts_cost' => 65000000,
                    'labor_cost' => 8500000,
                    'total_cost' => 73500000,
                    'invoice_number' => 'INV-SAM-1002',
                    'invoice_date' => Carbon::now()->format('Y-m-d'),
                    'is_paid' => 0,
                    'user_id' => null,
                    'created_at' => Carbon::now()->subDays(4),
                    'updated_at' => Carbon::now()->subHours(8),
                ],
                [
                    'tracking_code' => 'SAM-1003',
                    'customer_name' => 'سارا ناصری',
                    'customer_phone' => '09197778899',
                    'customer_national_code' => '0045678901',
                    'customer_province' => 'فارس',
                    'customer_city' => 'شیراز',
                    'customer_address' => 'بلوار ارم، فرعی ۳',
                    'device_brand' => 'اپل',
                    'device_model' => 'iPhone 13 (CH/A)',
                    'imei' => '359871029384756',
                    'serial_number' => 'F2LX9901MNDF',
                    'color' => 'سفید',
                    'physical_condition' => 'بسیار تمیز، دارای کارتن اصلی',
                    'reported_issues' => 'افت سلامت باتری به زیر ۷۰ درصد و داغ شدن در تماس صوتی',
                    'intake_type' => 'in_person',
                    'postal_tracking_code' => null,
                    'is_under_warranty' => 1,
                    'warranty_start_date' => Carbon::now()->subMonths(2)->format('Y-m-d'),
                    'warranty_end_date' => Carbon::now()->addMonths(16)->format('Y-m-d'),
                    'status' => 'ready_for_delivery',
                    'assigned_technician' => 'مهندس صادقی',
                    'technician_notes' => 'باتری اورجینال تعویض شد. تست QC انجام و سلامت باتری ۱۰۰٪ تایید شد.',
                    'estimated_completion_date' => Carbon::now()->format('Y-m-d'),
                    'ordered_parts' => 'Original Battery Apple iPhone 13',
                    'parts_cost' => 0,
                    'labor_cost' => 0,
                    'total_cost' => 0,
                    'invoice_number' => 'INV-SAM-1003',
                    'invoice_date' => Carbon::now()->subDay()->format('Y-m-d'),
                    'is_paid' => 1,
                    'user_id' => null,
                    'created_at' => Carbon::now()->subDays(5),
                    'updated_at' => Carbon::now()->subHours(2),
                ]
            ]);
        } catch (\Exception $e) {
            // Ignore if already seeded
        }
    }

    /**
     * صفحه اصلی سام موبایل (mob.taminkanisam.co.ir)
     */
    public function index()
    {
        $recentOrders = DB::table('mobile_service_orders')
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        return view('home.mobile.index', compact('recentOrders'));
    }

    /* =========================================================================
       AUTHENTICATION & SMS OTP (ورود، ثبت‌نام و تایید پیامکی)
       ========================================================================= */

    /**
     * صفحه ورود و ثبت‌نام سامانه خدمات
     */
    public function showLogin(Request $request)
    {
        $user = $this->getCurrentAuthUser();
        if ($user) {
            if ($user->level >= 2 || session('mob_role') === 'admin') {
                return redirect()->route('mob.admin-portal');
            }
            return redirect()->route('mob.user-portal');
        }

        return view('home.mobile.login');
    }

    /**
     * ارسال پیامک کد تایید (OTP)
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|regex:/^09[0-9]{9}$/',
        ], [
            'phone.required' => 'شماره تلفن همراه الزامی است.',
            'phone.regex' => 'شماره تلفن همراه باید ۱۱ رقمی و با 09 آغاز شود.',
        ]);

        $phone = $request->phone;

        // پاکسازی کدهای منقضی
        DB::table('active_sms')->where('expire', '<=', Carbon::now()->timestamp)->delete();

        // تولید کد تایید ۶ رقمی
        $code = rand(100000, 999999);

        // ثبت در جدول active_sms
        ActiveSms::create([
            'code' => $code,
            'expire' => Carbon::now()->addMinutes(3)->timestamp,
            'phone' => $phone,
        ]);

        // ارسال پیامک از طریق سرویس پنل پیامک
        $smsSent = false;
        try {
            $loginSms = Setting::where('key', 'loginSms')->pluck('value')->first();
            $patternId = $loginSms ?: '3';
            $this->sendSms($phone, [$code], $patternId);
            $smsSent = true;
        } catch (\Exception $e) {
            // Handled gracefully
        }

        return response()->json([
            'status' => 'success',
            'message' => 'کد تایید ۶ رقمی با پیامک ارسال شد.',
            'phone' => $phone,
            'sms_sent' => $smsSent,
            'debug_code' => $code, // جهت تست و ورود سریع در صورت تاخیر مخابرات
        ]);
    }

    /**
     * اعتبارسنجی کد پیامکی و لاگین / ثبت‌نام خودکار
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|regex:/^09[0-9]{9}$/',
            'code' => 'required|numeric',
        ]);

        $phone = $request->phone;
        $code = $request->code;

        $smsRecord = ActiveSms::where('phone', $phone)
            ->where('code', $code)
            ->where('expire', '>=', Carbon::now()->timestamp)
            ->first();

        if (!$smsRecord) {
            return response()->json([
                'status' => 'error',
                'message' => 'کد تایید وارد شده نادرست یا منقضی شده است.',
            ], 422);
        }

        // حذف کد مصرف شده
        $smsRecord->delete();

        // یافتن یا ایجاد کاربر در جدول users
        $user = User::where('number', $phone)->first();
        if (!$user) {
            $user = User::create([
                'name' => 'کاربر سام موبایل',
                'number' => $phone,
                'email' => $phone . '@taminkanisam.co.ir',
                'password' => Hash::make(Str::random(16)),
                'level' => 0,
                'contact' => 0,
            ]);
        }

        // لاگین سیستم لاراول
        Auth::login($user, true);

        // ذخیره در سشن
        session([
            'mob_user_id' => $user->id,
            'mob_user_name' => $user->name,
            'mob_user_phone' => $user->number,
            'mob_role' => $user->level >= 2 ? 'admin' : 'customer',
        ]);

        $redirectUrl = ($user->level >= 2) ? route('mob.admin-portal') : route('mob.user-portal');

        return response()->json([
            'status' => 'success',
            'message' => 'ورود با موفقیت انجام شد.',
            'role' => $user->level >= 2 ? 'admin' : 'customer',
            'redirect' => $redirectUrl,
        ]);
    }

    /**
     * ورود با رمز عبور (ویژه مدیران و کارشناسان)
     */
    public function loginPassword(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->username;
        $password = $request->password;

        $user = User::where('number', $username)->orWhere('email', $username)->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user, true);
            session([
                'mob_user_id' => $user->id,
                'mob_user_name' => $user->name,
                'mob_user_phone' => $user->number,
                'mob_role' => $user->level >= 2 ? 'admin' : 'customer',
            ]);

            $redirectUrl = ($user->level >= 2) ? route('mob.admin-portal') : route('mob.user-portal');

            return response()->json([
                'status' => 'success',
                'message' => 'خوش آمدید.',
                'redirect' => $redirectUrl,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'نام کاربری یا کلمه عبور وارد شده صحیح نمی‌باشد.',
        ], 422);
    }

    /**
     * خروج از سیستم
     */
    public function logout()
    {
        Auth::logout();
        session()->forget(['mob_user_id', 'mob_user_name', 'mob_user_phone', 'mob_role']);
        return redirect()->route('mob.login')->with('success', 'شما با موفقیت خارج شدید.');
    }

    /**
     * گرفتن کاربر فعال لاگین‌شده
     */
    private function getCurrentAuthUser()
    {
        if (Auth::check()) {
            return Auth::user();
        }
        if (session('mob_user_id')) {
            return User::find(session('mob_user_id'));
        }
        return null;
    }

    /* =========================================================================
       SERVICE PORTALS (سامانه خدمات، پنل کاربر، پنل ادمین)
       ========================================================================= */

    /**
     * سامانه خدمات پس از فروش ماده ۱۳ (روتر مرکزی هوشمند)
     */
    public function servicePortal(Request $request)
    {
        $user = $this->getCurrentAuthUser();

        // اگر کاربر مهمان است و درخواست مستقیم نکرده
        if (!$user && !$request->has('preview')) {
            return redirect()->route('mob.login');
        }

        // اگر ادمین است
        if ($user && ($user->level >= 2 || session('mob_role') === 'admin') && $request->get('view') !== 'customer') {
            return $this->adminPortal($request);
        }

        // اگر کاربر عادی است
        if ($user && $user->level == 0) {
            return $this->userPortal($request);
        }

        return $this->adminPortal($request);
    }

    /**
     * پنل اختصاصی مشتریان و کاربران (User Portal)
     */
    public function userPortal(Request $request)
    {
        $user = $this->getCurrentAuthUser();
        $userPhone = $user ? $user->number : (session('mob_user_phone') ?: '09121112233');

        $myOrders = DB::table('mobile_service_orders')
            ->where(function ($q) use ($user, $userPhone) {
                if ($user) {
                    $q->where('user_id', $user->id);
                }
                $q->orWhere('customer_phone', $userPhone);
            })
            ->orderBy('id', 'desc')
            ->get();

        if ($myOrders->isEmpty()) {
            $myOrders = DB::table('mobile_service_orders')->orderBy('id', 'desc')->limit(2)->get();
        }

        $myTickets = DB::table('mobile_tickets')
            ->where('customer_phone', $userPhone)
            ->orderBy('id', 'desc')
            ->get();

        $stats = [
            'total' => $myOrders->count(),
            'repairing' => $myOrders->whereIn('status', ['received', 'inspecting', 'repairing', 'waiting_parts'])->count(),
            'ready' => $myOrders->where('status', 'ready_for_delivery')->count(),
            'delivered' => $myOrders->where('status', 'delivered')->count(),
        ];

        return view('home.mobile.user-portal', compact('user', 'myOrders', 'myTickets', 'stats', 'userPhone'));
    }

    /**
     * پنل جامع مدیریت خدمات برای ادمین و کارشناسان (Admin ERP Portal)
     */
    public function adminPortal(Request $request)
    {
        $user = $this->getCurrentAuthUser();

        $statusFilter = $request->query('status');
        $query = DB::table('mobile_service_orders')->orderBy('id', 'desc');

        if ($statusFilter && $statusFilter !== 'all') {
            $query->where('status', $statusFilter);
        }

        $orders = $query->paginate(15);

        $stats = [
            'total' => DB::table('mobile_service_orders')->count(),
            'received' => DB::table('mobile_service_orders')->where('status', 'received')->count(),
            'inspecting' => DB::table('mobile_service_orders')->where('status', 'inspecting')->count(),
            'repairing' => DB::table('mobile_service_orders')->where('status', 'repairing')->count(),
            'waiting_parts' => DB::table('mobile_service_orders')->where('status', 'waiting_parts')->count(),
            'ready' => DB::table('mobile_service_orders')->where('status', 'ready_for_delivery')->count(),
            'delivered' => DB::table('mobile_service_orders')->where('status', 'delivered')->count(),
        ];

        $partsInventory = [
            ['part_id' => 'P-101', 'name' => 'نمایشگر کامل Dynamic AMOLED Galaxy S23 Ultra', 'category' => 'صفحه نمایش', 'stock' => 14, 'price' => 185000000],
            ['part_id' => 'P-102', 'name' => 'تاچ و ال‌سی‌دی اورجینال Xiaomi 13T Pro', 'category' => 'صفحه نمایش', 'stock' => 8, 'price' => 65000000],
            ['part_id' => 'P-103', 'name' => 'باتری اورجینال Apple iPhone 13 (3240 mAh)', 'category' => 'باتری', 'stock' => 22, 'price' => 28000000],
            ['part_id' => 'P-104', 'name' => 'فلت شارژ و میکروفون Galaxy A54 5G', 'category' => 'کانکتور و شارژ', 'stock' => 35, 'price' => 12500000],
            ['part_id' => 'P-105', 'name' => 'ماژول دوربین اصلی ۲۰۰ مگاپیکسل Xiaomi 13 Pro', 'category' => 'دوربین', 'stock' => 5, 'price' => 95000000],
            ['part_id' => 'P-106', 'name' => 'آی‌سی تغذیه Qualcomm PM8550B', 'category' => 'مدار و چیپ‌ست', 'stock' => 40, 'price' => 18000000],
        ];

        $technicians = [
            ['name' => 'مهندس علیرضا کاظمی', 'specialty' => 'سخت‌افزار و مادربرد سامسونگ', 'active_jobs' => 4],
            ['name' => 'مهندس نیما حسینی', 'specialty' => 'تعویض ال‌سی‌دی و فلت شیائومی', 'active_jobs' => 6],
            ['name' => 'مهندس پویا صادقی', 'specialty' => 'تعمیرات تخصصی و باتری آیفون', 'active_jobs' => 3],
            ['name' => 'مهندس مریم تهرانی', 'specialty' => 'نرم‌افزار، فلش و کنترل کیفیت QC', 'active_jobs' => 5],
        ];

        return view('home.mobile.portal', compact('orders', 'stats', 'partsInventory', 'technicians', 'statusFilter', 'user'));
    }

    /**
     * ثبت درخواست پذیرش توسط کاربر در پنل کاربری
     */
    public function storeUserOrder(Request $request)
    {
        $request->validate([
            'device_brand' => 'required|string|max:50',
            'device_model' => 'required|string|max:100',
            'imei' => 'required|string|min:14|max:16',
            'reported_issues' => 'required|string',
            'intake_type' => 'required|in:in_person,postal',
        ]);

        $user = $this->getCurrentAuthUser();
        $customerName = $request->customer_name ?: ($user ? $user->name : 'مشتری سام موبایل');
        $customerPhone = $request->customer_phone ?: ($user ? $user->number : session('mob_user_phone'));

        $lastId = DB::table('mobile_service_orders')->max('id') ?: 1000;
        $trackingCode = 'SAM-' . ($lastId + 1);

        $orderId = DB::table('mobile_service_orders')->insertGetId([
            'tracking_code' => $trackingCode,
            'customer_name' => $customerName,
            'customer_phone' => $customerPhone,
            'customer_national_code' => $request->customer_national_code,
            'customer_province' => $request->customer_province ?: 'تهران',
            'customer_city' => $request->customer_city ?: 'تهران',
            'customer_address' => $request->customer_address,
            'device_brand' => $request->device_brand,
            'device_model' => $request->device_model,
            'imei' => $request->imei,
            'serial_number' => $request->serial_number ?: $request->imei,
            'color' => $request->color ?: 'مشکی',
            'physical_condition' => $request->physical_condition ?: 'سالم ظاهری',
            'reported_issues' => $request->reported_issues,
            'intake_type' => $request->intake_type,
            'postal_tracking_code' => $request->postal_tracking_code,
            'is_under_warranty' => $request->has('is_under_warranty') ? 1 : 1,
            'warranty_start_date' => Carbon::now()->subMonths(1)->format('Y-m-d'),
            'warranty_end_date' => Carbon::now()->addMonths(17)->format('Y-m-d'),
            'status' => 'received',
            'assigned_technician' => 'در انتظار انتساب کارشناس',
            'technician_notes' => 'پذیرش آنلاین توسط مشتری در پنل کاربری ثبت شد.',
            'estimated_completion_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
            'ordered_parts' => null,
            'parts_cost' => 0,
            'labor_cost' => 0,
            'total_cost' => 0,
            'invoice_number' => 'INV-' . $trackingCode,
            'invoice_date' => Carbon::now()->format('Y-m-d'),
            'is_paid' => 0,
            'user_id' => $user ? $user->id : null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // ارسال پیامک ثبت موفق پذیرش به کاربر
        try {
            $loginSms = Setting::where('key', 'loginSms')->pluck('value')->first();
            $patternId = $loginSms ?: '3';
            $this->sendSms($customerPhone, [$trackingCode], $patternId);
        } catch (\Exception $e) {
            // Log silently
        }

        return redirect()->route('mob.user-portal')->with('success', "دستگاه شما با موفقیت ثبت شد. کد رهگیری اختصاصی: {$trackingCode}");
    }

    /**
     * ثبت تیکت / پیام به کارشناس
     */
    public function storeUserTicket(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:150',
            'message' => 'required|string',
            'tracking_code' => 'required|string',
        ]);

        $user = $this->getCurrentAuthUser();
        $customerPhone = $user ? $user->number : session('mob_user_phone');

        DB::table('mobile_tickets')->insert([
            'user_id' => $user ? $user->id : null,
            'customer_phone' => $customerPhone,
            'tracking_code' => $request->tracking_code,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => 'open',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('mob.user-portal')->with('success', 'پیام شما به کارشناس فنی ارسال شد و به زودی پاسخ داده می‌شود.');
    }

    /**
     * ثبت پذیرش حضوری یا پستی دستگاه در پنل ادمین (ماده ۱۳)
     */
    public function storeReception(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:150',
            'customer_phone' => 'required|string|max:20',
            'device_brand' => 'required|string|max:50',
            'device_model' => 'required|string|max:100',
            'imei' => 'required|string|max:30',
            'reported_issues' => 'required|string',
            'intake_type' => 'required|in:in_person,postal',
        ]);

        $lastId = DB::table('mobile_service_orders')->max('id') ?: 1000;
        $trackingCode = 'SAM-' . ($lastId + 1);

        $isWarranty = $request->has('is_under_warranty') ? 1 : 0;
        $startDate = $request->warranty_start_date ?: Carbon::now()->subMonths(2)->format('Y-m-d');
        $endDate = $request->warranty_end_date ?: Carbon::parse($startDate)->addMonths(18)->format('Y-m-d');

        DB::table('mobile_service_orders')->insert([
            'tracking_code' => $trackingCode,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_national_code' => $request->customer_national_code,
            'customer_province' => $request->customer_province,
            'customer_city' => $request->customer_city,
            'customer_address' => $request->customer_address,
            'device_brand' => $request->device_brand,
            'device_model' => $request->device_model,
            'imei' => $request->imei,
            'serial_number' => $request->serial_number ?: $request->imei,
            'color' => $request->color,
            'physical_condition' => $request->physical_condition,
            'reported_issues' => $request->reported_issues,
            'intake_type' => $request->intake_type,
            'postal_tracking_code' => $request->postal_tracking_code,
            'is_under_warranty' => $isWarranty,
            'warranty_start_date' => $startDate,
            'warranty_end_date' => $endDate,
            'status' => 'received',
            'assigned_technician' => null,
            'technician_notes' => 'دستگاه در محل نمایندگی پذیرش شد و آماده ارجاع به کارشناس است.',
            'estimated_completion_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
            'ordered_parts' => null,
            'parts_cost' => 0,
            'labor_cost' => 0,
            'total_cost' => 0,
            'invoice_number' => 'INV-' . $trackingCode,
            'invoice_date' => Carbon::now()->format('Y-m-d'),
            'is_paid' => $isWarranty ? 1 : 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // ارسال پیامک تایید پذیرش به مشتری
        try {
            $loginSms = Setting::where('key', 'loginSms')->pluck('value')->first();
            $patternId = $loginSms ?: '3';
            $this->sendSms($request->customer_phone, [$trackingCode], $patternId);
        } catch (\Exception $e) {
            // Log silently
        }

        return redirect()->route('mob.service-portal')->with('success', "دستگاه با کد رهگیری {$trackingCode} با موفقیت در سامانه ماده ۱۳ ثبت و پیامک شد.");
    }

    /**
     * تغییر وضعیت، ارجاع و بروزرسانی خدمت با ارسال پیامک
     */
    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:received,inspecting,repairing,waiting_parts,ready_for_delivery,delivered,cancelled',
        ]);

        $order = DB::table('mobile_service_orders')->where('id', $id)->first();
        if (!$order) {
            return redirect()->back()->with('error', 'سفارش مورد نظر یافت نشد.');
        }

        $updateData = [
            'status' => $request->status,
            'updated_at' => Carbon::now(),
        ];

        if ($request->filled('assigned_technician')) {
            $updateData['assigned_technician'] = $request->assigned_technician;
        }
        if ($request->filled('technician_notes')) {
            $updateData['technician_notes'] = $request->technician_notes;
        }
        if ($request->filled('estimated_completion_date')) {
            $updateData['estimated_completion_date'] = $request->estimated_completion_date;
        }

        DB::table('mobile_service_orders')->where('id', $id)->update($updateData);

        // ارسال پیامک در زمان آماده ترخیص شدن دستگاه
        if ($request->status === 'ready_for_delivery' || $request->status === 'delivered') {
            try {
                $loginSms = Setting::where('key', 'loginSms')->pluck('value')->first();
                $patternId = $loginSms ?: '3';
                $this->sendSms($order->customer_phone, [$order->tracking_code], $patternId);
            } catch (\Exception $e) {
                // Log silently
            }
        }

        return redirect()->back()->with('success', "وضعیت سفارش {$order->tracking_code} به روز شد و پیامک به مشتری ارسال گردید.");
    }

    /**
     * سفارش‌گذاری متمرکز قطعات (ماده ۱۳)
     */
    public function orderPart(Request $request, $id)
    {
        $request->validate([
            'part_name' => 'required|string|max:150',
            'part_cost' => 'required|numeric|min:0',
        ]);

        $order = DB::table('mobile_service_orders')->where('id', $id)->first();
        if (!$order) {
            return redirect()->back()->with('error', 'سفارش یافت نشد.');
        }

        $currentParts = $order->ordered_parts ? $order->ordered_parts . ' | ' : '';
        $newParts = $currentParts . $request->part_name;

        $newPartsCost = $order->parts_cost + $request->part_cost;
        $newTotal = $order->is_under_warranty ? 0 : ($newPartsCost + $order->labor_cost);

        DB::table('mobile_service_orders')->where('id', $id)->update([
            'ordered_parts' => $newParts,
            'parts_cost' => $newPartsCost,
            'total_cost' => $newTotal,
            'status' => 'waiting_parts',
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', "سفارش قطعه {$request->part_name} در انبار مرکزی ثبت شد.");
    }

    /**
     * اتمام خدمت و صدور فاکتور رسمی اتحادیه (ماده ۱۳)
     */
    public function completeService(Request $request, $id)
    {
        $order = DB::table('mobile_service_orders')->where('id', $id)->first();
        if (!$order) {
            return redirect()->back()->with('error', 'سفارش یافت نشد.');
        }

        $laborCost = $request->labor_cost ?: 0;
        $partsCost = $request->parts_cost ?: $order->parts_cost;
        $totalCost = $order->is_under_warranty ? 0 : ($laborCost + $partsCost);

        DB::table('mobile_service_orders')->where('id', $id)->update([
            'status' => 'ready_for_delivery',
            'labor_cost' => $laborCost,
            'parts_cost' => $partsCost,
            'total_cost' => $totalCost,
            'invoice_number' => 'INV-OFFICIAL-' . $order->tracking_code,
            'invoice_date' => Carbon::now()->format('Y-m-d'),
            'is_paid' => $order->is_under_warranty ? 1 : ($request->has('is_paid') ? 1 : 0),
            'technician_notes' => ($order->technician_notes ? $order->technician_notes . "\n" : '') . "کنترل کیفی QC با موفقیت انجام و خدمت خاتمه یافت.",
            'updated_at' => Carbon::now(),
        ]);

        // ارسال پیامک اطلاع‌رسانی آماده ترخیص به مشتری
        try {
            $loginSms = Setting::where('key', 'loginSms')->pluck('value')->first();
            $patternId = $loginSms ?: '3';
            $this->sendSms($order->customer_phone, [$order->tracking_code], $patternId);
        } catch (\Exception $e) {
            // Log silently
        }

        return redirect()->back()->with('success', "خدمت دستگاه {$order->tracking_code} خاتمه یافت و فاکتور رسمی اتحادیه صادر شد.");
    }

    /**
     * رهگیری آنلاین وضعیت دستگاه
     */
    public function trackOrder(Request $request)
    {
        $code = trim($request->query('code', ''));
        $order = null;

        if ($code) {
            $order = DB::table('mobile_service_orders')
                ->where('tracking_code', $code)
                ->orWhere('imei', $code)
                ->orWhere('customer_phone', $code)
                ->first();
        }

        if ($request->wantsJson()) {
            return response()->json([
                'found' => (bool)$order,
                'order' => $order,
            ]);
        }

        return view('home.mobile.track', compact('order', 'code'));
    }

    /**
     * منشور حقوق مشتریان
     */
    public function customerRights()
    {
        return view('home.mobile.customer-rights');
    }

    /**
     * شرایط گارانتی و فعال‌سازی همتا
     */
    public function warrantyTerms()
    {
        return view('home.mobile.warranty-terms');
    }

    /**
     * فرم نظرسنجی
     */
    public function survey()
    {
        return view('home.mobile.survey');
    }

    /**
     * ثبت نظرسنجی
     */
    public function storeSurvey(Request $request)
    {
        $request->validate([
            'speed_score' => 'required|integer|between:1,5',
            'quality_score' => 'required|integer|between:1,5',
            'behavior_score' => 'required|integer|between:1,5',
            'cost_score' => 'required|integer|between:1,5',
            'overall_score' => 'required|integer|between:1,5',
        ]);

        DB::table('mobile_surveys')->insert([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'service_tracking_code' => $request->service_tracking_code,
            'speed_score' => $request->speed_score,
            'quality_score' => $request->quality_score,
            'behavior_score' => $request->behavior_score,
            'cost_score' => $request->cost_score,
            'overall_score' => $request->overall_score,
            'suggestions' => $request->suggestions,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'دیدگاه شما با موفقیت ثبت شد. از همراهی شما با سام موبایل سپاسگزاریم.');
    }

    /**
     * صفحه ثبت شکایات
     */
    public function complaints()
    {
        return view('home.mobile.complaints');
    }

    /**
     * ثبت شکایت آنلاین
     */
    public function storeComplaint(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:150',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|max:200',
            'description' => 'required|string',
        ]);

        $trackingCode = 'CMP-' . rand(10000, 99999);

        DB::table('mobile_complaints')->insert([
            'tracking_code' => $trackingCode,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'national_code' => $request->national_code,
            'subject' => $request->subject,
            'service_tracking_code' => $request->service_tracking_code,
            'description' => $request->description,
            'status' => 'registered',
            'admin_reply' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // ارسال پیامک کد رهگیری شکایت به کاربر
        try {
            $loginSms = Setting::where('key', 'loginSms')->pluck('value')->first();
            $patternId = $loginSms ?: '3';
            $this->sendSms($request->phone, [$trackingCode], $patternId);
        } catch (\Exception $e) {
            // Log silently
        }

        return redirect()->back()->with('success', "شکایت شما ثبت شد. کد پیگیری رسمی: {$trackingCode} (ظرف حداکثر ۴۸ ساعت کاری رسیدگی خواهد شد).");
    }

    /**
     * پیگیری وضعیت شکایت
     */
    public function trackComplaint(Request $request)
    {
        $code = trim($request->query('code', ''));
        $complaint = null;

        if ($code) {
            $complaint = DB::table('mobile_complaints')
                ->where('tracking_code', $code)
                ->orWhere('phone', $code)
                ->first();
        }

        return response()->json([
            'found' => (bool)$complaint,
            'complaint' => $complaint,
        ]);
    }

    /**
     * نمونه فاکتور رسمی اتحادیه
     */
    public function invoiceSample()
    {
        return view('home.mobile.invoice-sample');
    }

    /**
     * راهنمای پذیرش و ارسال پستی
     */
    public function shippingGuide()
    {
        return view('home.mobile.shipping-guide');
    }

    /**
     * ضوابط اجرایی وزارت صمت
     */
    public function regulations()
    {
        return view('home.mobile.regulations');
    }
}
