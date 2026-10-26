<style>
    /* ==========================================================================
       SAM KHODRO ULTRA-PREMIUM LIGHT EDITORIAL MAGAZINE & NEWS
       طراحی تماماً لایت، سفید متالیک و با کنتراست شفاف روی بک‌گراند دارک
       ========================================================================== */
    :root {
        --bl-light-card-bg: #ffffff;
        --bl-light-card-sub: #f8fafc;
        --bl-light-border: #e2e8f0;
        --bl-light-border-hover: #93c5fd;
        --bl-text-dark: #0f172a;
        --bl-text-body: #334155;
        --bl-text-muted: #64748b;
        --bl-primary-blue: #2563eb;
        --bl-primary-dark: #1d4ed8;
        --bl-accent-cyan: #0284c7;
        --bl-emerald: #10b981;
    }

    .allBlogIndex {
        position: relative !important;
        width: 100% !important;
        padding: 40px 0 35px 0 !important;
        background: transparent !important;
        direction: rtl !important;
        isolation: isolate !important;
        clear: both !important;
        box-sizing: border-box !important;
    }

    .allBlogIndex .blog-container-wrapper {
        max-width: 1440px !important;
        margin: 0 auto !important;
        padding: 0 24px !important;
        box-sizing: border-box !important;
        position: relative !important;
    }

    /* هدر بخش وبلاگ و اخبار */
    .allBlogIndex .hp-blog-header-box {
        text-align: center !important;
        margin: 0 auto 36px auto !important;
        width: 100% !important;
        position: relative !important;
        z-index: 3 !important;
        padding: 0 16px !important;
        box-sizing: border-box !important;
    }

    .allBlogIndex .hp-blog-header-box h3 {
        font-size: 2.3rem !important;
        font-weight: 900 !important;
        color: #ffffff !important;
        margin: 0 0 14px 0 !important;
        position: relative !important;
        display: inline-block !important;
        letter-spacing: -0.6px !important;
        background: linear-gradient(135deg, #ffffff 40%, #e2e8f0 100%) !important;
        -webkit-background-clip: text !important;
        -webkit-text-fill-color: transparent !important;
        line-height: 1.35 !important;
    }

    .allBlogIndex .hp-blog-header-box h3::after {
        content: '' !important;
        position: absolute !important;
        bottom: -10px !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        width: 80px !important;
        height: 3.5px !important;
        background: linear-gradient(90deg, #06b6d4, #2563eb, #8b5cf6) !important;
        border-radius: 99px !important;
        box-shadow: 0 0 20px rgba(37, 99, 235, 0.7) !important;
    }

    .allBlogIndex .hp-blog-header-box p {
        font-size: 1.02rem !important;
        color: #94a3b8 !important;
        max-width: 680px !important;
        margin: 20px auto 0 auto !important;
        line-height: 1.9 !important;
    }

    /* ==========================================================================
       کارت ادیتوریال افقی ویژه حالت تک‌مقاله‌ای (Grand Single Editorial Showcase)
       جهت جلوگیری از خالی دیده شدن صفحه هنگام وجود یک خبر در دیتابیس
       ========================================================================== */
    .hp-blog-featured-single {
        max-width: 1100px !important;
        margin: 0 auto 30px auto !important;
        background: #ffffff !important;
        border-radius: 28px !important;
        border: 1px solid rgba(255, 255, 255, 0.9) !important;
        box-shadow: 
            0 25px 60px -15px rgba(0, 0, 0, 0.55),
            0 0 0 1px rgba(226, 232, 240, 0.8) inset,
            0 0 40px rgba(37, 99, 235, 0.15) !important;
        overflow: hidden !important;
        display: flex !important;
        flex-direction: row !important;
        align-items: stretch !important;
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.5s ease !important;
        text-decoration: none !important;
        color: inherit !important;
    }

    .hp-blog-featured-single:hover {
        transform: translateY(-8px) scale(1.01) !important;
        box-shadow: 
            0 35px 80px -15px rgba(0, 0, 0, 0.75),
            0 0 50px rgba(37, 99, 235, 0.3) !important;
    }

    .hp-blog-featured-single .featured-pic-box {
        width: 48% !important;
        position: relative !important;
        overflow: hidden !important;
        background: #0f172a !important;
        min-height: 380px !important;
    }

    .hp-blog-featured-single .featured-pic-box img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        object-position: center !important;
        transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .hp-blog-featured-single:hover .featured-pic-box img {
        transform: scale(1.07) !important;
    }

    .hp-blog-featured-single .featured-content-box {
        width: 52% !important;
        padding: 40px 38px !important;
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
        box-sizing: border-box !important;
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%) !important;
    }

    .hp-blog-featured-single .featured-tag-row {
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        margin-bottom: 16px !important;
    }

    .hp-blog-badge-pill {
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        background: #eff6ff !important;
        border: 1px solid #bfdbfe !important;
        color: #1d4ed8 !important;
        padding: 6px 14px !important;
        border-radius: 99px !important;
        font-size: 0.8rem !important;
        font-weight: 800 !important;
    }

    .hp-blog-badge-pill .pulse-dot {
        width: 6px !important;
        height: 6px !important;
        border-radius: 50% !important;
        background: #10b981 !important;
        box-shadow: 0 0 6px #10b981 !important;
    }

    .hp-blog-time-pill {
        font-size: 0.78rem !important;
        color: #64748b !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 5px !important;
        font-weight: 700 !important;
    }

    .hp-blog-time-pill svg {
        width: 14px !important;
        height: 14px !important;
        color: #0284c7 !important;
    }

    .hp-blog-featured-single h4.featured-title {
        font-size: 1.45rem !important;
        font-weight: 900 !important;
        color: var(--bl-text-dark) !important;
        line-height: 1.6 !important;
        margin: 0 0 16px 0 !important;
        letter-spacing: -0.4px !important;
        transition: color 0.3s ease !important;
    }

    .hp-blog-featured-single:hover h4.featured-title {
        color: var(--bl-primary-blue) !important;
    }

    .hp-blog-featured-single p.featured-excerpt {
        font-size: 0.96rem !important;
        line-height: 1.95 !important;
        color: var(--bl-text-body) !important;
        margin: 0 0 24px 0 !important;
        text-align: justify !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 3 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
    }

    .hp-blog-featured-single .featured-footer {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        padding-top: 20px !important;
        border-top: 1px solid var(--bl-light-border) !important;
    }

    .hp-blog-author-tag {
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
    }

    .hp-blog-author-avatar {
        width: 36px !important;
        height: 36px !important;
        border-radius: 50% !important;
        background: linear-gradient(135deg, #1e40af, #2563eb) !important;
        color: #ffffff !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-weight: 900 !important;
        font-size: 0.8rem !important;
        box-shadow: 0 3px 10px rgba(37, 99, 235, 0.3) !important;
    }

    .hp-blog-author-name strong {
        display: block !important;
        font-size: 0.86rem !important;
        color: var(--bl-text-dark) !important;
        font-weight: 800 !important;
    }

    .hp-blog-author-name span {
        font-size: 0.74rem !important;
        color: var(--bl-text-muted) !important;
    }

    .hp-blog-cta-btn {
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%) !important;
        color: #ffffff !important;
        padding: 10px 22px !important;
        border-radius: 99px !important;
        font-size: 0.88rem !important;
        font-weight: 800 !important;
        box-shadow: 0 6px 18px rgba(37, 99, 235, 0.35) !important;
        transition: all 0.3s ease !important;
    }

    .hp-blog-cta-btn svg {
        width: 15px !important;
        height: 15px !important;
        stroke-width: 2.4 !important;
        transition: transform 0.3s ease !important;
    }

    .hp-blog-featured-single:hover .hp-blog-cta-btn {
        background: #1e40af !important;
        box-shadow: 0 8px 24px rgba(37, 99, 235, 0.5) !important;
    }

    .hp-blog-featured-single:hover .hp-blog-cta-btn svg {
        transform: translateX(-4px) !important;
    }

    /* ==========================================================================
       کارت‌های عمودی لایت برای حالت چندمقاله‌ای (Carousel / Grid Multi-Cards)
       ========================================================================== */
    .hp-blog-grid-multi {
        display: grid !important;
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 26px !important;
        padding: 10px 0 25px 0 !important;
    }

    .allBlogIndex .hp-blog-card-light {
        position: relative !important;
        background: #ffffff !important;
        border-radius: 24px !important;
        border: 1px solid rgba(226, 232, 240, 0.9) !important;
        box-shadow: 
            0 16px 40px -10px rgba(0, 0, 0, 0.4),
            0 0 0 1px rgba(255, 255, 255, 0.8) inset !important;
        transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.5s ease, border-color 0.4s ease !important;
        display: flex !important;
        flex-direction: column !important;
        overflow: hidden !important;
        isolation: isolate !important;
        height: 100% !important;
    }

    .allBlogIndex .hp-blog-card-light a {
        text-decoration: none !important;
        color: inherit !important;
        display: flex !important;
        flex-direction: column !important;
        height: 100% !important;
    }

    .allBlogIndex .hp-blog-card-light:hover {
        transform: translateY(-8px) !important;
        border-color: #93c5fd !important;
        box-shadow: 
            0 26px 60px -12px rgba(0, 0, 0, 0.6),
            0 0 35px rgba(37, 99, 235, 0.25) !important;
    }

    .allBlogIndex .hp-blog-pic {
        height: 225px !important;
        width: 100% !important;
        position: relative !important;
        overflow: hidden !important;
        background: #0f172a !important;
    }

    .allBlogIndex .hp-blog-pic img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        object-position: center !important;
        display: block !important;
        transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1) !important;
    }

    .allBlogIndex .hp-blog-card-light:hover .hp-blog-pic img {
        transform: scale(1.07) !important;
    }

    .allBlogIndex .hp-blog-cat-pill {
        position: absolute !important;
        top: 14px !important;
        right: 14px !important;
        background: rgba(255, 255, 255, 0.95) !important;
        color: #1d4ed8 !important;
        border: 1px solid #bfdbfe !important;
        padding: 5px 14px !important;
        border-radius: 99px !important;
        font-size: 0.74rem !important;
        font-weight: 800 !important;
        z-index: 4 !important;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15) !important;
    }

    .allBlogIndex .hp-blog-time {
        position: absolute !important;
        bottom: 14px !important;
        left: 14px !important;
        background: rgba(15, 23, 42, 0.88) !important;
        color: #ffffff !important;
        padding: 4px 12px !important;
        border-radius: 99px !important;
        font-size: 0.72rem !important;
        font-weight: 700 !important;
        z-index: 4 !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 5px !important;
    }

    .allBlogIndex .hp-blog-info {
        padding: 24px !important;
        background: #ffffff !important;
        display: flex !important;
        flex-direction: column !important;
        flex-grow: 1 !important;
        justify-content: space-between !important;
    }

    .allBlogIndex .hp-blog-meta {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        margin-bottom: 12px !important;
        font-size: 0.78rem !important;
        color: #64748b !important;
    }

    .allBlogIndex .hp-blog-title {
        font-size: 1.15rem !important;
        font-weight: 900 !important;
        color: #0f172a !important;
        line-height: 1.65 !important;
        margin: 0 0 18px 0 !important;
        min-height: 52px !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
        transition: color 0.3s ease !important;
    }

    .allBlogIndex .hp-blog-card-light:hover .hp-blog-title {
        color: #2563eb !important;
    }

    .allBlogIndex .hp-blog-footer {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        padding-top: 16px !important;
        border-top: 1px solid #f1f5f9 !important;
    }

    .allBlogIndex .hp-view-more-cta {
        display: inline-flex !important;
        align-items: center !important;
        gap: 10px !important;
        background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 50%, #0284c7 100%) !important;
        color: #ffffff !important;
        padding: 13px 36px !important;
        border-radius: 99px !important;
        font-weight: 800 !important;
        font-size: 0.95rem !important;
        text-decoration: none !important;
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.45) !important;
        transition: all 0.35s ease !important;
    }

    .allBlogIndex .hp-view-more-cta:hover {
        transform: translateY(-3px) !important;
        box-shadow: 0 16px 35px rgba(37, 99, 235, 0.65) !important;
        color: #ffffff !important;
    }

    @media (max-width: 991px) {
        .hp-blog-featured-single { flex-direction: column !important; }
        .hp-blog-featured-single .featured-pic-box,
        .hp-blog-featured-single .featured-content-box { width: 100% !important; }
        .hp-blog-featured-single .featured-pic-box { min-height: 240px !important; }
        .hp-blog-grid-multi { grid-template-columns: 1fr !important; }
    }
</style>

<div class="allBlogIndex">
    <div class="blog-container-wrapper">
        
        <!-- تیتر بخش اخبار و مقالات بدون نشان یا متن مازاد -->
        <div class="hp-blog-header-box">
            <h3>{{$data['title'] ?? 'اخبار و رویدادها'}}</h3>
            @if(!empty($data['description']))
                <p>{{$data['description']}}</p>
            @endif
        </div>

        @php
            $posts = !empty($data['post']) ? $data['post'] : [];
            $postsCount = is_countable($posts) ? count($posts) : 0;
        @endphp

        @if($postsCount === 1)
            <!-- حالت ویژه تک‌خبر (طراحی ادیتوریال عریض پرمیوم و لایت) -->
            @php
                $item = is_object($posts) && method_exists($posts, 'first') ? $posts->first() : reset($posts);
                $blogImg = !empty($item->image) ? $item->image : '/img/404Image.png';
                $createdDate = 'امروز';
                if (!empty($item->created_at)) {
                    if (is_string($item->created_at)) {
                        $createdDate = substr($item->created_at, 0, 10);
                    } elseif (is_object($item->created_at) && method_exists($item->created_at, 'format')) {
                        $createdDate = $item->created_at->format('Y/m/d');
                    }
                }
                $readTime = !empty($item->time) ? $item->time : 5;
                $rawBody = !empty($item->bodySeo) ? $item->bodySeo : (!empty($item->body) ? $item->body : 'آخرین اطلاعیه رسمی و تحویل سریع خودروهای وارداتی گروه خودرویی سام');
                $cleanExcerpt = mb_substr(strip_tags($rawBody), 0, 185, 'UTF-8') . '...';
            @endphp

            <article class="hp-blog-featured-single">
                <a href="/blog/{{$item->slug}}" class="featured-pic-box" title="{{$item->title}}">
                    <img src="{{$blogImg}}" alt="{{$item->titleSeo ?? $item->title}}" onerror="this.onerror=null; this.src='/img/404Image.png';">
                </a>

                <div class="featured-content-box">
                    <div>
                        <div class="featured-tag-row">
                            <span class="hp-blog-badge-pill">
                                <span class="pulse-dot"></span>
                                <span>گزارش تحلیلی رسمی</span>
                            </span>
                            <span class="hp-blog-time-pill">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <span>{{$readTime}} دقیقه مطالعه</span>
                            </span>
                            <span style="font-size:0.78rem; color:#64748b; font-weight:700;">{{$createdDate}}</span>
                        </div>

                        <a href="/blog/{{$item->slug}}" style="text-decoration:none;">
                            <h4 class="featured-title">{{$item->title}}</h4>
                        </a>
                        <p class="featured-excerpt">{{$cleanExcerpt}}</p>
                    </div>

                    <div class="featured-footer">
                        <div class="hp-blog-author-tag">
                            <div class="hp-blog-author-avatar">سام</div>
                            <div class="hp-blog-author-name">
                                <strong>روابط عمومی گروه خودرویی سام</strong>
                                <span>واحد واردات و ترخیص خودرو</span>
                            </div>
                        </div>

                        <a href="/blog/{{$item->slug}}" class="hp-blog-cta-btn" title="مطالعه گزارش">
                            <span>مطالعه کامل گزارش</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                        </a>
                    </div>
                </div>
            </article>

        @elseif($postsCount > 1)
            <!-- حالت چندخبری (اسلایدر ۳تایی کارت‌های لایت سفید) -->
            <div class="slider-blogs owl-carousel owl-theme">
                @foreach($posts as $item)
                    @php
                        $blogImg = !empty($item->image) ? $item->image : '/img/404Image.png';
                        $createdDate = 'امروز';
                        if (!empty($item->created_at)) {
                            if (is_string($item->created_at)) {
                                $createdDate = substr($item->created_at, 0, 10);
                            } elseif (is_object($item->created_at) && method_exists($item->created_at, 'format')) {
                                $createdDate = $item->created_at->format('Y/m/d');
                            }
                        }
                        $readTime = !empty($item->time) ? $item->time : 5;
                    @endphp

                    <article class="hp-blog-card-light">
                        <a href="/blog/{{$item->slug}}" title="{{$item->title}}">
                            <div class="hp-blog-pic">
                                <img src="{{$blogImg}}" alt="{{$item->titleSeo ?? $item->title}}" onerror="this.onerror=null; this.src='/img/404Image.png';">
                                <span class="hp-blog-cat-pill">اخبار خودرو</span>
                                <span class="hp-blog-time">{{$readTime}} دقیقه</span>
                            </div>

                            <div class="hp-blog-info">
                                <div class="hp-blog-meta">
                                    <span>{{$createdDate}}</span>
                                    <span style="color:#10b981; font-weight:800;">• گزارش رسمی</span>
                                </div>

                                <h4 class="hp-blog-title">{{$item->title}}</h4>

                                <div class="hp-blog-footer">
                                    <span style="font-size:0.8rem; font-weight:800; color:#64748b;">گروه خودرویی سام</span>
                                    <span style="font-size:0.88rem; font-weight:800; color:#2563eb; display:inline-flex; align-items:center; gap:4px;">
                                        مطالعه خبر &larr;
                                    </span>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        @endif
        
        <!-- دکمه مشاهده همه مقالات -->
        <div style="text-align: center; margin-top: 36px;">
            <a href="/blogs" class="hp-view-more-cta" title="مشاهده تمامی اخبار و مقالات">
                <span>{{$data['more'] ?? 'مشاهده همه اخبار و مقالات'}}</span>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>
        </div>

    </div>
</div>