<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    //  Show Cart Page
    public function index()
    {
        $items = collect(session()->get('cart', []));

        $total = $items->sum(function ($item) {
            return $item['price'] * $item['qty'];
        });

        // Calculate subtotal
        $subtotal = $items->sum(function ($item) {
            return ($item['price'] ?? 0) * ($item['qty'] ?? 1);
        });

        // VAT (15%)
        $vat = $subtotal * 0.15;

        // Total = Subtotal + VAT
        $total = $subtotal + $vat;

        return view('pages.website.cart', compact('items', 'total', 'subtotal', 'vat'));
    }

    //  Add to Cart
    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $qty = $request->quantity ?? 1;

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            // Increase quantity
            $cart[$product->id]['qty'] += $qty;
        } else {
            // Add new item
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->sale_price ?: $product->regular_price,
                'qty' => $qty,
                'image' => $product->image,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // Remove Item
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Item removed!');
    }

    // Update Quantity
    public function update(Request $request)
{
    $cart = session()->get('cart', []);
    $quantities = $request->input('quantity', []);

    foreach ($quantities as $id => $qty) {
        if (isset($cart[$id])) {
            $cart[$id]['qty'] = max(1, (int)$qty); // prevent qty < 1
        }
    }

    session()->put('cart', $cart);

    return back()->with('success', 'Cart updated!');
}

    // 🧹 Clear Cart
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart')->with('success', 'Cart cleared!');
    }
}
