<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Store\StoreOrder;
use App\Models\Store\StoreOrderItem;
use App\Models\Store\StoreProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\StripeClient;

class CheckoutController extends Controller
{
    public function show()
    {
        $cart = session()->get('cart', ['items' => []]);

        $variantIds = array_keys($cart['items'] ?? []);
        $variants = \App\Models\Store\StoreProductVariant::with('product')
            ->whereIn('id', $variantIds)
            ->where('is_active', true)
            ->get()
            ->keyBy('id');

        $lines = [];
        $subtotal = 0;

        foreach (($cart['items'] ?? []) as $variantId => $item) {
            if (!isset($variants[$variantId])) continue;

            $variant = $variants[$variantId];
            $qty = (int) $item['qty'];
            $line = $variant->price_cents * $qty;

            $lines[] = compact('variant', 'qty', 'line');
            $subtotal += $line;
        }

        return view('store.checkout', [
            'lines' => $lines,
            'subtotal_cents' => $subtotal,
            'currency' => 'EUR',
        ]);
    }

    public function createOrder(Request $request)
    {
        $data = $request->validate([
            'mc_username' => ['required','string','min:3','max:16'],
            'coupon' => ['nullable','string','max:50'], // optional
        ]);

        $cart = session()->get('cart', ['items' => []]);
        if (empty($cart['items'])) {
            return redirect()->route('cart.show')->withErrors('Your cart is empty.');
        }

        $variantIds = array_keys($cart['items']);
        $variants = StoreProductVariant::with('product')
            ->whereIn('id', $variantIds)
            ->where('is_active', true)
            ->get()
            ->keyBy('id');

        return DB::transaction(function () use ($variants, $cart, $data, $request) {
            $subtotal = 0;

            foreach ($cart['items'] as $variantId => $item) {
                if (!isset($variants[$variantId])) continue;
                $subtotal += $variants[$variantId]->price_cents * (int) $item['qty'];
            }

            // Coupon logic later (keep 0 for now)
            $discount = 0;
            $total = max(0, $subtotal - $discount);

            $order = StoreOrder::create([
                'user_id' => $request->user()->id,
                'mc_username' => $data['mc_username'],
                'status' => 'pending',
                'subtotal_cents' => $subtotal,
                'discount_cents' => $discount,
                'total_cents' => $total,
                'currency' => 'EUR',
            ]);

            foreach ($cart['items'] as $variantId => $item) {
                if (!isset($variants[$variantId])) continue;

                $variant = $variants[$variantId];
                $qty = (int) $item['qty'];
                $line = $variant->price_cents * $qty;

                StoreOrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $variant->product_id,
                    'variant_id' => $variant->id,
                    'name_snapshot' => $variant->product->name . ' - ' . $variant->name,
                    'unit_price_cents' => $variant->price_cents,
                    'qty' => $qty,
                    'line_total_cents' => $line,
                    'meta_snapshot' => $variant->meta,
                ]);
            }

            // Clear cart
            session()->forget('cart');

            // Redirect to order page (from there you can click "Pay")
            return redirect()->route('orders.show', $order)->with('success', 'Order created! Please complete payment.');
        });
    }

    /**
     * Create Stripe Checkout Session and redirect user to Stripe
     */
    public function pay(StoreOrder $order)
    {
        // Only owner can pay
        abort_unless($order->user_id === auth()->id(), 403);

        // Only pending orders can be paid
        abort_unless($order->status === 'pending', 400);

        $order->loadMissing('items');

        // Safety: if somehow empty
        if ($order->items->isEmpty()) {
            return redirect()->route('orders.show', $order)->withErrors('Order has no items.');
        }

        $stripe = new StripeClient(config('services.stripe.secret'));

        $session = $stripe->checkout->sessions->create([
            'mode' => 'payment',
            'payment_method_types' => ['card'],
            'line_items' => $order->items->map(function ($item) use ($order) {
                return [
                    'quantity' => (int) $item->qty,
                    'price_data' => [
                        'currency' => strtolower($order->currency ?? 'eur'),
                        'unit_amount' => (int) $item->unit_price_cents,
                        'product_data' => [
                            'name' => $item->name_snapshot,
                        ],
                    ],
                ];
            })->values()->all(),

            'metadata' => [
                'order_id' => (string) $order->id,
                'user_id' => (string) $order->user_id,
            ],

            // Where Stripe sends the customer after payment/cancel
            'success_url' => url("/orders/{$order->id}?paid=1"),
            'cancel_url' => url("/orders/{$order->id}?canceled=1"),
        ]);

        // Store reference on the order
        $order->update([
            'payment_provider' => 'stripe',
            'payment_reference' => $session->id,
        ]);

        return redirect()->away($session->url);
    }
}
