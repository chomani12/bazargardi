<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $todayOrders = Order::whereDate('created_at', Carbon::today())->count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('total_amount');
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $recentOrders = Order::latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'todayOrders',
            'pendingOrders',
            'totalRevenue',
            'totalProducts',
            'totalCategories',
            'recentOrders'
        ));
    }
}
