@extends('layouts.admin')
@section('page_title', 'جۆرەکان')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="text-white mb-0">جۆرەکان</h5>
        <a href="/admin/categories/create" class="btn btn-gold"><i class="fas fa-plus me-2"></i>جۆری نوێ</a>
    </div>

    <div class="card-dark">
        <div class="card-body p-0">
            <table class="table table-dark-custom mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ناوی کوردی</th>
                        <th>ناوی ئینگلیزی</th>
                        <th>ڕیزبەندی</th>
                        <th>بار</th>
                        <th>کردارەکان</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $cat)
                        <tr>
                            <td>{{ $cat->id }}</td>
                            <td>{{ $cat->name_ku }}</td>
                            <td>{{ $cat->name_en }}</td>
                            <td>{{ $cat->sort_order }}</td>
                            <td>{!! $cat->is_active ? '<span class="text-success">چالاک</span>' : '<span class="text-danger">ناچالاک</span>' !!}
                            </td>
                            <td>
                                <a href="/admin/categories/{{ $cat->id }}/edit" class="btn btn-sm btn-outline-gold me-1"><i
                                        class="fas fa-edit"></i></a>
                                <form action="/admin/categories/{{ $cat->id }}" method="POST" class="d-inline"
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