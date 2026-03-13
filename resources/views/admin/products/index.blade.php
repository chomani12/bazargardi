@extends('layouts.admin')
@section('page_title', 'بەرهەمەکان')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="text-white mb-0">بەرهەمەکان</h5>
        <a href="/admin/products/create" class="btn btn-gold"><i class="fas fa-plus me-2"></i>بەرهەمی نوێ</a>
    </div>

    <div class="card-dark">
        <div class="card-body p-0">
            <table class="table table-dark-custom mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>وێنە</th>
                        <th>ناو</th>
                        <th>جۆر</th>
                        <th>نرخ</th>
                        <th>تایبەت</th>
                        <th>بار</th>
                        <th>کردارەکان</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if($product->image)
                                    <img src="/storage/{{ $product->image }}"
                                        style="width:50px;height:50px;object-fit:cover;border-radius:8px;">
                                @else
                                    <div
                                        style="width:50px;height:50px;background:#222;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                        <i class="fas fa-image text-muted"></i></div>
                                @endif
                            </td>
                            <td>{{ $product->name_ku }}</td>
                            <td><span style="color:#D4A745;">{{ $product->category->name_ku ?? '-' }}</span></td>
                            <td>{{ number_format($product->price) }} د.ع</td>
                            <td>{!! $product->is_featured ? '<i class="fas fa-star text-warning"></i>' : '' !!}</td>
                            <td>{!! $product->is_active ? '<span class="text-success">چالاک</span>' : '<span class="text-danger">ناچالاک</span>' !!}
                            </td>
                            <td>
                                <a href="/admin/products/{{ $product->id }}/edit" class="btn btn-sm btn-outline-gold me-1"><i
                                        class="fas fa-edit"></i></a>
                                <form action="/admin/products/{{ $product->id }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('دڵنیای لە سڕینەوە؟')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection