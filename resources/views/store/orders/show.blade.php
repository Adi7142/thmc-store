<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="text-slate-900 text-xl font-bold">Order #{{ $order->id }}</div>
            <div class="text-slate-600 text-sm">Payment and delivery details.</div>
        </div>
    </x-slot>

    @if(session('success'))
        <div class="mb-4 thmc-surface rounded-2xl p-4 border border-emerald-200">
            <div class="text-emerald-700 font-medium">{{ session('success') }}</div>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 thmc-surface rounded-2xl p-4 border border-red-200">
            <div class="text-red-700 font-medium">{{ $errors->first() }}</div>
        </div>
    @endif

    @php
        $badge = match($order->status) {
            'paid' => 'bg-emerald-50 border-emerald-200 text-emerald-700',
            'fulfilled' => 'bg-cyan-50 border-cyan-200 text-cyan-700',
            'failed' => 'bg-red-50 border-red-200 text-red-700',
            default => 'bg-slate-50 border-slate-200 text-slate-700',
        };
    @endphp

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-4">
            <div class="thmc-surface rounded-[2rem] p-6">
                <div class="flex items-center justify-between gap-4">
                    <div class="text-slate-900 font-bold text-lg">Order info</div>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $badge }}">
                        {{ strtoupper($order->status) }}
                    </span>
                </div>

                <div class="mt-4 text-sm text-slate-700 space-y-2">
                    <div>MC Username: <span class="text-slate-900 font-semibold">{{ $order->mc_username }}</span></div>
                    <div>Total: <span class="text-slate-900 font-semibold">€{{ number_format($order->total_cents/100, 2) }}</span></div>
                    @if($order->paid_at)
                        <div>Paid at: <span class="text-slate-900 font-semibold">{{ $order->paid_at->format('Y-m-d H:i') }}</span></div>
                    @endif
                </div>

                @if($order->status === 'pending')
                    <form method="POST" action="{{ route('checkout.pay', $order) }}" class="mt-6">
                        @csrf
                        <button class="px-6 py-3 rounded-2xl thmc-btn-primary font-semibold transition">
                            Pay with card
                        </button>
                    </form>
                @endif
            </div>

            <div class="thmc-surface rounded-[2rem] p-6">
                <div class="text-slate-900 font-bold text-lg mb-4">Items</div>
                <div class="space-y-3">
                    @foreach($order->items as $item)
                        <div class="flex items-center justify-between gap-4 border-b border-slate-200 pb-3">
                            <div class="text-slate-700 min-w-0">
                                <div class="font-semibold text-slate-900">{{ $item->name_snapshot }}</div>
                                <div class="text-xs text-slate-500">x{{ $item->qty }}</div>
                            </div>
                            <div class="text-slate-900 font-semibold">
                                €{{ number_format($item->line_total_cents/100, 2) }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="thmc-surface rounded-[2rem] p-6 h-fit">
            <div class="text-slate-900 font-bold text-lg">Totals</div>
            <div class="mt-4 space-y-2 text-sm text-slate-700">
                <div class="flex justify-between">
                    <span>Subtotal</span>
                    <span class="text-slate-900">€{{ number_format($order->subtotal_cents/100, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span>Discount</span>
                    <span class="text-slate-900">€{{ number_format($order->discount_cents/100, 2) }}</span>
                </div>
                <div class="border-t border-slate-200 pt-3 flex justify-between font-semibold">
                    <span class="text-slate-800">Total</span>
                    <span class="text-slate-900">€{{ number_format($order->total_cents/100, 2) }}</span>
                </div>
            </div>

            <div class="mt-6">
                <a class="text-cyan-700 hover:text-cyan-600 underline" href="{{ route('orders.index') }}">Back to orders</a>
            </div>
        </div>
    </div>
</x-app-layout>
