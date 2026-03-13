@extends('layouts.front')
@section('title', $product->name_ku . ' - گەردی بازاڕ')
@section('description', $product->description_ku ?? $product->name_ku)
@section('og_tags')
    <meta property="og:title" content="{{ $product->name_ku }} - گەردی بازاڕ">
    <meta property="og:description" content="{{ $product->description_ku ?? '' }}">
    <meta property="og:image" content="{{ $product->image ? url('/storage/' . $product->image) : url('/img/logo.png') }}">
    <meta property="og:url" content="{{ url('/products/' . $product->id) }}">
    <meta property="og:type" content="product">
@endsection
@section('content')
    <section class="container" style="margin-top: 40px;">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="glass-box p-0 overflow-hidden" style="border-radius: 20px;">
                    <img src="{{ $product->image ? '/storage/' . $product->image : '/img/photo_2026-03-08_03-54-52.jpg' }}"
                        style="width: 100%; height: 400px; object-fit: cover;">
                </div>
            </div>
            <div class="col-md-6">
                <div class="glass-box h-100">
                    <span class="cat-name mb-2 d-inline-block" style="font-size: 0.9rem;">
                        <i class="fas fa-tag me-1"></i> {{ $product->category->name_ku ?? '' }}
                    </span>
                    <h1 style="color: #fff; font-weight: 800; font-size: 2rem; margin-bottom: 16px;">{{ $product->name_ku }}
                    </h1>

                    @if($product->description_ku)
                        <p style="color: var(--text2); line-height: 2; margin-bottom: 24px;">{{ $product->description_ku }}</p>
                    @endif

                    <div class="price mb-4" style="font-size: 2rem;">
                        {{ number_format($product->price) }} <small
                            style="font-size: 0.8rem; color: var(--text2);">د.ع</small>
                    </div>

                    <form action="/cart/add" method="POST" class="d-flex gap-3 align-items-end mb-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div>
                            <label class="form-label text-muted" style="font-size: 0.85rem;">بڕ</label>
                            <input type="number" name="quantity" value="1" min="1" class="form-control form-control-dark"
                                style="width: 80px;">
                        </div>
                        <button class="btn btn-gold btn-lg flex-grow-1">
                            <i class="fas fa-cart-plus me-2"></i> زیادکردن بۆ سەبەتە
                        </button>
                    </form>

                    <!-- Share buttons -->
                    <div class="d-flex gap-2">
                        <span class="text-muted align-self-center" style="font-size: 0.85rem;">هاوبەش بکە:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url('/products/' . $product->id)) }}"
                            target="_blank" class="btn btn-sm btn-outline-gold"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://wa.me/?text={{ urlencode($product->name_ku . ' - ' . url('/products/' . $product->id)) }}"
                            target="_blank" class="btn btn-sm btn-outline-gold"><i class="fab fa-whatsapp"></i></a>
                        <a href="https://t.me/share/url?url={{ urlencode(url('/products/' . $product->id)) }}&text={{ urlencode($product->name_ku) }}"
                            target="_blank" class="btn btn-sm btn-outline-gold"><i class="fab fa-telegram"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div style="margin-top: 60px;">
                <div class="section-title">
                    <h2><i class="fas fa-box me-2" style="color: var(--gold);"></i> بەرهەمە هاوشێوەکان</h2>
                    <div class="line"></div>
                </div>
                <div class="row g-4">
                    @foreach($relatedProducts as $related)
                        <div class="col-6 col-md-3">
                            <div class="product-card">
                                <a href="/products/{{ $related->id }}">
                                    <div class="card-img"
                                        style="background-image: url('{{ $related->image ? '/storage/' . $related->image : '/img/photo_2026-03-08_03-54-52.jpg' }}');">
                                    </div>
                                </a>
                                <div class="card-body">
                                    <h5>{{ $related->name_ku }}</h5>
                                    <div class="price">{{ number_format($related->price) }} <small>د.ع</small></div>
                                </div>
                                <div class="card-actions">
                                    <form action="/cart/add" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $related->id }}">
                                        <button class="btn btn-gold w-100 btn-sm"><i class="fas fa-cart-plus me-1"></i>
                                            زیادکردن</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </section>
@endsection