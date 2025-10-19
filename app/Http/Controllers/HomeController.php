<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use App\Services\RecommendationService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        private readonly ProductService $productService,
        private readonly RecommendationService $recommendationService
    ) {}

    public function __invoke(Request $request): View
    {
        $searchQuery = trim((string) $request->query('q', ''));
        $products    = $this->getProducts($searchQuery);
        $limit       = config('app.recommendation_limit', 3);

        $lastViewedIds = collect((array) $request->session()->get('last_viewed', []))->take($limit);

        $recommendations = $this->recommendationService->recommend($lastViewedIds->toArray(), $limit);

        return view('home', [
            'products'        => $products,
            'recommendations' => $recommendations,
            'searchQuery'     => $searchQuery,
        ]);
    }

    /**
     * Retrieve paginated or searched products.
     *
     * @return LengthAwarePaginator<int, Product>|EloquentCollection<int, Product>
     */
    private function getProducts(string $searchQuery): LengthAwarePaginator|EloquentCollection
    {
        return $searchQuery === ''
            ? $this->productService->allPaginated()
            : $this->productService->search($searchQuery);
    }
}
