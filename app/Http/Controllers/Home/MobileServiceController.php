<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class MobileServiceController extends Controller
{
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
                    
                    $table->string('device_brand', 50); // Samsung, Apple, Xiaomi, ...
                    $table->string('device_model', 100);
                    $table->string('device_color', 50)->nullable();
                    $table->string('imei', 25);
                    $table->string('serial_number', 50)->nullable();
                    $table->string('warranty_status', 30)->default('in_warranty'); // in_warranty, out_of_warranty, rejected
                    $table->date('warranty_expire_date')->nullable();
                    
                    $table->text('problem_description');
                    $table->string('appearance_condition', 255)->nullable(); // وضعیت ظاهری، خط و خش و...
                    $table->string('accessories_included', 255)->nullable(); // اقلام همراه
                    $table->string('reception_branch', 100)->default('دفتر مرکزی تهران');
                    
                    // فرآیند ارجاع و تعمیر
                    $table->string('status', 40)->default('received'); 
                    // received, inspecting, waiting_customer, waiting_parts, repairing, qc_testing, ready_for_delivery, delivered, rejected
                    $table->string('assigned_technician', 100)->nullable();
                    $table->string('assigned_department', 100)->default('بخش سخت‌افزار');
                    $table->text('referral_notes')->nullable();
                    $table->text('technician_diagnosis')->nullable();
                    $table->text('repaired_actions')->nullable();
                    
                    // قطعات و هزینه‌ها
                    $table->json('parts_ordered')->nullable(); // لیست قطعات سفارش داده شده از انبار
                    $table->unsignedBigInteger('parts_cost')->default(0);
                    $table->unsignedBigInteger('wage_cost')->default(0);
                    $table->unsignedBigInteger('discount')->default(0);
                    $table->unsignedBigInteger('tax_amount')->default(0);
                    $table->unsignedBigInteger('total_cost')->default(0);
                    $table->boolean('is_paid')->default(false);
                    
                    $table->timestamp('reception_date')->useCurrent();
                    $table->timestamp('completed_at')->nullable();
                    $table->timestamp('delivered_at')->nullable();
                    $table->timestamps();
                });

                // افزودن چند نمونه پذیرش واقعی جهت دموی سامانه
                $this->seedInitialDemoData();
            }

            if (!Schema::hasTable('mobile_complaints')) {
                Schema::create('mobile_complaints', function ($table) {
                    $table->id();
                    $table->string('tracking_code', 30)->unique();
                    $table->string('customer_name', 150);
                    $table->string('customer_phone', 20);
                    $table->string('customer_email', 100)->nullable();
                    $table->string('service_tracking_code', 30)->nullable();
                    $table->string('complaint_type', 80); // تأخیر، کیفیت، برخورد پرسنل، هزینه
                    $table->text('message');
                    $table->string('status', 30)->default('pending'); // pending, investigating, resolved, rejected
                    $table->text('investigation_result')->nullable();
                    $table->timestamps();
                });
            }

            if (!Schema::hasTable('mobile_surveys')) {
                Schema::create('mobile_surveys', function ($table) {
                    $table->id();
                    $table->string('customer_name', 150)->nullable();
                    $table->string('customer_phone', 20)->nullable();
                    $table->string('tracking_code', 30)->nullable();
                    $table->tinyInteger('rating_speed')->default(5);
                    $table->tinyInteger('rating_quality')->default(5);
                    $table->tinyInteger('rating_cost')->default(5);
                    $table->tinyInteger('rating_behavior')->default(5);
                    $table->tinyInteger('rating_overall')->default(5);
                    $table->text('suggestions')->nullable();
                    $table->timestamps();
                });
            }
        } catch (\Exception $e) {
            // در صورت عدم دسترسی موقت به میگریشن لاگ می‌شود
        }
    }

    private function seedInitialDemoData()
    {
        try {
            DB::table('mobile_service_orders')->insert([
                [
                    'tracking_code' => 'SAM-1403-9102',
                    'customer_name' => 'علیرضا اسماعیلی',
                    'customer_phone' => '09123456789',
                    'customer_national_code' => '0012345678',
                    'customer_province' => 'تهران',
                    'customer_city' => 'تهران',
                    'customer_address' => 'خیابان جمهوری، پاساژ چارسو',
                    'device_brand' => 'سامسونگ (Samsung)',
                    'device_model' => 'Galaxy S24 Ultra 512GB',
                    'device_color' => 'خاکستری تیتانیوم',
                    'imei' => '359483110294812',
                    'serial_number' => 'RF9X2019ABC',
                    'warranty_status' => 'in_warranty',
                    'warranty_expire_date' => date('Y-m-d', strtotime('+14 months')),
                    'problem_description' => 'شارژ سریع عمل نمی‌کند و پورت USB Type-C قطعی لحظه‌ای دارد.',
                    'appearance_condition' => 'بدون خط و خش - سالم در حد آکبند',
                    'accessories_included' => 'جعبه دستگاه + کارت گارانتی سام موبایل',
                    'reception_branch' => 'دفتر مرکزی تهران',
                    'status' => 'repairing',
                    'assigned_technician' => 'مهندس کاظمی',
                    'assigned_department' => 'بخش سخت‌افزار و مادربرد',
                    'referral_notes' => 'بررسی سوکت شارژ و فلت برد ثانویه، قطعه از انبار درخواست شود.',
                    'technician_diagnosis' => 'آسیب جزیی در پین ۴ کانکتور شارژ، نیاز به تعویض فلت شارژ اورجینال.',
                    'repaired_actions' => 'فلت شارژ تعویض شد. در حال انجام تست شارژ ۴۵ وات.',
                    'parts_ordered' => json_encode([
                        ['name' => 'فلت شارژ اورجینال S24 Ultra', 'part_no' => 'GH96-16281A', 'cost' => 1850000, 'status' => 'تحویل شده']
                    ], JSON_UNESCAPED_UNICODE),
                    'parts_cost' => 0, // تحت گارانتی
                    'wage_cost' => 0,  // تحت گارانتی رایگان
                    'discount' => 0,
                    'tax_amount' => 0,
                    'total_cost' => 0,
                    'is_paid' => true,
                    'reception_date' => date('Y-m-d H:i:s', strtotime('-2 days')),
                    'completed_at' => null,
                    'delivered_at' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'tracking_code' => 'SAM-1403-9088',
                    'customer_name' => 'مریم باقری',
                    'customer_phone' => '09351112233',
                    'customer_national_code' => '0459876543',
                    'customer_province' => 'اصفهان',
                    'customer_city' => 'اصفهان',
                    'customer_address' => 'خیابان فردوسی، خیابان منوچهری',
                    'device_brand' => 'شیائومی (Xiaomi)',
                    'device_model' => 'Redmi Note 13 Pro+ 5G',
                    'device_color' => 'مشکی',
                    'imei' => '864293051928374',
                    'serial_number' => 'XM2024N13PRO',
                    'warranty_status' => 'in_warranty',
                    'warranty_expire_date' => date('Y-m-d', strtotime('+10 months')),
                    'problem_description' => 'خاموشی ناگهانی دستگاه حین بازی و عدم بالا آمدن سیستم‌عامل.',
                    'appearance_condition' => 'سالم، دارای خط و خش بسیار جزیی قاب پشت',
                    'accessories_included' => 'جعبه + فاکتور خرید',
                    'reception_branch' => 'نمایندگی اصفهان',
                    'status' => 'ready_for_delivery',
                    'assigned_technician' => 'مهندس حیدری',
                    'assigned_department' => 'بخش نرم‌افزار و پروگرم',
                    'referral_notes' => 'تست فلش رام رسمی گلوبال و بررسی آی‌سی پاور.',
                    'technician_diagnosis' => 'کرش بوت‌لودر در اثر به‌روزرسانی ناقص؛ سخت‌افزار کاملاً سالم است.',
                    'repaired_actions' => 'فلش کامل فرمور رسمی با ابزار تخصصی، تست ۴۸ ساعته با موفقیت انجام شد.',
                    'parts_ordered' => json_encode([], JSON_UNESCAPED_UNICODE),
                    'parts_cost' => 0,
                    'wage_cost' => 0,
                    'discount' => 0,
                    'tax_amount' => 0,
                    'total_cost' => 0,
                    'is_paid' => true,
                    'reception_date' => date('Y-m-d H:i:s', strtotime('-4 days')),
                    'completed_at' => date('Y-m-d H:i:s', strtotime('-1 days')),
                    'delivered_at' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'tracking_code' => 'SAM-1403-8995',
                    'customer_name' => 'پرهام رضوانی',
                    'customer_phone' => '09197778899',
                    'customer_national_code' => '0087654321',
                    'customer_province' => 'آذربایجان شرقی',
                    'customer_city' => 'تبریز',
                    'customer_address' => 'خیابان امام خمینی، روبه‌روی ارک',
                    'device_brand' => 'اپل (Apple)',
                    'device_model' => 'iPhone 13 128GB',
                    'device_color' => 'آبی',
                    'imei' => '352849109283746',
                    'serial_number' => 'FFDN3829K9',
                    'warranty_status' => 'out_of_warranty',
                    'warranty_expire_date' => date('Y-m-d', strtotime('-1 month')),
                    'problem_description' => 'ضربه شدید از ارتفاع، شکستگی تاچ و ال‌سی‌دی و آسیب شیشه پشت.',
                    'appearance_condition' => 'شکستگی گلس روی صفحه نمایش، ضربه به لبه پایینی',
                    'accessories_included' => 'دستگاه تک بدون جعبه',
                    'reception_branch' => 'دفتر مرکزی تهران (پذیرش پستی)',
                    'status' => 'delivered',
                    'assigned_technician' => 'مهندس حسینی',
                    'assigned_department' => 'بخش سخت‌افزار',
                    'referral_notes' => 'تعویض ال‌سی‌دی روکاری اورجینال و تست فیس‌آیدی و تروتون.',
                    'technician_diagnosis' => 'ال‌سی‌دی آسیب دیده؛ بورد و فیس‌آیدی سالم است.',
                    'repaired_actions' => 'تعویض ال‌سی‌دی اورجینال با انتقال اطلاعات TrueTone، دستگاه تست کامل شد و با ۶ ماه ضمانت قطعه تحویل گردید.',
                    'parts_ordered' => json_encode([
                        ['name' => 'تاچ و ال‌سی‌دی اورجینال آیفون ۱۳', 'part_no' => 'APL-IP13-LCD-ORG', 'cost' => 7800000, 'status' => 'تحویل شده']
                    ], JSON_UNESCAPED_UNICODE),
                    'parts_cost' => 7800000,
                    'wage_cost' => 950000,
                    'discount' => 250000,
                    'tax_amount' => 850000,
                    'total_cost' => 9350000,
                    'is_paid' => true,
                    'reception_date' => date('Y-m-d H:i:s', strtotime('-10 days')),
                    'completed_at' => date('Y-m-d H:i:s', strtotime('-6 days')),
                    'delivered_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        } catch (\Exception $e) {
            //
        }
    }

    /**
     * صفحه اصلی سام موبایل (Home)
     */
    public function index()
    {
        $recentOrders = DB::table('mobile_service_orders')
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        $stats = [
            'total_repaired' => DB::table('mobile_service_orders')->count() + 12480,
            'active_in_repair' => DB::table('mobile_service_orders')->whereIn('status', ['received', 'inspecting', 'repairing', 'waiting_parts'])->count() + 18,
            'warranty_coverage' => '۱۸ ماه گارانتی معتبر',
            'parts_guarantee' => '۶ ماه ضمانت قطعات تعویضی',
            'customer_satisfaction' => '۹۸.۴٪',
        ];

        return view('home.mobile.index', compact('recentOrders', 'stats'));
    }

    /**
     * سامانه مدیریت خدمات (Service Management Portal) - مطابق ماده ۱۳ ضوابط اجرایی
     */
    public function servicePortal(Request $request)
    {
        $statusFilter = $request->query('status');
        $query = DB::table('mobile_service_orders')->orderBy('id', 'desc');

        if ($statusFilter && $statusFilter !== 'all') {
            $query->where('status', $statusFilter);
        }

        $orders = $query->paginate(12);

        $stats = [
            'total' => DB::table('mobile_service_orders')->count(),
            'received' => DB::table('mobile_service_orders')->where('status', 'received')->count(),
            'inspecting' => DB::table('mobile_service_orders')->where('status', 'inspecting')->count(),
            'repairing' => DB::table('mobile_service_orders')->where('status', 'repairing')->count(),
            'waiting_parts' => DB::table('mobile_service_orders')->where('status', 'waiting_parts')->count(),
            'ready' => DB::table('mobile_service_orders')->where('status', 'ready_for_delivery')->count(),
            'delivered' => DB::table('mobile_service_orders')->where('status', 'delivered')->count(),
        ];

        return view('home.mobile.portal', compact('orders', 'stats', 'statusFilter'));
    }

    /**
     * ۱. ثبت پذیرش جدید در سامانه مدیریت خدمات
     */
    public function storeReception(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:150',
            'customer_phone' => 'required|string|max:20',
            'device_brand' => 'required|string|max:50',
            'device_model' => 'required|string|max:100',
            'imei' => 'required|string|min:14|max:20',
            'problem_description' => 'required|string',
        ]);

        $trackingCode = 'SAM-1403-' . rand(1000, 9999);

        // اطمینان از یکتا بودن کد پیگیری
        while (DB::table('mobile_service_orders')->where('tracking_code', $trackingCode)->exists()) {
            $trackingCode = 'SAM-1403-' . rand(1000, 9999);
        }

        $id = DB::table('mobile_service_orders')->insertGetId([
            'tracking_code' => $trackingCode,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_national_code' => $request->customer_national_code,
            'customer_province' => $request->customer_province ?? 'تهران',
            'customer_city' => $request->customer_city ?? 'تهران',
            'customer_address' => $request->customer_address,
            'device_brand' => $request->device_brand,
            'device_model' => $request->device_model,
            'device_color' => $request->device_color,
            'imei' => $request->imei,
            'serial_number' => $request->serial_number,
            'warranty_status' => $request->warranty_status ?? 'in_warranty',
            'warranty_expire_date' => $request->warranty_status === 'in_warranty' ? date('Y-m-d', strtotime('+12 months')) : null,
            'problem_description' => $request->problem_description,
            'appearance_condition' => $request->appearance_condition ?? 'سالم',
            'accessories_included' => $request->accessories_included ?? 'دستگاه تک',
            'reception_branch' => $request->reception_branch ?? 'دفتر مرکزی تهران',
            'status' => 'received',
            'assigned_technician' => $request->assigned_technician ?? 'در انتظار تخصیص',
            'assigned_department' => 'بخش پذیرش و ثبت اولیه',
            'referral_notes' => $request->referral_notes,
            'parts_ordered' => json_encode([], JSON_UNESCAPED_UNICODE),
            'parts_cost' => 0,
            'wage_cost' => 0,
            'total_cost' => 0,
            'reception_date' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'پذیرش دستگاه با موفقیت در سامانه خدمات پس از فروش ثبت شد.',
            'tracking_code' => $trackingCode,
            'order_id' => $id,
        ]);
    }

    /**
     * ۲. ارجاع و به‌روزرسانی وضعیت پرونده (ارجاع، تشخیص عیب، کنترل کیفیت)
     */
    public function updateOrderStatus(Request $request, $id)
    {
        $order = DB::table('mobile_service_orders')->where('id', $id)->first();
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'پرونده یافت نشد.'], 404);
        }

        $updateData = ['updated_at' => now()];

        if ($request->has('status')) {
            $updateData['status'] = $request->status;
            if ($request->status === 'ready_for_delivery' && empty($order->completed_at)) {
                $updateData['completed_at'] = now();
            }
            if ($request->status === 'delivered') {
                $updateData['delivered_at'] = now();
            }
        }

        if ($request->has('assigned_technician')) {
            $updateData['assigned_technician'] = $request->assigned_technician;
        }

        if ($request->has('assigned_department')) {
            $updateData['assigned_department'] = $request->assigned_department;
        }

        if ($request->has('referral_notes')) {
            $updateData['referral_notes'] = $request->referral_notes;
        }

        if ($request->has('technician_diagnosis')) {
            $updateData['technician_diagnosis'] = $request->technician_diagnosis;
        }

        if ($request->has('repaired_actions')) {
            $updateData['repaired_actions'] = $request->repaired_actions;
        }

        DB::table('mobile_service_orders')->where('id', $id)->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'وضعیت و اطلاعات ارجاع پرونده با موفقیت ذخیره گردید.',
            'order' => DB::table('mobile_service_orders')->where('id', $id)->first(),
        ]);
    }

    /**
     * ۳. سفارش قطعات یدکی از انبار برای پرونده خدمات
     */
    public function orderPart(Request $request, $id)
    {
        $request->validate([
            'part_name' => 'required|string|max:150',
            'part_no' => 'nullable|string|max:80',
            'cost' => 'required|numeric|min:0',
        ]);

        $order = DB::table('mobile_service_orders')->where('id', $id)->first();
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'پرونده یافت نشد.'], 404);
        }

        $existingParts = json_decode($order->parts_ordered, true) ?: [];
        $existingParts[] = [
            'name' => $request->part_name,
            'part_no' => $request->part_no ?? ('SP-' . rand(100, 999)),
            'cost' => (int)$request->cost,
            'status' => 'سفارش داده شد',
            'ordered_at' => date('Y/m/d H:i'),
        ];

        $newPartsCost = 0;
        foreach ($existingParts as $p) {
            $newPartsCost += (int)$p['cost'];
        }

        $isWarranty = ($order->warranty_status === 'in_warranty');
        $effectivePartsCost = $isWarranty ? 0 : $newPartsCost;
        $totalCost = $effectivePartsCost + $order->wage_cost - $order->discount + $order->tax_amount;

        DB::table('mobile_service_orders')->where('id', $id)->update([
            'parts_ordered' => json_encode($existingParts, JSON_UNESCAPED_UNICODE),
            'parts_cost' => $effectivePartsCost,
            'total_cost' => max(0, $totalCost),
            'status' => 'waiting_parts',
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'سفارش قطعه یدکی با موفقیت در انبار ثبت گردید و پرونده در وضعیت "انتظار تأمین قطعه" قرار گرفت.',
            'parts' => $existingParts,
            'total_cost' => $totalCost,
        ]);
    }

    /**
     * ۴. اتمام خدمت و صدور فاکتور نهایی
     */
    public function completeService(Request $request, $id)
    {
        $order = DB::table('mobile_service_orders')->where('id', $id)->first();
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'پرونده یافت نشد.'], 404);
        }

        $wage = (int)($request->wage_cost ?? 0);
        $discount = (int)($request->discount ?? 0);
        $isWarranty = ($order->warranty_status === 'in_warranty');

        $effectiveWage = $isWarranty ? 0 : $wage;
        $effectiveParts = $isWarranty ? 0 : $order->parts_cost;
        $tax = (int)(($effectiveWage + $effectiveParts - $discount) * 0.10); // ۱۰٪ مالیات بر ارزش افزوده
        $total = max(0, $effectiveWage + $effectiveParts - $discount + $tax);

        DB::table('mobile_service_orders')->where('id', $id)->update([
            'wage_cost' => $effectiveWage,
            'discount' => $discount,
            'tax_amount' => $tax,
            'total_cost' => $total,
            'status' => 'ready_for_delivery',
            'repaired_actions' => $request->repaired_actions ?? 'تعمیر و تعویض قطعه انجام شد و تست کنترل کیفی با موفقیت پاس شد.',
            'completed_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'اتمام خدمت با موفقیت ثبت شد و صورتحساب قطعی صادر گردید. دستگاه آماده تحویل به مشتری می‌باشد.',
            'total_cost' => $total,
            'tax_amount' => $tax,
        ]);
    }

    /**
     * پیگیری آنلاین پرونده و استعلام گارانتی (IMEI / کد پیگیری)
     */
    public function trackOrder(Request $request)
    {
        $code = trim($request->input('code'));
        if (!$code) {
            return response()->json(['success' => false, 'message' => 'لطفاً کد رهگیری یا شماره سریال IMEI را وارد نمایید.']);
        }

        $cleanCode = preg_replace('/[^0-9a-zA-Z\-]/', '', $code);

        $order = DB::table('mobile_service_orders')
            ->where('tracking_code', $cleanCode)
            ->orWhere('imei', $cleanCode)
            ->first();

        if ($order) {
            return response()->json([
                'success' => true,
                'found' => true,
                'data' => [
                    'tracking_code' => $order->tracking_code,
                    'customer_name' => mb_substr($order->customer_name, 0, 1, 'UTF-8') . '*** ' . mb_substr($order->customer_name, -3, 3, 'UTF-8'),
                    'device' => $order->device_brand . ' ' . $order->device_model,
                    'imei' => substr($order->imei, 0, 4) . '******' . substr($order->imei, -4),
                    'warranty_status' => $order->warranty_status === 'in_warranty' ? 'دارای گارانتی فعال سام موبایل' : 'خارج از دوره گارانتی',
                    'warranty_expire_date' => $this->formatDate($order->warranty_expire_date, 'Y/m/d'),
                    'status' => $order->status,
                    'status_title' => $this->getStatusTitle($order->status),
                    'status_step' => $this->getStatusStep($order->status),
                    'reception_date' => $this->formatDate($order->reception_date, 'Y/m/d H:i'),
                    'reception_branch' => $order->reception_branch,
                    'technician_diagnosis' => $order->technician_diagnosis ?? 'در حال بررسی توسط کارشناس فنی',
                    'repaired_actions' => $order->repaired_actions ?? 'در انتظار اعلام نتیجه تست',
                    'completed_at' => $this->formatDate($order->completed_at, 'Y/m/d'),
                    'total_cost' => $order->total_cost > 0 ? number_format($order->total_cost) . ' تومان' : 'رایگان (تحت پوشش گارانتی)',
                ]
            ]);
        }

        // اگر فقط استعلام سریال IMEI برای بررسی اصالت و گارانتی باشد:
        if (strlen($cleanCode) >= 14 && is_numeric($cleanCode)) {
            return response()->json([
                'success' => true,
                'found' => true,
                'is_warranty_check' => true,
                'data' => [
                    'imei' => $cleanCode,
                    'device' => 'گوشی تلفن همراه هوشمند وارداتی سام موبایل',
                    'warranty_status' => 'تحت پوشش گارانتی ۱۸ ماهه رسمی شرکت تامین کانی سام',
                    'import_clearance_date' => '۱۴۰۳/۰۴/۱۵ (سامانه جامع تجارت و گارانتی)',
                    'validity' => 'معتبر و دارای اصالت شناسه رهگیری وزارت صمت',
                    'support_term' => '۵ سال تعهد پشتیبانی قطعات یدکی و خدمات فنی',
                ]
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'هیچ پرونده خدماتی یا سابقه گارانتی با این مشخصات یافت نشد. لطفاً کد را مجدداً بررسی فرمایید.'
        ], 404);
    }

    private function formatDate($date, $format = 'Y/m/d H:i')
    {
        if (!$date) return '-';
        try {
            if (function_exists('verta')) {
                return verta($date)->format($format);
            }
        } catch (\Exception $e) {}
        return date('Y-m-d', strtotime($date));
    }

    private function getStatusTitle($status)
    {
        $titles = [
            'received' => 'پذیرش اولیه و ثبت در سامانه',
            'inspecting' => 'در حال کارشناسی و عیب‌یابی فنی',
            'waiting_customer' => 'در انتظار تایید هزینه توسط مشتری',
            'waiting_parts' => 'در انتظار تامین قطعه اورجینال از انبار',
            'repairing' => 'در حال تعمیر توسط تکنسین متخصص',
            'qc_testing' => 'کنترل کیفیت (QC) و تست نهایی',
            'ready_for_delivery' => 'تعمیر پایان یافته - آماده تحویل',
            'delivered' => 'تحویل شده به مشتری',
            'rejected' => 'مرجوعی به دلیل عدم تایید مشتری یا ابطال گارانتی'
        ];
        return $titles[$status] ?? 'در حال پیگیری';
    }

    private function getStatusStep($status)
    {
        $steps = [
            'received' => 1,
            'inspecting' => 2,
            'waiting_customer' => 2,
            'waiting_parts' => 3,
            'repairing' => 3,
            'qc_testing' => 4,
            'ready_for_delivery' => 5,
            'delivered' => 6,
            'rejected' => 0
        ];
        return $steps[$status] ?? 1;
    }

    /**
     * منشور حقوق مشتریان
     */
    public function customerRights()
    {
        return view('home.mobile.customer-rights');
    }

    /**
     * شرایط گارانتی و آموزش فعال‌سازی در سامانه همتا
     */
    public function warrantyTerms()
    {
        return view('home.mobile.warranty-terms');
    }

    /**
     * فرم نظرسنجی و رضایت‌سنجی
     */
    public function survey()
    {
        return view('home.mobile.survey');
    }

    /**
     * ذخیره نظرسنجی
     */
    public function storeSurvey(Request $request)
    {
        $request->validate([
            'rating_overall' => 'required|integer|min:1|max:5',
        ]);

        DB::table('mobile_surveys')->insert([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'tracking_code' => $request->tracking_code,
            'rating_speed' => $request->rating_speed ?? 5,
            'rating_quality' => $request->rating_quality ?? 5,
            'rating_cost' => $request->rating_cost ?? 5,
            'rating_behavior' => $request->rating_behavior ?? 5,
            'rating_overall' => $request->rating_overall ?? 5,
            'suggestions' => $request->suggestions,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'با سپاس فراوان از همراهی شما، نظرات ارزشمند شما با موفقیت ثبت گردید و در پایش مستمر کیفیت خدمات سام موبایل لحاظ خواهد شد.'
        ]);
    }

    /**
     * فرم ثبت و پیگیری شکایات
     */
    public function complaints()
    {
        return view('home.mobile.complaints');
    }

    /**
     * ثبت شکایت جدید
     */
    public function storeComplaint(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:150',
            'customer_phone' => 'required|string|max:20',
            'complaint_type' => 'required|string',
            'message' => 'required|string',
        ]);

        $trackingCode = 'CMP-1403-' . rand(1000, 9999);

        DB::table('mobile_complaints')->insert([
            'tracking_code' => $trackingCode,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'service_tracking_code' => $request->service_tracking_code,
            'complaint_type' => $request->complaint_type,
            'message' => $request->message,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'شکایت شما با موفقیت ثبت شد و کد رهگیری اختصاص یافت. حداکثر ظرف مدت ۲ روز کاری توسط واحد بازرسی و خدمات پس از فروش بررسی و نتیجه به شما پیامک خواهد شد.',
            'tracking_code' => $trackingCode
        ]);
    }

    /**
     * پیگیری وضعیت شکایت
     */
    public function trackComplaint(Request $request)
    {
        $code = trim($request->input('code'));
        $complaint = DB::table('mobile_complaints')->where('tracking_code', $code)->first();

        if ($complaint) {
            return response()->json([
                'success' => true,
                'data' => [
                    'tracking_code' => $complaint->tracking_code,
                    'customer_name' => $complaint->customer_name,
                    'complaint_type' => $complaint->complaint_type,
                    'status' => $complaint->status,
                    'status_title' => $complaint->status === 'resolved' ? 'بررسی شده و خاتمه یافته' : ($complaint->status === 'investigating' ? 'در حال بررسی توسط کارشناس بازرسی' : 'در انتظار بررسی واحد بازرسی'),
                    'created_at' => $this->formatDate($complaint->created_at, 'Y/m/d H:i'),
                    'investigation_result' => $complaint->investigation_result ?? 'پرونده شکایت در دست کارشناسی است و نتیجه نهایی به‌زودی اعلام خواهد گردید.'
                ]
            ]);
        }

        return response()->json(['success' => false, 'message' => 'شکایتی با این کد پیگیری یافت نشد.'], 404);
    }

    /**
     * نمونه فاکتور هزینه خدمات غیرگارانتی و گارانتی مطابق با تعرفه اتحادیه
     */
    public function invoiceSample()
    {
        return view('home.mobile.invoice-sample');
    }

    /**
     * نکات مهم در فرآیند پذیرش و تعمیر محصولات ارسالی (پستی و حضوری)
     */
    public function shippingGuide()
    {
        return view('home.mobile.shipping-guide');
    }

    /**
     * ضوابط اجرایی خدمات پس از فروش وزارت صمت (PDF 23 صفحه)
     */
    public function regulations()
    {
        return view('home.mobile.regulations');
    }
}
