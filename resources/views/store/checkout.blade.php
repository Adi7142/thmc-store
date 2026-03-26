<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="text-slate-900 text-xl font-bold">Checkout</div>
            <div class="text-slate-600 text-sm">Enter your Minecraft username for delivery.</div>
        </div>
    </x-slot>

    @if($errors->any())
        <div class="mb-4 thmc-surface rounded-2xl p-4 border border-red-200">
            <div class="text-red-700 font-medium">{{ $errors->first() }}</div>
        </div>
    @endif

    @if(empty($lines))
        <div class="thmc-surface rounded-[2rem] p-8 text-slate-600">
            Your cart is empty.
            <div class="mt-4">
                <a class="text-cyan-700 hover:text-cyan-600 underline" href="{{ route('store.index') }}">Back to store</a>
            </div>
        </div>
    @else
        <div class="grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 thmc-surface rounded-[2rem] p-6">
                <div class="text-slate-900 text-lg font-bold">Delivery details</div>
                <div class="mt-1 text-sm text-slate-600">Make sure the username is correct.</div>

                <form method="POST" action="{{ route('checkout.create') }}" class="mt-6 space-y-4">
                    @csrf

                    <div>
                        <label class="block text-sm text-slate-700 mb-2">Minecraft username</label>
                        <input name="mc_username" required minlength="3" maxlength="16"
                               class="w-full rounded-2xl bg-white border border-slate-200 px-4 py-3 text-slate-900 focus:outline-none focus:ring-2 focus:ring-cyan-300"
                               placeholder="YourMinecraftName"
                               value="{{ old('mc_username') }}">
                        <div class="mt-2 text-xs text-slate-500">
                            Your purchase will be delivered to this player in-game.
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm text-slate-700 mb-2">Coupon (optional)</label>
                        <input name="coupon"
                               class="w-full rounded-2xl bg-white border border-slate-200 px-4 py-3 text-slate-900 focus:outline-none focus:ring-2 focus:ring-cyan-300"
                               placeholder="CODE"
                               value="{{ old('coupon') }}">
                    </div>

                    <button class="w-full sm:w-auto px-6 py-3 rounded-2xl thmc-btn-primary font-semibold transition">
                        Create order
                    </button>
                </form>
            </div>

            <div class="thmc-surface rounded-[2rem] p-6 h-fit">
                <div class="text-slate-900 text-lg font-bold">Order summary</div>
                <div class="mt-4 space-y-2 text-sm">
                    @foreach($lines as $row)
                        <div class="flex justify-between gap-3 text-slate-600">
                            <span class="truncate">
                                {{ $row['variant']->product->name }} (x{{ $row['qty'] }})
                            </span>
                            <span class="text-slate-900 font-semibold">€{{ number_format($row['line']/100, 2) }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5 border-t border-slate-200 pt-4 flex justify-between text-slate-600">
                    <span>Subtotal</span>
                    <span class="text-slate-900 font-semibold">€{{ number_format($subtotal_cents/100, 2) }}</span>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
