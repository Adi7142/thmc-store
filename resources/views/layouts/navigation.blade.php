<nav x-data="{ open: false }" class="sticky top-0 z-50 border-b border-black/40 bg-[#1f1b1b]/95 backdrop-blur">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex items-center gap-10">
                <a href="{{ route('store.index') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/thmc-logo-128.webp') }}" alt="THMC" class="h-12 w-12 rounded-xl shadow-sm">
                    <div class="leading-tight">
                        <div class="font-extrabold tracking-tight text-white">THMC</div>
                        <div class="text-xs text-white/60 -mt-0.5">Minecraft Store</div>
                    </div>
                </a>

                <div class="hidden md:flex items-center gap-2 text-sm font-semibold">
                    <a href="{{ route('store.coins') }}" class="px-4 py-2 rounded-xl text-white/85 hover:bg-white/10 hover:text-white transition">Coins</a>
                    <a href="{{ route('store.bundles') }}" class="px-4 py-2 rounded-xl text-white/85 hover:bg-white/10 hover:text-white transition">Bundles</a>
                    <a href="{{ route('store.ranks') }}" class="px-4 py-2 rounded-xl text-white/85 hover:bg-white/10 hover:text-white transition">Ranks</a>
                    <a href="{{ route('store.keys') }}" class="px-4 py-2 rounded-xl text-white/85 hover:bg-white/10 hover:text-white transition">Crate Keys</a>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-3">
                <button
                    type="button"
                    @click="$dispatch('open-cart')"
                    class="relative px-4 py-2 rounded-2xl bg-white/10 border border-white/10 text-white hover:bg-white/15 transition font-semibold text-sm"
                >
                    Cart
                    @if(($cartDrawerCount ?? 0) > 0)
                        <span class="absolute -top-2 -right-2 h-6 min-w-6 px-1 rounded-full bg-emerald-500 text-white text-xs flex items-center justify-center">
                            {{ $cartDrawerCount }}
                        </span>
                    @endif
                </button>

                @auth
                    <a href="{{ route('orders.index') }}"
                       class="px-4 py-2 rounded-2xl bg-white/10 border border-white/10 text-white hover:bg-white/15 transition font-semibold text-sm">
                        My Orders
                    </a>

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 px-4 py-2 rounded-2xl bg-white/10 border border-white/10 text-white hover:bg-white/15 transition font-semibold text-sm">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.94a.75.75 0 111.08 1.04l-4.24 4.5a.75.75 0 01-1.08 0l-4.24-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                            <x-dropdown-link :href="route('orders.index')">My Orders</x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}"
                       class="px-5 py-3 rounded-xl thmc-btn-primary thmc-btn-blocky font-semibold text-sm transition">
                        Log in
                    </a>

                    @if(Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="px-4 py-2 rounded-2xl bg-white/10 border border-white/10 text-white hover:bg-white/15 transition font-semibold text-sm">
                            Register
                        </a>
                    @endif
                @endauth
            </div>

            <div class="flex items-center md:hidden">
                <button @click="open = ! open" class="p-2 rounded-xl text-white hover:bg-white/10">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" class="md:hidden border-t border-white/10 bg-[#1f1b1b]/95">
        <div class="px-4 py-3 space-y-2 text-sm font-semibold">
            <a href="{{ route('store.coins') }}" class="block px-3 py-2 rounded-xl text-white hover:bg-white/10">Coins</a>
            <a href="{{ route('store.bundles') }}" class="block px-3 py-2 rounded-xl text-white hover:bg-white/10">Bundles</a>
            <a href="{{ route('store.ranks') }}" class="block px-3 py-2 rounded-xl text-white hover:bg-white/10">Ranks</a>
            <a href="{{ route('store.keys') }}" class="block px-3 py-2 rounded-xl text-white hover:bg-white/10">Crate Keys</a>

            <button type="button" @click="$dispatch('open-cart'); open = false" class="w-full text-left block px-3 py-2 rounded-xl text-white hover:bg-white/10">
                Cart
            </button>

            @auth
                <a href="{{ route('orders.index') }}" class="block px-3 py-2 rounded-xl text-white hover:bg-white/10">My Orders</a>
            @endauth
        </div>
    </div>
</nav>
