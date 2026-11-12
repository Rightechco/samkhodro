@extends('home.mobile.layout')

@section('title', 'لیست نمایندگان رسمی خدمات پس از فروش و گارانتی ۱۸ ماهه | تامین کانی سام (موبایل)')
@section('meta_description', 'لیست شعب و نمایندگی‌های رسمی خدمات پس از فروش تامین کانی سام (موبایل) در سراسر کشور با نقشه آنلاین، شماره تماس و آدرس دقیق')

@push('styles')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    .rep-container {
        max-width: 1440px;
        margin: 0 auto;
        padding: 20px 16px 80px;
    }

    /* Page Hero Header */
    .rep-hero {
        background: linear-gradient(135deg, #ffffff 0%, #f0f7ff 100%);
        border: 1px solid #bfdbfe;
        border-radius: 20px;
        padding: 28px 24px;
        margin-bottom: 24px;
        box-shadow: 0 10px 30px rgba(37, 99, 235, 0.05);
        display: flex;
        flex-direction: column;
        gap: 12px;
        position: relative;
        overflow: hidden;
    }
    .rep-hero::after {
        content: '';
        position: absolute;
        top: -40px;
        left: -40px;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.12) 0%, transparent 70%);
        pointer-events: none;
    }
    .rep-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #93c5fd;
        padding: 4px 12px;
        border-radius: 99px;
        font-size: 0.76rem;
        font-weight: 800;
        width: fit-content;
    }
    .rep-title {
        font-size: 1.65rem;
        font-weight: 900;
        color: #0f172a;
        margin: 0;
        line-height: 1.3;
    }
    .rep-subtitle {
        font-size: 0.9rem;
        color: #475569;
        margin: 0;
        line-height: 1.6;
        max-width: 900px;
    }

    /* Filter & Search Bar */
    .rep-toolbar {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 14px 18px;
        margin-bottom: 24px;
        box-shadow: 0 4px 18px rgba(15, 23, 42, 0.03);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        flex-wrap: wrap;
    }
    .rep-search-box {
        flex: 1;
        min-width: 260px;
        position: relative;
    }
    .rep-search-input {
        width: 100%;
        padding: 11px 40px 11px 16px;
        border-radius: 12px;
        border: 1.5px solid #cbd5e1;
        font-family: inherit;
        font-size: 0.88rem;
        outline: none;
        transition: all 0.2s;
        box-sizing: border-box;
    }
    .rep-search-input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
    }
    .rep-search-icon {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        pointer-events: none;
    }
    .rep-filter-pills {
        display: flex;
        align-items: center;
        gap: 6px;
        overflow-x: auto;
        padding-bottom: 2px;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }
    .rep-pill {
        padding: 8px 14px;
        border-radius: 10px;
        font-size: 0.82rem;
        font-weight: 700;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        color: #475569;
        cursor: pointer;
        transition: all 0.2s;
    }
    .rep-pill:hover,
    .rep-pill.active {
        background: #2563eb;
        color: #ffffff;
        border-color: #2563eb;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    }

    /* Main Grid: Cards + Map */
    .rep-layout {
        display: grid;
        grid-template-columns: 460px 1fr;
        gap: 24px;
        align-items: start;
    }
    @media (max-width: 1024px) {
        .rep-layout {
            grid-template-columns: 1fr;
        }
    }

    /* Left: Cards List */
    .rep-cards-container {
        display: flex;
        flex-direction: column;
        gap: 16px;
        max-height: 720px;
        overflow-y: auto;
        padding-left: 4px;
    }
    .rep-card {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 16px;
        padding: 18px;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.03);
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        cursor: pointer;
        position: relative;
    }
    .rep-card:hover,
    .rep-card.selected {
        border-color: #2563eb;
        box-shadow: 0 10px 28px rgba(37, 99, 235, 0.12);
        transform: translateY(-2px);
    }
    .rep-card.selected::before {
        content: '';
        position: absolute;
        right: 0;
        top: 14px;
        bottom: 14px;
        width: 4px;
        background: #2563eb;
        border-radius: 4px 0 0 4px;
    }
    .rep-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    .rep-branch-title {
        font-size: 1.05rem;
        font-weight: 800;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .rep-city-badge {
        font-size: 0.75rem;
        font-weight: 800;
        padding: 3px 10px;
        border-radius: 8px;
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
    }
    .rep-address {
        font-size: 0.85rem;
        color: #334155;
        line-height: 1.6;
        margin-bottom: 12px;
        display: flex;
        align-items: flex-start;
        gap: 6px;
    }
    .rep-address svg {
        flex-shrink: 0;
        margin-top: 3px;
        color: #2563eb;
    }
    .rep-meta-row {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.78rem;
        color: #64748b;
        margin-bottom: 14px;
        flex-wrap: wrap;
    }
    .rep-meta-item {
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .rep-card-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        padding-top: 12px;
        border-top: 1px dashed #e2e8f0;
    }
    .btn-agency-call {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 9px 12px;
        border-radius: 10px;
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
        font-size: 0.82rem;
        font-weight: 800;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-agency-call:hover {
        background: #059669;
        color: #ffffff;
    }
    .btn-agency-nav {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 9px 14px;
        border-radius: 10px;
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
        font-size: 0.82rem;
        font-weight: 800;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-agency-nav:hover {
        background: #2563eb;
        color: #ffffff;
    }

    /* Right: Interactive Map */
    .rep-map-wrapper {
        position: sticky;
        top: 90px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        height: 720px;
        display: flex;
        flex-direction: column;
    }
    #agencyMap {
        width: 100%;
        height: 100%;
        z-index: 10;
    }
    .map-status-overlay {
        position: absolute;
        bottom: 16px;
        right: 16px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(8px);
        border: 1px solid #cbd5e1;
        padding: 8px 14px;
        border-radius: 12px;
        font-size: 0.78rem;
        font-weight: 700;
        color: #0f172a;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        z-index: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Mobile Quick Map Toggle */
    .mobile-map-toggle {
        display: none;
        width: 100%;
        padding: 12px;
        border-radius: 14px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #ffffff;
        border: none;
        font-size: 0.9rem;
        font-weight: 800;
        margin-bottom: 16px;
        cursor: pointer;
        box-shadow: 0 4px 14px rgba(37, 99, 235, 0.25);
    }
    @media (max-width: 1024px) {
        .mobile-map-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .rep-map-wrapper {
            position: static;
            height: 380px;
            margin-bottom: 24px;
        }
        .rep-cards-container {
            max-height: none;
        }
    }

    /* Leaflet Custom Marker Style */
    .custom-map-pin {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border-radius: 50% 50% 50% 0;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        transform: rotate(-45deg);
        box-shadow: -2px 4px 10px rgba(37, 99, 235, 0.4);
        border: 2px solid #ffffff;
        cursor: pointer;
        transition: transform 0.2s ease;
    }
    .custom-map-pin:hover {
        transform: rotate(-45deg) scale(1.15);
    }
    .custom-map-pin-inner {
        transform: rotate(45deg);
        color: #ffffff;
        font-size: 0.85rem;
    }
</style>
@endpush

@section('content')
<div class="rep-container">

    <!-- Hero Header -->
    <div class="rep-hero">
        <div class="rep-badge-pill">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            <span>شبکه رسمی خدمات پس از فروش و گارانتی ۱۸ ماهه (ماده ۱۳)</span>
        </div>
        <h1 class="rep-title">شعب و نمایندگی‌های رسمی خدمات تامین کانی سام (موبایل) در سراسر کشور</h1>
        <p class="rep-subtitle">
            کلیه شعب زیر به عنوان نمایندگان رسمی شرکت تامین کانی سام، موظف به پذیرش، عیب‌یابی تخصصی، تامین قطعات ۱۰۰٪ اورجینال و ارائه کلیه تعهدات ۱۸ ماهه گارانتی طبق ضوابط سازمان حمایت از حقوق مصرف‌کنندگان می‌باشند.
        </p>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="rep-toolbar">
        <div class="rep-search-box">
            <svg class="rep-search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            <input type="text" id="agencySearchInput" class="rep-search-input" placeholder="جستجو بر اساس نام شهر، استان، نام شعبه یا خیابان..." oninput="filterAgencies();">
        </div>
        <div class="rep-filter-pills" id="provinceFilterPills">
            <button type="button" class="rep-pill active" onclick="filterByProvince('all', this);">همه شعب ({{ count($agencies) }})</button>
            @php
                $provinces = $agencies->pluck('province')->unique()->values();
            @endphp
            @foreach($provinces as $prov)
                <button type="button" class="rep-pill" onclick="filterByProvince('{{ $prov }}', this);">{{ $prov }}</button>
            @endforeach
        </div>
    </div>

    <!-- Mobile Map Toggle -->
    <button type="button" class="mobile-map-toggle" id="btnToggleMobileMap" onclick="toggleMobileMap();">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"/><line x1="8" y1="2" x2="8" y2="18"/><line x1="16" y1="6" x2="16" y2="22"/></svg>
        <span id="mobileMapBtnText">مشاهده روی نقشه آنلاین</span>
    </button>

    <!-- Main Layout: Cards on Left + Map on Right -->
    <div class="rep-layout">

        <!-- Branches Cards Container -->
        <div class="rep-cards-container" id="agenciesCardsContainer">
            @forelse($agencies as $idx => $agency)
                <div class="rep-card {{ $idx === 0 ? 'selected' : '' }}" 
                     id="agency-card-{{ $agency->id }}"
                     data-id="{{ $agency->id }}"
                     data-name="{{ $agency->name }}"
                     data-province="{{ $agency->province }}"
                     data-city="{{ $agency->city }}"
                     data-lat="{{ $agency->latitude }}"
                     data-lng="{{ $agency->longitude }}"
                     onclick="focusAgencyOnMap({{ $agency->id }}, {{ $agency->latitude }}, {{ $agency->longitude }});">
                    
                    <div class="rep-card-top">
                        <div class="rep-branch-title">
                            <span style="display:inline-flex; align-items:center; justify-content:center; width:26px; height:26px; border-radius:50%; background:#eff6ff; color:#2563eb; font-size:0.8rem; font-weight:800;">{{ $idx + 1 }}</span>
                            <span>{{ $agency->name }}</span>
                        </div>
                        <span class="rep-city-badge">{{ $agency->city }} ({{ $agency->province }})</span>
                    </div>

                    <div class="rep-address">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        <span>{{ $agency->address }}</span>
                    </div>

                    <div class="rep-meta-row">
                        <div class="rep-meta-item">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            <span>{{ $agency->working_hours }}</span>
                        </div>
                        @if(!empty($agency->manager_name))
                        <div class="rep-meta-item">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            <span>مدیر شعبه: {{ $agency->manager_name }}</span>
                        </div>
                        @endif
                    </div>

                    <div class="rep-card-actions" onclick="event.stopPropagation();">
                        <a href="tel:{{ preg_replace('/[^0-9]/', '', $agency->phone) }}" class="btn-agency-call" title="تماس تلفنی مستقیم با شعبه">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            <span>تماس: {{ $agency->phone }}</span>
                        </a>

                        <button type="button" class="btn-agency-nav" onclick="openDirections({{ $agency->latitude }}, {{ $agency->longitude }}, '{{ addslashes($agency->name) }}');" title="مسیریابی با برنامه‌های نقشه">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><polygon points="3 11 22 2 13 21 11 13 3 11"/></svg>
                            <span>مسیریابی</span>
                        </button>
                    </div>
                </div>
            @empty
                <div style="padding: 40px 20px; text-align: center; color: #94a3b8;">
                    نمایندگی فعالی ثبت نشده است.
                </div>
            @endforelse
        </div>

        <!-- Interactive Map Wrapper -->
        <div class="rep-map-wrapper" id="repMapWrapper">
            <div id="agencyMap"></div>
            <div class="map-status-overlay">
                <span style="width: 8px; height: 8px; border-radius: 50%; background: #10b981; display: inline-block;"></span>
                <span>۶ شعبه فعال در سراسر ایران</span>
            </div>
        </div>

    </div>

</div>
@endsection

@push('scripts')
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    let map = null;
    let markers = {};
    const agenciesData = @json($agencies);
    let selectedProvince = 'all';

    document.addEventListener('DOMContentLoaded', function() {
        initAgencyMap();
    });

    function initAgencyMap() {
        // Center of Iran (approximately around Isfahan / central coordinates)
        const iranCenter = [33.5, 53.0];
        const defaultZoom = window.innerWidth < 768 ? 5 : 6;

        map = L.map('agencyMap', {
            center: [35.7208, 51.4332],
            zoom: defaultZoom,
            scrollWheelZoom: true
        });

        // OpenStreetMap Tile Layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors | تامین کانی سام (موبایل)'
        }).addTo(map);

        // Custom DivIcon
        const customPinIcon = L.divIcon({
            className: 'custom-map-pin',
            html: '<div class="custom-map-pin-inner">📱</div>',
            iconSize: [36, 36],
            iconAnchor: [18, 36],
            popupAnchor: [0, -36]
        });

        const bounds = [];

        // Add markers for all agencies
        agenciesData.forEach((agency, i) => {
            if (agency.latitude && agency.longitude) {
                const lat = parseFloat(agency.latitude);
                const lng = parseFloat(agency.longitude);
                bounds.push([lat, lng]);

                const popupContent = `
                    <div style="direction: rtl; text-align: right; font-family: 'Vazirmatn', sans-serif; padding: 4px; min-width: 200px;">
                        <div style="font-weight: 800; color: #0f172a; font-size: 0.95rem; margin-bottom: 4px;">${agency.name}</div>
                        <div style="font-size: 0.76rem; color: #2563eb; font-weight: 700; margin-bottom: 6px;">📍 ${agency.city} (${agency.province})</div>
                        <div style="font-size: 0.8rem; color: #475569; line-height: 1.5; margin-bottom: 10px;">${agency.address}</div>
                        <div style="display: flex; gap: 6px;">
                            <a href="tel:${agency.phone.replace(/[^0-9]/g, '')}" style="flex:1; background: #059669; color: #fff; padding: 6px 10px; border-radius: 8px; text-decoration: none; font-size: 0.76rem; font-weight: 800; text-align: center; display: inline-flex; align-items: center; justify-content: center; gap: 4px;">
                                📞 تماس: ${agency.phone}
                            </a>
                            <button onclick="openDirections(${lat}, ${lng}, '${agency.name}')" style="background: #2563eb; color: #fff; border: none; padding: 6px 10px; border-radius: 8px; cursor: pointer; font-size: 0.76rem; font-weight: 800;">
                                🧭 مسیریابی
                            </button>
                        </div>
                    </div>
                `;

                const marker = L.marker([lat, lng], { icon: customPinIcon }).addTo(map);
                marker.bindPopup(popupContent);
                marker.on('click', function() {
                    highlightCard(agency.id);
                });

                markers[agency.id] = marker;
            }
        });

        if (bounds.length > 0) {
            map.fitBounds(bounds, { padding: [40, 40] });
        }
    }

    function focusAgencyOnMap(id, lat, lng) {
        highlightCard(id);
        if (map && lat && lng) {
            map.flyTo([lat, lng], 15, { duration: 1.2 });
            if (markers[id]) {
                setTimeout(() => {
                    markers[id].openPopup();
                }, 1200);
            }
        }
        // If mobile, scroll smoothly to map
        if (window.innerWidth <= 1024) {
            const mapEl = document.getElementById('repMapWrapper');
            if (mapEl) {
                mapEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    }

    function highlightCard(id) {
        document.querySelectorAll('.rep-card').forEach(c => c.classList.remove('selected'));
        const card = document.getElementById('agency-card-' + id);
        if (card) {
            card.classList.add('selected');
            card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    }

    function filterByProvince(prov, btn) {
        selectedProvince = prov;
        document.querySelectorAll('.rep-pill').forEach(p => p.classList.remove('active'));
        if (btn) btn.classList.add('active');
        filterAgencies();
    }

    function filterAgencies() {
        const query = document.getElementById('agencySearchInput').value.trim().toLowerCase();
        let visibleCount = 0;
        const visibleBounds = [];

        document.querySelectorAll('.rep-card').forEach(card => {
            const name = (card.dataset.name || '').toLowerCase();
            const province = (card.dataset.province || '').toLowerCase();
            const city = (card.dataset.city || '').toLowerCase();
            const id = card.dataset.id;
            const lat = parseFloat(card.dataset.lat);
            const lng = parseFloat(card.dataset.lng);

            const matchProvince = (selectedProvince === 'all') || (card.dataset.province === selectedProvince);
            const matchQuery = !query || name.includes(query) || province.includes(query) || city.includes(query);

            if (matchProvince && matchQuery) {
                card.style.display = 'block';
                visibleCount++;
                if (markers[id]) {
                    map.addLayer(markers[id]);
                    visibleBounds.push([lat, lng]);
                }
            } else {
                card.style.display = 'none';
                if (markers[id]) {
                    map.removeLayer(markers[id]);
                }
            }
        });

        if (visibleBounds.length > 0 && map) {
            map.fitBounds(visibleBounds, { padding: [40, 40], maxZoom: 14 });
        }
    }

    function openDirections(lat, lng, title) {
        const url = `https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}`;
        window.open(url, '_blank');
    }

    function toggleMobileMap() {
        const mapWrapper = document.getElementById('repMapWrapper');
        const btnText = document.getElementById('mobileMapBtnText');
        if (!mapWrapper) return;

        if (mapWrapper.style.display === 'none') {
            mapWrapper.style.display = 'flex';
            if (btnText) btnText.innerText = 'بستن نقشه';
            if (map) {
                setTimeout(() => map.invalidateSize(), 200);
            }
        } else {
            mapWrapper.style.display = 'none';
            if (btnText) btnText.innerText = 'مشاهده روی نقشه آنلاین';
        }
    }
</script>
@endpush
