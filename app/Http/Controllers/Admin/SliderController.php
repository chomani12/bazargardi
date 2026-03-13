<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('sort_order')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_ku' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'sort_order' => 'integer',
            'image' => 'required|image|max:4096',
        ]);

        $data['image'] = $request->file('image')->store('sliders', 'public');
        $data['is_active'] = $request->has('is_active');
        Slider::create($data);
        return redirect('/admin/sliders')->with('success', 'سلایدەر زیادکرا');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.form', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $data = $request->validate([
            'title_ku' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'sort_order' => 'integer',
            'image' => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('sliders', 'public');
        }

        $data['is_active'] = $request->has('is_active');
        $slider->update($data);
        return redirect('/admin/sliders')->with('success', 'سلایدەر نوێکرایەوە');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect('/admin/sliders')->with('success', 'سلایدەر سڕایەوە');
    }
}
