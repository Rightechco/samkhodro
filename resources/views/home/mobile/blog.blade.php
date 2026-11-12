@extends('home.mobile.layout')

@section('title', $single ? ($post->meta_title ?: $post->title) : 'وبلاگ تخصصی و مقالات آموزشی تامین کانی سام (موبایل)')

@section('seo_meta')
@if($single)
    <meta name="description" content="{{ $post->meta_description ?: $post->excerpt }}">
    <meta name="keywords" content="{{ $post->meta_keywords ?: 'تعمیرات گوشی, گارانتی تامین کانی سام (موبایل)' }}">
    <link rel="canonical" href="{{ $post->canonical_url ?: url('/blog/' . $post->slug) }}">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $post->title }}">
    <meta property="og:description" content="{{ $post->excerpt }}">
    <meta property="og:image" content="{{ $post->featured_image }}">
    <meta property="og:url" content="{{ url('/blog/' . $post->slug) }}">
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $post->title }}">
    <meta name="twitter:description" content="{{ $post->excerpt }}">
    <meta name="twitter:image" content="{{ $post->featured_image }}">
    <!-- Structured Data (JSON-LD) for Google SEO -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "BlogPosting",
      "headline": "{{ $post->title }}",
      "image": "{{ $post->featured_image }}",
      "author": {
        "@type": "Person",
        "name": "{{ $post->author }}"
      },
      "publisher": {
        "@type": "Organization",
        "name": "شرکت تامین کانی سام",
        "logo": {
          "@type": "ImageObject",
          "url": "https://taminkanisam.co.ir/assets/logo.png"
        }
      },
      "datePublished": "{{ $post->created_at }}",
      "dateModified": "{{ $post->updated_at }}",
      "description": "{{ $post->meta_description ?: $post->excerpt }}"
    }
    </script>
@endif
@endsection

@section('content')
<div class="page-container" style="max-width: 1100px; margin: 30px auto; padding: 0 16px;">
    
    @if($single)
        <!-- Single Blog Post View -->
        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 20px; padding: 32px; box-shadow: 0 4px 25px rgba(0,0,0,0.03);">
            
            <!-- Breadcrumbs -->
            <div style="display: flex; gap: 8px; align-items: center; font-size: 0.82rem; color: #64748b; margin-bottom: 20px;">
                <a href="{{ url('/') }}" style="color: #64748b; text-decoration: none;">صفحه اصلی</a>
                <span>›</span>
                <a href="{{ url('/blog') }}" style="color: #64748b; text-decoration: none;">وبلاگ تخصصی</a>
                <span>›</span>
                <span style="color: #2563eb; font-weight: 700;">{{ $post->title }}</span>
            </div>

            <!-- Post Meta Header -->
            <div style="display: flex; gap: 10px; align-items: center; margin-bottom: 12px; flex-wrap: wrap;">
                <span style="background: #eff6ff; color: #2563eb; font-weight: 800; font-size: 0.76rem; padding: 4px 12px; border-radius: 20px; border: 1px solid #bfdbfe;">
                    {{ $post->category }}
                </span>
                <span style="font-size: 0.78rem; color: #64748b;">
                    🕒 زمان مطالعه: {{ $post->read_time }}
                </span>
                <span style="font-size: 0.78rem; color: #64748b;">
                    👁️ بازدید: {{ number_format($post->views) }}
                </span>
                <span style="font-size: 0.78rem; color: #64748b;">
                    ✍️ نویسنده: {{ $post->author }}
                </span>
            </div>

            <h1 style="font-size: 1.65rem; font-weight: 900; color: #0f172a; line-height: 1.5; margin-bottom: 20px;">
                {{ $post->title }}
            </h1>

            @if($post->featured_image)
                <div style="margin-bottom: 25px; border-radius: 16px; overflow: hidden; max-height: 420px; border: 1px solid #e2e8f0;">
                    <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" style="width: 100%; height: auto; object-fit: cover; display: block;">
                </div>
            @endif

            @if($post->excerpt)
                <div style="background: #f8fafc; border-right: 4px solid #2563eb; padding: 16px 20px; border-radius: 0 12px 12px 0; margin-bottom: 25px; font-weight: 600; color: #334155; line-height: 1.8;">
                    {{ $post->excerpt }}
                </div>
            @endif

            <!-- Post Body -->
            <div class="blog-article-content" style="font-size: 0.98rem; line-height: 2.1; color: #1e293b;">
                {!! $post->content !!}
            </div>

            <!-- Author Box -->
            <div style="margin-top: 40px; padding: 20px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; display: flex; align-items: center; gap: 16px;">
                <div style="width: 52px; height: 52px; border-radius: 50%; background: #2563eb; color: #ffffff; display: flex; align-items: center; justify-content: center; font-weight: 900; font-size: 1.2rem; flex-shrink: 0;">
                    {{ mb_substr($post->author, 0, 1) }}
                </div>
                <div>
                    <div style="font-weight: 800; color: #0f172a; font-size: 0.92rem;">نگارش یافته توسط {{ $post->author }}</div>
                    <div style="font-size: 0.78rem; color: #64748b; margin-top: 4px;">کارشناس ارشد واحد خدمات پس از فروش و گارانتی رسمی شرکت تامین کانی سام</div>
                </div>
            </div>

            <!-- Related Posts -->
            @if(isset($relatedPosts) && count($relatedPosts) > 0)
                <div style="margin-top: 40px;">
                    <h3 style="font-size: 1.15rem; font-weight: 800; color: #0f172a; margin-bottom: 16px;">مقالات مرتبط و پیشنهادی</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 16px;">
                        @foreach($relatedPosts as $rel)
                            <a href="{{ url('/blog/' . $rel->slug) }}" style="text-decoration: none; color: inherit; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px; padding: 16px; transition: all 0.2s ease;">
                                <div style="font-weight: 800; font-size: 0.88rem; color: #0f172a; line-height: 1.5; margin-bottom: 8px;">{{ $rel->title }}</div>
                                <div style="font-size: 0.76rem; color: #64748b; line-height: 1.6;">{{ mb_substr(strip_tags($rel->excerpt ?: $rel->content), 0, 90) }}...</div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <div style="margin-top: 30px; text-align: center;">
                <a href="{{ url('/blog') }}" style="display: inline-flex; align-items: center; gap: 8px; background: #eff6ff; color: #2563eb; padding: 10px 24px; border-radius: 12px; font-weight: 800; text-decoration: none; border: 1px solid #bfdbfe;">
                    ← بازگشت به آرشیو مقالات وبلاگ
                </a>
            </div>

        </div>

    @else
        <!-- Blog Listing Index View -->
        <div style="text-align: center; margin-bottom: 35px;">
            <span style="background: #eff6ff; color: #2563eb; font-weight: 800; font-size: 0.8rem; padding: 6px 16px; border-radius: 30px; border: 1px solid #bfdbfe;">
                مجله تخصصی تامین کانی سام (موبایل)
            </span>
            <h1 style="font-size: 1.85rem; font-weight: 900; color: #0f172a; margin-top: 14px; margin-bottom: 8px;">
                وبلاگ آموزشی و مقالات تخصصی تلفن همراه
            </h1>
            <p style="color: #64748b; font-size: 0.92rem; max-width: 600px; margin: 0 auto;">
                راهنماهای فنی عیب‌یابی، استعلام و فعال‌سازی گارانتی ۱۸ ماهه، نگهداری باتری و بررسی اصالت قطعات هوشمند.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">
            @forelse($posts as $p)
                <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 18px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; flex-direction: column; transition: transform 0.2s ease;">
                    @if($p->featured_image)
                        <div style="height: 180px; overflow: hidden; background: #f1f5f9;">
                            <img src="{{ $p->featured_image }}" alt="{{ $p->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    @endif
                    <div style="padding: 20px; display: flex; flex-direction: column; flex-grow: 1;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                            <span style="background: #eff6ff; color: #2563eb; font-weight: 800; font-size: 0.72rem; padding: 3px 10px; border-radius: 14px;">
                                {{ $p->category }}
                            </span>
                            <span style="font-size: 0.72rem; color: #94a3b8;">
                                🕒 {{ $p->read_time }}
                            </span>
                        </div>
                        <h2 style="font-size: 1.05rem; font-weight: 800; color: #0f172a; line-height: 1.5; margin-bottom: 10px;">
                            <a href="{{ url('/blog/' . $p->slug) }}" style="color: inherit; text-decoration: none;">
                                {{ $p->title }}
                            </a>
                        </h2>
                        <p style="font-size: 0.82rem; color: #64748b; line-height: 1.7; flex-grow: 1; margin-bottom: 16px;">
                            {{ mb_substr(strip_tags($p->excerpt ?: $p->content), 0, 110) }}...
                        </p>
                        <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #f1f5f9; padding-top: 12px;">
                            <span style="font-size: 0.74rem; color: #94a3b8;">✍️ {{ $p->author }}</span>
                            <a href="{{ url('/blog/' . $p->slug) }}" style="color: #2563eb; font-weight: 800; font-size: 0.8rem; text-decoration: none;">
                                مطالعه کامل ←
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 60px; background: #ffffff; border-radius: 18px; border: 1px dashed #cbd5e1;">
                    <div style="font-size: 2.5rem; margin-bottom: 10px;">📚</div>
                    <div style="font-weight: 800; color: #0f172a; margin-bottom: 6px;">هنوز مقاله‌ای منتشر نشده است</div>
                    <div style="color: #64748b; font-size: 0.85rem;">به زودی مقالات تخصصی و راهنماهای گارانتی در این بخش قرار خواهند گرفت.</div>
                </div>
            @endforelse
        </div>

        @if(method_exists($posts, 'links'))
            <div style="margin-top: 30px; text-align: center;">
                {{ $posts->links() }}
            </div>
        @endif
    @endif

</div>
@endsection
