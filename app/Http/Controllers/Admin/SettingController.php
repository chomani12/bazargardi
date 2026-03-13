<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $keys = ['phone', 'whatsapp_phone', 'address', 'delivery_fee', 'facebook_url', 'instagram_url', 'tiktok_url', 'about_text'];

        foreach ($keys as $key) {
            Setting::set($key, $request->input($key, ''));
        }

        return back()->with('success', 'ڕێکخستنەکان پاشەکەوتکران');
    }
}
