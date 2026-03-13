@extends('layouts.front')
@section('title', 'تەواوکردنی داواکاری - گەردی بازاڕ')
@section('content')
    <section class="container" style="margin-top: 40px;">
        <div class="section-title">
            <h2><i class="fas fa-credit-card me-2" style="color: var(--gold);"></i> تەواوکردنی داواکاری</h2>
            <div class="line"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-7">
                <div class="glass-box">
                    <h5 style="color: var(--gold); font-weight: 700; margin-bottom: 24px;">زانیاریەکانت</h5>
                    <form action="/checkout" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-muted">ناوی تەواو *</label>
                            <input type="text" name="customer_name" class="form-control form-control-dark"
                                value="{{ old('customer_name') }}" required placeholder="ناوی تەواو">
                            @error('customer_name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">ژمارەی مۆبایل *</label>
                            <input type="text" name="customer_phone" class="form-control form-control-dark"
                                value="{{ old('customer_phone') }}" required placeholder="07xxxxxxxxx">
                            @error('customer_phone') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted">ناونیشانی گەیاندن *</label>
                            <textarea name="customer_address" class="form-control form-control-dark" rows="3" required
                                placeholder="ناونیشانی تەواو بۆ گەیاندن">{{ old('customer_address') }}</textarea>
                            @error('customer_address') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted"><i class="fas fa-map-marker-alt me-1" style="color: var(--gold);"></i>شوێنی GPS</label>
                            <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                            <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
                            <div class="d-flex gap-2 align-items-center">
                                <button type="button" id="getLocationBtn" class="btn w-100"
                                    style="background: rgba(212,167,69,0.15); color: var(--gold); border: 1px dashed var(--gold); border-radius: 10px; padding: 12px;"
                                    onclick="getLocation()">
                                    <i class="fas fa-location-crosshairs me-2"></i> دیاریکردنی شوێنم
                                </button>
                            </div>
                            <div id="locationStatus" class="mt-2" style="display: none;">
                                <small class="text-success"><i class="fas fa-check-circle me-1"></i> <span id="locationText"></span></small>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted">تێبینی</label>
                            <textarea name="notes" class="form-control form-control-dark" rows="2"
                                placeholder="تێبینی ئەگەر هەبوو">{{ old('notes') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-gold btn-lg w-100">
                            <i class="fas fa-check-circle me-2"></i> ناردنی داواکاری
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-5">
                <div class="glass-box">
                    <h5 style="color: var(--gold); font-weight: 700; margin-bottom: 20px;">پوختەی داواکاری</h5>
                    @foreach($cartItems as $item)
                        <div class="d-flex justify-content-between align-items-center mb-3 pb-3"
                            style="border-bottom: 1px solid rgba(255,255,255,0.04);">
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ $item['product']->image ? '/storage/' . $item['product']->image : '/img/logo.png' }}"
                                    style="width: 45px; height: 45px; object-fit: cover; border-radius: 8px;">
                                <div>
                                    <strong style="color: #fff; font-size: 0.9rem;">{{ $item['product']->name_ku }}</strong>
                                    <br><small class="text-muted">{{ $item['quantity'] }}x</small>
                                </div>
                            </div>
                            <span style="color: var(--gold);">{{ number_format($item['subtotal']) }} د.ع</span>
                        </div>
                    @endforeach
                    <hr style="border-color: rgba(255,255,255,0.06);">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">کۆی بەرهەمەکان:</span>
                        <span style="color: #fff;">{{ number_format($total) }} د.ع</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">کرێی گەیاندن:</span>
                        <span style="color: #fff;">{{ number_format($deliveryFee) }} د.ع</span>
                    </div>
                    <hr style="border-color: rgba(255,255,255,0.06);">
                    <div class="d-flex justify-content-between">
                        <strong style="color: var(--gold); font-size: 1.1rem;">کۆی گشتی:</strong>
                        <strong style="color: var(--gold); font-size: 1.3rem;">{{ number_format($total + $deliveryFee) }}
                            د.ع</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function getLocation() {
            const btn = document.getElementById('getLocationBtn');
            const statusDiv = document.getElementById('locationStatus');
            const locationText = document.getElementById('locationText');

            if (!navigator.geolocation) {
                btn.innerHTML = '<i class="fas fa-times-circle me-2"></i> GPS لە ئەم بڕاوزەرە کار ناکات';
                btn.style.borderColor = '#dc3545';
                btn.style.color = '#dc3545';
                return;
            }

            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> شوێن دەدۆزرێتەوە...';
            btn.disabled = true;

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;

                    btn.innerHTML = '<i class="fas fa-check-circle me-2"></i> شوێن دیاریکرا ✅';
                    btn.style.background = 'rgba(40,167,69,0.15)';
                    btn.style.color = '#28a745';
                    btn.style.borderColor = '#28a745';
                    btn.disabled = false;

                    statusDiv.style.display = 'block';
                    locationText.textContent = 'شوێنەکەت بە سەرکەوتوویی تۆمارکرا';
                },
                function(error) {
                    btn.innerHTML = '<i class="fas fa-redo me-2"></i> هەوڵبدەرەوە';
                    btn.style.borderColor = '#dc3545';
                    btn.style.color = '#dc3545';
                    btn.disabled = false;

                    statusDiv.style.display = 'block';
                    locationText.textContent = 'تکایە ڕێگە بدە بە GPS لە ڕێکخستنەکانی مۆبایلەکەت';
                    document.querySelector('#locationStatus small').className = 'text-danger';
                },
                { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
            );
        }
    </script>
@endsection