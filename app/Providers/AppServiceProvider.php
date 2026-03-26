<?php

namespace App\Providers;

use App\Models\Store\StoreProductVariant;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $cart = session()->get('cart', ['items' => []]);

            $variantIds = array_keys($cart['items'] ?? []);
            $variants = collect();

            if (! empty($variantIds)) {
                $variants = StoreProductVariant::with('product')
                    ->whereIn('id', $variantIds)
                    ->where('is_active', true)
                    ->get()
                    ->keyBy('id');
            }

            $lines = [];
            $subtotal = 0;
            $count = 0;

            foreach (($cart['items'] ?? []) as $variantId => $item) {
                if (! isset($variants[$variantId])) {
                    continue;
                }

                $variant = $variants[$variantId];
                $qty = (int) ($item['qty'] ?? 1);
                $line = $variant->price_cents * $qty;

                $lines[] = [
                    'variant' => $variant,
                    'qty' => $qty,
                    'line' => $line,
                ];

                $subtotal += $line;
                $count += $qty;
            }

            $view->with('cartDrawerLines', $lines);
            $view->with('cartDrawerSubtotalCents', $subtotal);
            $view->with('cartDrawerCount', $count);
        });
    }
}
