@extends('layouts.front')
@section('title', 'بەرهەمەکان - گەردی بازاڕ')
@section('content')
    <section class="container" style="margin-top: 40px;">
        <div class="section-title">
            <h2><i class="fas fa-box me-2" style="color: var(--gold);"></i> بەرهەمەکان</h2>
            <div class="line"></div>
        </div>

        <!-- Category Filter -->
        <div class="d-flex flex-wrap gap-2 mb-4">
            <a href="/products" class="btn {{ !request('category') ? 'btn-gold' : 'btn-outline-gold' }} btn-sm">هەمووی</a>
            @foreach($categories as $cat)
                <a href="/products?category={{ $cat->id }}"
                    class="btn {{ request('category') == $cat->id ? 'btn-gold' : 'btn-outline-gold' }} btn-sm">
                    {{ $cat->name_ku }}
                </a>
            @endforeach
        </div>

        <!-- Products Grid -->
        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-6 col-md-3">
                    <div class="product-card">
                        <a href="/products/{{ $product->id }}">
                            <div class="card-img"
                                style="background-image: url('{{ $product->image ? '/storage/' . $product->image : '/img/photo_2026-03-08_03-54-52.jpg' }}');">
                                @if($product->is_featured)
                                    <span class="featured-badge"><i class="fas fa-star me-1"></i> تایبەت</span>
                                @endif
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
            @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <p class="text-muted">هیچ بەرهەمێک نەدۆزرایەوە</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection