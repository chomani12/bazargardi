@extends('layouts.front')
@section('title', 'سەبەتەی کڕین - گەردی بازاڕ')
@section('content')
    <section class="container" style="margin-top: 40px;">
        <div class="section-title">
            <h2><i class="fas fa-shopping-cart me-2" style="color: var(--gold);"></i> سەبەتەی کڕین</h2>
            <div class="line"></div>
        </div>

        @if(count($cartItems) > 0)
            <div class="row g-4">
                <div class="col-md-8">
                    <div class="glass-box p-0">
                        <form action="/cart/update" method="POST">
                            @csrf
                            <table class="table cart-table mb-0">
                                <thead>
                                    <tr>
                                        <th style="padding: 16px 20px;">بەرهەم</th>
                                        <th>نرخ</th>
                                        <th style="width: 100px;">بڕ</th>
                                        <th>کۆی</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cartItems as $item)
                                        <tr>
                                            <td style="padding: 16px 20px;">
                                                <div class="d-flex align-items-center gap-3">
                                                    <img src="{{ $item['product']->image ? '/storage/' . $item['product']->image : '/img/logo.png' }}"
                                                        style="width: 60px; height: 60px; object-fit: cover; border-radius: 10px;">
                                                    <div>
                                                        <strong style="color: #fff;">{{ $item['product']->name_ku }}</strong>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ number_format($item['product']->price) }} د.ع</td>
                                            <td>
                                                <input type="number" name="quantities[{{ $item['product']->id }}]"
                                                    value="{{ $item['quantity'] }}" min="0"
                                                    class="form-control form-control-dark text-center" style="width: 70px;">
                                            </td>
                                            <td style="color: var(--gold); font-weight: 700;">{{ number_format($item['subtotal']) }}
                                                د.ع</td>
                                            <td>
                                                <a href="/cart/remove/{{ $item['product']->id }}" class="btn btn-sm text-danger"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="p-3 text-start">
                                <button type="submit" class="btn btn-outline-gold btn-sm"><i class="fas fa-sync me-1"></i>
                                    نوێکردنەوەی سەبەتە</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="glass-box">
                        <h5 style="color: var(--gold); font-weight: 700; margin-bottom: 20px;">پوختەی داواکاری</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">کۆی بەرهەمەکان:</span>
                            <span style="color: #fff;">{{ number_format($total) }} د.ع</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">کرێی گەیاندن:</span>
                            <span style="color: #fff;">{{ number_format($deliveryFee) }} د.ع</span>
                        </div>
                        <hr style="border-color: rgba(255,255,255,0.06);">
                        <div class="d-flex justify-content-between mb-4">
                            <strong style="color: var(--gold);">کۆی گشتی:</strong>
                            <strong style="color: var(--gold); font-size: 1.3rem;">{{ number_format($total + $deliveryFee) }}
                                د.ع</strong>
                        </div>
                        <a href="/checkout" class="btn btn-gold w-100">
                            <i class="fas fa-credit-card me-2"></i> تەواوکردنی داواکاری
                        </a>
                        <a href="/products" class="btn btn-outline-gold w-100 mt-2">
                            <i class="fas fa-arrow-right me-2"></i> بەردەوامبوون لە کڕین
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="glass-box text-center py-5">
                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                <h4 style="color: #fff;">سەبەتەکەت بەتاڵە</h4>
                <p class="text-muted mb-4">هیچ بەرهەمێکت زیاد نەکردووە بۆ سەبەتە</p>
                <a href="/products" class="btn btn-gold"><i class="fas fa-shopping-bag me-2"></i> بەرهەمەکان ببینە</a>
            </div>
        @endif
    </section>
@endsection