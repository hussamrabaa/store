<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->string('status')->toString();
        $search = $request->string('search')->trim()->toString();

        $orders = Order::query()
            ->when(array_key_exists($status, Order::STATUSES), fn ($query) => $query->where('status', $status))
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('number', 'like', "%{$search}%")
                        ->orWhere('customer_name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->withCount('items')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $statuses = Order::STATUSES;

        return view('admin.orders.index', compact('orders', 'statuses', 'status', 'search'));
    }

    public function show(Order $order)
    {
        $order->load(['items.product', 'user']);

        $statuses = Order::STATUSES;

        return view('admin.orders.show', compact('order', 'statuses'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(array_keys(Order::STATUSES))],
        ]);

        $order->update(['status' => $data['status']]);

        return back()->with('success', __('Order status updated.'));
    }
}
