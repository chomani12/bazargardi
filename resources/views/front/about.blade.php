@extends('layouts.front')
@section('title', 'دەربارە - گەردی بازاڕ')
@section('content')
    <section class="container" style="margin-top: 40px;">
        <div class="section-title">
            <h2><i class="fas fa-info-circle me-2" style="color: var(--gold);"></i> دەربارەی گەردی بازاڕ</h2>
            <div class="line"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-7">
                <div class="glass-box">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <img src="/img/logo.png"
                            style="width: 70px; height: 70px; border-radius: 50%; border: 2px solid var(--gold);">
                        <div>
                            <h3 style="color: var(--gold); font-weight: 800; margin: 0;">گەردی بازاڕ</h3>
                            <span class="text-muted">Gardi Bazar</span>
                        </div>
                    </div>
                    <p style="color: var(--text2); line-height: 2; font-size: 1.05rem;">
                        {{ $settings['about_text'] ?? '' }}
                    </p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="glass-box mb-4">
                    <h5 style="color: var(--gold); font-weight: 700; margin-bottom: 20px;">
                        <i class="fas fa-address-book me-2"></i> پەیوەندی
                    </h5>
                    <div class="mb-3">
                        <i class="fas fa-phone me-2" style="color: var(--gold);"></i>
                        <a href="tel:{{ $settings['phone'] ?? '' }}" style="color: #fff;">{{ $settings['phone'] ?? '' }}</a>
                    </div>
                    <div class="mb-3">
                        <i class="fas fa-map-marker-alt me-2" style="color: var(--gold);"></i>
                        <span style="color: #fff;">{{ $settings['address'] ?? '' }}</span>
                    </div>
                </div>

                <div class="glass-box">
                    <h5 style="color: var(--gold); font-weight: 700; margin-bottom: 20px;">
                        <i class="fas fa-share-alt me-2"></i> سۆشیال میدیا
                    </h5>
                    <div class="d-flex flex-column gap-2">
                        @if(!empty($settings['facebook_url']))
                            <a href="{{ $settings['facebook_url'] }}" target="_blank"
                                class="d-flex align-items-center gap-3 p-2"
                                style="color: #fff; border-radius: 10px; background: rgba(59,89,152,0.1);">
                                <i class="fab fa-facebook-f" style="color: #4267B2; width: 20px;"></i> فەیسبووک
                            </a>
                        @endif
                        @if(!empty($settings['instagram_url']))
                            <a href="{{ $settings['instagram_url'] }}" target="_blank"
                                class="d-flex align-items-center gap-3 p-2"
                                style="color: #fff; border-radius: 10px; background: rgba(225,48,108,0.1);">
                                <i class="fab fa-instagram" style="color: #E1306C; width: 20px;"></i> ئینستاگرام
                            </a>
                        @endif
                        @if(!empty($settings['tiktok_url']))
                            <a href="{{ $settings['tiktok_url'] }}" target="_blank" class="d-flex align-items-center gap-3 p-2"
                                style="color: #fff; border-radius: 10px; background: rgba(255,255,255,0.04);">
                                <i class="fab fa-tiktok" style="color: #fff; width: 20px;"></i> تیکتۆک
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection