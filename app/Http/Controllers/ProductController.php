<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(private readonly ProductService $productService) {}

    public function show(Request $request, int $id): View
    {
        $product = $this->productService->getById($id);

        // update session
        $last   = $request->session()->get('last_viewed', []);
        $last   = array_values(array_filter($last, fn ($v) => $v !== $product->id));
        $last[] = $product->id;
        $last   = array_slice($last, -3);
        $request->session()->put('last_viewed', $last);

        // fetch recommendations
        $lastViewed = $this->productService->findMany($last);
        //        $recommendations = app(\App\Services\AIRecommendService::class)
        //            ->recommendFromProducts($lastViewed->toArray(), 3);

        return view('guest-product-show', [
            'product' => $product,
            //            'recommendations' => $recommendations,
            'lastViewed' => $lastViewed,
        ]);
    }
}
