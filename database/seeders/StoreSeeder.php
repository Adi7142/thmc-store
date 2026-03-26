<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store\StoreCategory;
use App\Models\Store\StoreProduct;
use App\Models\Store\StoreProductVariant;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */
        $coinsCategory = StoreCategory::firstOrCreate(
            ['slug' => 'coins'],
            ['name' => 'Coins']
        );

        $bundlesCategory = StoreCategory::firstOrCreate(
            ['slug' => 'bundles'],
            ['name' => 'Bundles']
        );

        $ranksCategory = StoreCategory::firstOrCreate(
            ['slug' => 'ranks'],
            ['name' => 'Ranks']
        );

        $keysCategory = StoreCategory::firstOrCreate(
            ['slug' => 'keys'],
            ['name' => 'Crate Keys']
        );

        /*
        |--------------------------------------------------------------------------
        | COINS
        |--------------------------------------------------------------------------
        */
        $coinsProduct = StoreProduct::updateOrCreate(
            ['slug' => 'server-coins'],
            [
                'category_id' => $coinsCategory->id,
                'name' => 'Server Coins',
                'description' => 'Use coins to buy upgrades, rewards, and special content in-game.',
                'type' => 'coins',
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        $this->createVariant($coinsProduct, '1,000 Coins', 299, [
            'coin_amount' => 1000,
        ]);

        $this->createVariant($coinsProduct, '2,500 Coins', 599, [
            'coin_amount' => 2500,
        ]);

        $this->createVariant($coinsProduct, '5,000 Coins', 999, [
            'coin_amount' => 5000,
        ]);

        $this->createVariant($coinsProduct, '10,000 Coins', 1799, [
            'coin_amount' => 10000,
        ]);

        $this->createVariant($coinsProduct, '25,000 Coins', 3499, [
            'coin_amount' => 25000,
        ]);

        /*
        |--------------------------------------------------------------------------
        | RANKS
        |--------------------------------------------------------------------------
        */
        $rankProduct = StoreProduct::updateOrCreate(
            ['slug' => 'server-ranks'],
            [
                'category_id' => $ranksCategory->id,
                'name' => 'Server Ranks',
                'description' => 'Unlock exclusive perks, tags, boosts, and more.',
                'type' => 'rank',
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        $this->createVariant($rankProduct, 'VIP Rank', 1299, [
            'rank_code' => 'vip',
        ]);

        $this->createVariant($rankProduct, 'Elite Rank', 2499, [
            'rank_code' => 'elite',
        ]);

        $this->createVariant($rankProduct, 'Legend Rank', 3999, [
            'rank_code' => 'legend',
        ]);

        $this->createVariant($rankProduct, 'Mythic Rank', 5999, [
            'rank_code' => 'mythic',
        ]);

        /*
        |--------------------------------------------------------------------------
        | CRATE KEYS
        |--------------------------------------------------------------------------
        */
        $legendaryKeysProduct = StoreProduct::updateOrCreate(
            ['slug' => 'legendary-keys'],
            [
                'category_id' => $keysCategory->id,
                'name' => 'Legendary Crate Keys',
                'description' => 'Open legendary crates for high-tier rewards.',
                'type' => 'key',
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        $this->createVariant($legendaryKeysProduct, '1 Key', 199, [
            'crate' => 'legendary',
            'key_amount' => 1,
        ]);

        $this->createVariant($legendaryKeysProduct, '5 Keys', 799, [
            'crate' => 'legendary',
            'key_amount' => 5,
        ]);

        $this->createVariant($legendaryKeysProduct, '10 Keys', 1499, [
            'crate' => 'legendary',
            'key_amount' => 10,
        ]);

        $mythicKeysProduct = StoreProduct::updateOrCreate(
            ['slug' => 'mythic-keys'],
            [
                'category_id' => $keysCategory->id,
                'name' => 'Mythic Crate Keys',
                'description' => 'Unlock the rarest and most valuable crate rewards.',
                'type' => 'key',
                'is_active' => true,
                'sort_order' => 2,
            ]
        );

        $this->createVariant($mythicKeysProduct, '1 Key', 349, [
            'crate' => 'mythic',
            'key_amount' => 1,
        ]);

        $this->createVariant($mythicKeysProduct, '3 Keys', 899, [
            'crate' => 'mythic',
            'key_amount' => 3,
        ]);

        $this->createVariant($mythicKeysProduct, '7 Keys', 1799, [
            'crate' => 'mythic',
            'key_amount' => 7,
        ]);

        /*
        |--------------------------------------------------------------------------
        | BUNDLES
        |--------------------------------------------------------------------------
        */
        $starterBundle = StoreProduct::updateOrCreate(
            ['slug' => 'starter-bundle'],
            [
                'category_id' => $bundlesCategory->id,
                'name' => 'Starter Bundle',
                'description' => 'Perfect bundle for new players starting their THMC journey.',
                'type' => 'bundle',
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        $this->createVariant($starterBundle, 'Starter Bundle', 2499, [
            'commands' => [
                'give %player% diamond 16',
                'eco give %player% 5000',
                'crate givekey %player% legendary 3',
            ],
        ]);

        $warriorBundle = StoreProduct::updateOrCreate(
            ['slug' => 'warrior-bundle'],
            [
                'category_id' => $bundlesCategory->id,
                'name' => 'Warrior Bundle',
                'description' => 'A combat-focused bundle with powerful rewards.',
                'type' => 'bundle',
                'is_active' => true,
                'sort_order' => 2,
            ]
        );

        $this->createVariant($warriorBundle, 'Warrior Bundle', 3999, [
            'commands' => [
                'give %player% diamond_sword 1',
                'give %player% golden_apple 16',
                'eco give %player% 10000',
                'crate givekey %player% legendary 5',
            ],
        ]);

        $kingBundle = StoreProduct::updateOrCreate(
            ['slug' => 'king-bundle'],
            [
                'category_id' => $bundlesCategory->id,
                'name' => 'King Bundle',
                'description' => 'Premium bundle for players who want the best start possible.',
                'type' => 'bundle',
                'is_active' => true,
                'sort_order' => 3,
            ]
        );

        $this->createVariant($kingBundle, 'King Bundle', 6999, [
            'commands' => [
                'give %player% netherite_ingot 16',
                'eco give %player% 25000',
                'crate givekey %player% mythic 10',
                'lp user %player% parent add vip',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | SPECIAL PRODUCT EXAMPLES
        |--------------------------------------------------------------------------
        */
        $seasonPass = StoreProduct::updateOrCreate(
            ['slug' => 'season-pass'],
            [
                'category_id' => $bundlesCategory->id,
                'name' => 'Season Pass',
                'description' => 'Unlock seasonal perks, bonus rewards, and exclusive extras.',
                'type' => 'bundle',
                'is_active' => true,
                'sort_order' => 4,
            ]
        );

        $this->createVariant($seasonPass, 'Season Pass', 1499, [
            'commands' => [
                'eco give %player% 3000',
                'crate givekey %player% legendary 2',
            ],
        ]);
    }

    private function createVariant(StoreProduct $product, string $name, int $priceCents, array $meta = []): void
    {
        StoreProductVariant::updateOrCreate(
            [
                'product_id' => $product->id,
                'name' => $name,
            ],
            [
                'price_cents' => $priceCents,
                'currency' => 'EUR',
                'meta' => $meta,
                'is_active' => true,
            ]
        );
    }
}
