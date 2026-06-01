<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4">
            <div class="flex items-start gap-4">
                <img src="{{ asset('images/items/tripwire_hook.png') }}" class="h-14 w-14 pixelated" alt="Crate Keys">
                <div>
                    <div class="mc-title-small text-white/70">CRATE KEYS</div>
                    <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold text-white">Crate Keys</h1>
                    <p class="mt-3 text-white/80 max-w-2xl leading-6">
                        Open crates and unlock rare, legendary and mythical rewards across the server.
                    </p>
                </div>
            </div>

            <!-- Urgency Banner -->
            <div class="mc-menu-card border-t-4 border-t-orange-400 mc-floating" style="animation-delay: 0.3s">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="font-bold text-orange-300">🔑 KEY SPECIAL</div>
                        <div class="text-sm text-white/80 mt-1">Buy 5+ keys and get a guaranteed Mythic loot! Offer expires in 2 days.</div>
                    </div>
                    <div class="text-right">
                        <div class="text-2xl font-extrabold text-orange-400">LAST CHANCE!</div>
                    </div>
                </div>
            </div>

            <div class="mc-divider"></div>
        </div>
    </x-slot>

    @include('store._product_list', ['products' => $products])
</x-app-layout>
