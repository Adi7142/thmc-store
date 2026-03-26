<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="text-slate-900 text-xl font-bold">Cart</div>
            <div class="text-slate-600 text-sm">Review your items before checkout.</div>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="mb-4 thmc-surface rounded-2xl p-4 border border-emerald-200">
            <div class="text-emerald-700 font-medium">{{ session('success') }}</div>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 thmc-surface rounded-2xl p-4 border border-red-200">
            <div class="text-red-700 font-medium">{{ $errors->first() }}</div>
        </div>
    @endif

    @if(empty($lines))
        <div class="thmc-surface rounded-[2rem] p-8 text-slate-600">
            Your cart is empty.
            <div class="mt-4">
                <a class="text-cyan-700 hover:text-cyan-600 underline" href="{{ route('store.index') }}">Back to store</a>
            </div>
        </div>
    @else
        <div class="grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-4">
                @foreach($lines as $row)
                    <div class="thmc-surface rounded-[2rem] p-5 flex items-center gap-4">
                        <div class="h-14 w-14 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center text-2xl shrink-0">
                            @php
                                $type = strtolower($row['variant']->product->type ?? '');
                                $icon = match($type) {
                                    'coins', 'coin' => '⛏️',
                                    'bundles', 'bundle' => '📦',
                                    'ranks', 'rank' => '⭐',
                                    'keys', 'key' => '🗝',
                                    default => '🧩',
                                };
                            @endphp
                            {{ $icon }}
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="text-slate-900 font-bold truncate">{{ $row['variant']->product->name }}</div>
                            <div class="text-sm text-slate-600">{{ $row['variant']->name }}</div>
                        </div>

                        <div class="text-slate-600 font-medium">x{{ $row['qty'] }}</div>

                        <div class="w-28 text-right text-slate-900 font-semibold">
                            €{{ number_format($row['line']/100, 2) }}
                        </div>

                        <form method="POST" action="{{ route('cart.remove') }}">
                            @csrf
                            <input type="hidden" name="variant_id" value="{{ $row['variant']->id }}">
                            <button class="px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 hover:border-red-300 transition">
                                Remove
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="thmc-surface rounded-[2rem] p-6 h-fit">
                <div class="text-slate-900 text-lg font-bold">Summary</div>

                <div class="mt-4 flex justify-between text-slate-600">
                    <span>Subtotal</span>
                    <span class="text-slate-900 font-semibold">€{{ number_format($subtotal_cents/100, 2) }}</span>
                </div>

                <div class="mt-6 space-y-3">
                    <a href="{{ route('store.index') }}"
                       class="w-full inline-flex justify-center px-5 py-3 rounded-2xl bg-white border border-slate-200 text-slate-800 hover:bg-slate-50 transition font-semibold">
                        Continue shopping
                    </a>
                    <a href="{{ route('checkout.show') }}"
                       class="w-full inline-flex justify-center px-5 py-3 rounded-2xl thmc-btn-primary font-semibold transition">
                        Checkout
                    </a>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
