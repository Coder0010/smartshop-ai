<?php

namespace App\Services;

use App\Http\DataToObjects\ProductDto;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Repositories\Eloquents\ProductRepositoryEloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use MkamelMasoud\StarterCoreKit\Core\BaseDto;
use MkamelMasoud\StarterCoreKit\Core\BaseService;

/**
 * @extends BaseService<
 *        ProductRepositoryContract,
 *        ProductDto
 *   >
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
        if ($model->file !== null && Storage::disk('public')->exists($model->file)) {
            Storage::disk('public')->delete($model->file);
        }
    }

    public function getById(int $id): Model
    {
        return $this->findOrFail($id);
    }

    public function search(string $q, int $limit = 24): Collection
    {
        return $this->repository->search($q, $limit);
    }

    public function random(int $count = 3): Collection
    {
        return $this->repository->allRandom($count);
    }

    public function findMany(array $ids): Collection
    {
        return $this->repository->findMany($ids);
    }
}
