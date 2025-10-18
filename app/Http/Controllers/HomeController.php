<?php

namespace App\Http\Controllers;

use App\Services\AIRecommendService;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        private readonly ProductService $productService,
        //        private readonly AIRecommendService $aiService,
    ) {}

    public function __invoke(Request $request): View
    {
        $searchQuery = trim((string) $request->query('q', ''));

        $products = $this->getProducts($searchQuery);

        return view('home', [
            'products'        => $products,
            'recommendations' => $recommendations ?? [],
            'searchQuery'     => $searchQuery,
        ]);
    }

    /**
     * Get products based on search query or paginate by default.
     */
    private function getProducts(string $searchQuery): mixed
    {
        if ($searchQuery === '') {
            // You could add caching here to reduce DB hits for the home page
            return $this->productService->allPaginated();
        }

        return $this->productService->search($searchQuery);
    }
}
