<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Jobs\FulfillOrderJob;
use App\Models\Store\StoreOrder;
use Illuminate\Http\Request;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->getContent();
        $sig = $request->header('Stripe-Signature');

        $secret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sig, $secret);
        } catch (\Throwable $e) {
            return response('Invalid signature', 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;

            $orderId = $session->metadata->order_id ?? null;
            if ($orderId) {
                $order = StoreOrder::with('items')->find($orderId);
                if ($order && $order->status === 'pending') {
                    $order->update([
                        'status' => 'paid',
                        'paid_at' => now(),
                        'payment_reference' => $session->id,
                    ]);

                    FulfillOrderJob::dispatch($order->id);
                }
            }
        }

        return response('ok', 200);
    }
}
