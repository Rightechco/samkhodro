<div class="allServiceIndex">
    <div class="width" style="max-width: 1440px; margin: 0 auto; padding: 0 24px; box-sizing: border-box;">
        
        <!-- تیتر بخش خدمات پس از فروش بدون متن یا نشان اضافه -->
        <div class="hp-title-box" style="margin-bottom: 35px;">
            <h3>خدمات پس از فروش</h3>
            @if(!empty($data['description']))
                <p>{{$data['description']}}</p>
            @endif
        </div>
        
        @php
            // خدمات سه‌گانه اختصاصی خدمات پس از فروش همراه با تصاویر دیتابیس و لینک‌های مستقیم
            $afterSalesServices = [
                [
                    'name' => 'گارانتی',
                    'body' => 'شرایط و ضوابط گارانتی رسمی خودروهای وارداتی و تعهدات قطعات و خدمات',
                    'link' => 'https://namikhodro.com/%da%af%d8%a7%d8%b1%d8%a7%d9%86%d8%aa%db%8c/',
                    'image' => '/upload/image/2025/1/1740811774.webp',
                    'badge' => 'گارانتی رسمی سام خودرو'
                ],
                [
                    'name' => 'عاملیت‌ها',
                    'body' => 'جستجو، معرفی و دسترسی به شبکه سراسری عاملیت‌های مجاز فروش و خدمات',
                    'link' => 'https://namikhodro.com/%d8%b9%d8%a7%d9%85%d9%84%db%8c%d8%aa-%d9%87%d8%a7/',
                    'image' => '/upload/image/2025/1/1740811565.jpg',
                    'badge' => 'شبکه عاملیت‌های مجاز'
                ],
                [
                    'name' => 'امداد جاده‌ای',
                    'body' => 'ارائه خدمات پشتیبانی ۲۴ ساعته، امدادرسانی سریع و حمل خودرو در سراسر کشور',
                    'link' => 'https://namikhodro.com/%d8%a7%d9%85%d8%af%d8%a7%d8%af/',
                    'image' => '/upload/image/2023/1/1692353770.jpg',
                    'badge' => 'پشتیبانی و امداد ۲۴/۷'
                ],
            ];
        @endphp

        <!-- کاروسل کارت‌های هایپرلوکس خدمات پس از فروش -->
        <div class="slider-service owl-carousel owl-theme">
            @foreach($afterSalesServices as $item)
                <div class="hp-service-item">
                    <img class="hp-service-bg lazyload" src="{{$item['image']}}" data-src="{{$item['image']}}" alt="{{$item['name']}}">
                    <div class="hp-service-overlay"></div>

                    <!-- نوار بالای کارت: برچسب اصالت و آیکون شیشه‌ای -->
                    <div class="hp-service-top-bar">
                        <div class="hp-service-badge">
                            <span class="pulse-point"></span>
                            <span>{{$item['badge']}}</span>
                        </div>
                        <div class="hp-service-icon-circle">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                    </div>

                    <!-- بدنه محتوایی کارت خدمات -->
                    <div class="hp-service-content">
                        <h4>{{$item['name']}}</h4>
                        <p>{{$item['body']}}</p>
                        
                        <a href="{{$item['link']}}" target="_blank" rel="noopener noreferrer" class="hp-service-action" title="{{$item['name']}}">
                            <span>ورود به سامانه</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>