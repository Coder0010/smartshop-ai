<?php

namespace App\Http\PipeLines\Product;

use App\Models\Product;
use App\Services\ProductService;
use Closure;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

readonly class LoadLastViewedProductsPipeLine
{
    public function __construct(private ProductService $productService) {}

    /**
     * Handle the pipeline logic for loading last viewed products.
     *
     * @param  array{0: Request, 1: int, 2: int, 3: Collection<int,int>}  $payload
     * @param  Closure(array{
     *     0: Request,
     *     1: int,
     *     2: int,
     *     3: Collection<int,int>,
     *     4: EloquentCollection<int,Product>
     * }): mixed  $next
     */
    public function handle(array $payload, Closure $next): mixed
    {
        [$request, $id, $limit, $lastViewedIds] = $payload;

        $lastViewedProducts = $this->productService
            ->findMany(
                $lastViewedIds
                    ->reject(fn ($pid) => $pid == $id)
                    ->all()
            )
            ->sortBy(fn ($p) => array_search($p->id, $lastViewedIds->toArray(), true))
            ->values();

        return $next([$request, $id, $limit, $lastViewedIds, $lastViewedProducts]);
    }
}
