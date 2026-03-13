@extends('layouts.admin')
@section('page_title', 'داواکاریەکان')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="text-white mb-0">داواکاریەکان</h5>
    <div class="d-flex gap-2">
        <a href="/admin/orders" class="btn btn-sm {{ !request('status') ? 'btn-gold' : 'btn-outline-gold' }}">هەمووی</a>
        <a href="/admin/orders?status=pending" class="btn btn-sm {{ request('status')=='pending' ? 'btn-gold' : 'btn-outline-gold' }}">چاوەڕوان</a>
        <a href="/admin/orders?status=confirmed" class="btn btn-sm {{ request('status')=='confirmed' ? 'btn-gold' : 'btn-outline-gold' }}">تەسدیقکراو</a>
        <a href="/admin/orders?status=delivering" class="btn btn-sm {{ request('status')=='delivering' ? 'btn-gold' : 'btn-outline-gold' }}">گەیاندن</a>
        <a href="/admin/orders?status=delivered" class="btn btn-sm {{ request('status')=='delivered' ? 'btn-gold' : 'btn-outline-gold' }}">گەیشت</a>
    </div>
</div>

<div class="card-dark">
    <div class="card-body p-0">
        <table class="table table-dark-custom mb-0">
            <thead>
                <tr><th>#</th><th>ناو</th><th>مۆبایل</th><th>ناونیشان</th><th>کۆی گشتی</th><th>بار</th><th>بەروار</th><th>کردار</th></tr>
            </thead>
            <tbody>
                @forelse($orders As $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_phone }}</td>
                    <td style="max-width:150px;">{{ Str::limit($order->customer_address, 30) }}</td>
                    <td>{{ number_format($order->grand_total) }} د.ع</td>
                    <td>
                        <span class="badge-status badge-{{ $order->status }}">
                            @switch($order->status)
                                @case('pending') چاوەڕوان @break
                                @case('confirmed') تەسدیقکراو @break
                                @case('delivering') گەیاندن @break
                                @case('delivered') گەیشت @break
                                @case('cancelled') هەڵوەشێنراوە @break
                            @endswitch
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('Y/m/d H:i') }}</td>
                    <td><a href="/admin/orders/{{ $order->id }}" class="btn btn-sm btn-outline-gold"><i class="fas fa-eye"></i></a></td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-4">هیچ داواکارییەک نییە</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $orders->links() }}</div>
@endsection
