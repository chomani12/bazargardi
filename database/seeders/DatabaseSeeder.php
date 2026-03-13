<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Slider;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gardibazzar.com',
            'password' => Hash::make('password'),
        ]);

        // Settings
        $settings = [
            'phone' => '0750 750 1818',
            'address' => 'بحرکە - سەنتەری بازاڕ',
            'delivery_fee' => '5000',
            'facebook_url' => 'https://facebook.com/gardibazzar',
            'instagram_url' => 'https://instagram.com/gardibazzar',
            'tiktok_url' => 'https://tiktok.com/@gardibazzar',
            'about_text' => 'گەردی بازاڕ باشترین شوێنە بۆ کڕینی گۆشت و بەرهەمی گۆشتی بە کوالیتی بەرز و نرخی گونجاو. ئێمە هەموو جۆرە گۆشتێک دابین دەکەین بە تازەترین شێوە.',
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }

        // Categories
        $categories = [
            ['name_ku' => 'گۆشتی مەڕ', 'name_en' => 'Lamb', 'sort_order' => 1],
            ['name_ku' => 'گۆشتی مانگا', 'name_en' => 'Beef', 'sort_order' => 2],
            ['name_ku' => 'گۆشتی مریشک', 'name_en' => 'Chicken', 'sort_order' => 3],
            ['name_ku' => 'کەباب', 'name_en' => 'Kebab', 'sort_order' => 4],
            ['name_ku' => 'گۆشتی ئامادەکراو', 'name_en' => 'Processed Meat', 'sort_order' => 5],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Sample Products
        $products = [
            ['category_id' => 1, 'name_ku' => 'گۆشتی شیشلیک', 'price' => 25000, 'is_featured' => true, 'description_ku' => 'گۆشتی شیشلیکی تازە و بە کوالیتی بەرز'],
            ['category_id' => 1, 'name_ku' => 'ڕانی مەڕ', 'price' => 22000, 'is_featured' => true, 'description_ku' => 'ڕانی مەڕی تازە بە نرخی گونجاو'],
            ['category_id' => 1, 'name_ku' => 'پاشکەوتەی مەڕ', 'price' => 18000, 'description_ku' => 'پاشکەوتەی مەڕی تازە'],
            ['category_id' => 2, 'name_ku' => 'ستیکی مانگا', 'price' => 30000, 'is_featured' => true, 'description_ku' => 'ستیکی مانگای تازە و بە کوالیتی نایاب'],
            ['category_id' => 2, 'name_ku' => 'گۆشتی هێلکراو', 'price' => 20000, 'description_ku' => 'گۆشتی مانگای هێلکراو بۆ خواردنی ڕۆژانە'],
            ['category_id' => 3, 'name_ku' => 'سینگی مریشک', 'price' => 12000, 'is_featured' => true, 'description_ku' => 'سینگی مریشکی تازە و بێ ئێسک'],
            ['category_id' => 3, 'name_ku' => 'ڕانی مریشک', 'price' => 10000, 'description_ku' => 'ڕانی مریشکی تازە'],
            ['category_id' => 4, 'name_ku' => 'کەبابی تکە', 'price' => 15000, 'is_featured' => true, 'description_ku' => 'کەبابی تکەی ئامادەکراو بۆ بریشتن'],
            ['category_id' => 4, 'name_ku' => 'کەبابی ئادانا', 'price' => 14000, 'description_ku' => 'کەبابی ئادانای ئامادەکراو'],
            ['category_id' => 5, 'name_ku' => 'سۆسیج', 'price' => 8000, 'description_ku' => 'سۆسیجی خانەیی'],
            ['category_id' => 5, 'name_ku' => 'بێرگەر', 'price' => 10000, 'description_ku' => 'بێرگەری خانەیی بە گۆشتی تازە'],
        ];

        foreach ($products as $prod) {
            Product::create($prod);
        }

        // Sliders
        Slider::create(['title_ku' => 'بەخێربێن بۆ گەردی بازاڕ', 'image' => 'img/photo_2026-03-08_03-54-52.jpg', 'sort_order' => 1]);
        Slider::create(['title_ku' => 'گۆشتی تازە بە نرخی گونجاو', 'image' => 'img/photo_2026-03-08_03-54-53.jpg', 'sort_order' => 2]);
        Slider::create(['title_ku' => 'گەیاندن بۆ ماڵەوە', 'image' => 'img/photo_2026-03-08_03-56-39.jpg', 'sort_order' => 3]);
    }
}
