<?php

namespace App\Repositories\Eloquents;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryContract;
use MkamelMasoud\StarterCoreKit\Core\Repositories\BaseEloquentRepository;

/**
 * @extends BaseEloquentRepository<Product>
 */
class ProductRepositoryEloquent extends BaseEloquentRepository implements ProductRepositoryContract
{
    protected function entity(): string
    {
        return Product::class;
    }
}
