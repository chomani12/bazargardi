@extends('layouts.admin')
@section('page_title', 'داشبۆرد')
@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p>داواکاریەکانی ئەمڕۆ</p>
                    <h3>{{ $todayOrders }}</h3>
                </div>
                <div class="icon" style="background: rgba(0,123,255,0.15); color: #007bff;"><i class="fas fa-shopping-bag"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p>چاوەڕوانی تەسدیق</p>
                    <h3>{{ $pendingOrders }}</h3>
                </div>
                <div class="icon" style="background: rgba(255,193,7,0.15); color: #ffc107;"><i class="fas fa-clock"></i></div>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <p>کۆی داهات</p>
                    <h3>{{ number_format($totalRevenue) }} <small style="font-size:0.7rem; color:#888;">د.ع</small></h3>
                </div>
                <div class="icon" style="background: rgba(40,167,69,0.15); color: #28a745;"><i class="fas fa-coins"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3 col-6">
        <div class="stat-card text-center">
            <div class="icon mx-auto mb-2" style="background: rgba(212,167,69,0.15); color: #D4A745;"><i class="fas fa-box"></i></div>
            <h3>{{ $totalProducts }}</h3>
            <p>بەرهەم</p>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="stat-card text-center">
            <div class="icon mx-auto mb-2" style="background: rgba(138,43,226,0.15); color: #8a2be2;"><i class="fas fa-tags"></i></div>
            <h3>{{ $totalCategories }}</h3>
            <p>جۆر</p>
        </div>
    </div>
</div>

<div class="card-dark">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fas fa-list me-2"></i>کۆتا داواکاریەکان</span>
        <a href="/admin/orders" class="btn btn-sm btn-outline-gold">هەمووی ببینە</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-dark-custom mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ناو</th>
                    <th>مۆبایل</th>
                    <th>بڕی کۆی</th>
                    <th>بار</th>
                    <th>بەروار</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentOrders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->customer_phone }}</td>
                    <td>{{ number_format($order->total_amount) }} د.ع</td>
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
                    <td>{{ $order->created_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">هیچ داواکارییەک نییە</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
