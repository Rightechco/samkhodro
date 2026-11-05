<!-- WARRANTY CARD MODAL & PRINT TEMPLATE -->
<div class="modal-overlay" id="warrantyCardModal">
    <div class="modal-dialog" style="max-width: 720px; width: 95%; background: #f8fafc; padding: 24px;">
        <div class="modal-header" style="border-bottom: 1px solid var(--border-light); padding-bottom: 12px; margin-bottom: 18px;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" style="color: var(--primary);"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                <h3 style="font-size: 1.15rem; font-weight: 800; color: var(--text-main); margin: 0;">کارت گارانتی ۱۸ ماهه رسمی گوشی همراه</h3>
            </div>
            <button type="button" class="modal-close-btn" onclick="closeWarrantyCardModal()" style="font-size: 1.5rem; background: none; border: none; cursor: pointer; color: var(--text-muted);">&times;</button>
        </div>

        <!-- View Mode Switcher -->
        <div style="display: flex; gap: 8px; margin-bottom: 18px; justify-content: center;">
            <button type="button" class="btn-demo-quick active" id="btnShowDigitalCard" onclick="switchCardDisplay('digital')" style="padding: 6px 16px; border-radius: 8px; font-weight: 700;">
                کارت دیجیتال مشخصات دستگاه
            </button>
            <button type="button" class="btn-demo-quick" id="btnShowOriginalCard" onclick="switchCardDisplay('original')" style="padding: 6px 16px; border-radius: 8px; font-weight: 700;">
                طرح کارت چاپی فیزیکی
            </button>
        </div>

        <!-- Display 1: Dynamic Digital Card (Populated with Device Info) -->
        <div id="cardViewDigital">
            <!-- Back of Card (With Filled Information) -->
            <div class="physical-card-preview" id="printableCardBack" style="background: #ffffff; border: 2px solid #0f3ba0; border-radius: 24px; padding: 20px; box-shadow: 0 10px 30px rgba(15, 59, 160, 0.15); margin-bottom: 18px; position: relative; overflow: hidden;">
                <!-- Card Header with 3 Icons -->
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #e2e8f0; padding-bottom: 14px; margin-bottom: 16px;">
                    <div style="display: flex; gap: 20px; align-items: center;">
                        <div style="text-align: center;">
                            <div style="width: 38px; height: 38px; border-radius: 50%; background: #eff6ff; color: #1d4ed8; display: flex; align-items: center; justify-content: center; margin: 0 auto 4px;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
                            </div>
                            <span style="font-size: 0.72rem; font-weight: 800; color: #0f172a; display: block; line-height: 1.3;">۱۸ ماه ضمانت رسمی<br>پس از فعال سازی</span>
                        </div>
                        <div style="text-align: center;">
                            <div style="width: 38px; height: 38px; border-radius: 50%; background: #eff6ff; color: #1d4ed8; display: flex; align-items: center; justify-content: center; margin: 0 auto 4px;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                            </div>
                            <span style="font-size: 0.72rem; font-weight: 800; color: #0f172a; display: block; line-height: 1.3;">خدمات پس از فروش<br>تخصصی</span>
                        </div>
                        <div style="text-align: center;">
                            <div style="width: 38px; height: 38px; border-radius: 50%; background: #eff6ff; color: #1d4ed8; display: flex; align-items: center; justify-content: center; margin: 0 auto 4px;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/></svg>
                            </div>
                            <span style="font-size: 0.72rem; font-weight: 800; color: #0f172a; display: block; line-height: 1.3;">پشتیبانی<br>حرفه‌ای</span>
                        </div>
                    </div>

                    <!-- 5 Filled Fields -->
                    <div style="flex: 1; max-width: 420px; display: flex; flex-direction: column; gap: 8px;">
                        <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1.5px solid #cbd5e1; border-radius: 10px; padding: 4px 10px;">
                            <span style="font-size: 0.78rem; font-weight: 800; color: #0f172a; display: flex; align-items: center; gap: 6px;">
                                <span style="background: #0f3ba0; color: #fff; width: 18px; height: 18px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 0.7rem;">۱</span>
                                کشور سازنده:
                            </span>
                            <span id="cardCountryVal" style="font-size: 0.82rem; font-weight: 700; color: #1e3a8a;">ویتنام / چین (اصلی)</span>
                        </div>

                        <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1.5px solid #cbd5e1; border-radius: 10px; padding: 4px 10px;">
                            <span style="font-size: 0.78rem; font-weight: 800; color: #0f172a; display: flex; align-items: center; gap: 6px;">
                                <span style="background: #0f3ba0; color: #fff; width: 18px; height: 18px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 0.7rem;">۲</span>
                                برند و مدل کالا:
                            </span>
                            <span id="cardDeviceModelVal" style="font-size: 0.82rem; font-weight: 800; color: #1e3a8a;">Galaxy S24 Ultra 5G</span>
                        </div>

                        <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1.5px solid #cbd5e1; border-radius: 10px; padding: 4px 10px;">
                            <span style="font-size: 0.78rem; font-weight: 800; color: #0f172a; display: flex; align-items: center; gap: 6px;">
                                <span style="background: #0f3ba0; color: #fff; width: 18px; height: 18px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 0.7rem;">۳</span>
                                شماره سریال کالا (IMEI):
                            </span>
                            <span id="cardImeiVal" style="font-size: 0.85rem; font-weight: 800; color: #1e3a8a; font-family: monospace;">359123456789012</span>
                        </div>

                        <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1.5px solid #cbd5e1; border-radius: 10px; padding: 4px 10px;">
                            <span style="font-size: 0.78rem; font-weight: 800; color: #0f172a; display: flex; align-items: center; gap: 6px;">
                                <span style="background: #0f3ba0; color: #fff; width: 18px; height: 18px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 0.7rem;">۴</span>
                                تاریخ شروع گارانتی:
                            </span>
                            <span id="cardStartDateVal" style="font-size: 0.82rem; font-weight: 800; color: #1e3a8a;">۱۴۰۳/۰۴/۱۵</span>
                        </div>

                        <div style="display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1.5px solid #cbd5e1; border-radius: 10px; padding: 4px 10px;">
                            <span style="font-size: 0.78rem; font-weight: 800; color: #0f172a; display: flex; align-items: center; gap: 6px;">
                                <span style="background: #0f3ba0; color: #fff; width: 18px; height: 18px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 0.7rem;">۵</span>
                                نام شرکت سازنده کالا:
                            </span>
                            <span id="cardMakerVal" style="font-size: 0.82rem; font-weight: 700; color: #1e3a8a;">Samsung Electronics Co.</span>
                        </div>
                    </div>
                </div>

                <!-- Exclusion Pill Banner -->
                <div style="background: #0b2559; color: #ffffff; border-radius: 20px; padding: 5px 16px; font-size: 0.8rem; font-weight: 800; text-align: center; margin: 0 auto 10px; width: fit-content;">
                    مواردی که شامل گارانتی نمی‌شوند:
                </div>

                <!-- Exclusion Points (2 Columns) -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6px 20px; font-size: 0.76rem; color: #1e293b; padding: 0 10px 14px;">
                    <div>• ضربه دیدگی و شکستگی</div>
                    <div>• خرابی ناشی از نوسانات برق</div>
                    <div>• نفوذ مایعات و رطوبت</div>
                    <div>• معیوب ماندن باتری و لوازم جانبی</div>
                    <div>• تعمیرات دستکاری توسط افراد غیر مجاز</div>
                    <div>• تمامی موارد خارج از شرایط گارانتی</div>
                </div>

                <!-- Card Bottom Bar (Exact to image and taminkanisam.co.ir) -->
                <div style="background: #081d45; color: #ffffff; border-radius: 14px; padding: 10px 14px; font-size: 0.76rem; line-height: 1.5;">
                    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px; border-bottom: 1px solid rgba(255, 255, 255, 0.15); padding-bottom: 6px; margin-bottom: 6px;">
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <span>📞 <strong>۰۴۱۳۶۶۸۹۰۰۰ (داخلی ۱)</strong></span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <span>🌐 <strong>taminkanisam.co.ir</strong></span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 6px;">
                            <span>✉️ <strong>Marketing@kanisam</strong></span>
                        </div>
                        <div style="font-weight: 800; color: #60a5fa;">
                            تامین کانی سام Taminkanisam
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 6px; font-size: 0.74rem; color: #e2e8f0;">
                        <span>📍 تبریز، فرشته شمالی، خیابان محمدپورصبور، نبش خیابان استاد میرعلی تبریزی، پلاک ۷۸</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Display 2: Original Printed Physical Card Image -->
        <div id="cardViewOriginal" style="display: none; text-align: center; margin-bottom: 18px;">
            <img src="/assets/images/mobile/warranty-card.jpg" alt="کارت گارانتی گوشی همراه تامین کانی سام" style="max-width: 100%; border-radius: 18px; box-shadow: 0 10px 30px rgba(0,0,0,0.15); border: 1px solid var(--border-light);">
        </div>

        <!-- Modal Actions -->
        <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--border-light); padding-top: 14px;">
            <span style="font-size: 0.8rem; color: var(--text-muted);">
                دارای تاییدیه رسمی سامانه جامع گارانتی و ضوابط اجرایی وزارت صمت
            </span>
            <div style="display: flex; gap: 10px;">
                <button type="button" class="btn-light-primary" onclick="printWarrantyCard()">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                    <span>چاپ کارت گارانتی</span>
                </button>
                <button type="button" class="btn-light-outline" onclick="closeWarrantyCardModal()">
                    بستن
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function openWarrantyCardModal(device) {
        if (device) {
            if (device.model) document.getElementById('cardDeviceModelVal').innerText = device.model;
            if (device.imei) document.getElementById('cardImeiVal').innerText = device.imei;
            if (device.country) document.getElementById('cardCountryVal').innerText = device.country;
            if (device.startDate) document.getElementById('cardStartDateVal').innerText = device.startDate;
            if (device.maker) document.getElementById('cardMakerVal').innerText = device.maker;
        }
        document.getElementById('warrantyCardModal').classList.add('open');
    }

    function closeWarrantyCardModal() {
        document.getElementById('warrantyCardModal').classList.remove('open');
    }

    function switchCardDisplay(view) {
        const btnDig = document.getElementById('btnShowDigitalCard');
        const btnOrig = document.getElementById('btnShowOriginalCard');
        const viewDig = document.getElementById('cardViewDigital');
        const viewOrig = document.getElementById('cardViewOriginal');

        if (view === 'digital') {
            btnDig.classList.add('active');
            btnOrig.classList.remove('active');
            viewDig.style.display = 'block';
            viewOrig.style.display = 'none';
        } else {
            btnOrig.classList.add('active');
            btnDig.classList.remove('active');
            viewDig.style.display = 'none';
            viewOrig.style.display = 'block';
        }
    }

    function printWarrantyCard() {
        window.print();
    }
</script>
