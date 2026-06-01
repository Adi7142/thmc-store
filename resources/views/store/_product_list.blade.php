@if($products->isEmpty())
    <div class="mc-section p-6 text-white/80">
        No products yet.
    </div>
@else
    <div class="space-y-8">
        @foreach($products as $product)
            @php
                $type = strtolower((string) $product->type);

                $typeLabel = match($type) {
                    'coin', 'coins' => 'COINS',
                    'bundle', 'bundles' => 'BUNDLE',
                    'rank', 'ranks' => 'RANK',
                    'key', 'keys' => 'KEYS',
                    default => strtoupper($type),
                };

                $typeTexture = match($typeLabel) {
                    'COINS' => asset('images/items/emerald.png'),
                    'BUNDLE' => asset('images/items/chest.png'),
                    'RANK' => asset('images/items/diamond.png'),
                    'KEYS' => asset('images/items/tripwire_hook.png'),
                    default => asset('images/items/nether_star.png'),
                };
            @endphp

            <section class="mc-section p-5 sm:p-6">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                    <div class="flex items-start gap-4">
                        <img src="{{ $typeTexture }}" class="mc-slot-icon pixelated" alt="">
                        <div>
                            <div class="mc-title-small">{{ $typeLabel }}</div>
                            <h2 class="mt-2 text-2xl sm:text-3xl font-extrabold text-white">{{ $product->name }}</h2>

                            @if($product->description)
                                <p class="mt-2 text-sm sm:text-base text-white/78 max-w-3xl leading-6">
                                    {{ $product->description }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <span class="mc-badge">{{ $typeLabel }}</span>
                </div>

                <div class="mt-6 mc-card-grid mc-card-grid-3">
                    @forelse($product->variants as $variant)
                        @php
                            $meta = $variant->meta ?? [];
                            $hint = null;
                            $variantNameLower = strtolower($variant->name . ' ' . $product->name);

                            // Rarity Detection
                            $rarity = 'ITEM';
                            $rarityIcon = '🧩';
                            $rarityClass = 'mc-badge';
                            $cardBorder = 'border-white/20';
                            $cardBgGlow = '';

                            if (str_contains($variantNameLower, 'mythic')) {
                                $rarity = 'MYTHIC';
                                $rarityIcon = '✨';
                                $rarityClass = 'mc-badge mc-badge-warning';
                                $cardBorder = 'border-yellow-400/50';
                                $cardBgGlow = 'ring-2 ring-yellow-400/30 mc-glow';
                            } elseif (str_contains($variantNameLower, 'legend')) {
                                $rarity = 'LEGEND';
                                $rarityIcon = '⭐';
                                $rarityClass = 'mc-badge';
                                $cardBorder = 'border-purple-400/40';
                                $cardBgGlow = 'ring-2 ring-purple-400/20';
                            } elseif (str_contains($variantNameLower, 'elite')) {
                                $rarity = 'ELITE';
                                $rarityIcon = '💎';
                                $rarityClass = 'mc-badge mc-badge-info';
                                $cardBorder = 'border-cyan-400/40';
                                $cardBgGlow = 'ring-2 ring-cyan-400/20';
                            } elseif (str_contains($variantNameLower, 'vip')) {
                                $rarity = 'VIP';
                                $rarityIcon = '👑';
                                $rarityClass = 'mc-badge mc-badge-success';
                                $cardBorder = 'border-emerald-400/40';
                                $cardBgGlow = 'ring-2 ring-emerald-400/20';
                            }

                            // Hint Text
                            if (isset($meta['coin_amount'])) {
                                $hint = number_format((int)$meta['coin_amount']) . ' coins';
                            } elseif (isset($meta['rank_code'])) {
                                $hint = strtoupper((string)$meta['rank_code']) . ' rank';
                            } elseif (isset($meta['key_amount'], $meta['crate'])) {
                                $hint = (int)$meta['key_amount'] . ' ' . ucfirst((string)$meta['crate']) . ' keys';
                            } elseif (isset($meta['commands']) && is_array($meta['commands'])) {
                                $hint = count($meta['commands']) . ' rewards';
                            }
                        @endphp

                        <div class="mc-slot h-full items-start border {{ $cardBorder }} {{ $cardBgGlow }}">
                            <img src="{{ $typeTexture }}" class="mc-slot-icon pixelated shrink-0" alt="">

                            <div class="mc-slot-body">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <div class="mc-slot-title truncate">{{ $variant->name }}</div>
                                        <div class="mc-slot-subtitle">
                                            @if($hint)
                                                Includes <span class="font-bold text-white">{{ $hint }}</span>
                                            @else
                                                Instant delivery after payment
                                            @endif
                                        </div>
                                    </div>

                                    <span class="{{ $rarityClass }} shrink-0 flex items-center gap-1">
                                        {{ $rarityIcon }} {{ $rarity }}
                                    </span>
                                </div>

                                <!-- Rarity Benefits (if premium tier) -->
                                @if(in_array($rarity, ['MYTHIC', 'LEGEND', 'ELITE', 'VIP']))
                                    <div class="mt-3 p-2 bg-white/5 border border-white/10 rounded text-xs">
                                        @if($rarity === 'MYTHIC')
                                            <div class="text-yellow-300 font-bold">🌟 Mythic Perks:</div>
                                            <div class="text-white/70 mt-1">• Exclusive cosmetics • Double rewards • Priority support</div>
                                        @elseif($rarity === 'LEGEND')
                                            <div class="text-purple-300 font-bold">⭐ Legend Perks:</div>
                                            <div class="text-white/70 mt-1">• Special badge • 1.5x rewards • VIP chat</div>
                                        @elseif($rarity === 'ELITE')
                                            <div class="text-cyan-300 font-bold">💎 Elite Perks:</div>
                                            <div class="text-white/70 mt-1">• Unique prefix • 1.2x rewards • Custom color</div>
                                        @elseif($rarity === 'VIP')
                                            <div class="text-emerald-300 font-bold">👑 VIP Perks:</div>
                                            <div class="text-white/70 mt-1">• VIP tag • Extra slots • Priority queue</div>
                                        @endif
                                    </div>
                                @endif

                                <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                    <div class="mc-slot-price">
                                        €{{ number_format($variant->price_cents / 100, 2) }}
                                    </div>

                                    <form method="POST" action="{{ route('cart.add') }}" class="flex items-center gap-2 flex-wrap">
                                        @csrf
                                        <input type="hidden" name="variant_id" value="{{ $variant->id }}">

                                        <input
                                            type="number"
                                            name="qty"
                                            value="1"
                                            min="1"
                                            max="99"
                                            class="mc-input w-20 px-3 py-2"
                                        >

                                        <button class="mc-btn mc-btn-primary" type="submit">
                                            Add
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="mc-menu-card text-white/75">
                            No variants for this product.
                        </div>
                    @endforelse
                </div>
            </section>
        @endforeach
    </div>
@endif
