@if($products->isEmpty())
    <div class="thmc-surface rounded-3xl p-6 text-slate-600">
        No products yet.
    </div>
@else
    <div class="space-y-6">
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

            <div class="thmc-surface rounded-[2rem] p-6">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                    <div class="flex items-start gap-3">
                        <img src="{{ $typeTexture }}" class="w-12 h-12 pixelated" alt="">
                        <div>
                            <div class="text-slate-900 text-2xl font-extrabold">{{ $product->name }}</div>
                            @if($product->description)
                                <div class="mt-1 text-sm text-slate-600">{{ $product->description }}</div>
                            @endif
                        </div>
                    </div>

                    <span class="thmc-badge px-3 py-1 rounded-full text-xs w-fit">
                        {{ $typeLabel }}
                    </span>
                </div>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-4">
                    @forelse($product->variants as $variant)
                        @php
                            $meta = $variant->meta ?? [];
                            $hint = null;
                            $variantNameLower = strtolower($variant->name . ' ' . $product->name);
                            $rarityClass = 'thmc-rarity-default';

                            if (isset($meta['coin_amount'])) {
                                $hint = number_format((int)$meta['coin_amount']) . ' coins';
                            } elseif (isset($meta['rank_code'])) {
                                $hint = strtoupper((string)$meta['rank_code']) . ' rank';
                            } elseif (isset($meta['key_amount'], $meta['crate'])) {
                                $hint = (int)$meta['key_amount'] . ' ' . ucfirst((string)$meta['crate']) . ' keys';
                            } elseif (isset($meta['commands']) && is_array($meta['commands'])) {
                                $hint = count($meta['commands']) . ' rewards';
                            }

                            if (str_contains($variantNameLower, 'mythic')) {
                                $rarityClass = 'thmc-rarity-mythic';
                            } elseif (str_contains($variantNameLower, 'legend')) {
                                $rarityClass = 'thmc-rarity-legend';
                            } elseif (str_contains($variantNameLower, 'elite')) {
                                $rarityClass = 'thmc-rarity-elite';
                            } elseif (str_contains($variantNameLower, 'vip')) {
                                $rarityClass = 'thmc-rarity-vip';
                            }
                        @endphp

                        <div class="rounded-[1.5rem] bg-white/75 border border-slate-200 p-5 thmc-tile-hover thmc-fun-card transition min-w-0 {{ $rarityClass }}">
                            <div class="flex items-start justify-between gap-3">
                                <div class="min-w-0">
                                    <div class="text-slate-900 font-bold text-lg truncate">{{ $variant->name }}</div>

                                    <div class="mt-1 text-xs text-slate-500">
                                        @if($hint)
                                            Includes: <span class="text-slate-800 font-semibold">{{ $hint }}</span>
                                        @else
                                            Instant delivery after payment
                                        @endif
                                    </div>
                                </div>

                                <img src="{{ $typeTexture }}" class="w-10 h-10 pixelated shrink-0" alt="">
                            </div>

                            <div class="mt-5 flex flex-wrap items-center justify-between gap-3">
                                <div class="text-3xl font-extrabold text-emerald-700 leading-none">
                                    €{{ number_format($variant->price_cents / 100, 2) }}
                                </div>

                                <form method="POST" action="{{ route('cart.add') }}" class="flex items-center gap-2 flex-wrap justify-end">
                                    @csrf
                                    <input type="hidden" name="variant_id" value="{{ $variant->id }}">

                                    <input type="number" name="qty" value="1" min="1" max="99"
                                           class="w-20 rounded-xl bg-white border border-slate-200 px-3 py-2 text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-300">

                                    <button class="px-5 py-2 rounded-xl thmc-btn-primary thmc-btn-blocky font-semibold transition whitespace-nowrap">
                                        Add
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="text-sm text-slate-500">No variants for this product.</div>
                    @endforelse
                </div>
            </div>
        @endforeach
    </div>
@endif
