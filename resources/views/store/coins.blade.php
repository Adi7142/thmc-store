<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4">
            <div class="flex items-start gap-4">
                <img src="{{ asset('images/items/emerald.png') }}" class="h-14 w-14 pixelated" alt="Coins">
                <div>
                    <div class="mc-title-small text-white/70">COINS SHOP</div>
                    <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold text-white">Server Coins</h1>
                    <p class="mt-3 text-white/80 max-w-2xl leading-6">
                        Stock up on coins and spend them on upgrades, rewards and exclusive content across THMC.
                    </p>
                </div>
            </div>

            <!-- Urgency Banner -->
            <div class="mc-menu-card border-t-4 border-t-yellow-400 mc-floating" style="animation-delay: 0s">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="font-bold text-yellow-300">⚡ LIMITED TIME OFFER</div>
                        <div class="text-sm text-white/80 mt-1">Get 15% bonus coins on all purchases this week!</div>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-extrabold text-yellow-300">4 DAYS LEFT</div>
                    </div>
                </div>
            </div>

            <div class="mc-divider"></div>
        </div>
    </x-slot>

    @include('store._product_list', ['products' => $products])
</x-app-layout>
