@extends('layouts.admin')
@section('page_title', isset($product) ? 'دەستکاری بەرهەم' : 'بەرهەمی نوێ')
@section('content')
    <div class="card-dark" style="max-width: 700px;">
        <div class="card-header">{{ isset($product) ? 'دەستکاری بەرهەم' : 'زیادکردنی بەرهەمی نوێ' }}</div>
        <div class="card-body p-4">
            <form action="{{ isset($product) ? '/admin/products/' . $product->id : '/admin/products' }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @if(isset($product)) @method('PUT') @endif

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">ناوی کوردی *</label>
                        <input type="text" name="name_ku" class="form-control form-control-dark"
                            value="{{ old('name_ku', $product->name_ku ?? '') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">ناوی ئینگلیزی</label>
                        <input type="text" name="name_en" class="form-control form-control-dark"
                            value="{{ old('name_en', $product->name_en ?? '') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">جۆر *</label>
                        <select name="category_id" class="form-select form-select-dark form-control form-control-dark"
                            required>
                            <option value="">هەڵبژێرە...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name_ku }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">نرخ (د.ع) *</label>
                        <input type="number" name="price" class="form-control form-control-dark"
                            value="{{ old('price', $product->price ?? '') }}" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">وەسف</label>
                    <textarea name="description_ku" class="form-control form-control-dark"
                        rows="3">{{ old('description_ku', $product->description_ku ?? '') }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">وێنە</label>
                    <input type="file" name="image" class="form-control form-control-dark" accept="image/*">
                    @if(isset($product) && $product->image)
                        <img src="/storage/{{ $product->image }}" class="mt-2" style="max-width:100px;border-radius:8px;">
                    @endif
                </div>
                <div class="mb-3 d-flex gap-4">
                    <div class="form-check">
                        <input type="checkbox" name="is_featured" value="1" class="form-check-input" id="is_featured" {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label text-muted" for="is_featured">بەرهەمی تایبەت</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label text-muted" for="is_active">چالاک</label>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-gold"><i class="fas fa-save me-2"></i>پاشەکەوتکردن</button>
                    <a href="/admin/products" class="btn btn-outline-gold">گەڕانەوە</a>
                </div>
            </form>
        </div>
    </div>
@endsection