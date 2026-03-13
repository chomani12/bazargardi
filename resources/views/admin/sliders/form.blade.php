@extends('layouts.admin')
@section('page_title', isset($slider) ? 'دەستکاری سلایدەر' : 'سلایدەری نوێ')
@section('content')
    <div class="card-dark" style="max-width: 600px;">
        <div class="card-header">{{ isset($slider) ? 'دەستکاری سلایدەر' : 'سلایدەری نوێ' }}</div>
        <div class="card-body p-4">
            <form action="{{ isset($slider) ? '/admin/sliders/' . $slider->id : '/admin/sliders' }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @if(isset($slider)) @method('PUT') @endif
                <div class="mb-3">
                    <label class="form-label text-muted">ناونیشان</label>
                    <input type="text" name="title_ku" class="form-control form-control-dark"
                        value="{{ old('title_ku', $slider->title_ku ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">لینک</label>
                    <input type="text" name="link" class="form-control form-control-dark"
                        value="{{ old('link', $slider->link ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">ڕیزبەندی</label>
                    <input type="number" name="sort_order" class="form-control form-control-dark"
                        value="{{ old('sort_order', $slider->sort_order ?? 0) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">وێنە {{ isset($slider) ? '' : '*' }}</label>
                    <input type="file" name="image" class="form-control form-control-dark" accept="image/*" {{ isset($slider) ? '' : 'required' }}>
                    @if(isset($slider))
                        <img src="/storage/{{ $slider->image }}" class="mt-2" style="max-width:200px;border-radius:8px;">
                    @endif
                </div>
                <div class="mb-4 form-check">
                    <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" {{ old('is_active', $slider->is_active ?? true) ? 'checked' : '' }}>
                    <label class="form-check-label text-muted" for="is_active">چالاک</label>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-gold"><i class="fas fa-save me-2"></i>پاشەکەوتکردن</button>
                    <a href="/admin/sliders" class="btn btn-outline-gold">گەڕانەوە</a>
                </div>
            </form>
        </div>
    </div>
@endsection