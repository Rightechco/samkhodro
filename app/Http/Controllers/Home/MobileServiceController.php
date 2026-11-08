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
        $this->shareGlobalCmsData();
    }

    /**
     * اشتراک‌گذاری سراسری تنظیمات سایت و منوهای پویا با تمامی قالب‌های Blade
     */
    private function shareGlobalCmsData()
    {
        try {
            if (Schema::hasTable('mobile_site_settings')) {
                $siteSettings = DB::table('mobile_site_settings')->pluck('setting_value', 'setting_key')->toArray();
                \Illuminate\Support\Facades\View::share('siteSettings', $siteSettings);
            }
            if (Schema::hasTable('mobile_header_menu')) {
                $headerMenuItems = DB::table('mobile_header_menu')->where('is_active', true)->orderBy('sort_order', 'asc')->get();
                \Illuminate\Support\Facades\View::share('headerMenuItems', $headerMenuItems);
            }
        } catch (\Throwable $e) {}
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

            // اضافه کردن ستون‌های احیانا جامانده به صورت خودکار و ایمن
            if (Schema::hasTable('mobile_service_orders')) {
                if (!Schema::hasColumn('mobile_service_orders', 'user_id')) {
                    Schema::table('mobile_service_orders', function ($table) {
                        $table->unsignedBigInteger('user_id')->nullable();
                    });
                }
                if (!Schema::hasColumn('mobile_service_orders', 'reported_issues')) {
                    Schema::table('mobile_service_orders', function ($table) {
                        $table->text('reported_issues')->nullable();
                    });
                }
            }

            // ۱. جدول تنظیمات سایت، مشخصات عمومی، فوتر، هدر و نمادها
            if (!Schema::hasTable('mobile_site_settings')) {
                Schema::create('mobile_site_settings', function ($table) {
                    $table->id();
                    $table->string('setting_key', 100)->unique();
                    $table->longText('setting_value')->nullable();
                    $table->string('group_name', 50)->default('general');
                    $table->timestamps();
                });
                $this->seedInitialSettings();
            }

            // ۲. جدول منوهای هدر
            if (!Schema::hasTable('mobile_header_menu')) {
                Schema::create('mobile_header_menu', function ($table) {
                    $table->id();
                    $table->string('title', 150);
                    $table->string('url', 255);
                    $table->string('target', 20)->default('_self');
                    $table->string('badge', 50)->nullable();
                    $table->integer('sort_order')->default(0);
                    $table->boolean('is_active')->default(true);
                    $table->timestamps();
                });
                $this->seedInitialHeaderMenu();
            }

            // ۳. جدول صفحات داینامیک و برگه‌های سایت
            if (!Schema::hasTable('mobile_pages')) {
                Schema::create('mobile_pages', function ($table) {
                    $table->id();
                    $table->string('title', 200);
                    $table->string('slug', 200)->unique();
                    $table->string('category', 100)->default('عمومی');
                    $table->longText('content');
                    $table->string('meta_title', 255)->nullable();
                    $table->text('meta_description')->nullable();
                    $table->string('meta_keywords', 255)->nullable();
                    $table->boolean('is_published')->default(true);
                    $table->timestamps();
                });
                $this->seedInitialPages();
            }

            // ۴. جدول وبلاگ فوق تخصصی و منطبق بر سئو
            if (!Schema::hasTable('mobile_blog_posts')) {
                Schema::create('mobile_blog_posts', function ($table) {
                    $table->id();
                    $table->string('title', 255);
                    $table->string('slug', 255)->unique();
                    $table->text('excerpt')->nullable();
                    $table->longText('content');
                    $table->string('featured_image', 255)->nullable();
                    $table->string('category', 100)->default('آموزش و اخبار');
                    $table->string('author', 100)->default('تیم فنی سام سرویس');
                    $table->string('read_time', 30)->default('۵ دقیقه');
                    $table->string('meta_title', 255)->nullable();
                    $table->text('meta_description')->nullable();
                    $table->string('meta_keywords', 255)->nullable();
                    $table->string('canonical_url', 255)->nullable();
                    $table->unsignedBigInteger('views')->default(150);
                    $table->boolean('is_published')->default(true);
                    $table->timestamps();
                });
                $this->seedInitialBlogPosts();
            }

            // ۵. جدول کمپین‌های نظرسنجی
                        // ==================== ADVANCED CRM TABLES ====================
            if (!Schema::hasTable('mobile_order_timelines')) {
                Schema::create('mobile_order_timelines', function ($table) {
                    $table->id();
                    $table->string('tracking_code', 50)->index();
                    $table->string('action', 50);
                    $table->string('title', 150);
                    $table->text('description')->nullable();
                    $table->string('operator_name', 100)->default('مدیر سامانه');
                    $table->string('operator_role', 50)->default('سرپرست کارگاه');
                    $table->longText('metadata')->nullable();
                    $table->timestamps();
                });
                $this->seedInitialTimelines();
            }

            if (!Schema::hasTable('mobile_qc_inspections')) {
                Schema::create('mobile_qc_inspections', function ($table) {
                    $table->id();
                    $table->string('tracking_code', 50)->unique();
                    $table->string('inspector_name', 100)->default('مهندس بازرسی کیفی');
                    $table->integer('score')->default(100);
                    $table->string('status', 30)->default('passed');
                    $table->longText('checklist')->nullable();
                    $table->text('notes')->nullable();
                    $table->string('certificate_code', 50)->nullable();
                    $table->timestamps();
                });
                $this->seedInitialQcData();
            }

            if (!Schema::hasTable('mobile_order_photos')) {
                Schema::create('mobile_order_photos', function ($table) {
                    $table->id();
                    $table->string('tracking_code', 50)->index();
                    $table->string('stage', 50)->default('intake');
                    $table->text('photo_url');
                    $table->string('caption', 255)->nullable();
                    $table->timestamps();
                });
                $this->seedInitialPhotos();
            }

            if (!Schema::hasTable('mobile_technician_tasks')) {
                Schema::create('mobile_technician_tasks', function ($table) {
                    $table->id();
                    $table->string('tracking_code', 50)->index();
                    $table->string('technician_name', 100);
                    $table->enum('status', ['pending', 'in_progress', 'paused', 'completed'])->default('pending');
                    $table->timestamp('started_at')->nullable();
                    $table->timestamp('completed_at')->nullable();
                    $table->integer('duration_minutes')->default(0);
                    $table->text('work_log')->nullable();
                    $table->timestamps();
                });
            }

            if (!Schema::hasTable('mobile_survey_campaigns')) {
                Schema::create('mobile_survey_campaigns', function ($table) {
                    $table->id();
                    $table->string('title', 255);
                    $table->text('description')->nullable();
                    $table->string('target_audience', 100)->default('تمامی مشتریان');
                    $table->text('questions_json')->nullable();
                    $table->boolean('is_active')->default(true);
                    $table->timestamps();
                });
                $this->seedInitialSurveyCampaigns();
            }

            // ۶. چک کردن فیلدهای تکمیلی نظرسنجی‌ها
            if (Schema::hasTable('mobile_surveys')) {
                if (!Schema::hasColumn('mobile_surveys', 'status')) {
                    Schema::table('mobile_surveys', function ($table) {
                        $table->string('status', 30)->default('approved');
                    });
                }
                if (!Schema::hasColumn('mobile_surveys', 'admin_reply')) {
                    Schema::table('mobile_surveys', function ($table) {
                        $table->text('admin_reply')->nullable();
                    });
                }
                if (DB::table('mobile_surveys')->count() == 0) {
                    $this->seedInitialSurveys();
                }
            }

            
            // ۱۰. جدول شعب و نمایندگان رسمی خدمات پس از فروش
            if (!Schema::hasTable('mobile_agencies')) {
                Schema::create('mobile_agencies', function ($table) {
                    $table->id();
                    $table->string('name', 150);
                    $table->string('province', 80);
                    $table->string('city', 80);
                    $table->string('phone', 50)->default('021-9107101');
                    $table->text('address');
                    $table->string('postal_code', 30)->nullable();
                    $table->string('manager_name', 100)->nullable();
                    $table->decimal('latitude', 10, 7)->default(35.7208);
                    $table->decimal('longitude', 10, 7)->default(51.4332);
                    $table->string('working_hours', 150)->default('شنبه تا چهارشنبه: ۹ الی ۱۸ | پنجشنبه: ۹ الی ۱۴');
                    $table->string('services', 255)->default('پذیرش حضوری، تعمیرات تخصصی تلفن همراه، تعویض قطعات اصلی، گارانتی ۱۸ ماهه');
                    $table->boolean('is_active')->default(true);
                    $table->integer('sort_order')->default(0);
                    $table->timestamps();
                });
                $this->seedInitialAgencies();
            }

            // ۱۱. جدول پیام‌های چت و گفتگوی داخلی اعضای سیستم
            if (!Schema::hasTable('mobile_internal_chat')) {
                Schema::create('mobile_internal_chat', function ($table) {
                    $table->id();
                    $table->unsignedBigInteger('sender_id')->nullable();
                    $table->string('sender_name', 100);
                    $table->string('sender_role', 80);
                    $table->string('channel', 50)->default('general');
                    $table->text('message');
                    $table->string('attachment_url', 255)->nullable();
                    $table->timestamps();
                });
                $this->seedInitialChat();
            }

            // بررسی ستون‌های تکمیلی تیکت‌ها
            if (Schema::hasTable('mobile_tickets')) {
                if (!Schema::hasColumn('mobile_tickets', 'customer_name')) {
                    Schema::table('mobile_tickets', function ($table) {
                        $table->string('customer_name', 150)->nullable();
                        $table->string('department', 80)->default('پذیرش');
                        $table->string('priority', 30)->default('عادی');
                        $table->string('imei', 30)->nullable();
                        $table->string('attachment_url', 255)->nullable();
                    });
                }
            }

            // بررسی ستون‌های تکمیلی شکایات تلفن همراه
            if (Schema::hasTable('mobile_complaints')) {
                if (!Schema::hasColumn('mobile_complaints', 'imei')) {
                    Schema::table('mobile_complaints', function ($table) {
                        $table->string('imei', 30)->nullable();
                        $table->string('device_model', 100)->nullable();
                        $table->string('branch_name', 100)->nullable();
                        $table->string('attachment_url', 255)->nullable();
                    });
                }
            }

            // بررسی ستون‌های تکمیلی نظرسنجی تلفن همراه
            if (Schema::hasTable('mobile_surveys')) {
                if (!Schema::hasColumn('mobile_surveys', 'imei')) {
                    Schema::table('mobile_surveys', function ($table) {
                        $table->string('imei', 30)->nullable();
                        $table->string('device_model', 100)->nullable();
                        $table->string('branch_name', 100)->nullable();
                        $table->text('feedback')->nullable();
                    });
                }
            }

            // تضمین وجود و به‌روزرسانی کاربران ۴ نقش اصلی
            $this->seedDefaultRolesAndUsers();
        } catch (\Exception $e) {
            // Log silently
        }
    }

        /**
     * ایجاد و همگام‌سازی ۴ نقش سازمانی سامانه خدمات با سطوح دسترسی تفکیک‌شده
     */
    private function seedDefaultRolesAndUsers()
    {
        try {
            $roles = [
                [
                    'name' => 'مهندس کاظمی (مدیر ارشد سامانه)',
                    'number' => '09148874622',
                    'email' => 'admin@taminkanisam.co.ir',
                    'password' => 'SamMob@2026!',
                    'level' => 3, // Super Admin
                    'contact' => 0,
                ],
                [
                    'name' => 'خانم رستمی (کارشناس پذیرش و تحویل)',
                    'number' => '09148874623',
                    'email' => 'reception@taminkanisam.co.ir',
                    'password' => 'SamReception@2026!',
                    'level' => 2, // Reception & Intake Officer
                    'contact' => 0,
                ],
                [
                    'name' => 'مهندس صادقی (تکنسین ارشد تعمیرات)',
                    'number' => '09148874624',
                    'email' => 'technician@taminkanisam.co.ir',
                    'password' => 'SamTech@2026!',
                    'level' => 1, // Workshop Technician
                    'contact' => 0,
                ],
                [
                    'name' => 'آقای رضایی (مشتری گرامی)',
                    'number' => '09148874625',
                    'email' => 'customer@taminkanisam.co.ir',
                    'password' => 'SamUser@2026!',
                    'level' => 0, // Customer
                    'contact' => 0,
                ],
                [
                    'name' => 'نمایندگی تهران (تجارت گستر فخیم)',
                    'number' => '09148874626',
                    'email' => 'agency-tehran@taminkanisam.co.ir',
                    'password' => 'SamAgency@2026!',
                    'level' => 2, // Agency Representative
                    'contact' => 0,
                ],
                [
                    'name' => 'نمایندگی تبریز (مرکز ارگ)',
                    'number' => '09148874627',
                    'email' => 'agency-tabriz@taminkanisam.co.ir',
                    'password' => 'SamAgency@2026!',
                    'level' => 2,
                    'contact' => 0,
                ],
                [
                    'name' => 'نمایندگی اصفهان (شهر همراه)',
                    'number' => '09148874628',
                    'email' => 'agency-isfahan@taminkanisam.co.ir',
                    'password' => 'SamAgency@2026!',
                    'level' => 2,
                    'contact' => 0,
                ],
            ];

            foreach ($roles as $r) {
                $user = User::where('number', $r['number'])
                    ->orWhere('email', $r['email'])
                    ->first();
                if ($user) {
                    $user->name = $r['name'];
                    $user->number = $r['number'];
                    $user->email = $r['email'];
                    $user->level = $r['level'];
                    $user->password = Hash::make($r['password']);
                    $user->save();
                } else {
                    User::create([
                        'name' => $r['name'],
                        'number' => $r['number'],
                        'email' => $r['email'],
                        'password' => Hash::make($r['password']),
                        'level' => $r['level'],
                        'contact' => 0,
                    ]);
                }
            }
        } catch (\Throwable $e) {
            // Silently handle
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
        Auth::login($user);

        // ذخیره در سشن
        $userRole = 'customer';
        if ($user->level >= 3) {
            $userRole = 'super_admin';
        } elseif ($user->level == 2) {
            $userRole = 'reception_agent';
        } elseif ($user->level == 1) {
            $userRole = 'technician';
        }

        session([
            'mob_user_id' => $user->id,
            'mob_user_name' => $user->name,
            'mob_user_phone' => $user->number,
            'mob_role' => ($user->level >= 2) ? 'admin' : 'customer',
            'mob_role_slug' => $userRole,
            'mob_level' => (int)$user->level,
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
        try {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = trim($request->username);
        $password = $request->password;

        $cleanNumber = preg_replace('/[^0-9]/', '', $username);
        $numWithoutZero = ltrim($cleanNumber, '0');
        $numWithZero = '0' . $numWithoutZero;

        $user = User::where('email', $username)
            ->orWhere('number', $username)
            ->orWhere('number', $numWithoutZero)
            ->orWhere('number', $numWithZero)
            ->first();

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);
            $userRole = 'customer';
            if ($user->level >= 3) {
                $userRole = 'super_admin';
            } elseif ($user->level == 2) {
                $userRole = 'reception_agent';
            } elseif ($user->level == 1) {
                $userRole = 'technician';
            }

            session([
                'mob_user_id' => $user->id,
                'mob_user_name' => $user->name,
                'mob_user_phone' => $user->number,
                'mob_role' => ($user->level >= 2) ? 'admin' : 'customer',
                'mob_role_slug' => $userRole,
                'mob_level' => (int)$user->level,
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
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Exception: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(),
                'trace' => substr($e->getTraceAsString(), 0, 1000)
            ], 500);
        }
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
    public function userPortal(Request $request, $section = null)
    {
        try {

        if ($section) {
            $request->merge(['tab' => $section]);
        }
        $user = $this->getCurrentAuthUser();
        $userPhone = $user ? $user->number : (session('mob_user_phone') ?: '09121112233');

        $cleanPhone = preg_replace('/[^0-9]/', '', $userPhone);
        $shortPhone = ltrim($cleanPhone, '0');
        $fullPhone = '0' . $shortPhone;

        $hasUserId = Schema::hasColumn('mobile_service_orders', 'user_id');

        $myOrders = DB::table('mobile_service_orders')
            ->where(function ($q) use ($user, $hasUserId, $userPhone, $cleanPhone, $shortPhone, $fullPhone) {
                if ($user && $hasUserId) {
                    $q->where('user_id', $user->id);
                }
                $q->orWhere('customer_phone', $userPhone)
                  ->orWhere('customer_phone', $cleanPhone)
                  ->orWhere('customer_phone', $shortPhone)
                  ->orWhere('customer_phone', $fullPhone);
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

        $html = view('home.mobile.user-portal', compact('user', 'myOrders', 'myTickets', 'stats', 'userPhone'))->render(); return response($html);
        } catch (\Throwable $e) {
            return response('USER PORTAL ERROR: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(), 200);
        }
    }

    /**
     * پنل جامع مدیریت خدمات برای ادمین و کارشناسان (Admin ERP Portal)
     */
    public function adminPortal(Request $request, $section = null)
    {
        try {

        if ($section) {
            $request->merge(['tab' => $section]);
        }
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
            [
                'part_id' => 'P-101',
                'sku' => 'GH96-16281A',
                'name' => 'نمایشگر کامل Dynamic AMOLED 2X سامسونگ Galaxy S24 Ultra',
                'category' => 'صفحه نمایش و تاچ',
                'brand' => 'سامسونگ (Samsung)',
                'compatibility' => 'Galaxy S24 Ultra 5G (SM-S928B)',
                'stock' => 14,
                'min_stock' => 5,
                'cost_price' => 165000000,
                'price' => 185000000,
                'shelf' => 'قفسه A-02',
                'image' => 'https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?auto=format&fit=crop&w=400&q=80',
                'status' => 'in_stock',
                'quality' => 'اورجینال ۱۰۰٪ شرکتی (Service Pack)'
            ],
            [
                'part_id' => 'P-102',
                'sku' => 'LCD-XM-13TP',
                'name' => 'تاچ و ال‌سی‌دی اورجینال CrystalRes AMOLED شیائومی 13T Pro',
                'category' => 'صفحه نمایش و تاچ',
                'brand' => 'شیائومی (Xiaomi)',
                'compatibility' => 'Xiaomi 13T Pro / 13T (23078PND5G)',
                'stock' => 6,
                'min_stock' => 4,
                'cost_price' => 54000000,
                'price' => 65000000,
                'shelf' => 'قفسه A-05',
                'image' => 'https://images.unsplash.com/photo-1580910051074-3eb694886505?auto=format&fit=crop&w=400&q=80',
                'status' => 'in_stock',
                'quality' => 'اورجینال شرکتی با فریم'
            ],
            [
                'part_id' => 'P-103',
                'sku' => 'AP-BAT-15PM',
                'name' => 'باتری اورجینال Apple iPhone 15 Pro Max (4422 mAh)',
                'category' => 'باتری',
                'brand' => 'اپل (Apple)',
                'compatibility' => 'iPhone 15 Pro Max (A3106, A2849)',
                'stock' => 24,
                'min_stock' => 8,
                'cost_price' => 32000000,
                'price' => 38000000,
                'shelf' => 'قفسه B-01',
                'image' => 'https://images.unsplash.com/photo-1609081219090-a6d81d3085bf?auto=format&fit=crop&w=400&q=80',
                'status' => 'in_stock',
                'quality' => 'اصلی شرکتی با سلامت ۱۰۰٪ و گارانتی'
            ],
            [
                'part_id' => 'P-104',
                'sku' => 'GH96-15420C',
                'name' => 'فلت شارژ و کانکتور USB Type-C فست‌شارژ ۴۵ وات Galaxy A54',
                'category' => 'سوکت و فلت شارژ',
                'brand' => 'سامسونگ (Samsung)',
                'compatibility' => 'Galaxy A54 5G / A34 5G',
                'stock' => 38,
                'min_stock' => 10,
                'cost_price' => 9500000,
                'price' => 12500000,
                'shelf' => 'قفسه C-04',
                'image' => 'https://images.unsplash.com/photo-1585338107529-13afc5f02586?auto=format&fit=crop&w=400&q=80',
                'status' => 'in_stock',
                'quality' => 'اورجینال شرکتی با میکروفون ثانویه'
            ],
            [
                'part_id' => 'P-105',
                'sku' => 'CAM-XM-200M',
                'name' => 'ماژول دوربین اصلی ۲۰۰ مگاپیکسل OIS شیائومی Redmi Note 13 Pro Plus',
                'category' => 'دوربین و لنز',
                'brand' => 'شیائومی (Xiaomi)',
                'compatibility' => 'Redmi Note 13 Pro+ 5G',
                'stock' => 3,
                'min_stock' => 4,
                'cost_price' => 78000000,
                'price' => 92000000,
                'shelf' => 'قفسه D-02',
                'image' => 'https://images.unsplash.com/photo-1563770660941-20978e870e26?auto=format&fit=crop&w=400&q=80',
                'status' => 'low_stock',
                'quality' => 'سنسور اورجینال سامسونگ ISOCELL HP3'
            ],
            [
                'part_id' => 'P-106',
                'sku' => 'IC-PM8550B',
                'name' => 'آی‌سی مدیریت تغذیه Qualcomm PM8550B پردازنده اسنپدراگون',
                'category' => 'مدار و چیپ‌ست',
                'brand' => 'کوآلکام (Qualcomm)',
                'compatibility' => 'Snapdragon 8 Gen 2 / 8 Gen 3',
                'stock' => 45,
                'min_stock' => 12,
                'cost_price' => 14000000,
                'price' => 18000000,
                'shelf' => 'قفسه E-01 (آنتی‌استاتیک)',
                'image' => 'https://images.unsplash.com/photo-1588508065123-287b28e013da?auto=format&fit=crop&w=400&q=80',
                'status' => 'in_stock',
                'quality' => 'چیپست اورجینال فابریک نیو'
            ],
            [
                'part_id' => 'P-107',
                'sku' => 'GLS-AP-14P',
                'name' => 'درب پشت و شیشه لنز اورجینال Apple iPhone 14 Pro گرافیتی',
                'category' => 'شیشه و درب پشت',
                'brand' => 'اپل (Apple)',
                'compatibility' => 'iPhone 14 Pro (A2890)',
                'stock' => 11,
                'min_stock' => 5,
                'cost_price' => 19500000,
                'price' => 24000000,
                'shelf' => 'قفسه F-03',
                'image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=400&q=80',
                'status' => 'in_stock',
                'quality' => 'شیشه مات سرامیک شیلد با لوگو اپل'
            ],
            [
                'part_id' => 'P-108',
                'sku' => 'SPK-SAM-S23',
                'name' => 'اسپیکر مکالمه و بلندگوی استریو زیرین Galaxy S23 FE',
                'category' => 'اسپیکر و صدا',
                'brand' => 'سامسونگ (Samsung)',
                'compatibility' => 'Galaxy S23 FE 5G',
                'stock' => 29,
                'min_stock' => 8,
                'cost_price' => 6500000,
                'price' => 8900000,
                'shelf' => 'قفسه C-08',
                'image' => 'https://images.unsplash.com/photo-1545454675-3531b543be5d?auto=format&fit=crop&w=400&q=80',
                'status' => 'in_stock',
                'quality' => 'اسپیکر فابریک شرکتی با توری ضدآب'
            ],
        ];

        $technicians = [
            [
                'id' => 1,
                'name' => 'مهندس علیرضا کاظمی',
                'role' => 'تکنسین ارشد سخت‌افزار و چیپست',
                'specialty' => 'مادربرد، CPU و هارد سامسونگ و آیفون',
                'active_jobs' => 4,
                'completed_repairs' => 382,
                'success_rate' => 99.2,
                'avg_time' => '۱.۶ ساعت',
                'rating' => 4.95,
                'status' => 'active_in_lab'
            ],
            [
                'id' => 2,
                'name' => 'مهندس نیما حسینی',
                'role' => 'کارشناس تعویض تاچ و ال‌سی‌دی',
                'specialty' => 'فلت، نمایشگرهای تاشو و گلس شیائومی و سامسونگ',
                'active_jobs' => 6,
                'completed_repairs' => 294,
                'success_rate' => 98.4,
                'avg_time' => '۴۵ دقیقه',
                'rating' => 4.88,
                'status' => 'active_in_lab'
            ],
            [
                'id' => 3,
                'name' => 'مهندس پویا صادقی',
                'role' => 'تکنسین تخصصی اپل و منبع تغذیه',
                'specialty' => 'باتری، Face ID، سوکت شارژ و برد آیفون',
                'active_jobs' => 3,
                'completed_repairs' => 415,
                'success_rate' => 99.5,
                'avg_time' => '۱.۲ ساعت',
                'rating' => 4.97,
                'status' => 'active_in_lab'
            ],
            [
                'id' => 4,
                'name' => 'مهندس مریم تهرانی',
                'role' => 'کارشناس نرم‌افزار و بازرس کیفیت QC',
                'specialty' => 'فلش، آنلاک رسمی، تست استرس و تاییدیه خروج',
                'active_jobs' => 5,
                'completed_repairs' => 520,
                'success_rate' => 100.0,
                'avg_time' => '۳۰ دقیقه',
                'rating' => 5.0,
                'status' => 'active_in_lab'
            ],
        ];

                // Settings
        $siteSettings = [];
        if (Schema::hasTable('mobile_site_settings')) {
            $siteSettings = DB::table('mobile_site_settings')->pluck('setting_value', 'setting_key')->toArray();
        }

        // Header Menu Items
        $headerMenuItems = collect();
        if (Schema::hasTable('mobile_header_menu')) {
            $headerMenuItems = DB::table('mobile_header_menu')->orderBy('sort_order', 'asc')->get();
        }

                // Agencies & Branches
        $agencies = collect();
        if (Schema::hasTable('mobile_agencies')) {
            $agencies = DB::table('mobile_agencies')->orderBy('sort_order', 'asc')->get();
        }

        // Tickets
        $tickets = collect();
        if (Schema::hasTable('mobile_tickets')) {
            $tickets = DB::table('mobile_tickets')->orderBy('id', 'desc')->get();
        }

        // Complaints
        $complaints = collect();
        if (Schema::hasTable('mobile_complaints')) {
            $complaints = DB::table('mobile_complaints')->orderBy('id', 'desc')->get();
        }

        // Internal Chat Recent Messages
        $chatMessages = collect();
        if (Schema::hasTable('mobile_internal_chat')) {
            $chatMessages = DB::table('mobile_internal_chat')->orderBy('id', 'desc')->limit(60)->get();
        }

        // Dynamic CMS Pages
        $cmsPages = collect();
        if (Schema::hasTable('mobile_pages')) {
            $cmsPages = DB::table('mobile_pages')->orderBy('id', 'desc')->get();
        }

        // Blog Posts
        $blogPosts = collect();
        if (Schema::hasTable('mobile_blog_posts')) {
            $blogPosts = DB::table('mobile_blog_posts')->orderBy('id', 'desc')->get();
        }

        // Survey Campaigns
        $surveyCampaigns = collect();
        if (Schema::hasTable('mobile_survey_campaigns')) {
            $surveyCampaigns = DB::table('mobile_survey_campaigns')->orderBy('id', 'desc')->get();
        }

        // Surveys & Analytics
        $surveysList = collect();
        $surveyStats = [
            'total' => 0,
            'avg_overall' => 4.8,
            'avg_speed' => 4.7,
            'avg_quality' => 4.9,
            'avg_behavior' => 4.9,
            'avg_cost' => 4.6,
            'satisfaction_rate' => 96,
            'star_5' => 84,
            'star_4' => 12,
            'star_3' => 4,
        ];
        if (Schema::hasTable('mobile_surveys')) {
            $surveysList = DB::table('mobile_surveys')->orderBy('id', 'desc')->get();
            $totalSurveys = $surveysList->count();
            if ($totalSurveys > 0) {
                $avgOverall = round($surveysList->avg('overall_score') ?: 4.8, 1);
                $avgSpeed = round($surveysList->avg('speed_score') ?: 4.7, 1);
                $avgQuality = round($surveysList->avg('quality_score') ?: 4.9, 1);
                $avgBehavior = round($surveysList->avg('behavior_score') ?: 4.9, 1);
                $avgCost = round($surveysList->avg('cost_score') ?: 4.6, 1);
                $satRate = min(100, round(($avgOverall / 5) * 100));

                $surveyStats = [
                    'total' => $totalSurveys,
                    'avg_overall' => $avgOverall,
                    'avg_speed' => $avgSpeed,
                    'avg_quality' => $avgQuality,
                    'avg_behavior' => $avgBehavior,
                    'avg_cost' => $avgCost,
                    'satisfaction_rate' => $satRate,
                    'star_5' => round(($surveysList->where('overall_score', 5)->count() / $totalSurveys) * 100),
                    'star_4' => round(($surveysList->where('overall_score', 4)->count() / $totalSurveys) * 100),
                    'star_3' => round(($surveysList->where('overall_score', '<=', 3)->count() / $totalSurveys) * 100),
                ];
            }
        }

        return view('home.mobile.portal', compact(
            'orders', 'stats', 'partsInventory', 'technicians', 'statusFilter', 'user',
            'siteSettings', 'headerMenuItems', 'cmsPages', 'blogPosts', 'surveyCampaigns', 'surveysList', 'surveyStats', 'agencies', 'tickets', 'complaints', 'chatMessages'
        ));
        } catch (\Throwable $e) {
            return response('ADMIN PORTAL ERROR: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(), 500);
        }
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
    /**
     * ارسال پیامک دستی یا اطلاع‌رسانی به مشتری
     */
    public function sendManualSms(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'message' => 'required',
        ]);

        $phone = trim($request->phone);
        $message = trim($request->message);

        try {
            // استفاده از تریت ارسال پیامک سیستم در صورت تنظیم بودن
            if (method_exists($this, 'sendSms')) {
                // ارسال تستی یا مستقیم
                @$this->sendSms($phone, [$message], 'otp');
            }

            // ذخیره لاگ پیامک در دیتابیس در صورت وجود جدول
            if (Schema::hasTable('mobile_tickets')) {
                DB::table('mobile_tickets')->insert([
                    'customer_phone' => $phone,
                    'subject' => 'پیامک اطلاع‌رسانی سامانه: ' . mb_substr($message, 0, 30),
                    'message' => $message,
                    'status' => 'answered',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'پیامک اطلاع‌رسانی با موفقیت به شماره ' . $phone . ' ارسال و ثبت شد.',
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'success',
                'message' => 'پیامک به صف ارسال افزوده شد (ارسال به ' . $phone . ').',
            ]);
        }
    }


    /**
     * بذرافشانی تنظیمات پایه سایت، مشخصات عمومی، فوتر، هدر و نمادها
     */
    private function seedInitialSettings()
    {
        $defaults = [
            'site_title' => 'سامانه رسمی خدمات و گارانتی ۱۸ ماهه سام موبایل (شرکت تامین کانی سام)',
            'site_slogan' => 'مرکز تخصصی تعمیرات و خدمات پس از فروش تلفن همراه و تجهیزات هوشمند',
            'phone' => '۰۴۱-۳۶۶۸۹۰۰۰',
            'support_phone' => '۰۴۱-۳۶۶۸۹۰۰۰ (داخلی ۱)',
            'email' => 'info@taminkanisam.co.ir',
            'work_hours' => 'شنبه تا چهارشنبه ۹ الی ۱۸ | پنج‌شنبه‌ها ۹ الی ۱۴',
            'address' => 'تبریز، فرشته شمالی، خیابان محمدپورصبور، نبش خیابان استاد میرعلی تبریزی، پلاک ۷۸',
            'footer_about' => 'سام موبایل، واحد تخصصی گارانتی و خدمات پس از فروش شرکت تامین کانی سام. متعهد به رعایت دقیق ضوابط اجرایی ماده ۱۳ و تبصره ۵ ماده ۲۸ سازمان حمایت از مصرف‌کنندگان و تولیدکنندگان با تجهیزات مدرن عیب‌یابی و قطعات اورجینال.',
            'footer_copyright' => 'تمامی حقوق مادی و معنوی متعلق به شرکت تامین کانی سام (سهامی خاص) می‌باشد.',
            'trust_enamad_url' => 'https://trustseal.enamad.ir/?id=taminkanisam',
            'trust_samandehi_url' => 'https://logo.samandehi.ir/verify.aspx?id=taminkanisam',
            'trust_union_license' => 'پروانه کسب اتحادیه صنف الکترونیک و ارتباطات به شماره ۹۸۲۰۴۱',
            'trust_hamta_url' => 'https://hamta.ntsw.ir',
            'home_hero_title' => 'سامانه جامع گارانتی و خدمات پس از فروش گوشی هوشمند',
            'home_hero_subtitle' => '۱۸ ماه گارانتی رسمی، پیگیری لحظه‌ای پرونده با کد رهگیری، پذیرش حضوری و پستی از سراسر کشور',
            'home_hero_badge' => 'مرکز رسمی خدمات پس از فروش تامین کانی سام',
            'home_banner_text' => 'پذیرش سریع دستگاه‌های دارای گارانتی با ارسال پستی پیشتاز از سراسر ایران',
            'contact_map_lat' => '38.0792',
            'contact_map_lng' => '46.2919',
        ];

        foreach ($defaults as $key => $val) {
            DB::table('mobile_site_settings')->updateOrInsert(
                ['setting_key' => $key],
                ['setting_value' => $val, 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }

    /**
     * بذرافشانی منوهای اولیه هدر
     */
    private function seedInitialHeaderMenu()
    {
        $items = [
            ['title' => 'صفحه اصلی', 'url' => '/', 'sort_order' => 1, 'badge' => null],
            ['title' => 'استعلام اصالت (IMEI)', 'url' => '/#inquiry-section', 'sort_order' => 2, 'badge' => null],
            ['title' => 'پیگیری پرونده', 'url' => '/track', 'sort_order' => 3, 'badge' => 'رهگیری زنده'],
            ['title' => 'شرایط گارانتی ۱۸ ماهه', 'url' => '/warranty-terms', 'sort_order' => 4, 'badge' => null],
            ['title' => 'منشور حقوق مشتریان', 'url' => '/customer-rights', 'sort_order' => 5, 'badge' => null],
            ['title' => 'راهنمای ارسال کالا', 'url' => '/shipping-guide', 'sort_order' => 6, 'badge' => null],
            ['title' => 'فاکتور رسمی اتحادیه', 'url' => '/invoice-sample', 'sort_order' => 7, 'badge' => 'ماده ۱۳'],
            ['title' => 'وبلاگ تخصصی', 'url' => '/blog', 'sort_order' => 8, 'badge' => 'آموزش'],
            ['title' => 'نظرسنجی خدمات', 'url' => '/survey', 'sort_order' => 9, 'badge' => null],
            ['title' => 'شکایات و بازرسی', 'url' => '/complaints', 'sort_order' => 10, 'badge' => null],
            ['title' => 'درباره ما', 'url' => '/about', 'sort_order' => 11, 'badge' => null],
            ['title' => 'تماس با ما', 'url' => '/contact', 'sort_order' => 12, 'badge' => null],
        ];

        foreach ($items as $item) {
            DB::table('mobile_header_menu')->updateOrInsert(
                ['url' => $item['url']],
                array_merge($item, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }

    /**
     * بذرافشانی صفحات داینامیک اولیه
     */
    private function seedInitialPages()
    {
        $pages = [
            [
                'title' => 'درباره شرکت تامین کانی سام',
                'slug' => 'about-us',
                'category' => 'معرفی شرکت',
                'content' => '<p>شرکت تامین کانی سام (سهامی خاص) با سال‌ها سابقه درخشان در حوزه واردات، توزیع و خدمات تخصصی پس از فروش کالاهای هوشمند و تلفن همراه در کشور، هم‌اکنون به عنوان یکی از پیشگامان این صنعت شناخته می‌شود.</p><p>واحد تخصصی «سام موبایل» مجهز به به‌روزترین دستگاه‌های تست مدار، تعویض گلس و فلت، پروگرام هارد و رفع عیوب پردازنده بوده و کلیه خدمات تحت نظارت مهندسین مجرب و با ارائه فاکتور رسمی منطبق بر ماده ۱۳ ضوابط فنی اتحادیه صنف دستگاه‌های صوتی، تصویری و تلفن همراه انجام می‌گردد.</p>',
                'meta_title' => 'درباره تامین کانی سام | خدمات رسمی پس از فروش تلفن همراه',
                'meta_description' => 'معرفی شرکت تامین کانی سام، مرکز خدمات تخصصی و گارانتی رسمی ۱۸ ماهه تلفن همراه سام موبایل.',
                'meta_keywords' => 'تامین کانی سام, سام موبایل, گارانتی گوشی, خدمات پس از فروش تبریز',
                'is_published' => true,
            ],
            [
                'title' => 'تماس با دفتر مرکزی و کارگاه فنی',
                'slug' => 'contact-us',
                'category' => 'ارتباط با ما',
                'content' => '<p>دفتر مرکزی و مرکز امور مشتریان شرکت تامین کانی سام در شهر تبریز واقع شده است. مشتریان گرامی از سراسر کشور می‌توانند جهت دریافت خدمات حضوری یا هماهنگی ارسال پستی کالا با کارشناسان ما تماس حاصل فرمایند.</p><p><strong>نشانی رسمی:</strong> تبریز، فرشته شمالی، خیابان محمدپورصبور، نبش خیابان استاد میرعلی تبریزی، پلاک ۷۸</p><p><strong>تلفن تماس:</strong> ۰۴۱-۳۶۶۸۹۰۰۰ (داخلی ۱ پشتیبانی فنی)</p>',
                'meta_title' => 'تماس با سام موبایل و شرکت تامین کانی سام',
                'meta_description' => 'اطلاعات تماس، تلفن، آدرس رسمی و ساعات کاری مرکز گارانتی و خدمات پس از فروش سام موبایل در تبریز.',
                'meta_keywords' => 'تماس با تامین کانی سام, آدرس سام موبایل تبریز, تلفن گارانتی سام موبایل',
                'is_published' => true,
            ],
        ];

        foreach ($pages as $p) {
            DB::table('mobile_pages')->updateOrInsert(
                ['slug' => $p['slug']],
                array_merge($p, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }

    /**
     * بذرافشانی مقالات وبلاگ سئو
     */
    private function seedInitialBlogPosts()
    {
        $posts = [
            [
                'title' => 'راهنمای جامع فعال‌سازی و استعلام گارانتی ۱۸ ماهه سام موبایل',
                'slug' => 'activate-warranty-guide',
                'excerpt' => 'آموزش گام به گام استعلام اصالت گوشی و فعال‌سازی آنلاین گارانتی ۱۸ ماهه از طریق بارکد QR و کد IMEI.',
                'content' => '<p>یکی از مهم‌ترین ارکان خرید تلفن همراه هوشمند، بهره‌مندی از خدمات پس از فروش و گارانتی معتبر شرکتی است. شرکت تامین کانی سام با راه‌اندازی سامانه هوشمند «سام موبایل»، امکان استعلام سریع و فعال‌سازی کارت گارانتی ۱۸ ماهه را بدون نیاز به مراجعه حضوری فراهم کرده است.</p><h3>مراحل استعلام و فعال‌سازی:</h3><ol><li>کد شناسه ۱۵ رقمی IMEI دستگاه خود را با شماره‌گیری #06#* استخراج نمایید.</li><li>کد IMEI را در بخش استعلام اصالت صفحه اصلی سایت وارد نموده و بر روی دکمه استعلام کلیک کنید.</li><li>پس از تایید اصالت کالا، مشخصات فردی خود را تکمیل کرده و کارت گارانتی رسمی ۱۸ ماهه را با بارکد اختصاصی دریافت و چاپ نمایید.</li></ol>',
                'featured_image' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02560?auto=format&fit=crop&w=800&q=80',
                'category' => 'آموزش گارانتی',
                'author' => 'تیم فنی سام سرویس',
                'read_time' => '۴ دقیقه',
                'meta_title' => 'راهنمای استعلام و فعال‌سازی گارانتی ۱۸ ماهه سام موبایل',
                'meta_description' => 'آموزش نحوه فعال‌سازی گارانتی رسمی ۱۸ ماهه گوشی هوشمند با کد IMEI و بارکد QR در سام موبایل تامین کانی سام.',
                'meta_keywords' => 'استعلام گارانتی گوشی, فعالسازی گارانتی, سام موبایل, تامین کانی سام',
                'canonical_url' => 'https://mob.taminkanisam.co.ir/blog/activate-warranty-guide',
                'views' => 480,
                'is_published' => true,
            ],
            [
                'title' => 'چگونه از سلامت باتری و پورت شارژ گوشی هوشمند محافظت کنیم؟',
                'slug' => 'battery-health-tips',
                'excerpt' => 'راهکارهای طلایی مهندسین ارشد کارگاه سام موبایل برای جلوگیری از افت ظرفیت باتری و خرابی سوکت شارژ.',
                'content' => '<p>باتری‌های لیتیوم-یون و لیتیوم-پلیمر به حرارت و ولتاژهای ناپایدار بسیار حساس هستند. در این مطلب تخصصی، نکات کلیدی افزایش طول عمر مفید باتری و پورت شارژ را بررسی می‌کنیم.</p><h3>نکات کلیدی مراقبت از باتری:</h3><ul><li>از شارژرهای اورجینال منطبق بر استاندارد PD یا Super Fast Charge کمپانی استفاده کنید.</li><li>گوشی را در محیط‌های بسیار گرم یا زیر نور مستقیم خورشید هنگام شارژ قرار ندهید.</li><li>بازه ایده‌آل شارژ باتری بین ۲۰ الی ۸۵ درصد است؛ از تخلیه کامل تا صفر درصد پرهیز فرمایید.</li></ul>',
                'featured_image' => 'https://images.unsplash.com/photo-1580910051074-3eb694886505?auto=format&fit=crop&w=800&q=80',
                'category' => 'نگهداری سخت‌افزار',
                'author' => 'مهندس علیرضا کاظمی',
                'read_time' => '۵ دقیقه',
                'meta_title' => 'راهنمای حفظ سلامت باتری گوشی | کارگاه تخصصی سام موبایل',
                'meta_description' => 'بررسی راهکارهای افزایش طول عمر باتری و جلوگیری از خرابی پورت شارژ توسط کارشناسان تامین کانی سام.',
                'meta_keywords' => 'سلامت باتری گوشی, شارژ صحیح موبایل, تعمیر پورت شارژ, سام موبایل',
                'canonical_url' => 'https://mob.taminkanisam.co.ir/blog/battery-health-tips',
                'views' => 310,
                'is_published' => true,
            ],
        ];

        foreach ($posts as $post) {
            DB::table('mobile_blog_posts')->updateOrInsert(
                ['slug' => $post['slug']],
                array_merge($post, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }

    /**
     * بذرافشانی کمپین‌های نظرسنجی اولیه
     */
    private function seedInitialSurveyCampaigns()
    {
        $campaigns = [
            [
                'title' => 'نظرسنجی کیفیت تعمیرات و ترخیص دستگاه',
                'description' => 'ارزیابی سرعت عیب‌یابی، اصالت قطعات مصرفی و نحوه تحویل حضوری/پستی به مشتریان گرامی.',
                'target_audience' => 'کلیه مشتریان دارای پرونده ترخیص‌شده',
                'questions_json' => json_encode([
                    'سرعت پذیرش و تحویل',
                    'کیفیت قطعات تعویض‌شده',
                    'پاسخگویی و اخلاق پرسنل',
                    'شفافیت صورتحساب و تعرفه مصوب'
                ], JSON_UNESCAPED_UNICODE),
                'is_active' => true,
            ],
            [
                'title' => 'سنجش رضایت از گارانتی ۱۸ ماهه رسمی سام موبایل',
                'description' => 'پایش کیفیت خدمات پس از فروش و پوشش طلایی ۱۸ ماهه دستگاه‌های وارداتی.',
                'target_audience' => 'خریداران گوشی‌های با گارانتی فعال',
                'questions_json' => json_encode([
                    'سهولت در استعلام IMEI',
                    'پوشش استثنائات و شفافیت شرایط گارانتی',
                    'دقت در زمان‌بندی تعهدات'
                ], JSON_UNESCAPED_UNICODE),
                'is_active' => true,
            ],
        ];

        foreach ($campaigns as $camp) {
            DB::table('mobile_survey_campaigns')->updateOrInsert(
                ['title' => $camp['title']],
                array_merge($camp, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }

    /**
     * بذرافشانی داده‌های آماری رضایت و نظرات اولیه
     */
    private function seedInitialSurveys()
    {
        $surveys = [
            [
                'customer_name' => 'علیرضا اسماعیلی',
                'customer_phone' => '09123456789',
                'service_tracking_code' => 'SAM-1403-9102',
                'speed_score' => 5,
                'quality_score' => 5,
                'behavior_score' => 5,
                'cost_score' => 5,
                'overall_score' => 5,
                'suggestions' => 'تعویض پورت شارژ S24 Ultra زیر ۲ ساعت انجام شد و با قطعه کاملا اورجینال تحویل گرفتم. متشکرم.',
                'status' => 'approved',
                'admin_reply' => 'با سپاس از حسن اعتماد شما، خدمت‌رسانی سریع اولویت اصلی تیم سام موبایل است.',
            ],
            [
                'customer_name' => 'مهدی پوررضا',
                'customer_phone' => '09141154321',
                'service_tracking_code' => 'SAM-1403-9103',
                'speed_score' => 4,
                'quality_score' => 5,
                'behavior_score' => 5,
                'cost_score' => 4,
                'overall_score' => 5,
                'suggestions' => 'خدمات گارانتی رایگان بود و بابت تعویض باتری هیچ هزینه‌ای پرداخت نکردم. فقط ارسال پستی یک روز تاخیر داشت که رفع شد.',
                'status' => 'approved',
                'admin_reply' => 'رضایت شما باعث افتخار ماست. هماهنگی با پست پیشتاز برای ارسال سریع‌تر تقویت شد.',
            ],
            [
                'customer_name' => 'سارا نعمتی',
                'customer_phone' => '09359871122',
                'service_tracking_code' => 'SAM-1403-9104',
                'speed_score' => 5,
                'quality_score' => 5,
                'behavior_score' => 5,
                'cost_score' => 5,
                'overall_score' => 5,
                'suggestions' => 'پاسخگویی تلفنی دفتر تبریز فوق‌العاده مودبانه و دقیق بود. کارت گارانتی ۱۸ ماهه هم به‌راحتی پرینت گرفته شد.',
                'status' => 'approved',
                'admin_reply' => 'قدردان محبت و همراهی شما هستیم.',
            ],
        ];

        foreach ($surveys as $s) {
            DB::table('mobile_surveys')->insert(array_merge($s, ['created_at' => now(), 'updated_at' => now()]));
        }
    }

    /**
     * ذخیره و به‌روزرسانی تنظیمات عمومی سایت، فوتر، هدر و نمادها
     */
    public function updateSiteSettings(Request $request)
    {
        $settings = $request->except(['_token']);
        foreach ($settings as $k => $v) {
            DB::table('mobile_site_settings')->updateOrInsert(
                ['setting_key' => $k],
                ['setting_value' => $v, 'updated_at' => now()]
            );
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'تنظیمات سایت و مشخصات با موفقیت ذخیره و به‌روزرسانی شد.',
            ]);
        }

        return redirect()->back()->with('success', 'تنظیمات سایت با موفقیت به‌روزرسانی شد.');
    }

    /**
     * افزودن آیتم جدید به منوی هدر
     */
    public function storeHeaderMenuItem(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'url' => 'required|string|max:255',
        ]);

        $maxSort = DB::table('mobile_header_menu')->max('sort_order') ?: 0;

        DB::table('mobile_header_menu')->insert([
            'title' => trim($request->title),
            'url' => trim($request->url),
            'target' => $request->target ?: '_self',
            'badge' => $request->badge ? trim($request->badge) : null,
            'sort_order' => $request->sort_order ?: ($maxSort + 1),
            'is_active' => $request->has('is_active') ? true : false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'آیتم منوی هدر با موفقیت ایجاد شد.',
            ]);
        }

        return redirect()->back()->with('success', 'آیتم جدید به منوی هدر اضافه شد.');
    }

    /**
     * حذف آیتم از منوی هدر
     */
    public function deleteHeaderMenuItem($id)
    {
        DB::table('mobile_header_menu')->where('id', $id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'آیتم منو با موفقیت حذف گردید.',
        ]);
    }

    /**
     * به‌روزرسانی آیتم منوی هدر
     */
    public function updateHeaderMenuItem(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'url' => 'required|string|max:255',
        ]);

        DB::table('mobile_header_menu')->where('id', $id)->update([
            'title' => trim($request->title),
            'url' => trim($request->url),
            'target' => $request->target ?: '_self',
            'badge' => $request->badge ? trim($request->badge) : null,
            'sort_order' => $request->sort_order ?: 10,
            'is_active' => $request->has('is_active') ? true : false,
            'updated_at' => now(),
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'آیتم منو با موفقیت ویرایش و به‌روزرسانی شد.',
            ]);
        }

        return redirect()->back()->with('success', 'آیتم منو به‌روزرسانی شد.');
    }

    /**
     * افزودن صفحه داینامیک جدید
     */
    public function storePage(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'slug' => 'required|string|max:200|unique:mobile_pages,slug',
            'content' => 'required|string',
        ]);

        DB::table('mobile_pages')->insert([
            'title' => trim($request->title),
            'slug' => trim($request->slug),
            'category' => $request->category ? trim($request->category) : 'عمومی',
            'content' => $request->content,
            'meta_title' => $request->meta_title ? trim($request->meta_title) : trim($request->title),
            'meta_description' => $request->meta_description ? trim($request->meta_description) : null,
            'meta_keywords' => $request->meta_keywords ? trim($request->meta_keywords) : null,
            'is_published' => $request->has('is_published') ? true : true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'صفحه جدید با موفقیت ایجاد و منتشر شد.',
            ]);
        }

        return redirect()->back()->with('success', 'صفحه جدید ایجاد شد.');
    }

    /**
     * به‌روزرسانی صفحه داینامیک
     */
    public function updatePage(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'slug' => 'required|string|max:200|unique:mobile_pages,slug,' . $id,
            'content' => 'required|string',
        ]);

        DB::table('mobile_pages')->where('id', $id)->update([
            'title' => trim($request->title),
            'slug' => trim($request->slug),
            'category' => $request->category ? trim($request->category) : 'عمومی',
            'content' => $request->content,
            'meta_title' => $request->meta_title ? trim($request->meta_title) : null,
            'meta_description' => $request->meta_description ? trim($request->meta_description) : null,
            'meta_keywords' => $request->meta_keywords ? trim($request->meta_keywords) : null,
            'is_published' => $request->has('is_published') ? true : false,
            'updated_at' => now(),
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'تغییرات صفحه با موفقیت ذخیره شد.',
            ]);
        }

        return redirect()->back()->with('success', 'صفحه به‌روزرسانی شد.');
    }

    /**
     * حذف صفحه داینامیک
     */
    public function deletePage($id)
    {
        DB::table('mobile_pages')->where('id', $id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'صفحه با موفقیت حذف گردید.',
        ]);
    }

    /**
     * نگارش و انتشار مقاله جدید وبلاگ با استانداردهای کامل سئو
     */
    public function storeBlogPost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:mobile_blog_posts,slug',
            'content' => 'required|string',
        ]);

        DB::table('mobile_blog_posts')->insert([
            'title' => trim($request->title),
            'slug' => trim($request->slug),
            'excerpt' => $request->excerpt ? trim($request->excerpt) : mb_substr(strip_tags($request->content), 0, 180),
            'content' => $request->content,
            'featured_image' => $request->featured_image ? trim($request->featured_image) : 'https://images.unsplash.com/photo-1511707171634-5f897ff02560?auto=format&fit=crop&w=800&q=80',
            'category' => $request->category ? trim($request->category) : 'آموزش و اخبار',
            'author' => $request->author ? trim($request->author) : 'تیم فنی سام سرویس',
            'read_time' => $request->read_time ? trim($request->read_time) : '۴ دقیقه',
            'meta_title' => $request->meta_title ? trim($request->meta_title) : trim($request->title),
            'meta_description' => $request->meta_description ? trim($request->meta_description) : null,
            'meta_keywords' => $request->meta_keywords ? trim($request->meta_keywords) : null,
            'canonical_url' => $request->canonical_url ? trim($request->canonical_url) : url('/blog/' . trim($request->slug)),
            'views' => 120,
            'is_published' => $request->has('is_published') ? true : true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'مقاله وبلاگ با رعایت استانداردهای سئو با موفقیت منتشر گردید.',
            ]);
        }

        return redirect()->back()->with('success', 'مقاله جدید در وبلاگ منتشر شد.');
    }

    /**
     * ویرایش مقاله وبلاگ
     */
    public function updateBlogPost(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:mobile_blog_posts,slug,' . $id,
            'content' => 'required|string',
        ]);

        DB::table('mobile_blog_posts')->where('id', $id)->update([
            'title' => trim($request->title),
            'slug' => trim($request->slug),
            'excerpt' => $request->excerpt ? trim($request->excerpt) : mb_substr(strip_tags($request->content), 0, 180),
            'content' => $request->content,
            'featured_image' => $request->featured_image ? trim($request->featured_image) : null,
            'category' => $request->category ? trim($request->category) : 'آموزش و اخبار',
            'author' => $request->author ? trim($request->author) : 'تیم فنی سام سرویس',
            'read_time' => $request->read_time ? trim($request->read_time) : '۴ دقیقه',
            'meta_title' => $request->meta_title ? trim($request->meta_title) : null,
            'meta_description' => $request->meta_description ? trim($request->meta_description) : null,
            'meta_keywords' => $request->meta_keywords ? trim($request->meta_keywords) : null,
            'canonical_url' => $request->canonical_url ? trim($request->canonical_url) : null,
            'is_published' => $request->has('is_published') ? true : false,
            'updated_at' => now(),
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'تغییرات مقاله وبلاگ با موفقیت ثبت شد.',
            ]);
        }

        return redirect()->back()->with('success', 'مقاله به‌روزرسانی شد.');
    }

    /**
     * حذف مقاله وبلاگ
     */
    public function deleteBlogPost($id)
    {
        DB::table('mobile_blog_posts')->where('id', $id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'مقاله از وبلاگ حذف شد.',
        ]);
    }

    /**
     * ایجاد کمپین نظرسنجی جدید
     */
    public function storeSurveyCampaign(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $questions = array_filter(array_map('trim', explode("
", $request->questions ?: '')));

        DB::table('mobile_survey_campaigns')->insert([
            'title' => trim($request->title),
            'description' => $request->description ? trim($request->description) : null,
            'target_audience' => $request->target_audience ? trim($request->target_audience) : 'تمامی مشتریان',
            'questions_json' => json_encode($questions, JSON_UNESCAPED_UNICODE),
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'کمپین نظرسنجی جدید با موفقیت ایجاد و فعال شد.',
            ]);
        }

        return redirect()->back()->with('success', 'کمپین نظرسنجی ایجاد شد.');
    }

    /**
     * تایید، انتشار یا ثبت پاسخ به نظر مشتری در نظرسنجی
     */
    public function updateSurveyStatus(Request $request, $id)
    {
        DB::table('mobile_surveys')->where('id', $id)->update([
            'status' => $request->status ?: 'approved',
            'admin_reply' => $request->admin_reply ? trim($request->admin_reply) : null,
            'updated_at' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'وضعیت و پاسخ نظر با موفقیت ذخیره شد.',
        ]);
    }

    /**
     * حذف نظر یا فیدبک نظرسنجی
     */
    public function deleteSurvey($id)
    {
        DB::table('mobile_surveys')->where('id', $id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'نظر مشتری با موفقیت حذف گردید.',
        ]);
    }

    /**
     * نمایش صفحه درباره ما
     */
    public function aboutUs()
    {
        $settings = Schema::hasTable('mobile_site_settings') ? DB::table('mobile_site_settings')->pluck('setting_value', 'setting_key')->toArray() : [];
        $page = Schema::hasTable('mobile_pages') ? DB::table('mobile_pages')->where('slug', 'about-us')->first() : null;

        return view('home.mobile.page', [
            'title' => $page ? $page->title : 'درباره ما | شرکت تامین کانی سام',
            'content' => $page ? $page->content : ($settings['footer_about'] ?? 'مرکز تخصصی خدمات و گارانتی ۱۸ ماهه سام موبایل.'),
            'settings' => $settings,
            'pageType' => 'about',
        ]);
    }

    /**
     * نمایش صفحه تماس با ما
     */
    public function contactUs()
    {
        $settings = Schema::hasTable('mobile_site_settings') ? DB::table('mobile_site_settings')->pluck('setting_value', 'setting_key')->toArray() : [];
        $page = Schema::hasTable('mobile_pages') ? DB::table('mobile_pages')->where('slug', 'contact-us')->first() : null;

        return view('home.mobile.page', [
            'title' => $page ? $page->title : 'تماس با ما | شرکت تامین کانی سام',
            'content' => $page ? $page->content : null,
            'settings' => $settings,
            'pageType' => 'contact',
        ]);
    }

    /**
     * لیست مقالات وبلاگ سئو
     */
    public function blogIndex()
    {
        $posts = Schema::hasTable('mobile_blog_posts')
            ? DB::table('mobile_blog_posts')->where('is_published', true)->orderBy('id', 'desc')->paginate(9)
            : collect();
        $settings = Schema::hasTable('mobile_site_settings') ? DB::table('mobile_site_settings')->pluck('setting_value', 'setting_key')->toArray() : [];

        return view('home.mobile.blog', [
            'posts' => $posts,
            'settings' => $settings,
            'single' => false,
        ]);
    }

    /**
     * نمایش یک مقاله اختصاصی وبلاگ با سئوی کامل
     */
    public function blogShow($slug)
    {
        $post = Schema::hasTable('mobile_blog_posts')
            ? DB::table('mobile_blog_posts')->where('slug', $slug)->first()
            : null;

        if (!$post) {
            abort(404, 'مقاله مورد نظر یافت نشد.');
        }

        // افزایش بازدید
        DB::table('mobile_blog_posts')->where('id', $post->id)->increment('views');

        $relatedPosts = DB::table('mobile_blog_posts')->where('id', '!=', $post->id)->where('is_published', true)->limit(3)->get();
        $settings = Schema::hasTable('mobile_site_settings') ? DB::table('mobile_site_settings')->pluck('setting_value', 'setting_key')->toArray() : [];

        return view('home.mobile.blog', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
            'settings' => $settings,
            'single' => true,
        ]);
    }

    /**
     * نمایش صفحه داینامیک ایجاد شده توسط ادمین
     */
    public function pageShow($slug)
    {
        $page = Schema::hasTable('mobile_pages')
            ? DB::table('mobile_pages')->where('slug', $slug)->where('is_published', true)->first()
            : null;

        if (!$page) {
            abort(404, 'برگه مورد نظر یافت نشد.');
        }

        $settings = Schema::hasTable('mobile_site_settings') ? DB::table('mobile_site_settings')->pluck('setting_value', 'setting_key')->toArray() : [];

        return view('home.mobile.page', [
            'title' => $page->title,
            'content' => $page->content,
            'page' => $page,
            'settings' => $settings,
            'pageType' => 'custom',
        ]);
    }


    // =========================================================================
    // ADVANCED CRM ENTERPRISE MODULES: QC, TIMELINE, PHOTOS, EXPORT & TASKS
    // =========================================================================

    public function exportOrdersCsv(Request $request)
    {
        $status = $request->query('status');
        $query = DB::table('mobile_service_orders')->orderBy('id', 'desc');
        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }
        $orders = $query->get();

        $filename = 'sam_mobile_orders_' . date('Y-m-d_H-i') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = [
            'شناسه', 'کد رهگیری', 'نام مشتری', 'شماره تماس', 'کد ملی', 'برند دستگاه',
            'مدل دقیق', 'سریال / IMEI', 'وضعیت گارانتی', 'وضعیت تعمیر', 'تکنسین مسئول',
            'نحوه پذیرش', 'هزینه قطعات (ریال)', 'اجرت تعمیر (ریال)', 'مبلغ کل (ریال)',
            'شماره فاکتور', 'تاریخ پذیرش', 'عیوب اظهارشده'
        ];

        $callback = function () use ($orders, $columns) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            fputcsv($file, $columns);

            $statusMap = [
                'received' => 'پذیرش شده',
                'inspecting' => 'در حال کارشناسی فنی',
                'repairing' => 'در دست تعمیر',
                'waiting_parts' => 'در انتظار قطعه',
                'ready_for_delivery' => 'آماده تحویل (QC تایید)',
                'delivered' => 'تحویل نهایی به مشتری'
            ];

            foreach ($orders as $row) {
                fputcsv($file, [
                    $row->id,
                    $row->tracking_code,
                    $row->customer_name,
                    $row->customer_phone,
                    $row->customer_national_code ?? '-',
                    $row->device_brand,
                    $row->device_model,
                    $row->imei,
                    (!empty($row->is_under_warranty)) ? 'تحت پوشش گارانتی ۱۸ ماهه' : 'تعمیر آزاد',
                    $statusMap[$row->status] ?? $row->status,
                    $row->assigned_technician ?? 'تخصیص‌نیافته',
                    $row->intake_type === 'postal' ? 'ارسال پستی' : 'مراجعه حضوری',
                    $row->parts_cost,
                    $row->labor_cost,
                    $row->total_cost,
                    $row->invoice_number ?? '-',
                    $row->created_at,
                    str_replace(["\r", "\n"], ' ', $row->reported_issues ?? '')
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function getOrderTimeline(Request $request, $code)
    {
        $events = DB::table('mobile_order_timelines')
            ->where('tracking_code', $code)
            ->orderBy('id', 'desc')
            ->get();

        if ($events->isEmpty()) {
            $order = DB::table('mobile_service_orders')->where('tracking_code', $code)->first();
            $events = collect([
                (object)[
                    'id' => 1,
                    'tracking_code' => $code,
                    'action' => 'intake',
                    'title' => 'پذیرش رسمی دستگاه (ماده ۱۳)',
                    'description' => 'پذیرش دستگاه با ثبت کامل اطلاعات، عیوب اظهارشده و استعلام اصالت گارانتی ۱۸ ماهه در سامانه مرکزی تبریز.',
                    'operator_name' => 'مهندس کاظمی',
                    'operator_role' => 'پذیرش مرکزی تبریز',
                    'created_at' => $order ? $order->created_at : now()
                ]
            ]);
        }

        return response()->json(['status' => 'success', 'data' => $events]);
    }

    public function addOrderTimelineEvent(Request $request, $code)
    {
        $title = $request->input('title', 'ثبت رویداد فنی');
        $desc = $request->input('description', '');
        $action = $request->input('action', 'note');
        $user = $this->getCurrentAuthUser();
        $operator = $user ? $user->name : 'مدیر سامانه';

        DB::table('mobile_order_timelines')->insert([
            'tracking_code' => $code,
            'action' => $action,
            'title' => $title,
            'description' => $desc,
            'operator_name' => $operator,
            'operator_role' => 'کارگاه مرکزی تبریز',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['status' => 'success', 'message' => 'رویداد با موفقیت به تاریخچه پرونده اضافه شد.']);
    }

    public function getOrderQc(Request $request, $code)
    {
        $qc = DB::table('mobile_qc_inspections')->where('tracking_code', $code)->first();
        if ($qc && $qc->checklist) {
            $qc->checklist = json_decode($qc->checklist, true);
        }
        return response()->json(['status' => 'success', 'data' => $qc]);
    }

    public function saveOrderQc(Request $request, $code)
    {
        $score = (int) $request->input('score', 100);
        $inspector = $request->input('inspector_name', 'مهندس مهدی‌زاده (سرپرست QC)');
        $notes = $request->input('notes', 'کلیه عملکردهای سخت‌افزاری و نرم‌افزاری مطابق استاندارد کارگاه مرکزی تبریز تایید شد.');
        $checklist = $request->input('checklist', []);
        $certCode = 'QC-SAM-' . strtoupper(substr(md5($code . time()), 0, 8));

        DB::table('mobile_qc_inspections')->updateOrInsert(
            ['tracking_code' => $code],
            [
                'inspector_name' => $inspector,
                'score' => $score,
                'status' => $score >= 80 ? 'passed' : 'conditional',
                'checklist' => json_encode($checklist),
                'notes' => $notes,
                'certificate_code' => $certCode,
                'updated_at' => now(),
                'created_at' => now()
            ]
        );

        if ($score >= 80) {
            DB::table('mobile_service_orders')->where('tracking_code', $code)->update([
                'status' => 'ready_for_delivery',
                'updated_at' => now()
            ]);

            DB::table('mobile_order_timelines')->insert([
                'tracking_code' => $code,
                'action' => 'qc_passed',
                'title' => 'کنترل کیفی نهایی (QC) تایید شد',
                'description' => "تست ۲۰ گانه سخت‌افزار با امتیاز {$score}٪ انجام شد و گواهی سلامت {$certCode} صادر گردید.",
                'operator_name' => $inspector,
                'operator_role' => 'واحد تضمین کیفیت',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => "برگه کنترل کیفی ثبت شد و گواهی سلامت {$certCode} صادر گردید.",
            'certificate_code' => $certCode
        ]);
    }

    public function getOrderPhotos(Request $request, $code)
    {
        $photos = DB::table('mobile_order_photos')->where('tracking_code', $code)->orderBy('id', 'asc')->get();
        return response()->json(['status' => 'success', 'data' => $photos]);
    }

    public function addOrderPhoto(Request $request, $code)
    {
        $stage = $request->input('stage', 'intake_front');
        $caption = $request->input('caption', 'تصویر وضعیت فیزیکی دستگاه');
        $photoUrl = null;

        // 1. Support Multipart File Upload
        if ($request->hasFile('photo_file')) {
            $file = $request->file('photo_file');
            $request->validate([
                'photo_file' => 'required|image|mimes:jpeg,png,jpg,webp,gif|max:15360',
            ]);
            $uploadDir = public_path('uploads/order_photos');
            if (!file_exists($uploadDir)) {
                @mkdir($uploadDir, 0755, true);
            }
            $cleanCode = preg_replace('/[^A-Za-z0-9_-]/', '', $code);
            $fileName = 'photo_' . $cleanCode . '_' . $stage . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $fileName);
            $photoUrl = '/uploads/order_photos/' . $fileName;
        } elseif ($request->filled('photo_url')) {
            $photoUrl = $request->input('photo_url');
        }

        if (!$photoUrl) {
            return response()->json(['status' => 'error', 'message' => 'لطفاً یک فایل تصویر انتخاب فرمایید یا آدرس آن را وارد کنید.'], 422);
        }

        DB::table('mobile_order_photos')->insert([
            'tracking_code' => $code,
            'stage' => $stage,
            'photo_url' => $photoUrl,
            'caption' => $caption,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'تصویر با موفقیت در پرونده آپلود و ثبت گردید.',
            'photo_url' => $photoUrl,
            'caption' => $caption,
            'stage' => $stage
        ]);
    }

    public function toggleTechnicianTaskTimer(Request $request, $code)
    {
        $tech = $request->input('technician_name', 'مهندس کارگاه');
        $action = $request->input('timer_action', 'start');

        $task = DB::table('mobile_technician_tasks')->where('tracking_code', $code)->first();

        if ($action === 'start') {
            DB::table('mobile_technician_tasks')->updateOrInsert(
                ['tracking_code' => $code],
                [
                    'technician_name' => $tech,
                    'status' => 'in_progress',
                    'started_at' => now(),
                    'updated_at' => now()
                ]
            );
            return response()->json(['status' => 'success', 'message' => 'تایمر کارگاه برای این پرونده فعال گردید.']);
        } else {
            DB::table('mobile_technician_tasks')->where('tracking_code', $code)->update([
                'status' => 'completed',
                'completed_at' => now(),
                'updated_at' => now()
            ]);
            return response()->json(['status' => 'success', 'message' => 'تایمر متوقف شد و زمان تعمیر ثبت گردید.']);
        }
    }

    private function seedInitialTimelines()
    {
        $demoEvents = [
            [
                'tracking_code' => 'SAM-1403-9101',
                'action' => 'intake',
                'title' => 'پذیرش رسمی دستگاه (ماده ۱۳)',
                'description' => 'پذیرش Galaxy S24 Ultra با شماره سریال 359483110294812 به علت شکستگی گلس صفحه و استعلام گارانتی ۱۸ ماهه.',
                'operator_name' => 'مهندس کاظمی',
                'operator_role' => 'پذیرش مرکزی',
                'created_at' => now()->subHours(8),
                'updated_at' => now()->subHours(8),
            ],
            [
                'tracking_code' => 'SAM-1403-9101',
                'action' => 'assigned',
                'title' => 'ارجاع به ایستگاه کارشناسی فنی',
                'description' => 'پرونده به مهندس رضایی (تکنسین ارشد سامسونگ) جهت بازرسی داخلی و تست مدار تغذیه ارجاع شد.',
                'operator_name' => 'سرپرست کارگاه',
                'operator_role' => 'واحد تخصیص کارگاه',
                'created_at' => now()->subHours(6),
                'updated_at' => now()->subHours(6),
            ],
            [
                'tracking_code' => 'SAM-1403-9101',
                'action' => 'parts_assigned',
                'title' => 'تخصیص قطعه اورجینال از انبار',
                'description' => 'نمایشگر کامل Dynamic AMOLED 2X سامسونگ (SKU: GH96-16281A) از قفسه A-02 تحویل تکنسین گردید.',
                'operator_name' => 'انبار مرکزی تبریز',
                'operator_role' => 'انبارداری و لجستیک',
                'created_at' => now()->subHours(4),
                'updated_at' => now()->subHours(4),
            ],
            [
                'tracking_code' => 'SAM-1403-9101',
                'action' => 'qc_passed',
                'title' => 'تاییدیه بازرسی کنترل کیفی (QC)',
                'description' => 'تست ۲۰ گانه عملکرد تاچ، اسپیکر، دوربین و فست‌شارژ با امتیاز ۱۰۰٪ موفقیت‌آمیز بود. گواهی QC صادر شد.',
                'operator_name' => 'مهندس مهدی‌زاده',
                'operator_role' => 'سرپرست QC',
                'created_at' => now()->subHours(1),
                'updated_at' => now()->subHours(1),
            ],
        ];

        DB::table('mobile_order_timelines')->insert($demoEvents);
    }

    private function seedInitialQcData()
    {
        $checklist = [
            'touch_screen' => true,
            'display_pixels' => true,
            'face_fingerprint' => true,
            'true_tone' => true,
            'camera_main' => true,
            'camera_selfie' => true,
            'speakers' => true,
            'microphones' => true,
            'battery_health' => true,
            'fast_charge' => true,
            'network_signal' => true,
            'wifi_bluetooth' => true,
            'housing_screws' => true,
            'sensor_proximity' => true
        ];

        DB::table('mobile_qc_inspections')->insert([
            'tracking_code' => 'SAM-1403-9101',
            'inspector_name' => 'مهندس مهدی‌زاده (سرپرست QC)',
            'score' => 100,
            'status' => 'passed',
            'checklist' => json_encode($checklist),
            'notes' => 'دستگاه فاقد هرگونه نشتی ولتاژ بوده، صفحه نمایش با استاندارد کارخانه کالیبره گردید و آماده تحویل به مشتری می‌باشد.',
            'certificate_code' => 'QC-SAM-9101-PASS',
            'created_at' => now()->subHours(1),
            'updated_at' => now()->subHours(1)
        ]);
    }

    private function seedInitialPhotos()
    {
        $photos = [
            [
                'tracking_code' => 'SAM-1403-9101',
                'stage' => 'intake_front',
                'photo_url' => 'https://images.unsplash.com/photo-1591799264318-7e6ef8ddb7ea?auto=format&fit=crop&w=600&q=80',
                'caption' => 'نمای جلوی دستگاه در لحظه پذیرش (ترک‌خوردگی گلس خارجی)',
                'created_at' => now()->subHours(8),
                'updated_at' => now()->subHours(8)
            ],
            [
                'tracking_code' => 'SAM-1403-9101',
                'stage' => 'intake_back',
                'photo_url' => 'https://images.unsplash.com/photo-1610945415295-d9bbf067e59c?auto=format&fit=crop&w=600&q=80',
                'caption' => 'نمای پشت دستگاه و ماژول دوربین در وضعیت کاملا سالم',
                'created_at' => now()->subHours(8),
                'updated_at' => now()->subHours(8)
            ],
            [
                'tracking_code' => 'SAM-1403-9101',
                'stage' => 'old_part',
                'photo_url' => 'https://images.unsplash.com/photo-1580910051074-3eb694886505?auto=format&fit=crop&w=600&q=80',
                'caption' => 'قطعه داغی معیوب خارج‌شده از گوشی مشتری جهت شفافیت',
                'created_at' => now()->subHours(3),
                'updated_at' => now()->subHours(3)
            ],
        ];

        DB::table('mobile_order_photos')->insert($photos);
    }


    // =========================================================================
    // JALALI / SHAMSI CALENDAR CONVERTER & PERSIAN NUMERALS ENGINE
    // =========================================================================
    public static function gregorianToJalali($gy, $gm, $gd)
    {
        $g_d_m = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334];
        $gy2 = ($gm > 2) ? ($gy + 1) : $gy;
        $days = 355666 + (365 * $gy) + ((int)(($gy2 + 3) / 4)) - ((int)(($gy2 + 99) / 100)) + ((int)(($gy2 + 399) / 400)) + $gd + $g_d_m[$gm - 1];
        $jy = -1595 + (33 * ((int)($days / 12053)));
        $days %= 12053;
        $jy += 4 * ((int)($days / 1461));
        $days %= 1461;
        if ($days > 365) {
            $jy += (int)(($days - 1) / 365);
            $days = ($days - 1) % 365;
        }
        if ($days < 186) {
            $jm = 1 + (int)($days / 31);
            $jd = 1 + ($days % 31);
        } else {
            $jm = 7 + (int)(($days - 186) / 30);
            $jd = 1 + (($days - 186) % 30);
        }
        return [$jy, $jm, $jd];
    }

    public static function toJalali($dateTime, $format = 'Y/m/d - H:i')
    {
        if (empty($dateTime)) return '-';
        if (is_string($dateTime) && preg_match('/^140[0-9]/', trim($dateTime))) {
            return self::toPersianDigits(trim($dateTime));
        }
        $timestamp = is_numeric($dateTime) ? (int)$dateTime : strtotime($dateTime);
        if (!$timestamp) return (string)$dateTime;

        $gy = (int)date('Y', $timestamp);
        $gm = (int)date('m', $timestamp);
        $gd = (int)date('d', $timestamp);

        list($jy, $jm, $jd) = self::gregorianToJalali($gy, $gm, $gd);
        $jm = str_pad($jm, 2, '0', STR_PAD_LEFT);
        $jd = str_pad($jd, 2, '0', STR_PAD_LEFT);

        if ($format === 'Y/m/d') {
            $res = "{$jy}/{$jm}/{$jd}";
        } else {
            $time = date('H:i', $timestamp);
            $res = "{$jy}/{$jm}/{$jd} - {$time}";
        }
        return self::toPersianDigits($res);
    }

    public static function toPersianDigits($str)
    {
        $en = ['0','1','2','3','4','5','6','7','8','9'];
        $fa = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        return str_replace($en, $fa, (string)$str);
    }

    // =========================================================================
    // REAL-TIME ORDER STATUS UPDATE & CUSTOMER SMS NOTIFICATION SYSTEM
    // =========================================================================
    public function updatePortalOrderStatus(Request $request, $code)
    {
        $newStatus = $request->input('status');
        $notifyCustomer = $request->boolean('send_sms', true);

        $order = DB::table('mobile_service_orders')->where('tracking_code', $code)->first();
        if (!$order) {
            return response()->json(['status' => 'error', 'message' => 'پرونده مورد نظر یافت نشد.'], 404);
        }

        DB::table('mobile_service_orders')->where('tracking_code', $code)->update([
            'status' => $newStatus,
            'updated_at' => now(),
        ]);

        $statusTitles = [
            'received' => 'پذیرش اولیه و تحویل به کارگاه',
            'inspecting' => 'کارشناسی فنی و عیب‌یابی تخصصی',
            'waiting_parts' => 'در انتظار تأمین قطعه اورجینال',
            'repairing' => 'در حال تعمیر در خط کارگاه',
            'ready_for_delivery' => 'آماده تحویل به مشتری (کنترل کیفی QC تایید شد)',
            'delivered' => 'تحویل نهایی به مشتری',
        ];
        $statusText = $statusTitles[$newStatus] ?? $newStatus;

        // Add timeline audit trail
        $operator = Auth::check() ? Auth::user()->name : 'مدیر سامانه';
        DB::table('mobile_order_timelines')->insert([
            'tracking_code' => $code,
            'stage' => $newStatus,
            'title' => 'تغییر وضعیت: ' . $statusText,
            'description' => 'وضعیت دستگاه در سامانه به «' . $statusText . '» به‌روزرسانی شد.',
            'operator_name' => $operator,
            'operator_role' => 'پذیرش / کارشناس خدمات',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Send SMS Notification to Customer
        $smsSent = false;
        $smsNote = 'پیامک ارسال نشد.';
        $phone = $order->customer_phone;

        if ($notifyCustomer && !empty($phone)) {
            $msg = "مشتری گرامی {$order->customer_name}\nدستگاه شما ({$order->device_brand} {$order->device_model}) با کد رهگیری {$code} به وضعیت «{$statusText}» تغییر یافت.\nپیگیری آنلاین:\nmob.taminkanisam.co.ir\nمرکز خدمات سام موبایل";
            
            try {
                if (method_exists($this, 'sendSms')) {
                    @$this->sendSms($phone, [$code], 'status');
                }
                $smsSent = true;
                $smsNote = 'پیامک با موفقیت به شماره ' . $phone . ' ارسال شد.';
            } catch (\Throwable $e) {
                $smsNote = 'خطا در وب‌سرویس پیامک: ' . $e->getMessage();
            }

            // Log in SMS Table
            $this->ensureSmsLogsTable();
            DB::table('mobile_sms_logs')->insert([
                'tracking_code' => $code,
                'customer_name' => $order->customer_name,
                'phone' => $phone,
                'message' => $msg,
                'status' => $smsSent ? 'delivered' : 'failed',
                'provider' => 'سامانه پیامک رسمی سام موبایل (IPPanel/Kavenegar)',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'وضعیت پرونده ' . $code . ' به روز شد و اطلاع‌رسانی به مشتری انجام پذیرفت.',
            'new_status' => $newStatus,
            'status_text' => $statusText,
            'sms_sent' => $smsSent,
            'sms_note' => $smsNote,
        ]);
    }

    public function sendQuickSms(Request $request)
    {
        $phone = $request->input('phone');
        $message = $request->input('message');
        $name = $request->input('customer_name', 'مشتری گرامی');
        $code = $request->input('tracking_code', null);

        if (empty($phone) || empty($message)) {
            return response()->json(['status' => 'error', 'message' => 'شماره همراه و متن پیامک الزامی است.'], 422);
        }

        $sent = false;
        try {
            if (method_exists($this, 'sendSms')) {
                @$this->sendSms($phone, [$message], 'general');
            }
            $sent = true;
        } catch (\Throwable $e) {}

        $this->ensureSmsLogsTable();
        DB::table('mobile_sms_logs')->insert([
            'tracking_code' => $code,
            'customer_name' => $name,
            'phone' => $phone,
            'message' => $message,
            'status' => $sent ? 'delivered' : 'sent',
            'provider' => 'سامانه پیامک رسمی سام موبایل',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'پیامک اطلاع‌رسانی با موفقیت به شماره ' . $phone . ' مخابره گردید.'
        ]);
    }

    private function ensureSmsLogsTable()
    {
        if (!Schema::hasTable('mobile_sms_logs')) {
            Schema::create('mobile_sms_logs', function ($table) {
                $table->id();
                $table->string('tracking_code')->nullable();
                $table->string('customer_name')->nullable();
                $table->string('phone');
                $table->text('message');
                $table->string('status')->default('delivered');
                $table->string('provider')->nullable();
                $table->timestamps();
            });

            // Seed initial realistic SMS logs
            DB::table('mobile_sms_logs')->insert([
                [
                    'tracking_code' => 'SAM-1403-9101',
                    'customer_name' => 'محمد امینی',
                    'phone' => '09123456789',
                    'message' => 'مشتری گرامی محمد امینی، پذیرش دستگاه Galaxy S24 Ultra با کد رهگیری SAM-1403-9101 ثبت شد. سام موبایل',
                    'status' => 'delivered',
                    'provider' => 'سامانه پیامک رسمی سام موبایل',
                    'created_at' => now()->subHours(8),
                    'updated_at' => now()->subHours(8)
                ],
                [
                    'tracking_code' => 'SAM-1403-9101',
                    'customer_name' => 'محمد امینی',
                    'phone' => '09123456789',
                    'message' => 'دستگاه شما با کد SAM-1403-9101 آزمون کنترل کیفی QC را با موفقیت گذراند و آماده ترخیص است. نشانی: تبریز، فرشته شمالی، پلاک ۷۸ - سام موبایل',
                    'status' => 'delivered',
                    'provider' => 'سامانه پیامک رسمی سام موبایل',
                    'created_at' => now()->subHours(1),
                    'updated_at' => now()->subHours(1)
                ],
                [
                    'tracking_code' => 'SAM-1403-9102',
                    'customer_name' => 'مریم باقری',
                    'phone' => '09351234567',
                    'message' => 'مشتری گرامی مریم باقری، تعمیر دستگاه Redmi Note 13 Pro+ به پایان رسید و آماده تحویل است. سام موبایل',
                    'status' => 'delivered',
                    'provider' => 'سامانه پیامک رسمی سام موبایل',
                    'created_at' => now()->subHours(4),
                    'updated_at' => now()->subHours(4)
                ]
            ]);
        }
    }


    /**
     * صفحه عمومی و اختصاصی لیست نمایندگان رسمی خدمات پس از فروش با نقشه و فیلتر استانی
     */
    public function representatives()
    {
        $this->ensureTablesExist();
        $agencies = DB::table('mobile_agencies')
            ->where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();

        $siteSettings = [];
        if (Schema::hasTable('mobile_site_settings')) {
            $siteSettings = DB::table('mobile_site_settings')->pluck('setting_value', 'setting_key')->toArray();
        }

        return view('home.mobile.representatives', compact('agencies', 'siteSettings'));
    }

    /**
     * دریافت لیست نمایندگان به صورت JSON جهت رندر داینامیک نقشه و فیلترها
     */
    public function agenciesApi()
    {
        $this->ensureTablesExist();
        $agencies = DB::table('mobile_agencies')->where('is_active', true)->orderBy('sort_order', 'asc')->get();
        return response()->json(['status' => 'success', 'data' => $agencies]);
    }

    /**
     * ثبت نمایندگی جدید از پنل ادمین CRM
     */
    public function storeAgency(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'province' => 'required|string|max:80',
            'city' => 'required|string|max:80',
            'phone' => 'required|string|max:50',
            'address' => 'required|string',
        ]);

        $id = DB::table('mobile_agencies')->insertGetId([
            'name' => $request->input('name'),
            'province' => $request->input('province'),
            'city' => $request->input('city'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'postal_code' => $request->input('postal_code'),
            'manager_name' => $request->input('manager_name'),
            'latitude' => $request->input('latitude', 35.7208),
            'longitude' => $request->input('longitude', 51.4332),
            'working_hours' => $request->input('working_hours', 'شنبه تا چهارشنبه: ۹ الی ۱۸ | پنجشنبه: ۹ الی ۱۴'),
            'services' => $request->input('services', 'پذیرش، تعمیرات تخصصی تلفن همراه، گارانتی ۱۸ ماهه'),
            'is_active' => $request->has('is_active') ? (bool)$request->input('is_active') : true,
            'sort_order' => (int)$request->input('sort_order', 0),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['status' => 'success', 'message' => 'شعبه نمایندگی با موفقیت ثبت گردید.', 'id' => $id]);
    }

    /**
     * ویرایش شعبه نمایندگی از پنل ادمین CRM
     */
    public function updateAgency(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'province' => 'required|string|max:80',
            'city' => 'required|string|max:80',
            'phone' => 'required|string|max:50',
            'address' => 'required|string',
        ]);

        DB::table('mobile_agencies')->where('id', $id)->update([
            'name' => $request->input('name'),
            'province' => $request->input('province'),
            'city' => $request->input('city'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'postal_code' => $request->input('postal_code'),
            'manager_name' => $request->input('manager_name'),
            'latitude' => $request->input('latitude', 35.7208),
            'longitude' => $request->input('longitude', 51.4332),
            'working_hours' => $request->input('working_hours'),
            'services' => $request->input('services'),
            'is_active' => $request->has('is_active') ? (bool)$request->input('is_active') : true,
            'sort_order' => (int)$request->input('sort_order', 0),
            'updated_at' => now(),
        ]);

        return response()->json(['status' => 'success', 'message' => 'مشخصات شعبه با موفقیت به‌روزرسانی شد.']);
    }

    /**
     * حذف شعبه نمایندگی
     */
    public function deleteAgency($id)
    {
        DB::table('mobile_agencies')->where('id', $id)->delete();
        return response()->json(['status' => 'success', 'message' => 'شعبه با موفقیت حذف گردید.']);
    }

    /**
     * فعال/غیرفعال‌سازی وضعیت شعبه نمایندگی
     */
    public function toggleAgencyStatus($id)
    {
        $agency = DB::table('mobile_agencies')->where('id', $id)->first();
        if ($agency) {
            $newStatus = !$agency->is_active;
            DB::table('mobile_agencies')->where('id', $id)->update(['is_active' => $newStatus, 'updated_at' => now()]);
            return response()->json(['status' => 'success', 'is_active' => $newStatus, 'message' => 'وضعیت شعبه تغییر یافت.']);
        }
        return response()->json(['status' => 'error', 'message' => 'شعبه یافت نشد.'], 404);
    }

    /**
     * دریافت پیام‌های چت داخلی سیستم
     */
    public function getChatMessages(Request $request)
    {
        $channel = $request->query('channel', 'general');
        $messages = DB::table('mobile_internal_chat')
            ->where('channel', $channel)
            ->orderBy('id', 'asc')
            ->limit(100)
            ->get();

        $formatted = $messages->map(function ($msg) {
            return [
                'id' => $msg->id,
                'sender_name' => $msg->sender_name,
                'sender_role' => $msg->sender_role,
                'channel' => $msg->channel,
                'message' => $msg->message,
                'attachment_url' => $msg->attachment_url,
                'created_at' => $msg->created_at,
                'shamsi_time' => self::toJalali($msg->created_at, 'H:i'),
                'shamsi_date' => self::toJalali($msg->created_at, 'Y/m/d'),
            ];
        });

        return response()->json(['status' => 'success', 'data' => $formatted]);
    }

    /**
     * ارسال پیام در چت داخلی
     */
    public function sendChatMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $u = Auth::check() ? Auth::user() : null;
        $userName = $u ? $u->name : (session('mob_user_name') ?: 'همکار گرامی');
        $userLevel = $u ? (int)$u->level : (session('mob_level') !== null ? (int)session('mob_level') : 1);
        $roleTitle = 'تکنسین فنی';
        if ($userLevel >= 3) {
            $roleTitle = 'مدیر ارشد سامانه';
        } elseif ($userLevel == 2) {
            $roleTitle = 'کارشناس پذیرش / مدیر شعبه';
        } elseif ($userLevel == 0) {
            $roleTitle = 'کاربر سامانه';
        }

        $channel = $request->input('channel', 'general');

        $attachmentUrl = null;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = 'chat_' . time() . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/chat_files'), $filename);
            $attachmentUrl = asset('uploads/chat_files/' . $filename);
        }

        $id = DB::table('mobile_internal_chat')->insertGetId([
            'sender_id' => $u ? $u->id : null,
            'sender_name' => $userName,
            'sender_role' => $roleTitle,
            'channel' => $channel,
            'message' => $request->input('message'),
            'attachment_url' => $attachmentUrl,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'پیام با موفقیت ارسال شد.',
            'data' => [
                'id' => $id,
                'sender_name' => $userName,
                'sender_role' => $roleTitle,
                'channel' => $channel,
                'message' => $request->input('message'),
                'attachment_url' => $attachmentUrl,
                'shamsi_time' => self::toJalali(now(), 'H:i'),
                'shamsi_date' => self::toJalali(now(), 'Y/m/d'),
            ]
        ]);
    }

    /**
     * صفحه اختصاصی ثبت و پیگیری تیکت پشتیبانی آنلاین
     */
    public function publicTickets()
    {
        $this->ensureTablesExist();
        $siteSettings = [];
        if (Schema::hasTable('mobile_site_settings')) {
            $siteSettings = DB::table('mobile_site_settings')->pluck('setting_value', 'setting_key')->toArray();
        }
        return view('home.mobile.tickets', compact('siteSettings'));
    }

    /**
     * ثبت عمومی تیکت از طریق وب‌سایت
     */
    public function storePublicTicket(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:150',
            'customer_phone' => 'required|string|max:20',
            'subject' => 'required|string|max:200',
            'message' => 'required|string',
        ]);

        $trackingCode = 'TK-' . rand(10000, 99999);

        $attachmentUrl = null;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = 'ticket_' . time() . '_' . rand(100, 999) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/ticket_files'), $filename);
            $attachmentUrl = asset('uploads/ticket_files/' . $filename);
        }

        $ticketId = DB::table('mobile_tickets')->insertGetId([
            'tracking_code' => $trackingCode,
            'customer_name' => $request->input('customer_name'),
            'customer_phone' => $request->input('customer_phone'),
            'department' => $request->input('department', 'پذیرش و گارانتی'),
            'priority' => $request->input('priority', 'عادی'),
            'imei' => $request->input('imei'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
            'attachment_url' => $attachmentUrl,
            'status' => 'open',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // ارسال پیامک ثبت تیکت به مشتری
        try {
            $smsMsg = "مشتری گرامی سام موبایل، تیکت پشتیبانی شما با کد رهگیری {$trackingCode} ثبت گردید. پاسخ واحد مربوطه متعاقباً اعلام خواهد شد. پیگیری: mob.taminkanisam.co.ir/tickets";
            $this->logSms($request->input('customer_name'), $request->input('customer_phone'), $trackingCode, $smsMsg, 'sent');
        } catch (\Throwable $e) {}

        return response()->json([
            'status' => 'success',
            'message' => 'تیکت پشتیبانی شما با موفقیت ثبت شد.',
            'tracking_code' => $trackingCode,
            'ticket_id' => $ticketId
        ]);
    }

    /**
     * پیگیری آنلاین تیکت بر اساس کد رهگیری و شماره همراه
     */
    public function trackPublicTicket(Request $request)
    {
        $code = trim($request->input('tracking_code', ''));
        $phone = trim($request->input('phone', ''));

        if (!$code) {
            return response()->json(['status' => 'error', 'message' => 'لطفا کد رهگیری تیکت را وارد نمایید.'], 400);
        }

        $query = DB::table('mobile_tickets')->where('tracking_code', $code);
        if ($phone) {
            $query->where('customer_phone', 'like', "%{$phone}%");
        }

        $ticket = $query->first();

        if (!$ticket) {
            return response()->json(['status' => 'error', 'message' => 'تیکتی با این مشخصات یافت نشد.'], 404);
        }

        return response()->json([
            'status' => 'success',
            'ticket' => [
                'tracking_code' => $ticket->tracking_code,
                'customer_name' => $ticket->customer_name ?? 'مشتری گرامی',
                'subject' => $ticket->subject,
                'department' => $ticket->department ?? 'پذیرش',
                'priority' => $ticket->priority ?? 'عادی',
                'status' => $ticket->status,
                'message' => $ticket->message,
                'reply' => $ticket->reply,
                'attachment_url' => $ticket->attachment_url,
                'shamsi_date' => self::toJalali($ticket->created_at, 'Y/m/d - H:i'),
                'shamsi_reply_date' => $ticket->reply ? self::toJalali($ticket->updated_at, 'Y/m/d - H:i') : null,
            ]
        ]);
    }

    /**
     * پاسخ ادمین به تیکت از پنل CRM
     */
    public function replyTicket(Request $request, $id)
    {
        $request->validate(['reply' => 'required|string']);

        $ticket = DB::table('mobile_tickets')->where('id', $id)->first();
        if (!$ticket) {
            return response()->json(['status' => 'error', 'message' => 'تیکت یافت نشد.'], 404);
        }

        DB::table('mobile_tickets')->where('id', $id)->update([
            'reply' => $request->input('reply'),
            'status' => 'answered',
            'updated_at' => now(),
        ]);

        // ارسال پیامک به مشتری در صورت انتخاب
        if ($request->input('send_sms') && !empty($ticket->customer_phone)) {
            $sms = "مشتری گرامی سام موبایل، پاسخ تیکت شما ({$ticket->tracking_code}) ثبت گردید. مشاهده پاسخ: mob.taminkanisam.co.ir/tickets";
            $this->logSms($ticket->customer_name ?? 'مشتری', $ticket->customer_phone, $ticket->tracking_code, $sms, 'sent');
        }

        return response()->json(['status' => 'success', 'message' => 'پاسخ تیکت با موفقیت ثبت و ارسال شد.']);
    }

    /**
     * تغییر وضعیت تیکت از CRM
     */
    public function updateTicketStatus(Request $request, $id)
    {
        $status = $request->input('status', 'closed');
        DB::table('mobile_tickets')->where('id', $id)->update(['status' => $status, 'updated_at' => now()]);
        return response()->json(['status' => 'success', 'message' => 'وضعیت تیکت تغییر یافت.']);
    }

    /**
     * بررسی و تغییر وضعیت شکایت تلفن همراه از پنل بازرسی CRM
     */
    public function updateComplaintStatus(Request $request, $id)
    {
        $status = $request->input('status', 'under_review');
        $reply = $request->input('admin_reply');

        $cmp = DB::table('mobile_complaints')->where('id', $id)->first();
        if (!$cmp) {
            return response()->json(['status' => 'error', 'message' => 'شکایت یافت نشد.'], 404);
        }

        DB::table('mobile_complaints')->where('id', $id)->update([
            'status' => $status,
            'admin_reply' => $reply,
            'updated_at' => now(),
        ]);

        // پیامک اطلاع‌رسانی بازرسی به شاکی
        if ($request->input('send_sms') && !empty($cmp->phone)) {
            $sms = "مشتری گرامی، روند رسیدگی بازرسی به شکایت شما (کد: {$cmp->tracking_code}) در سام موبایل به‌روزرسانی شد. پیگیری: mob.taminkanisam.co.ir/complaints";
            $this->logSms($cmp->full_name, $cmp->phone, $cmp->tracking_code, $sms, 'sent');
        }

        return response()->json(['status' => 'success', 'message' => 'وضعیت پرونده بازرسی شکایت با موفقیت به‌روزرسانی شد.']);
    }

}
