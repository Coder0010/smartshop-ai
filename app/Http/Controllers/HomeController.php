<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use App\Services\RecommendationService;
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
        $filters = $request->validate([
            'name'  => 'nullable|string',
            'price' => 'nullable|string',
        ]);
        $filters = array_filter(
            $filters,
            fn ($value) => $value !== null && $value !== ''
        );
        //        dd($filters);
        $products = $this->productService->fetchData(
            filters: $filters,
            dataTypeReturn: 'paginate'
        );

        $limit           = config('app.recommendation_limit', 3);
        $lastViewedIds   = collect((array) $request->session()->get('last_viewed', []))->take($limit);
        $recommendations = $this->recommendationService->recommend($lastViewedIds->toArray(), $limit);

        return view('home', [
            'products'        => $products,
            'recommendations' => $recommendations,
        ]);
    }
}
