<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        $related = Product::whereKeyNot($product->getKey())
            ->latest()
            ->take(3)
            ->get();

        return view('products.show', compact('product', 'related'));
    }
}
