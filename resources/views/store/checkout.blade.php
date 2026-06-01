<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2">
            <div class="mc-title-small">CHECKOUT</div>
            <div class="text-2xl font-extrabold text-white">Enter delivery details</div>
            <div class="text-sm text-white/72">We'll deliver the purchase to your Minecraft username instantly.</div>
        </div>
    </x-slot>

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
        <!-- Urgency Countdown -->
        <div class="mb-6 mc-menu-card border-t-4 border-t-red-400 mc-floating">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="text-2xl">⏱️</span>
                    <div>
                        <div class="font-bold text-white">Complete checkout now</div>
                        <div class="text-sm text-white/80">Your cart will be saved for 15 minutes</div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-xl font-extrabold text-red-400">15:00</div>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 mc-section p-6">
                <div class="text-xl font-bold text-white">Delivery details</div>
                <div class="mt-1 text-sm text-white/72">Make sure the username is correct. Delivery is instant after payment.</div>

                <form method="POST" action="{{ route('checkout.create') }}" class="mt-6 space-y-4">
                    @csrf

                    <div>
                        <label class="mc-label">Minecraft username</label>
                        <input name="mc_username" required minlength="3" maxlength="16"
                               class="mc-input"
                               placeholder="YourMinecraftName"
                               value="{{ old('mc_username') }}">
                        <div class="mt-2 text-xs text-white/60">
                            ✓ Your purchase will be delivered to this player in-game within seconds.
                        </div>
                    </div>

                    <div>
                        <label class="mc-label">Coupon (optional)</label>
                        <input name="coupon"
                               class="mc-input"
                               placeholder="ENTER CODE"
                               value="{{ old('coupon') }}">
                        <div class="mt-2 text-xs text-white/60">
                            Have a coupon code? Enter it here for instant savings.
                        </div>
                    </div>

                    <!-- Security & Trust Badges -->
                    <div class="p-3 bg-white/5 border border-white/10 rounded mt-6">
                        <div class="text-xs text-white/70 font-bold mb-2">SAFE & SECURE</div>
                        <div class="flex flex-wrap gap-2">
                            <span class="text-xs bg-green-500/20 text-green-300 px-2 py-1 border border-green-500/30">🔒 Encrypted</span>
                            <span class="text-xs bg-blue-500/20 text-blue-300 px-2 py-1 border border-blue-500/30">✓ Verified</span>
                            <span class="text-xs bg-purple-500/20 text-purple-300 px-2 py-1 border border-purple-500/30">⚡ Instant</span>
                        </div>
                    </div>

                    <button class="w-full sm:w-auto mc-btn mc-btn-primary text-lg font-bold">
                        💳 Complete Payment →
                    </button>
                </form>
            </div>

            <div class="mc-section p-6 h-fit sticky top-24">
                <div class="text-xl font-bold text-white">Order Summary</div>

                <div class="mt-4 space-y-3 max-h-96 overflow-y-auto">
                    @foreach($lines as $row)
                        @php
                            $variantNameLower = strtolower($row['variant']->name . ' ' . $row['variant']->product->name);
                            $rarity = 'ITEM';
                            $rarityColor = 'text-white';
                            $rarityBgColor = 'bg-white/5';

                            if (str_contains($variantNameLower, 'mythic')) {
                                $rarity = '✨ MYTHIC';
                                $rarityColor = 'text-yellow-300';
                                $rarityBgColor = 'bg-yellow-500/10';
                            } elseif (str_contains($variantNameLower, 'legend')) {
                                $rarity = '⭐ LEGEND';
                                $rarityColor = 'text-purple-300';
                                $rarityBgColor = 'bg-purple-500/10';
                            } elseif (str_contains($variantNameLower, 'elite')) {
                                $rarity = '💎 ELITE';
                                $rarityColor = 'text-cyan-300';
                                $rarityBgColor = 'bg-cyan-500/10';
                            } elseif (str_contains($variantNameLower, 'vip')) {
                                $rarity = '👑 VIP';
                                $rarityColor = 'text-emerald-300';
                                $rarityBgColor = 'bg-emerald-500/10';
                            }
                        @endphp

                        <div class="{{ $rarityBgColor }} p-3 border border-white/10 rounded">
                            <div class="flex justify-between items-start gap-2 mb-2">
                                <div class="text-sm font-bold text-white truncate">
                                    {{ $row['variant']->product->name }}
                                </div>
                                <span class="text-xs {{ $rarityColor }} font-bold shrink-0">{{ $rarity }}</span>
                            </div>
                            <div class="text-xs text-white/70 mb-2">{{ $row['variant']->name }} (x{{ $row['qty'] }})</div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-white/60">Subtotal:</span>
                                <span class="font-bold text-white">€{{ number_format($row['line']/100, 2) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 border-t border-white/10 pt-4">
                    <div class="flex justify-between text-white/75 mb-3">
                        <span>Total</span>
                        <span class="font-extrabold text-white text-lg">€{{ number_format($subtotal_cents/100, 2) }}</span>
                    </div>

                    <!-- Limited Offer Badge -->
                    <div class="p-2 bg-green-500/10 border border-green-500/30 rounded text-center">
                        <div class="text-xs text-green-300 font-bold">🎁 +15% BONUS COINS</div>
                        <div class="text-xs text-white/70">with this order!</div>
                    </div>
                </div>

                <!-- Social Proof -->
                <div class="mt-4 text-center">
                    <div class="text-xs text-white/60">
                        <div class="mb-2">⏱️ <span class="text-white/80">Delivered in seconds</span></div>
                        <div>👥 <span class="text-white/80">50,000+ happy players</span></div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
