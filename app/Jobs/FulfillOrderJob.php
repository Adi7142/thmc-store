<?php

namespace App\Jobs;

use App\Models\Store\StoreFulfillment;
use App\Models\Store\StoreOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class FulfillOrderJob implements ShouldQueue
{
    use Dispatchable, Queueable;

    public function __construct(public int $orderId) {}

    public function handle(): void
    {
        $order = StoreOrder::with('items')->findOrFail($this->orderId);

        $fulfillment = StoreFulfillment::firstOrCreate(
            ['order_id' => $order->id],
            ['status' => 'pending']
        );

        try {
            $commands = [];

            foreach ($order->items as $item) {
                $meta = $item->meta_snapshot ?? [];

                // Example: coins
                if (isset($meta['coin_amount'])) {
                    $commands[] = "eco give {$order->mc_username} {$meta['coin_amount']}";
                }

                // Example: rank
                if (isset($meta['rank_code'])) {
                    $commands[] = "lp user {$order->mc_username} parent add {$meta['rank_code']}";
                }

                // Example: crate keys
                if (isset($meta['key_amount'], $meta['crate'])) {
                    $commands[] = "crate givekey {$order->mc_username} {$meta['crate']} {$meta['key_amount']}";
                }

                // Example: bundles with predefined commands
                if (isset($meta['commands']) && is_array($meta['commands'])) {
                    foreach ($meta['commands'] as $cmd) {
                        $commands[] = str_replace('%player%', $order->mc_username, $cmd);
                    }
                }
            }

            // TODO: send $commands to your server via RCON or plugin API
            // For now: mark as sent and store payload for debugging
            $fulfillment->update([
                'status' => 'sent',
                'provider' => 'todo',
                'payload' => ['commands' => $commands],
                'delivered_at' => now(),
            ]);

            $order->update(['status' => 'fulfilled']);
        } catch (\Throwable $e) {
            $fulfillment->update([
                'status' => 'failed',
                'last_error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
}
