@extends('layouts.front')
@section('title', 'گەردی بازاڕ - Gardi Bazar')
@section('content')
    <!-- Hero Slider -->
    <div id="heroSlider" class="carousel slide hero-slider" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($sliders as $i => $slider)
                <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                    <div class="hero-slide" style="background-image: url('{{ Str::startsWith($slider->image, 'img/') ? '/' . $slider->image : '/storage/' . $slider->image }}');">
                        <div class="caption">
                            <h2 class="animate-in">{{ $slider->title_ku }}</h2>
                            <a href="/products" class="btn btn-gold mt-3 animate-in">
                                <i class="fas fa-shopping-bag me-2"></i> بەرهەمەکان ببینە
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Categories -->
    <section class="container" style="margin-top: 60px;">
        <div class="section-title">
            <h2><i class="fas fa-tags me-2" style="color: var(--gold);"></i> جۆرەکان</h2>
            <div class="line"></div>
        </div>
        <div class="row g-3">
            @php
                $icons = ['fas fa-drumstick-bite', 'fas fa-cow', 'fas fa-feather', 'fas fa-fire', 'fas fa-utensils'];
            @endphp
            @foreach($categories as $i => $cat)
                <div class="col-6 col-md-2">
                    <a href="/products?category={{ $cat->id }}" class="cat-card">
                        <div class="icon"><i class="{{ $icons[$i % count($icons)] }}"></i></div>
                        <h6>{{ $cat->name_ku }}</h6>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Featured Products -->
    <section class="container" style="margin-top: 60px;">
        <div class="section-title">
            <h2><i class="fas fa-star me-2" style="color: var(--gold);"></i> بەرهەمە تایبەتەکان</h2>
            <div class="line"></div>
            <a href="/products" class="btn btn-outline-gold btn-sm">هەمووی ببینە</a>
        </div>
        <div class="row g-4">
            @foreach($featuredProducts as $product)
                <div class="col-6 col-md-3">
                    <div class="product-card">
                        <a href="/products/{{ $product->id }}">
                            <div class="card-img"
                                style="background-image: url('{{ $product->image ? '/storage/' . $product->image : '/img/photo_2026-03-08_03-54-52.jpg' }}');">
                                <span class="featured-badge"><i class="fas fa-star me-1"></i> تایبەت</span>
                            </div>
                        </a>
                        <div class="card-body">
                            <span class="cat-name">{{ $product->category->name_ku ?? '' }}</span>
                            <h5>{{ $product->name_ku }}</h5>
                            <div class="price">{{ number_format($product->price) }} <small>د.ع</small></div>
                        </div>
                        <div class="card-actions">
                            <form action="/cart/add" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button class="btn btn-gold w-100 btn-sm">
                                    <i class="fas fa-cart-plus me-1"></i> زیادکردن بۆ سەبەتە
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- CTA Section -->
    <section
        style="margin-top: 80px; padding: 60px 0; background: linear-gradient(135deg, rgba(139,0,0,0.2), rgba(212,167,69,0.1));">
        <div class="container text-center">
            <h2 style="color: #fff; font-weight: 800; font-size: 2rem; margin-bottom: 16px;">
                <i class="fas fa-truck me-2" style="color: var(--gold);"></i>
                گەیاندن بۆ ماڵەوە
            </h2>
            <p class="text-muted mb-4" style="max-width: 500px; margin: 0 auto; font-size: 1.05rem;">
                گۆشتی تازە بە نرخی گونجاو دەگەیەنین بۆ ماڵەوە. داواکاری بکە ئێستا!
            </p>
            <a href="/products" class="btn btn-gold btn-lg">
                <i class="fas fa-shopping-bag me-2"></i> داواکاری بکە
            </a>
            <div class="mt-4">
                <a href="tel:{{ $settings['phone'] ?? '' }}" class="btn btn-outline-gold">
                    <i class="fas fa-phone me-2"></i> {{ $settings['phone'] ?? '' }}
                </a>
            </div>
        </div>
    </section>
@endsection