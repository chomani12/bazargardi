@extends('layouts.front')
@section('title', 'شوێنکەوتنی داواکاری - گەردی بازاڕ')
@section('content')
<section class="container" style="margin-top: 40px;">
    <div class="section-title">
        <h2><i class="fas fa-search me-2" style="color: var(--gold);"></i> شوێنکەوتنی داواکاری</h2>
        <div class="line"></div>
    </div>

    <div class="glass-box" style="max-width: 600px; margin: 0 auto 40px;">
        <form action="/track" method="POST">
            @csrf
            <div class="d-flex gap-2">
                <input type="text" name="phone" class="form-control form-control-dark" placeholder="ژمارەی مۆبایلت بنووسە..."
                       value="{{ request('phone') }}" required>
                <button class="btn btn-gold"><i class="fas fa-search me-1"></i> گەڕان</button>
            </div>
        </form>
    </div>

    @if(isset($orders))
        @if($orders->count() > 0)
            <div class="row g-3">
                @foreach($orders as $order)
                <div class="col-md-6">
                    <div class="glass-box">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 style="color: var(--gold); margin: 0;">داواکاری #{{ $order->id }}</h6>
                            <span class="status-{{ $order->status }}">
                                @switch($order->status)
                                    @case('pending') چاوەڕوان @break
                                    @case('confirmed') تەسدیقکراو @break
                                    @case('delivering') لە ڕێگادا @break
                                    @case('delivered') گەیشت @break
                                    @case('cancelled') هەڵوەشێنراوە @break
                                @endswitch
                            </span>
                        </div>
                        @foreach($order->items as $item)
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">{{ $item->product->name_ku ?? 'سڕاوە' }} ({{ $item->quantity }}x)</span>
                            <span style="color: #fff;">{{ number_format($item->subtotal) }} د.ع</span>
                        </div>
                        @endforeach
                        <hr style="border-color: rgba(255,255,255,0.06);">
                        <div class="d-flex justify-content-between">
                            <strong style="color: var(--gold);">کۆی گشتی:</strong>
                            <strong style="color: var(--gold);">{{ number_format($order->grand_total) }} د.ع</strong>
                        </div>
                        <small class="text-muted d-block mt-2"><i class="fas fa-clock me-1"></i> {{ $order->created_at->format('Y/m/d H:i') }}</small>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="glass-box text-center py-4" style="max-width: 500px; margin: 0 auto;">
                <i class="fas fa-box-open fa-2x text-muted mb-3"></i>
                <p class="text-muted">هیچ داواکارییەک نەدۆزرایەوە بۆ ئەم ژمارەیە</p>
            </div>
        @endif
    @endif
</section>
@endsection
