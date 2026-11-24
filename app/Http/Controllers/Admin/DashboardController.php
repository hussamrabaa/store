<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        $recentProducts = Product::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentProducts'));
    }
}
