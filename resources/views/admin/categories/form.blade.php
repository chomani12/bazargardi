@extends('layouts.admin')
@section('page_title', isset($category) ? 'دەستکاری جۆر' : 'جۆری نوێ')
@section('content')
    <div class="card-dark" style="max-width: 600px;">
        <div class="card-header">{{ isset($category) ? 'دەستکاری جۆر' : 'زیادکردنی جۆری نوێ' }}</div>
        <div class="card-body p-4">
            <form action="{{ isset($category) ? '/admin/categories/' . $category->id : '/admin/categories' }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @if(isset($category)) @method('PUT') @endif

                <div class="mb-3">
                    <label class="form-label text-muted">ناوی کوردی *</label>
                    <input type="text" name="name_ku" class="form-control form-control-dark"
                        value="{{ old('name_ku', $category->name_ku ?? '') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">ناوی ئینگلیزی</label>
                    <input type="text" name="name_en" class="form-control form-control-dark"
                        value="{{ old('name_en', $category->name_en ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">ڕیزبەندی</label>
                    <input type="number" name="sort_order" class="form-control form-control-dark"
                        value="{{ old('sort_order', $category->sort_order ?? 0) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">وێنە</label>
                    <input type="file" name="image" class="form-control form-control-dark" accept="image/*">
                </div>
                <div class="mb-4 form-check">
                    <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" {{ old('is_active', $category->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label text-muted" for="is_active">چالاک</label>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-gold"><i class="fas fa-save me-2"></i>پاشەکەوتکردن</button>
                    <a href="/admin/categories" class="btn btn-outline-gold">گەڕانەوە</a>
                </div>
            </form>
        </div>
    </div>
@endsection