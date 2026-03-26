<div
    x-cloak
    x-show="cartOpen"
    class="fixed inset-0 z-[70]"
    aria-modal="true"
    role="dialog"
>
    <div class="absolute inset-0 bg-slate-900/35" @click="cartOpen = false"></div>

    <div
        x-show="cartOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="absolute right-0 top-0 h-full w-full max-w-md bg-white thmc-cart-drawer border-l border-slate-200"
    >
        <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200">
            <div>
                <div class="font-bold text-slate-900">Your Cart</div>
                <div class="text-xs text-slate-500">{{ $cartDrawerCount }} item(s)</div>
            </div>

            <button @click="cartOpen = false" class="p-2 rounded-xl hover:bg-slate-100 text-slate-600">
                ✕
            </button>
        </div>

        <div class="p-5 space-y-4 overflow-y-auto h-[calc(100%-170px)]">
            @if(empty($cartDrawerLines))
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-5 text-slate-500">
                    Your cart is empty.
                </div>
            @else
                @foreach($cartDrawerLines as $row)
                    <div class="rounded-2xl border border-slate-200 bg-white p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div class="min-w-0">
                                <div class="font-semibold text-slate-900 truncate">
                                    {{ $row['variant']->product->name }}
                                </div>
                                <div class="text-sm text-slate-500">
                                    {{ $row['variant']->name }}
                                </div>
                                <div class="mt-1 text-xs text-slate-400">
                                    Qty: {{ $row['qty'] }}
                                </div>
                            </div>

                            <div class="text-right">
                                <div class="font-bold text-slate-900">
                                    €{{ number_format($row['line'] / 100, 2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="absolute bottom-0 left-0 right-0 border-t border-slate-200 bg-white p-5">
            <div class="flex items-center justify-between text-sm">
                <span class="text-slate-600">Subtotal</span>
                <span class="font-bold text-slate-900">€{{ number_format($cartDrawerSubtotalCents / 100, 2) }}</span>
            </div>

            <div class="mt-4 grid grid-cols-2 gap-3">
                <a href="{{ route('cart.show') }}"
                   class="inline-flex justify-center px-4 py-3 rounded-2xl border border-slate-200 bg-white hover:bg-slate-50 font-semibold text-slate-800">
                    View cart
                </a>

                <a href="{{ route('checkout.show') }}"
                   class="inline-flex justify-center px-4 py-3 rounded-2xl thmc-btn-primary font-semibold">
                    Checkout
                </a>
            </div>
        </div>
    </div>
</div>
