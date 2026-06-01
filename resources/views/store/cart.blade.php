<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <div class="mc-title-small">CART</div>
            <div class="text-2xl font-extrabold text-white">Review your items</div>
            <div class="text-sm text-white/72">Make sure everything looks right before checkout.</div>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="mb-4 mc-menu-card">
            <div class="text-emerald-300 font-medium">{{ session('success') }}</div>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 mc-menu-card">
            <div class="text-red-300 font-medium">{{ $errors->first() }}</div>
        </div>
    @endif

    @if(empty($lines))
        <div class="mc-section p-8 text-white/76">
            <div class="text-xl font-bold text-white">Your cart is empty</div>
            <div class="mt-3">
                <a class="mc-link" href="{{ route('store.index') }}">← Back to store</a>
            </div>
        </div>
    @else
        <!-- Urgency Message -->
        <div class="mb-6 mc-menu-card border-l-4 border-l-yellow-400 mc-pulse">
            <div class="flex items-center gap-3">
                <span class="text-2xl">⚡</span>
                <div>
                    <div class="font-bold text-yellow-300">INSTANT DELIVERY</div>
                    <div class="text-sm text-white/80">Your items will be delivered within seconds after checkout!</div>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-4">
                @foreach($lines as $row)
                    <div class="mc-slot items-center">
                        <div class="h-14 w-14 rounded-xl bg-white/8 border border-white/10 flex items-center justify-center text-2xl shrink-0">
                            @php
                                $type = strtolower($row['variant']->product->type ?? '');
                                $icon = match($type) {
                                    'coins', 'coin' => '⛏️',
                                    'bundles', 'bundle' => '📦',
                                    'ranks', 'rank' => '⭐',
                                    'keys', 'key' => '🗝️',
                                    default => '🧩',
                                };
                            @endphp
                            {{ $icon }}
                        </div>

                        <div class="flex-1 min-w-0">
                            <div class="font-bold text-white truncate">{{ $row['variant']->product->name }}</div>
                            <div class="text-sm text-white/72">{{ $row['variant']->name }}</div>
                        </div>

                        <div class="text-white/75 font-medium">x{{ $row['qty'] }}</div>

                        <div class="w-28 text-right font-semibold text-white">
                            €{{ number_format($row['line']/100, 2) }}
                        </div>

                        <form method="POST" action="{{ route('cart.remove') }}">
                            @csrf
                            <input type="hidden" name="variant_id" value="{{ $row['variant']->id }}">
                            <button class="mc-btn mc-btn-secondary" type="submit">Remove</button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="mc-section p-6 h-fit sticky top-24">
                <div class="text-xl font-bold text-white">Summary</div>

                <div class="mt-4 flex justify-between text-white/75">
                    <span>Subtotal</span>
                    <span class="font-semibold text-white">€{{ number_format($subtotal_cents/100, 2) }}</span>
                </div>

                <!-- Bonus Info -->
                <div class="mt-4 p-3 bg-green-500/10 border border-green-500/30 rounded">
                    <div class="text-xs text-green-300 font-bold">✓ GET 15% BONUS COINS</div>
                    <div class="text-xs text-white/70 mt-1">with any purchase this week</div>
                </div>

                <div class="mt-6 space-y-3">
                    <a href="{{ route('store.index') }}"
                       class="w-full inline-flex justify-center mc-btn mc-btn-secondary">
                        ← Continue shopping
                    </a>
                    <a href="{{ route('checkout.show') }}"
                       class="w-full inline-flex justify-center mc-btn mc-btn-primary mc-floating">
                        Proceed to Checkout →
                    </a>
                </div>

                <!-- Trust Signal -->
                <div class="mt-4 text-center text-xs text-white/60">
                    🔒 Secure checkout  •  ✓ Instant delivery
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
