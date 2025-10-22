<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use MkamelMasoud\StarterCoreKit\Traits\Support\SupportCacheTrait;

class RecommendationService
{
    use SupportCacheTrait;

    public function __construct(
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

        $cacheKey = 'ai-recommend:' . implode('-', $lastViewedIds);
        $callable = function () use ($lastViewedIds, $limit) {
            $products = $this->productService->findMany($lastViewedIds);
            $names    = $products->pluck('name')->implode(', ');
            $response = app('ai-client')->ask(
                prompt: $this->getPromptMessage(
                    search: $names,
                    limit: $limit
                ),
                options: [
                    'system_prompt' => 'You are a helpful e-commerce recommender assistant.',
                ]
            );
            if (is_string($response) && $response !== '') {
                $names = collect(explode(',', $response))
                    ->map(fn ($n) => trim($n))
                    ->filter()
                    ->take($limit);

                if ($names->isNotEmpty()) {
                    $matched = $this->productService->search(
                        filters: [
                            'name' => $names->toArray(),
                        ]
                    );
                    if ($matched->isNotEmpty()) {
                        return $matched;
                    }
                }
            }

            return $this->productService->inRandomOrder($limit);
        };

        return $this->cacheRemember(
            table: 'products',
            cacheKey: $cacheKey,
            callBack: $callable
        );
    }

    private function getPromptMessage(string $search, int $limit = 3): string
    {
        return <<<PROMPT
User recently viewed these products: {$search}.
Suggest {$limit} similar product names from our catalog.
Return only the names, separated by commas.
PROMPT;
    }
}
