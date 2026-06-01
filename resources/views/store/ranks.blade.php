<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4">
            <div class="flex items-start gap-4">
                <img src="{{ asset('images/items/diamond.png') }}" class="h-14 w-14 pixelated" alt="Ranks">
                <div>
                    <div class="mc-title-small text-white/70">RANKS SYSTEM</div>
                    <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold text-white">Server Ranks</h1>
                    <p class="mt-3 text-white/80 max-w-2xl leading-6">
                        Unlock exclusive tags, perks and prestige with rank upgrades tailored for every type of player.
                    </p>
                </div>
            </div>

            <!-- Urgency Banner -->
            <div class="mc-menu-card border-t-4 border-t-cyan-400 mc-floating" style="animation-delay: 0.2s">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="font-bold text-cyan-300">👑 RANK BOOST</div>
                        <div class="text-sm text-white/80 mt-1">New ranks added! Only 12 players at Elite rank — claim yours today!</div>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-extrabold text-cyan-400">LIMITED SLOTS</div>
                    </div>
                </div>
            </div>

            <div class="mc-divider"></div>
        </div>
    </x-slot>

    @include('store._product_list', ['products' => $products])
</x-app-layout>
