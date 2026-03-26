<x-app-layout>
    <x-slot name="header">
        <div>
            <div class="text-slate-900 text-xl font-bold">My Orders</div>
            <div class="text-slate-600 text-sm">Track payments and delivery status.</div>
        </div>
    </x-slot>

    <div class="space-y-4">
        @forelse($orders as $order)
            <a class="block thmc-surface rounded-[2rem] p-5 hover:border-cyan-300 transition"
               href="{{ route('orders.show', $order) }}">
                <div class="flex items-center justify-between gap-4">
                    <div class="min-w-0">
                        <div class="text-slate-900 font-bold text-lg">Order #{{ $order->id }}</div>
                        <div class="text-sm text-slate-600 mt-1">
                            MC: {{ $order->mc_username }} • Total: €{{ number_format($order->total_cents/100, 2) }}
                        </div>
                    </div>

                    @php
                        $badge = match($order->status) {
                            'paid' => 'bg-emerald-50 border-emerald-200 text-emerald-700',
                            'fulfilled' => 'bg-cyan-50 border-cyan-200 text-cyan-700',
                            'failed' => 'bg-red-50 border-red-200 text-red-700',
                            default => 'bg-slate-50 border-slate-200 text-slate-700',
                        };
                    @endphp

                    <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $badge }}">
                        {{ strtoupper($order->status) }}
                    </span>
                </div>
            </a>
        @empty
            <div class="thmc-surface rounded-[2rem] p-8 text-slate-600">
                No orders yet.
            </div>
        @endforelse

        <div class="mt-6">{{ $orders->links() }}</div>
    </div>
</x-app-layout>
