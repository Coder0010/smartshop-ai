<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class RecommendationService
{
    public function __construct(
        protected AiClientService $ai,
        protected ProductService $productService
    ) {}

    /**
     * Generate AI-based recommendations or fallback to random.
     *
     * @param  array<int>  $lastViewedIds  Last viewed product IDs (from session)
     * @param  int|null  $limit  Number of recommendations to return
     * @return Collection<int, Product>
     */
    public function recommend(array $lastViewedIds = [], ?int $limit = null): Collection
    {
        $limit = $limit ?? config('app.recommendation_limit', 3);

        if ($lastViewedIds === []) {
            return $this->productService->inRandomOrder($limit);
        }

        $cacheKey = 'ai_recommend:' . implode('-', $lastViewedIds);
        $ttl      = now()->addMinutes(10);

        return Cache::remember($cacheKey, $ttl, function () use ($lastViewedIds, $limit) {
            $products = $this->productService->findMany($lastViewedIds);

            $names  = $products->pluck('name')->implode(', ');
            $prompt = <<<PROMPT
User recently viewed these products: {$names}.
Suggest {$limit} similar product names from our catalog.
Return only the names, separated by commas.
PROMPT;

            $response = $this->ai->getRecommendations($prompt);

            if (is_string($response) && $response !== '') {
                $names = collect(explode(',', $response))
                    ->map(fn ($n) => trim($n))
                    ->filter()
                    ->take($limit);

                if ($names->isNotEmpty()) {
                    $matched = $this->productService->search($names->toArray());
                    if ($matched->isNotEmpty()) {
                        return $matched;
                    }
                }
            }

            return $this->productService->inRandomOrder($limit);
        });
    }
}
