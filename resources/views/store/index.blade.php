<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/thmc-logo-128.webp') }}" class="h-10 w-10 rounded-xl shadow-sm" alt="THMC">
                <div>
                    <div class="text-slate-900 text-2xl font-bold tracking-tight">THMC Store</div>
                    <div class="text-slate-600 text-sm">Support the server and unlock rewards.</div>
                </div>
            </div>

            <button
                type="button"
                @click="$dispatch('open-cart')"
                class="w-fit px-4 py-2 rounded-2xl bg-white border border-slate-200 text-slate-800 hover:bg-slate-50 transition font-semibold text-sm"
            >
                View cart
            </button>
        </div>
    </x-slot>

    {{-- HERO --}}
    <section class="relative overflow-hidden rounded-[2rem] thmc-surface thmc-noise thmc-glow-hover">
        <div class="absolute inset-0">
            <img src="{{ asset('images/thmc-hero-1920.webp') }}" class="h-full w-full object-cover opacity-20" alt="">
            <div class="absolute inset-0 thmc-hero-overlay"></div>
            <div class="absolute inset-0 thmc-grid-pattern opacity-35"></div>
        </div>

        <div class="thmc-particles">
            <span></span><span></span><span></span><span></span><span></span><span></span>
        </div>

        <div class="relative px-8 py-10 lg:px-12 lg:py-14 grid lg:grid-cols-2 gap-10 items-center">
            <div>
                <div class="thmc-mc-title text-xs sm:text-sm text-emerald-700">
                    THMC STORE
                </div>

                <div class="mt-3 inline-flex items-center gap-2 rounded-full bg-white/75 border border-slate-200 px-4 py-2 text-xs text-slate-700">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    Adventure starts here
                </div>

                <h1 class="mt-6 text-4xl lg:text-6xl font-extrabold tracking-tight leading-tight">
                    Level up your
                    <span class="thmc-title-gradient">THMC adventure</span>
                </h1>

                <p class="mt-4 max-w-xl text-slate-600 text-lg">
                    Coins, bundles, ranks and crate keys — all in one place, delivered instantly after purchase.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('store.coins') }}"
                       class="px-6 py-3 rounded-2xl thmc-btn-primary thmc-btn-blocky font-semibold transition">
                        Buy Coins
                    </a>

                    <a href="{{ route('store.ranks') }}"
                       class="px-6 py-3 rounded-2xl bg-white border border-slate-200 text-slate-800 hover:bg-slate-50 transition font-semibold">
                        View Ranks
                    </a>

                    <a href="{{ route('store.bundles') }}"
                       class="px-6 py-3 rounded-2xl bg-white border border-slate-200 text-slate-800 hover:bg-slate-50 transition font-semibold">
                        View Bundles
                    </a>
                </div>

                <div class="mt-8 grid grid-cols-1 sm:grid-cols-3 gap-3 max-w-2xl">
                    <div class="rounded-2xl bg-white/75 border border-slate-200 p-4 thmc-fun-card">
                        <div class="text-xs text-slate-500">Delivery</div>
                        <div class="mt-1 font-bold text-slate-900">Instant</div>
                    </div>

                    <div class="rounded-2xl bg-white/75 border border-slate-200 p-4 thmc-fun-card"
                         x-data="{ value: 0, target: 10000 }"
                         x-init="let i = setInterval(() => { value += Math.ceil(target / 40); if (value >= target) { value = target; clearInterval(i); } }, 25)">
                        <div class="text-xs text-slate-500">Top coin pack</div>
                        <div class="mt-1 font-bold text-slate-900">
                            <span x-text="value.toLocaleString()"></span>+
                        </div>
                    </div>

                    <div class="rounded-2xl bg-white/75 border border-slate-200 p-4 thmc-fun-card">
                        <div class="text-xs text-slate-500">Payments</div>
                        <div class="mt-1 font-bold text-slate-900">Stripe</div>
                    </div>
                </div>
            </div>

            <div class="rounded-[2rem] thmc-surface-soft p-7 thmc-fun-card thmc-glow-hover">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/items/nether_star.gif') }}" class="w-12 h-12 pixelated" alt="">
                    <div>
                        <div class="text-xs uppercase tracking-wider text-slate-500">Featured</div>
                        <div class="text-3xl font-extrabold text-slate-900">Starter Bundle</div>
                    </div>
                </div>

                <div class="mt-2 text-slate-600">
                    A perfect bundle to start your THMC journey.
                </div>

                <div class="mt-4 thmc-pixel-divider"></div>

                <div class="mt-6 grid grid-cols-2 gap-3 text-sm">
                    <div class="rounded-2xl bg-white/80 border border-slate-200 p-4">
                        <div class="text-xs text-slate-500">Contains</div>
                        <div class="font-semibold text-slate-900">Coins</div>
                    </div>
                    <div class="rounded-2xl bg-white/80 border border-slate-200 p-4">
                        <div class="text-xs text-slate-500">Contains</div>
                        <div class="font-semibold text-slate-900">Keys</div>
                    </div>
                    <div class="rounded-2xl bg-white/80 border border-slate-200 p-4">
                        <div class="text-xs text-slate-500">Contains</div>
                        <div class="font-semibold text-slate-900">Perks</div>
                    </div>
                    <div class="rounded-2xl bg-white/80 border border-slate-200 p-4">
                        <div class="text-xs text-slate-500">Contains</div>
                        <div class="font-semibold text-slate-900">Rewards</div>
                    </div>
                </div>

                <a href="{{ route('store.bundles') }}"
                   class="mt-6 block text-center px-6 py-3 rounded-2xl thmc-btn-warm thmc-btn-blocky font-semibold transition">
                    Explore Bundles
                </a>
            </div>
        </div>
    </section>

    {{-- CATEGORY TILES --}}
    <section class="mt-10">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">Shop Categories</h2>
            <p class="text-slate-600 text-sm mt-1">Choose what you want to upgrade first.</p>
        </div>

        <div class="mt-5 grid sm:grid-cols-2 xl:grid-cols-4 gap-4">
            <a href="{{ route('store.coins') }}" class="thmc-surface rounded-[1.75rem] p-6 thmc-tile-hover transition thmc-fun-card">
                <img src="{{ asset('images/items/emerald.png') }}" class="w-12 h-12 pixelated" alt="">
                <div class="mt-4 text-slate-900 font-bold text-xl">Coins</div>
                <div class="mt-1 text-slate-600 text-sm">Buy in-game currency and spend it on upgrades.</div>
            </a>

            <a href="{{ route('store.bundles') }}" class="thmc-surface rounded-[1.75rem] p-6 thmc-tile-hover transition thmc-fun-card">
                <img src="{{ asset('images/items/chest.png') }}" class="w-12 h-12 pixelated" alt="">
                <div class="mt-4 text-slate-900 font-bold text-xl">Bundles</div>
                <div class="mt-1 text-slate-600 text-sm">Best-value packs with multiple rewards included.</div>
            </a>

            <a href="{{ route('store.ranks') }}" class="thmc-surface rounded-[1.75rem] p-6 thmc-tile-hover transition thmc-fun-card">
                <img src="{{ asset('images/items/diamond.png') }}" class="w-12 h-12 pixelated" alt="">
                <div class="mt-4 text-slate-900 font-bold text-xl">Ranks</div>
                <div class="mt-1 text-slate-600 text-sm">Unlock exclusive perks, tags and status benefits.</div>
            </a>

            <a href="{{ route('store.keys') }}" class="thmc-surface rounded-[1.75rem] p-6 thmc-tile-hover transition thmc-fun-card">
                <img src="{{ asset('images/items/tripwire_hook.png') }}" class="w-12 h-12 pixelated" alt="">
                <div class="mt-4 text-slate-900 font-bold text-xl">Crate Keys</div>
                <div class="mt-1 text-slate-600 text-sm">Open crates and claim rare rewards.</div>
            </a>
        </div>
    </section>

    {{-- LATEST PURCHASES --}}
    <section class="mt-10 grid xl:grid-cols-3 gap-6">
        <div class="xl:col-span-2 thmc-surface rounded-[2rem] p-6">
            <div>
                <div class="thmc-mc-title text-xs text-emerald-700">LATEST PURCHASES</div>
                <h2 class="mt-3 text-2xl font-bold text-slate-900">Recent players supporting THMC</h2>
                <p class="text-slate-600 text-sm mt-1">Live purchase feed for the server store.</p>
            </div>

            <div class="mt-6">
                @if(isset($latestOrders) && $latestOrders->count())
                    <div class="grid md:grid-cols-2 gap-4">
                        @foreach($latestOrders as $order)
                            <div class="thmc-feed-item rounded-2xl bg-white/75 border border-slate-200 p-4">
                                <div class="flex items-start gap-3">
                                    <img
                                        src="https://mc-heads.net/avatar/{{ urlencode($order->mc_username) }}/48"
                                        alt="{{ $order->mc_username }}"
                                        class="h-12 w-12 rounded-xl border border-slate-200 bg-slate-100"
                                    >

                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center justify-between gap-3">
                                            <div class="font-semibold text-slate-900 truncate">{{ $order->mc_username }}</div>
                                            <span class="thmc-badge px-3 py-1 rounded-full text-xs">
                                                {{ strtoupper($order->status) }}
                                            </span>
                                        </div>

                                        <div class="mt-1 text-sm text-slate-700">
                                            @if($order->items->count())
                                                Bought
                                                <span class="font-semibold text-slate-900">
                                                    {{ $order->items->first()->name_snapshot }}
                                                </span>
                                            @else
                                                Completed a purchase
                                            @endif
                                        </div>

                                        <div class="mt-2 text-xs text-slate-500">
                                            €{{ number_format($order->total_cents / 100, 2) }}
                                            @if($order->paid_at)
                                                • {{ $order->paid_at->diffForHumans() }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="rounded-2xl bg-white/75 border border-slate-200 p-6 text-slate-500">
                        No recent purchases yet.
                    </div>
                @endif
            </div>
        </div>

        <div class="thmc-surface rounded-[2rem] p-6 thmc-glow-hover">
            <div class="text-xs uppercase tracking-wider text-slate-500">Why support THMC?</div>
            <div class="mt-2 text-2xl font-extrabold text-slate-900">Keep the server growing</div>
            <p class="mt-3 text-slate-600 text-sm leading-6">
                Purchases help support hosting, development, events and new content for the THMC server.
            </p>

            <div class="mt-6 space-y-3">
                <div class="rounded-2xl bg-white/75 border border-slate-200 p-4">
                    <div class="text-slate-900 font-semibold">⚡ Instant delivery</div>
                    <div class="text-xs text-slate-500 mt-1">Orders are processed automatically after payment.</div>
                </div>

                <div class="rounded-2xl bg-white/75 border border-slate-200 p-4">
                    <div class="text-slate-900 font-semibold">🔒 Safe checkout</div>
                    <div class="text-xs text-slate-500 mt-1">Payments are secured through Stripe.</div>
                </div>

                <div class="rounded-2xl bg-white/75 border border-slate-200 p-4">
                    <div class="text-slate-900 font-semibold">🎮 In-game rewards</div>
                    <div class="text-xs text-slate-500 mt-1">Buy coins, ranks, bundles and crate keys.</div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
