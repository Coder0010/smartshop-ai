<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CartService
{
    private const KEY = 'cart.items';

    public function add(int $productId, int $qty = 1): void
    {
        /** @var array<int, int> $cart */
        $cart = Session::get(self::KEY, []);

        $cart[$productId] = ($cart[$productId] ?? 0) + max(1, $qty);

        Session::put(self::KEY, $cart);
    }

    public function update(int $productId, int $qty): void
    {
        /** @var array<int, int> $cart */
        $cart = Session::get(self::KEY, []);

        if ($qty <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $qty;
        }

        Session::put(self::KEY, $cart);
    }

    /**
     * Get all cart items.
     *
     * @return array<int, int> Product IDs mapped to quantities.
     */
    public function items(): array
    {
        return Session::get(self::KEY, []);
    }

    public function clear(): void
    {
        Session::forget(self::KEY);
    }
}
