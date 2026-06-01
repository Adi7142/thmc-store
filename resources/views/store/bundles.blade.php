<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4">
            <div class="flex items-start gap-4">
                <img src="{{ asset('images/items/chest.png') }}" class="h-14 w-14 pixelated" alt="Bundles">
                <div>
                    <div class="mc-title-small text-white/70">TREASURE BUNDLES</div>
                    <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold text-white">Treasure Bundles</h1>
                    <p class="mt-3 text-white/80 max-w-2xl leading-6">
                        Get the best-value packs with coins, perks, keys and bonus rewards bundled together.
                    </p>
                </div>
            </div>

            <!-- Urgency Banner -->
            <div class="mc-menu-card border-t-4 border-t-purple-400 mc-floating" style="animation-delay: 0.1s">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="font-bold text-purple-300">✨ BUNDLE BONUS</div>
                        <div class="text-sm text-white/80 mt-1">Save up to 25% by bundling coins, ranks and keys together!</div>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-extrabold text-purple-400">ENDS SOON</div>
                    </div>
                </div>
            </div>

            <div class="mc-divider"></div>
        </div>
    </x-slot>

    @include('store._product_list', ['products' => $products])
</x-app-layout>
