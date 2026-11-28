<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'full_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:50'],
            'country' => ['required', 'string', 'max:255'],
            'method' => ['required', 'in:card,paypal,cod'],
            'items' => ['required', 'string'],
        ]);

        $items = collect(json_decode($data['items'], true) ?: [])
            ->filter(fn ($item) => is_array($item) && isset($item['id'], $item['qty']) && (int) $item['qty'] > 0)
            ->map(function ($item) {
                $product = Product::find($item['id']);

                if (! $product) {
                    return null;
                }

                return [
                    'product' => $product,
                    'quantity' => min(999, (int) $item['qty']),
                ];
            })
            ->filter()
            ->values();

        if ($items->isEmpty()) {
            return response()->json([
                'message' => __('Your cart is empty.'),
            ], 422);
        }

        $subtotal = $items->sum(fn ($line) => (float) $line['product']->price * $line['quantity']);
        $shipping = $subtotal >= 50 ? 0 : 4.99;
        $total = $subtotal + $shipping;

        $order = DB::transaction(function () use ($request, $data, $items, $subtotal, $shipping, $total) {
            $order = Order::create([
                'number' => $this->generateNumber(),
                'user_id' => $request->user()?->id,
                'customer_name' => $data['full_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'city' => $data['city'],
                'postal_code' => $data['postal_code'],
                'country' => $data['country'],
                'payment_method' => $data['method'],
                'status' => Order::STATUS_PENDING,
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'total' => $total,
            ]);

            foreach ($items as $line) {
                $order->items()->create([
                    'product_id' => $line['product']->id,
                    'name' => $line['product']->name,
                    'price' => $line['product']->price,
                    'quantity' => $line['quantity'],
                ]);
            }

            return $order;
        });

        return response()->json([
            'id' => $order->id,
            'number' => $order->number,
            'total' => $order->total,
        ], 201);
    }

    private function generateNumber(): string
    {
        do {
            $number = 'ORD-'.Str::upper(Str::random(8));
        } while (Order::where('number', $number)->exists());

        return $number;
    }
}
