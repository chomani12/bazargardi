@extends('layouts.admin')
@section('page_title', 'سلایدەرەکان')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="text-white mb-0">سلایدەرەکان</h5>
        <a href="/admin/sliders/create" class="btn btn-gold"><i class="fas fa-plus me-2"></i>سلایدەری نوێ</a>
    </div>
    <div class="row g-3">
        @foreach($sliders as $slider)
            <div class="col-md-4">
                <div class="card-dark overflow-hidden">
                    <img src="/storage/{{ $slider->image }}" style="width:100%;height:180px;object-fit:cover;">
                    <div class="card-body p-3">
                        <h6 class="text-white mb-2">{{ $slider->title_ku ?? 'بدوون ناونیشان' }}</h6>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted" style="font-size:0.8rem;">ڕیزبەندی: {{ $slider->sort_order }}</span>
                            <div>
                                <a href="/admin/sliders/{{ $slider->id }}/edit" class="btn btn-sm btn-outline-gold"><i
                                        class="fas fa-edit"></i></a>
                                <form action="/admin/sliders/{{ $slider->id }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('دڵنیای؟')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection