<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;
use MkamelMasoud\StarterCoreKit\Repositories\Contracts\BaseRepositoryContract;

interface ProductRepositoryContract extends BaseRepositoryContract
{
    public function findMany(array $ids): Collection;

    public function allRandom(int $count = 3): Collection;

    public function search(string $q, int $limit = 24): Collection;
}
