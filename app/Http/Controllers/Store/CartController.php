<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Store\StoreProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show()
    {
        $cart = session()->get('cart', ['items' => []]);

        $variantIds = array_keys($cart['items']);
        $variants = StoreProductVariant::with('product')
            ->whereIn('id', $variantIds)
            ->get()
            ->keyBy('id');

        $lines = [];
        $subtotal = 0;

        foreach ($cart['items'] as $variantId => $item) {
            if (!isset($variants[$variantId])) continue;

            $variant = $variants[$variantId];
            $qty = (int)$item['qty'];
            $line = $variant->price_cents * $qty;

            $lines[] = compact('variant','qty','line');
            $subtotal += $line;
        }

        return view('store.cart', [
            'lines' => $lines,
            'subtotal_cents' => $subtotal,
            'currency' => 'EUR',
        ]);
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'variant_id' => ['required','integer','exists:store_product_variants,id'],
            'qty' => ['nullable','integer','min:1','max:99'],
        ]);

        $qty = $data['qty'] ?? 1;
        $variantId = (string)$data['variant_id'];

        $cart = session()->get('cart', ['items' => []]);
        $cart['items'][$variantId]['variant_id'] = (int)$variantId;
        $cart['items'][$variantId]['qty'] = ($cart['items'][$variantId]['qty'] ?? 0) + $qty;

        session()->put('cart', $cart);

        return back()->with('success', 'Added to cart!');
    }

    public function remove(Request $request)
    {
        $data = $request->validate([
            'variant_id' => ['required','integer'],
        ]);

        $cart = session()->get('cart', ['items' => []]);
        unset($cart['items'][(string)$data['variant_id']]);
        session()->put('cart', $cart);

        return back()->with('success', 'Removed from cart.');
    }
}
