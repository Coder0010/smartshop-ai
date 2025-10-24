<?php

namespace App\Services;

use App\Http\DataToObjects\ProductDto;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryContract;
use App\Repositories\Eloquents\ProductRepositoryEloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use MkamelMasoud\StarterCoreKit\Core\BaseDto;
use MkamelMasoud\StarterCoreKit\Core\BaseService;

/**
 * @extends BaseService<
 *     ProductRepositoryContract,
 *     ProductDto,
 *     Product
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

    protected function beforeDeleteAction(Model $model): void
    {
        /** @var Product $model */
        $path = $model->getRawOriginal('image');

        if (is_string($path) && $path !== '' && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
