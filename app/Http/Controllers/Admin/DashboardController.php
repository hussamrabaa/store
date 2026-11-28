<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'users' => User::count(),
            'admins' => User::where('role', 'admin')->count(),
        ];

        if (in_array(request()->user()->role, ['admin', 'editor'], true)) {
            $stats['orders'] = Order::count();
            $stats['pending_orders'] = Order::where('status', Order::STATUS_PENDING)->count();
        }

        $recentProducts = Product::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentProducts'));
    }
}
