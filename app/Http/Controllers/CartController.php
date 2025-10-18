<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct(
        private readonly CartService $cartService,
        private readonly ProductService $productService
    ) {}

    public function index(): View
    {
        $items    = $this->cartService->items();
        $products = $this->productService->findMany(array_keys($items));

        return view('guest-cart-index', [
            'products' => $products,
            'items'    => $items,
        ]);
    }

    public function add(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'qty'        => 'nullable|integer|min:1',
        ]);

        $this->cartService->add($validated['product_id'], $validated['qty'] ?? 1);

        return back()->with('success', 'Product added to cart');
    }

    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'qty'        => 'required|integer|min:0',
        ]);

        $this->cartService->update($validated['product_id'], $validated['qty']);

        return response()->json(['ok' => true]);
    }

    public function checkout(Request $request): RedirectResponse
    {
        $this->cartService->clear();

        return redirect()->route('guest.cart.index')->with('success', 'Order confirmed (simulation)');
    }
}
