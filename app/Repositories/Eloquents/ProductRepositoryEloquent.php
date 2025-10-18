<?php

namespace App\Repositories\Eloquents;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryContract;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use MkamelMasoud\StarterCoreKit\Repositories\BaseEloquentRepository;

class ProductRepositoryEloquent extends BaseEloquentRepository implements ProductRepositoryContract
{
    /**
     * Return the fully qualified model class name.
     */
    public function entity(): string
    {
        return Product::class;
    }

    public function findMany(array $ids): Collection
    {
        return $this->entity->whereIn('id', $ids)->get();
    }

    public function search(string $q, int $limit = 24): Collection
    {
        if (trim($q) === '') {
            return $this->entity->orderBy('id', 'desc')
                ->take($limit)
                ->get();
        }

        return $this->entity->where('name', 'like', "%{$q}%")
            ->limit($limit)
            ->get();
    }

    public function allRandom(int $count = 3): Collection
    {
        return $this->entity->inRandomOrder()->limit($count)->get();
    }

    public function paginate(int $limit = 15): LengthAwarePaginator
    {
        return $this->entity->paginate($limit);
    }
}
