@extends('layouts.admin')
@section('page_title', 'وردەکاری داواکاری #' . $order->id)
@section('content')
    <div class="row g-4">
        <div class="col-md-8">
            <div class="card-dark mb-4">
                <div class="card-header">بابەتەکانی داواکاری</div>
                <div class="card-body p-0">
                    <table class="table table-dark-custom mb-0">
                        <thead>
                            <tr>
                                <th>بەرهەم</th>
                                <th>نرخی یەکە</th>
                                <th>بڕ</th>
                                <th>کۆی گشتی</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product->name_ku ?? 'سڕاوە' }}</td>
                                    <td>{{ number_format($item->unit_price) }} د.ع</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->subtotal) }} د.ع</td>
                                </tr>
                            @endforeach
                            <tr style="background: rgba(212,167,69,0.05);">
                                <td colspan="3" class="text-end"><strong>کۆی بەرهەمەکان:</strong></td>
                                <td><strong>{{ number_format($order->total_amount) }} د.ع</strong></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end">کرێی گەیاندن:</td>
                                <td>{{ number_format($order->delivery_fee) }} د.ع</td>
                            </tr>
                            <tr style="background: rgba(212,167,69,0.1);">
                                <td colspan="3" class="text-end"><strong style="color:#D4A745;">کۆی گشتی:</strong></td>
                                <td><strong style="color:#D4A745;">{{ number_format($order->grand_total) }} د.ع</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-dark mb-4">
                <div class="card-header">زانیاری کڕیار</div>
                <div class="card-body">
                    <p class="mb-2"><i class="fas fa-user me-2" style="color:#D4A745;"></i> {{ $order->customer_name }}</p>
                    <p class="mb-2"><i class="fas fa-phone me-2" style="color:#D4A745;"></i> {{ $order->customer_phone }}
                    </p>
                    <p class="mb-2"><i class="fas fa-map-marker-alt me-2" style="color:#D4A745;"></i>
                        {{ $order->customer_address }}</p>
                    @if($order->notes)
                        <p class="mb-2"><i class="fas fa-sticky-note me-2" style="color:#D4A745;"></i> {{ $order->notes }}</p>
                    @endif
                    <p class="mb-0 text-muted"><i class="fas fa-clock me-2"></i>
                        {{ $order->created_at->format('Y/m/d H:i') }}</p>
                    <hr style="border-color: rgba(255,255,255,0.06);">
                    @php
                        $waPhone = $order->customer_phone;
                        $waPhone = preg_replace('/[^0-9]/', '', $waPhone);
                        if (str_starts_with($waPhone, '0')) {
                            $waPhone = '964' . substr($waPhone, 1);
                        }
                        $waMsg = "سڵاو " . $order->customer_name . "، داواکاری ژمارە #" . $order->id . "\n";
                        if ($order->latitude && $order->longitude) {
                            $waMsg .= "📌 شوێن: https://maps.google.com/maps?q=" . $order->latitude . "," . $order->longitude . "\n";
                        }
                    @endphp
                    <a href="https://wa.me/{{ $waPhone }}?text={{ urlencode($waMsg) }}"
                        target="_blank" class="btn w-100 mb-2"
                        style="background: #25D366; color: #fff; font-weight: 700; border-radius: 8px;">
                        <i class="fab fa-whatsapp me-2"></i> پەیوەندی لە واتسئاپ
                    </a>
                    @if($order->latitude && $order->longitude)
                        <a href="https://maps.google.com/maps?q={{ $order->latitude }},{{ $order->longitude }}"
                            target="_blank" class="btn w-100"
                            style="background: rgba(66,133,244,0.15); color: #4285F4; border: 1px solid #4285F4; font-weight: 700; border-radius: 8px;">
                            <i class="fas fa-map-marked-alt me-2"></i> بینینی شوێن لە نەخشە
                        </a>
                    @endif
                </div>
            </div>

            <div class="card-dark">
                <div class="card-header">گۆڕینی بار</div>
                <div class="card-body">
                    <form action="/admin/orders/{{ $order->id }}/status" method="POST">
                        @csrf @method('PUT')
                        <select name="status" class="form-select form-control-dark mb-3">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>چاوەڕوان</option>
                            <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>تەسدیقکراو
                            </option>
                            <option value="delivering" {{ $order->status == 'delivering' ? 'selected' : '' }}>لە ڕێگادا
                            </option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>گەیشت</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>هەڵوەشێنراوە
                            </option>
                        </select>
                        <button class="btn btn-gold w-100"><i class="fas fa-save me-2"></i>نوێکردنەوە</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <a href="/admin/orders" class="btn btn-outline-gold mt-3"><i class="fas fa-arrow-right me-2"></i>گەڕانەوە</a>
@endsection