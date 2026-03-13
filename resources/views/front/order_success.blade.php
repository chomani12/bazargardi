@extends('layouts.front')
@section('title', 'داواکاری سەرکەوتوو - گەردی بازاڕ')
@section('content')
    <section class="container" style="margin-top: 60px;">
        <div class="glass-box text-center" style="max-width: 600px; margin: 0 auto;">
            <div
                style="width: 80px; height: 80px; background: rgba(40,167,69,0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                <i class="fas fa-check fa-2x" style="color: #28a745;"></i>
            </div>
            <h2 style="color: #fff; font-weight: 800; margin-bottom: 12px;">داواکاریەکەت سەرکەوتوو بوو!</h2>
            <p class="text-muted mb-4">سوپاس بۆ داواکاریت. بەم زووانە پەیوەندیت پێوە دەکرێت.</p>

            <div class="glass-box text-start mb-4" style="background: rgba(255,255,255,0.02);">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">ژمارەی داواکاری:</span>
                    <strong style="color: var(--gold);">#{{ $order->id }}</strong>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">ناو:</span>
                    <span style="color: #fff;">{{ $order->customer_name }}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">مۆبایل:</span>
                    <span style="color: #fff;">{{ $order->customer_phone }}</span>
                </div>
                <hr style="border-color: rgba(255,255,255,0.06);">
                @foreach($order->items as $item)
                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">{{ $item->product->name_ku ?? '' }} ({{ $item->quantity }}x)</span>
                        <span style="color: #fff;">{{ number_format($item->subtotal) }} د.ع</span>
                    </div>
                @endforeach
                <hr style="border-color: rgba(255,255,255,0.06);">
                <div class="d-flex justify-content-between mb-1">
                    <span class="text-muted">کرێی گەیاندن:</span>
                    <span style="color: #fff;">{{ number_format($order->delivery_fee) }} د.ع</span>
                </div>
                <div class="d-flex justify-content-between">
                    <strong style="color: var(--gold);">کۆی گشتی:</strong>
                    <strong style="color: var(--gold); font-size: 1.2rem;">{{ number_format($order->grand_total) }}
                        د.ع</strong>
                </div>
            </div>

            <div class="d-flex gap-2 justify-content-center flex-wrap">
                @if(!empty($whatsappPhone))
                    @php
                        $waMessage = "سڵاو، داواکارییەکم تۆمارکرا ✅\n";
                        $waMessage .= "📋 ژمارەی داواکاری: #" . $order->id . "\n";
                        $waMessage .= "👤 ناو: " . $order->customer_name . "\n";
                        $waMessage .= "📱 مۆبایل: " . $order->customer_phone . "\n";
                        $waMessage .= "📍 ناونیشان: " . $order->customer_address . "\n";
                        $waMessage .= "━━━━━━━━━━━━━━━\n";
                        foreach($order->items as $item) {
                            $waMessage .= "🔸 " . ($item->product->name_ku ?? '') . " × " . $item->quantity . " = " . number_format($item->subtotal) . " د.ع\n";
                        }
                        $waMessage .= "━━━━━━━━━━━━━━━\n";
                        $waMessage .= "🚚 کرێی گەیاندن: " . number_format($order->delivery_fee) . " د.ع\n";
                        $waMessage .= "💰 کۆی گشتی: " . number_format($order->grand_total) . " د.ع\n";
                        if ($order->latitude && $order->longitude) {
                            $waMessage .= "\n📌 شوێنی گەیاندن:\nhttps://maps.google.com/maps?q=" . $order->latitude . "," . $order->longitude . "\n";
                        }
                        $waMessage .= "\nسوپاس بۆ خزمەتگوزاری 🙏";
                    @endphp
                    <a href="https://wa.me/{{ $whatsappPhone }}?text={{ urlencode($waMessage) }}"
                        target="_blank" class="btn btn-lg"
                        style="background: #25D366; color: #fff; font-weight: 700; border-radius: 12px; padding: 12px 28px;">
                        <i class="fab fa-whatsapp me-2" style="font-size: 1.3rem;"></i> ناردنی لە واتسئاپ
                    </a>
                @endif
                <a href="/track" class="btn btn-outline-gold"><i class="fas fa-search me-2"></i> شوێنکەوتنی داواکاری</a>
                <a href="/" class="btn btn-gold"><i class="fas fa-home me-2"></i> گەڕانەوە بۆ سەرەکی</a>
            </div>
        </div>
    </section>
@endsection