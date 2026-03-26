<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Store\StoreOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = StoreOrder::query()
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(15);

        return view('store.orders.index', compact('orders'));
    }

    public function show(Request $request, StoreOrder $order)
    {
        abort_unless($order->user_id === $request->user()->id, 403);

        $order->load('items.variant.product');

        return view('store.orders.show', compact('order'));
    }
}
