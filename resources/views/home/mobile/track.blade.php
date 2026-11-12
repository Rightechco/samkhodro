@extends('home.mobile.layout')

@section('title', 'پیگیری وضعیت پرونده و تعمیر دستگاه | تامین کانی سام (موبایل)')

@section('content')
<div class="page-container" style="max-width: 900px; margin: 30px auto; padding: 0 16px;">
    
    <!-- Header -->
    <div style="text-align: center; margin-bottom: 30px;">
        <span style="background: #eff6ff; color: #2563eb; font-weight: 800; font-size: 0.8rem; padding: 6px 16px; border-radius: 30px; border: 1px solid #bfdbfe;">
            رهگیری لحظه‌ای پرونده
        </span>
        <h1 style="font-size: 1.85rem; font-weight: 900; color: #0f172a; margin-top: 14px; margin-bottom: 8px;">
            پیگیری آنلاین وضعیت تعمیر و پذیرش دستگاه
        </h1>
        <p style="color: #64748b; font-size: 0.92rem; max-width: 600px; margin: 0 auto;">
            جهت مشاهده مرحله کارشناسی، تامین قطعه، هزینه مصوب و تاریخ تقریبی تحویل، کد رهگیری، شماره همراه یا کد IMEI را وارد نمایید.
        </p>
    </div>

    <!-- Search Box -->
    <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 28px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); margin-bottom: 30px;">
        <form action="{{ url('/track') }}" method="GET" style="display: flex; gap: 12px; flex-wrap: wrap;">
            <div style="flex-grow: 1; min-width: 250px;">
                <input type="text" name="code" value="{{ $code ?? '' }}" required placeholder="کد رهگیری (مثلاً SAM-1403-9102) یا کد IMEI یا شماره تماس..." style="width: 100%; padding: 14px 18px; border: 1px solid #cbd5e1; border-radius: 12px; font-size: 0.92rem;">
            </div>
            <button type="submit" style="background: #2563eb; color: #ffffff; border: none; border-radius: 12px; padding: 14px 28px; font-weight: 800; font-size: 0.95rem; cursor: pointer; display: flex; align-items: center; gap: 8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <span>استعلام لحظه‌ای</span>
            </button>
        </form>
    </div>

    @if(!empty($code))
        @if($order)
            <!-- Order Details Card -->
            <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 32px; box-shadow: 0 4px 25px rgba(0,0,0,0.04); margin-bottom: 30px;">
                
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px; padding-bottom: 20px; border-bottom: 1px solid #f1f5f9; flex-wrap: wrap; gap: 14px;">
                    <div>
                        <span style="background: #eff6ff; color: #2563eb; font-size: 0.76rem; font-weight: 800; padding: 4px 12px; border-radius: 20px;">
                            پرونده معتبر
                        </span>
                        <h2 style="font-size: 1.35rem; font-weight: 900; color: #0f172a; margin-top: 8px;">
                            {{ $order->device_brand }} {{ $order->device_model }}
                        </h2>
                        <div style="font-size: 0.8rem; color: #64748b; margin-top: 4px;">
                            مشتری گرامی: <strong>{{ $order->customer_name }}</strong> | شناسه IMEI: <code style="direction: ltr;">{{ $order->imei }}</code>
                        </div>
                    </div>
                    <div style="text-align: left;">
                        <div style="font-size: 0.74rem; color: #64748b;">کد رهگیری سامانه:</div>
                        <div style="font-size: 1.25rem; font-weight: 900; color: #2563eb; direction: ltr;">{{ $order->tracking_code }}</div>
                    </div>
                </div>

                <!-- 5-Step Process Bar -->
                @php
                    $steps = [
                        'received' => ['title' => 'پذیرش دستگاه', 'step' => 1],
                        'inspecting' => ['title' => 'کارشناسی فنی', 'step' => 2],
                        'repairing' => ['title' => 'تعمیر و تعویض قطعه', 'step' => 3],
                        'waiting_parts' => ['title' => 'تامین قطعه از انبار', 'step' => 3],
                        'ready_for_delivery' => ['title' => 'تست QC و آماده تحویل', 'step' => 4],
                        'delivered' => ['title' => 'ترخیص و تحویل نهایی', 'step' => 5],
                    ];
                    $currentStep = $steps[$order->status]['step'] ?? 2;
                @endphp

                <div style="margin: 30px 0 35px;">
                    <div style="display: flex; justify-content: space-between; position: relative;">
                        <div style="position: absolute; top: 18px; right: 20px; left: 20px; height: 3px; background: #e2e8f0; z-index: 1;"></div>
                        
                        @foreach([
                            1 => 'ثبت و پذیرش',
                            2 => 'کارشناسی و عیب‌یابی',
                            3 => 'تعمیرات تخصصی',
                            4 => 'کنترل کیفیت QC',
                            5 => 'آماده ترخیص'
                        ] as $num => $title)
                            @php
                                $done = $currentStep >= $num;
                                $active = $currentStep == $num;
                            @endphp
                            <div style="text-align: center; position: relative; z-index: 2; flex: 1;">
                                <div style="width: 38px; height: 38px; border-radius: 50%; background: {{ $done ? '#2563eb' : '#ffffff' }}; border: 3px solid {{ $done ? '#2563eb' : '#cbd5e1' }}; color: {{ $done ? '#ffffff' : '#64748b' }}; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 0.95rem; margin: 0 auto 8px; box-shadow: {{ $active ? '0 0 0 4px rgba(37,99,235,0.2)' : 'none' }};">
                                    {{ $done ? '✓' : $num }}
                                </div>
                                <div style="font-size: 0.74rem; font-weight: {{ $active ? '800' : '600' }}; color: {{ $active ? '#2563eb' : ($done ? '#0f172a' : '#94a3b8') }};">
                                    {{ $title }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Info Grid -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 20px; margin-bottom: 24px;">
                    <div>
                        <div style="font-size: 0.74rem; color: #64748b;">شرح ایراد اظهارشده:</div>
                        <div style="font-size: 0.86rem; font-weight: 700; color: #0f172a; margin-top: 4px;">{{ $order->problem_description ?? 'بررسی اولیه فنی' }}</div>
                    </div>
                    <div>
                        <div style="font-size: 0.74rem; color: #64748b;">گزارش تکنسین ارشد:</div>
                        <div style="font-size: 0.86rem; font-weight: 700; color: #2563eb; margin-top: 4px;">{{ $order->technician_diagnosis ?? 'دستگاه در حال تست جریان‌کشی مدار' }}</div>
                    </div>
                    <div>
                        <div style="font-size: 0.74rem; color: #64748b;">وضعیت گارانتی:</div>
                        <div style="font-size: 0.86rem; font-weight: 800; color: #10b981; margin-top: 4px;">
                            {{ $order->warranty_status == 'under_warranty' || $order->warranty_status == 'in_warranty' ? 'تحت پوشش گارانتی ۱۸ ماهه رسمی' : 'خدمات مطابق تعرفه مصوب اتحادیه' }}
                        </div>
                    </div>
                    <div>
                        <div style="font-size: 0.74rem; color: #64748b;">تکنسین مسئول:</div>
                        <div style="font-size: 0.86rem; font-weight: 700; color: #0f172a; margin-top: 4px;">{{ $order->assigned_technician ?? 'کارگاه مرکزی تبریز' }}</div>
                    </div>
                </div>

                <!-- Actions -->
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                    <div style="font-size: 0.78rem; color: #64748b;">
                        تلفن پشتیبانی کارگاه تبریز: <strong>۰۴۱-۳۶۶۸۹۰۰۰ (داخلی ۱)</strong>
                    </div>
                    <div style="display: flex; gap: 8px;">
                        <a href="{{ route('mob.invoice.show', $order->tracking_code) }}" target="_blank" style="display: inline-flex; align-items: center; gap: 6px; background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; padding: 8px 16px; border-radius: 10px; font-size: 0.8rem; font-weight: 800; text-decoration: none;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                            <span>مشاهده و چاپ صورتحساب رسمی (ماده ۱۶)</span>
                        </a>
                        <a href="{{ url('/warranty-terms') }}" style="display: inline-flex; align-items: center; gap: 6px; background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; padding: 8px 16px; border-radius: 10px; font-size: 0.8rem; font-weight: 700; text-decoration: none;">
                            شرایط گارانتی ۱۸ ماهه
                        </a>
                    </div>
                </div>

            </div>
        @else
            <!-- Not Found Card -->
            <div style="background: #ffffff; border: 1px dashed #fca5a5; border-radius: 18px; padding: 36px; text-align: center; margin-bottom: 30px;">
                <div style="font-size: 2.5rem; margin-bottom: 10px;">🔍</div>
                <h3 style="font-size: 1.15rem; font-weight: 800; color: #991b1b; margin-bottom: 8px;">پرونده‌ای با شناسه «{{ $code }}» یافت نشد</h3>
                <p style="font-size: 0.85rem; color: #64748b; max-width: 500px; margin: 0 auto 16px;">
                    لطفاً از صحت کد رهگیری پذیرش یا کد ۱۵ رقمی IMEI دستگاه خود اطمینان حاصل فرمایید. در صورت نیاز با پشتیبانی تماس بگیرید.
                </p>
                <a href="tel:04136689000" style="display: inline-flex; align-items: center; gap: 6px; background: #eff6ff; color: #2563eb; padding: 8px 20px; border-radius: 10px; font-weight: 800; text-decoration: none; font-size: 0.85rem; border: 1px solid #bfdbfe;">
                    📞 تماس با پشتیبانی: ۰۴۱-۳۶۶۸۹۰۰۰ (داخلی ۱)
                </a>
            </div>
        @endif
    @endif

    <!-- Quick Help Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px;">
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 18px;">
            <div style="font-weight: 800; color: #0f172a; font-size: 0.9rem; margin-bottom: 6px;">📱 استخراج کد IMEI</div>
            <p style="font-size: 0.78rem; color: #64748b; line-height: 1.6;">
                با شماره‌گیری کد دستوری #06#* در تلفن همراه خود، کد ۱۵ رقمی IMEI نمایش داده می‌شود.
            </p>
        </div>
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 18px;">
            <div style="font-weight: 800; color: #0f172a; font-size: 0.9rem; margin-bottom: 6px;">📦 ارسال پستی از سراسر کشور</div>
            <p style="font-size: 0.78rem; color: #64748b; line-height: 1.6;">
                پذیرش کالا از تمام شهرستان‌ها از طریق پست پیشتاز به نشانی دفتر مرکزی تبریز صورت می‌پذیرد.
            </p>
        </div>
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 18px;">
            <div style="font-weight: 800; color: #0f172a; font-size: 0.9rem; margin-bottom: 6px;">⏱️ زمان‌بندی عیب‌یابی</div>
            <p style="font-size: 0.78rem; color: #64748b; line-height: 1.6;">
                عیب‌یابی اولیه ظرف کمتر از ۲ ساعت انجام شده و گزارش آن از طریق پیامک ارسال می‌گردد.
            </p>
        </div>
    </div>

</div>
@endsection
