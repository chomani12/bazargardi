@extends('layouts.admin')
@section('page_title', 'ڕێکخستنەکان')
@section('content')
    <div class="card-dark" style="max-width: 700px;">
        <div class="card-header"><i class="fas fa-cog me-2"></i>ڕێکخستنەکانی سایت</div>
        <div class="card-body p-4">
            <form action="/admin/settings" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">ژمارەی مۆبایل</label>
                        <input type="text" name="phone" class="form-control form-control-dark"
                            value="{{ $settings['phone'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted"><i class="fab fa-whatsapp me-1" style="color: #25D366;"></i>ژمارەی واتسئاپ</label>
                        <input type="text" name="whatsapp_phone" class="form-control form-control-dark"
                            value="{{ $settings['whatsapp_phone'] ?? '' }}" placeholder="964750xxxxxxx" dir="ltr">
                        <small class="text-muted">ژمارەکە بە کۆدی وڵات بنووسە بێ + (بۆ نموونە: 964750xxxxxxx)</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted">کرێی گەیاندن (د.ع)</label>
                        <input type="number" name="delivery_fee" class="form-control form-control-dark"
                            value="{{ $settings['delivery_fee'] ?? 5000 }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">ناونیشان</label>
                    <input type="text" name="address" class="form-control form-control-dark"
                        value="{{ $settings['address'] ?? '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted">دەربارەی فرۆشگا</label>
                    <textarea name="about_text" class="form-control form-control-dark"
                        rows="3">{{ $settings['about_text'] ?? '' }}</textarea>
                </div>
                <hr style="border-color: rgba(255,255,255,0.06);">
                <h6 class="text-muted mb-3"><i class="fas fa-share-alt me-2"></i>سۆشیال میدیا</h6>
                <div class="mb-3">
                    <label class="form-label text-muted"><i class="fab fa-facebook me-1"></i> فەیسبووک</label>
                    <input type="url" name="facebook_url" class="form-control form-control-dark"
                        value="{{ $settings['facebook_url'] ?? '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted"><i class="fab fa-instagram me-1"></i> ئینستاگرام</label>
                    <input type="url" name="instagram_url" class="form-control form-control-dark"
                        value="{{ $settings['instagram_url'] ?? '' }}">
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted"><i class="fab fa-tiktok me-1"></i> تیکتۆک</label>
                    <input type="url" name="tiktok_url" class="form-control form-control-dark"
                        value="{{ $settings['tiktok_url'] ?? '' }}">
                </div>
                <button type="submit" class="btn btn-gold"><i class="fas fa-save me-2"></i>پاشەکەوتکردن</button>
            </form>
        </div>
    </div>
@endsection