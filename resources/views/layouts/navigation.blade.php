<nav x-data="{ open: false }" class="sticky top-0 z-50 mc-panel border-x-0 border-t-0 rounded-none">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20 items-center gap-6">
            <div class="flex items-center gap-4 min-w-0">
                <a href="{{ route('store.index') }}" class="flex items-center gap-3 min-w-0">
                    <img src="{{ asset('images/thmc-logo-128.webp') }}" alt="THMC" class="h-12 w-12 pixelated">
                    <div class="leading-tight min-w-0">
                        <div class="font-bold tracking-tight text-white truncate">THMC</div>
                        <div class="text-xs text-white/75 -mt-0.5 truncate">Minecraft Store</div>
                    </div>
                </a>

                <div class="hidden lg:flex items-center gap-2">
                    <a href="{{ route('store.coins') }}" class="mc-btn mc-btn-secondary text-sm py-2 px-4">Coins</a>
                    <a href="{{ route('store.bundles') }}" class="mc-btn mc-btn-secondary text-sm py-2 px-4">Bundles</a>
                    <a href="{{ route('store.ranks') }}" class="mc-btn mc-btn-secondary text-sm py-2 px-4">Ranks</a>
                    <a href="{{ route('store.keys') }}" class="mc-btn mc-btn-secondary text-sm py-2 px-4">Keys</a>
                </div>
            </div>

            <div class="hidden lg:flex items-center gap-3">
                <button
                    type="button"
                    @click="$dispatch('open-cart')"
                    class="mc-btn mc-btn-primary relative text-sm py-2 px-4"
                >
                    Cart
                    @if(($cartDrawerCount ?? 0) > 0)
                        <span class="absolute -top-2 -right-2 h-6 min-w-6 px-1 rounded-full bg-red-500 text-white text-xs flex items-center justify-center border-2 border-black">
                            {{ $cartDrawerCount }}
                        </span>
                    @endif
                </button>

                @auth
                    <a href="{{ route('orders.index') }}" class="mc-btn mc-btn-secondary text-sm py-2 px-4">
                        My Orders
                    </a>

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="mc-btn mc-btn-secondary text-sm py-2 px-4 inline-flex items-center gap-2">
                                <span class="truncate max-w-[140px]">{{ Auth::user()->name }}</span>
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
                    <a href="{{ route('login') }}" class="mc-btn mc-btn-primary text-sm py-2 px-4">Log in</a>

                    @if(Route::has('register'))
                        <a href="{{ route('register') }}" class="mc-btn mc-btn-secondary text-sm py-2 px-4">Register</a>
                    @endif
                @endauth
            </div>

            <div class="flex items-center lg:hidden">
                <button @click="open = ! open" class="mc-btn mc-btn-secondary py-2 px-3">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" class="lg:hidden mc-panel border-x-0 border-b-0 rounded-none">
        <div class="max-w-7xl mx-auto px-4 py-4 space-y-3">
            <div class="grid grid-cols-2 gap-2">
                <a href="{{ route('store.coins') }}" class="mc-btn mc-btn-secondary text-sm py-2 px-4">Coins</a>
                <a href="{{ route('store.bundles') }}" class="mc-btn mc-btn-secondary text-sm py-2 px-4">Bundles</a>
                <a href="{{ route('store.ranks') }}" class="mc-btn mc-btn-secondary text-sm py-2 px-4">Ranks</a>
                <a href="{{ route('store.keys') }}" class="mc-btn mc-btn-secondary text-sm py-2 px-4">Keys</a>
            </div>

            <button type="button" @click="$dispatch('open-cart'); open = false" class="mc-btn mc-btn-primary w-full">
                Cart
            </button>

            @auth
                <a href="{{ route('orders.index') }}" class="mc-btn mc-btn-secondary w-full">My Orders</a>
            @endauth
        </div>
    </div>
</nav>
