<?php

namespace App\Http\Controllers;

use App\Http\PipeLines\Product\LoadLastViewedProductsPipeLine;
use App\Http\PipeLines\Product\StoreLastViewedInSessionPipeLine;
use App\Services\ProductService;
use App\Services\RecommendationService;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService,
        private readonly RecommendationService $recommendationService,
        private readonly Pipeline $pipeline
    ) {}

    public function show(Request $request, int $id): View
    {
        $product = $this->productService->findOrFail($id);
        $limit   = config('app.recommendation_limit', 3);

        [$request, $id, $limit, $lastViewedIds, $lastViewedProducts] = $this->pipeline
            ->send([$request, $id, $limit])
            ->through([
                StoreLastViewedInSessionPipeLine::class,
                LoadLastViewedProductsPipeLine::class,
            ])
            ->thenReturn();

        $recommendations = $this->recommendationService->recommend(
            $lastViewedProducts->pluck('id')->toArray(),
            $limit
        );

        return view('guest-product-show', [
            'product'         => $product,
            'recommendations' => $recommendations,
            'lastViewed'      => $lastViewedProducts,
        ]);
    }

    public function oldShow(Request $request, int $id): View
    {
        $product = $this->productService->findOrFail($id);

        $limit = config('app.recommendation_limit', 3);

        $lastViewedIds = collect((array) $request->session()->get('last_viewed', []))
            ->filter(fn ($pid) => is_numeric($pid))
            ->reject(fn ($pid) => $pid == $id)
            ->prepend($id)
            ->unique()
            ->take($limit)
            ->values();

        $request->session()->put('last_viewed', $lastViewedIds->all());

        $lastViewedProducts = $this->productService
            ->findMany($lastViewedIds->reject(fn ($pid) => $pid == $id)->all())
            ->sortBy(fn ($p) => array_search($p->id, $lastViewedIds->toArray(), true))
            ->values();

        $recommendations = $this->recommendationService->recommend(
            $lastViewedProducts->pluck('id')->toArray(),
            $limit
        );

        return view('guest-product-show', [
            'product'         => $product,
            'recommendations' => $recommendations,
            'lastViewed'      => $lastViewedProducts,
        ]);
    }
}
