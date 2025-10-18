<?php

namespace App\Services;

use App\Http\DataToObjects\ProductDto;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Repositories\Eloquents\ProductRepositoryEloquent;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use MkamelMasoud\StarterCoreKit\Core\BaseDto;
use MkamelMasoud\StarterCoreKit\Core\BaseService;

/**
 * @extends BaseService<
 *     ProductRepositoryContract,
 *     ProductDto
 * >
 *
 * @property ProductRepositoryEloquent $repository
 */
class ProductService extends BaseService
{
    public function __construct(ProductRepositoryContract $repository)
    {
        $this->validateRepo($repository);
        parent::__construct($repository);
    }

    protected function getRepoClass(): string
    {
        return ProductRepositoryContract::class;
    }

    protected function getDtoClass(): string
    {
        return ProductDto::class;
    }

    protected function beforeSaveAction(BaseDto $dto, ?string $existingFile = null): BaseDto
    {
        /** @var ProductDto $dto */
        $dto->image = $this->handleFileUpload($dto->image, $existingFile);

        return $dto;
    }

    protected function beforeDelete(Model $model): void
    {
        /** @var Product $model */
        $path = $model->getRawOriginal('image');

        if (is_string($path) && $path !== '' && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    public function getById(int $id): Model
    {
        return $this->repository->find($id);
    }

    /**
     * Search products by keyword.
     *
     * @return EloquentCollection<int, Product>
     */
    public function search(string $q, int $limit = 24): EloquentCollection
    {
        return $this->repository->search($q, $limit);
    }

    /**
     * Get random products.
     *
     * @return EloquentCollection<int, Product>
     */
    public function random(int $count = 3): EloquentCollection
    {
        return $this->repository->allRandom($count);
    }

    /**
     * Find multiple products by their IDs.
     *
     * @param  array<int>  $ids
     * @return EloquentCollection<int, Product>
     */
    public function findMany(array $ids): EloquentCollection
    {
        return $this->repository->findMany($ids);
    }
}
