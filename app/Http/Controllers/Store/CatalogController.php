<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Store\StoreProduct;

class CatalogController extends Controller
{
    public function index()
    {
        $latestOrders = \App\Models\Store\StoreOrder::query()
            ->whereIn('status', ['paid', 'fulfilled'])
            ->with(['items' => function ($query) {
                $query->latest()->limit(1);
            }])
            ->latest('paid_at')
            ->take(8)
            ->get();

        return view('store.index', compact('latestOrders'));
    }

    private function listByType(string $type)
    {
        $products = StoreProduct::query()
            ->where('is_active', true)
            ->where(function ($q) use ($type) {
                $q->where('type', $type)->orWhereHas('category', fn($c) => $c->where('slug', $type));
            })
            ->with(['variants' => fn($v) => $v->where('is_active', true)->orderBy('price_cents')])
            ->orderBy('sort_order')
            ->get();

        return view("store.$type", compact('products'));
    }

    public function coins() { return $this->listByType('coins'); }
    public function bundles() { return $this->listByType('bundles'); }
    public function ranks() { return $this->listByType('ranks'); }
    public function keys() { return $this->listByType('keys'); }
}
