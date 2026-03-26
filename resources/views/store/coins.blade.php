<x-app-layout>
    <x-slot name="header">
        <section class="thmc-category-hero thmc-category-coins rounded-[2rem] p-6 sm:p-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="flex items-start gap-4">
                    <img src="{{ asset('images/items/emerald.png') }}" class="w-14 h-14 pixelated" alt="Coins">

                    <div>
                        <div class="thmc-mc-title text-[10px] sm:text-xs thmc-category-accent-coins">
                            COINS SHOP
                        </div>
                        <h1 class="mt-3 text-3xl sm:text-4xl font-extrabold text-slate-900">Server Coins</h1>
                        <p class="mt-2 text-slate-700 max-w-2xl">
                            Stock up on coins and spend them on upgrades, rewards and exclusive content across THMC.
                        </p>

                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="thmc-category-chip">Fast delivery</span>
                            <span class="thmc-category-chip">Best value packs</span>
                            <span class="thmc-category-chip">Great for upgrades</span>
                        </div>
                    </div>
                </div>

                <div class="thmc-panel rounded-[1.5rem] p-5 min-w-[260px]">
                    <div class="text-xs text-slate-500">Popular pack</div>
                    <div class="mt-1 text-2xl font-extrabold thmc-category-accent-coins">10,000 Coins</div>
                    <div class="mt-2 text-sm text-slate-600">Perfect for players who want a strong start.</div>
                </div>
            </div>

            <div class="mt-6 thmc-section-divider thmc-divider-coins"></div>
        </section>
    </x-slot>

    @include('store._product_list', ['products' => $products])
</x-app-layout>
