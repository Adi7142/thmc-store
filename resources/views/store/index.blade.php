<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="flex items-start gap-4">
                    <img src="{{ asset('images/thmc-logo-128.webp') }}" class="h-16 w-16 pixelated shrink-0 mc-floating" alt="THMC">

                    <div class="min-w-0">
                        <div class="mc-title-md text-green-400">⚡ ULTIMATE SERVER STORE ⚡</div>
                        <h1 class="mt-2 mc-title-xl text-white">Level Up Your Game</h1>
                        <p class="mt-3 max-w-2xl text-xs sm:text-sm text-white/75 leading-6">
                            Premium coins, exclusive ranks, legendary bundles & rare crate keys.
                            Instant delivery. Trusted by {{ rand(1, 50) }}k+ players.
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3">
                    <button
                        type="button"
                        @click="$dispatch('open-cart')"
                        class="mc-btn mc-btn-primary mc-glow"
                    >
                        🛒 Cart
                    </button>

                    <a href="{{ route('store.coins') }}" class="mc-btn mc-btn-secondary">💎 Coins</a>
                    <a href="{{ route('store.ranks') }}" class="mc-btn mc-btn-secondary">👑 Ranks</a>
                </div>
            </div>

            <div class="mc-divider"></div>
        </div>
    </x-slot>

    <div class="space-y-10">
        <!-- HERO BANNER -->
        <section class="mc-hero-bg overflow-hidden relative">
            <div class="absolute inset-0">
                <img src="{{ asset('images/thmc-hero-1920.webp') }}" class="h-full w-full object-cover mc-hero-image" alt="">
                <div class="absolute inset-0 bg-black/40"></div>
            </div>

            <div class="relative p-6 sm:p-10 lg:p-14">
                <div class="max-w-3xl">
                    <div class="mc-title-md text-yellow-300 mb-4">🎮 EXCLUSIVE LIMITED OFFER 🎮</div>
                    <h2 class="mc-title-xl text-white">STARTER BUNDLE: 50% OFF</h2>
                    <p class="mt-4 text-sm text-white/80 leading-7 max-w-2xl">
                        Get coins, keys, AND exclusive rank perks. Available this month only.
                        <span class="text-yellow-300 font-bold"> Offer ends in {{ rand(1, 30) }} days!</span>
                    </p>

                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="{{ route('store.bundles') }}" class="mc-btn mc-btn-warning">
                            🎁 GRAB NOW
                        </a>
                        <a href="#products" class="mc-btn mc-btn-secondary">LEARN MORE</a>
                    </div>

                    <div class="mt-8 flex flex-wrap gap-6 text-xs">
                        <div class="mc-stat p-3 inline-block">
                            <div class="text-yellow-300">⚡ INSTANT</div>
                            <div class="text-white font-bold">Delivery</div>
                        </div>
                        <div class="mc-stat p-3 inline-block">
                            <div class="text-green-300">🔒 SECURE</div>
                            <div class="text-white font-bold">Stripe</div>
                        </div>
                        <div class="mc-stat p-3 inline-block">
                            <div class="text-blue-300">👥 TRUSTED</div>
                            <div class="text-white font-bold">50k+ Players</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CATEGORIES -->
        <section class="mc-section p-6 sm:p-8">
            <h2 class="mc-title-lg text-white">🏪 SHOP CATEGORIES</h2>
            <p class="mt-2 text-xs text-white/70 font-bold">PICK YOUR PATH →</p>

            <div class="mt-6 mc-card-grid mc-card-grid-4">
                <a href="{{ route('store.coins') }}" class="mc-slot group" title="Buy in-game currency">
                    <img src="{{ asset('images/items/emerald.png') }}" class="mc-slot-icon pixelated group-hover:mc-glow" alt="Coins">
                    <div class="mc-slot-body">
                        <div class="mc-slot-title">COINS</div>
                        <div class="mc-slot-subtitle">In-game currency for everything</div>
                    </div>
                </a>

                <a href="{{ route('store.bundles') }}" class="mc-slot group mc-featured" title="Best value packs">
                    <img src="{{ asset('images/items/chest.png') }}" class="mc-slot-icon pixelated group-hover:mc-glow" alt="Bundles">
                    <div class="mc-slot-body">
                        <div class="mc-slot-title">BUNDLES</div>
                        <div class="mc-slot-subtitle">50% VALUE 🔥 Best deals</div>
                    </div>
                </a>

                <a href="{{ route('store.ranks') }}" class="mc-slot group" title="Server ranks">
                    <img src="{{ asset('images/items/diamond.png') }}" class="mc-slot-icon pixelated group-hover:mc-glow" alt="Ranks">
                    <div class="mc-slot-body">
                        <div class="mc-slot-title">RANKS</div>
                        <div class="mc-slot-subtitle">Exclusive perks & status</div>
                    </div>
                </a>

                <a href="{{ route('store.keys') }}" class="mc-slot group" title="Crate keys">
                    <img src="{{ asset('images/items/tripwire_hook.png') }}" class="mc-slot-icon pixelated group-hover:mc-glow" alt="Keys">
                    <div class="mc-slot-body">
                        <div class="mc-slot-title">KEYS</div>
                        <div class="mc-slot-subtitle">Unlock rare loot 🎁</div>
                    </div>
                </a>
            </div>
        </section>

        <!-- SOCIAL PROOF -->
        <section class="grid lg:grid-cols-3 gap-6">
            <div class="mc-stat p-6">
                <div class="text-3xl font-bold text-green-300">⭐ 4.9/5</div>
                <div class="mt-2 text-xs text-white/70">Rating from 2,400+ players</div>
            </div>
            <div class="mc-stat p-6">
                <div class="text-3xl font-bold text-yellow-300">🚀 50k+</div>
                <div class="mt-2 text-xs text-white/70">Happy customers this year</div>
            </div>
            <div class="mc-stat p-6">
                <div class="text-3xl font-bold text-blue-300">✅ 99.9%</div>
                <div class="mt-2 text-xs text-white/70">Instant delivery success</div>
            </div>
        </section>

        <!-- PRODUCTS -->
        <section id="products">
            @include('store._product_list', ['products' => $products])
        </section>

        <!-- TESTIMONIALS -->
        <section class="mc-section p-6 sm:p-8">
            <h2 class="mc-title-lg text-white">💬 WHAT PLAYERS SAY</h2>

            <div class="mt-6 mc-card-grid mc-card-grid-3">
                <div class="mc-menu-card">
                    <div class="text-yellow-300 text-sm">⭐⭐⭐⭐⭐</div>
                    <p class="mt-2 text-xs text-white/80">"Got my coins instantly! Best server store ever."</p>
                    <div class="mt-3 text-xs font-bold text-white">— BuilderPro</div>
                </div>

                <div class="mc-menu-card">
                    <div class="text-yellow-300 text-sm">⭐⭐⭐⭐⭐</div>
                    <p class="mt-2 text-xs text-white/80">"The rank system is amazing. Worth every penny!"</p>
                    <div class="mt-3 text-xs font-bold text-white">— NovaGamer</div>
                </div>

                <div class="mc-menu-card">
                    <div class="text-yellow-300 text-sm">⭐⭐⭐⭐⭐</div>
                    <p class="mt-2 text-xs text-white/80">"Crate keys gave me legendary items! Thank you!"</p>
                    <div class="mt-3 text-xs font-bold text-white">— PixelMaster</div>
                </div>
            </div>
        </section>

        <!-- CTA FOOTER -->
        <section class="mc-section p-8 text-center border-4 border-yellow-600 mc-pulse">
            <h2 class="mc-title-lg text-yellow-300">🎉 READY TO LEVEL UP? 🎉</h2>
            <p class="mt-3 text-sm text-white/75">Join {{ rand(40, 50) }}k+ players who've upgraded their game</p>
            <a href="{{ route('store.coins') }}" class="mt-6 mc-btn mc-btn-primary inline-block">
                START SHOPPING NOW
            </a>
        </section>
    </div>
</x-app-layout>
