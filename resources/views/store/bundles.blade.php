<x-app-layout>
    <x-slot name="header">
        <section class="thmc-category-hero thmc-category-bundles rounded-[2rem] p-6 sm:p-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="flex items-start gap-4">
                    <img src="{{ asset('images/items/chest.png') }}" class="w-14 h-14 pixelated" alt="Bundles">

                    <div>
                        <div class="thmc-mc-title text-[10px] sm:text-xs thmc-category-accent-bundles">
                            BUNDLES
                        </div>
                        <h1 class="mt-3 text-3xl sm:text-4xl font-extrabold text-slate-900">Treasure Bundles</h1>
                        <p class="mt-2 text-slate-700 max-w-2xl">
                            Get the best-value packs with coins, perks, keys and bonus rewards bundled together.
                        </p>

                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="thmc-category-chip">Best value</span>
                            <span class="thmc-category-chip">Starter friendly</span>
                            <span class="thmc-category-chip">Premium rewards</span>
                        </div>
                    </div>
                </div>

                <div class="thmc-panel rounded-[1.5rem] p-5 min-w-[260px]">
                    <div class="text-xs text-slate-500">Featured bundle</div>
                    <div class="mt-1 text-2xl font-extrabold thmc-category-accent-bundles">Starter Bundle</div>
                    <div class="mt-2 text-sm text-slate-600">A great way to jump into THMC with instant rewards.</div>
                </div>
            </div>

            <div class="mt-6 thmc-section-divider thmc-divider-bundles"></div>
        </section>
    </x-slot>

    @include('store._product_list', ['products' => $products])
</x-app-layout>
