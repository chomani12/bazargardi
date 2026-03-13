<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Slider;
use App\Models\Setting;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function home()
    {
        $sliders = Slider::where('is_active', true)->orderBy('sort_order')->get();
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();
        $featuredProducts = Product::where('is_active', true)->where('is_featured', true)->with('category')->take(8)->get();
        $settings = Setting::all()->pluck('value', 'key');
        return view('front.home', compact('sliders', 'categories', 'featuredProducts', 'settings'));
    }

    public function products(Request $request)
    {
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();
        $query = Product::where('is_active', true)->with('category');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->get();
        $settings = Setting::all()->pluck('value', 'key');
        return view('front.products', compact('products', 'categories', 'settings'));
    }

    public function productDetail(Product $product)
    {
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)->get();
        $settings = Setting::all()->pluck('value', 'key');
        return view('front.product_detail', compact('product', 'relatedProducts', 'settings'));
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        $cartItems = [];

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $product->price * $item['quantity'],
                ];
                $total += $product->price * $item['quantity'];
            }
        }

        $deliveryFee = (int) Setting::get('delivery_fee', 5000);
        $settings = Setting::all()->pluck('value', 'key');
        return view('front.cart', compact('cartItems', 'total', 'deliveryFee', 'settings'));
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = ['quantity' => $quantity];
        }

        session()->put('cart', $cart);
        return back()->with('success', 'بەرهەم زیادکرا بۆ سەبەتە');
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $quantities = $request->input('quantities', []);

        foreach ($quantities as $id => $qty) {
            if ($qty > 0) {
                $cart[$id]['quantity'] = $qty;
            } else {
                unset($cart[$id]);
            }
        }

        session()->put('cart', $cart);
        return back()->with('success', 'سەبەتە نوێکرایەوە');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return back()->with('success', 'بەرهەم لابرا لە سەبەتە');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'سەبەتەکەت بەتاڵە');
        }

        $total = 0;
        $cartItems = [];

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'subtotal' => $product->price * $item['quantity'],
                ];
                $total += $product->price * $item['quantity'];
            }
        }

        $deliveryFee = (int) Setting::get('delivery_fee', 5000);
        $settings = Setting::all()->pluck('value', 'key');
        return view('front.checkout', compact('cartItems', 'total', 'deliveryFee', 'settings'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'سەبەتەکەت بەتاڵە');
        }

        $deliveryFee = (int) Setting::get('delivery_fee', 5000);
        $total = 0;

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'notes' => $request->notes,
            'delivery_fee' => $deliveryFee,
            'status' => 'pending',
        ]);

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                ]);
                $total += $product->price * $item['quantity'];
            }
        }

        $order->update(['total_amount' => $total]);
        session()->forget('cart');

        return redirect('/order-success/' . $order->id)->with('order_placed', true);
    }

    public function orderSuccess(Order $order)
    {
        $order->load('items.product');
        $settings = Setting::all()->pluck('value', 'key');
        $whatsappPhone = Setting::get('whatsapp_phone', '');
        return view('front.order_success', compact('order', 'settings', 'whatsappPhone'));
    }

    public function track()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('front.track', compact('settings'));
    }

    public function trackResult(Request $request)
    {
        $request->validate(['phone' => 'required|string']);
        $orders = Order::where('customer_phone', $request->phone)->with('items.product')->latest()->get();
        $settings = Setting::all()->pluck('value', 'key');
        return view('front.track', compact('orders', 'settings'));
    }

    public function about()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('front.about', compact('settings'));
    }
}
